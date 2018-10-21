<?php
namespace AztecGameStudios\controllers;

use AztecGameStudios\exceptions\NotFoundException;
use AztecGameStudios\models\PlayerModel;

class RegisterController extends AbstractController {

    public function get(): string {
        $properties = ['Message' => 'Register Controller'];
        return $this->render('register.twig',$properties);
    }

    public function register(): string {
        if (!$this->request->isPost()) {
            return $this->render('register.twig', []);
        }

        $params = $this->request->getParams();
        $playerModel = new PlayerModel($this->db);
        $playerModel -> insert();
        
        session_start();
        $_SESSION["isAuthenticated"] = "true";
        $_SESSION["Session_start_time"] = date("m-d-Y h:i:s");


        $properties =  ['Message' => 'Register Controller says - Welcome '
                    ];
                        
        return $this->render('main.twig',$properties);
    }
}