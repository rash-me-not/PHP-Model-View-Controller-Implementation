<?php

namespace AztecGameStudios\core;

use AztecGameStudios\controllers\ErrorController;
use AztecGameStudios\controllers\LoginController;

class Router {
    private $routeMap;
    private static $regexPatters = [
        'number' => '\d+',
        'string' => '\w'
    ];

    public function __construct() {
        $json = file_get_contents(
            __DIR__ . '/../../config/routes.json'
        );
        $this->routeMap = json_decode($json, true);
    }

    public function route(Requests $request): string {
        $path = $request->getPath();

        foreach ($this->routeMap as $route => $info) {
            $regexRoute = $this->getRegexRoute($route, $info);
            if (preg_match("@^$regexRoute$@", $path)) {
                return $this->executeController(
                    $route, $path, $info, $request
                );
            }
        }

        
        $errorController = new ErrorController($request);
        return $errorController->notFound();
    }

        private function getRegexRoute(
            string $route,
            array $info
        ): string {
            if (isset($info['params'])) {
                foreach ($info['params'] as $name => $type) {
                    $route = str_replace(
                        ':' . $name, self::$regexPatters[$type], $route
                    );
                }
            }
        
            return $route;
        }

        private function extractParams(
            string $route,
            string $path
        ): array {
            $params = [];
        
            $pathParts = explode('/', $path);
            $routeParts = explode('/', $route);
        
            foreach ($routeParts as $key => $routePart) {
                if (strpos($routePart, ':') === 0) {
                    $name = substr($routePart, 1);
                    $params[$name] = $pathParts[$key+1];
                }
            }
        
            return $params;
        }

        private function executeController(
            string $route,
            string $path,
            array $info,
            Requests $request
        ): string {
            $controllerName = '\AztecGameStudios\controllers\\'
                . $info['controller'] . 'Controller';
            $controller = new $controllerName($request);
        
            // if (isset($info['login']) && $info['login']) {
                if ($info['method'] == 'login') {
                if ($request->getCookies()->has('user')) {
                    $playerId = $request->getCookies()->get('user');
                    $controller->setCustomerId($playerId);
                } else {
                    $errorController = new LoginController($request);
                    return $errorController->login();
                }
            }
        
            $params = $this->extractParams($route, $path);
            return call_user_func_array(
                [$controller, $info['method']], $params
            );
        }


    
}