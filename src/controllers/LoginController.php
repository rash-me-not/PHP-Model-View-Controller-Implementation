<?php
namespace AztecGameStudios\controllers;

use AztecGameStudios\exceptions\NotFoundException;
use AztecGameStudios\models\PlayerModel;

class LoginController extends AbstractController {

    public function get(): string {
        $properties = ['Message' => 'Login Controller'];
        return $this->render('main.twig',$properties);
    }

    public function login(): string {
        if (!$this->request->isPost()) {
            return $this->render('login.twig', []);
        }

        $params = $this->request->getParams();

// If username is not present in database
        if (!$params->has('username')) {
            $params = ['errorMessage' => 'No info provided.', 'BASE_URL' => $_SERVER['SERVER_NAME']  ];
            $this->page = $this->render('login.twig', $params);
            header($this->page);
        }   
// Retrieve the username and start a session for the user
        $username = $params->getString('username');
        
        $playerModel = new PlayerModel($this->db);

        try {
            $player = $playerModel->getbyUsername($username);
        } catch (NotFoundException $e) {
            $this->log->warn('Player username not found: ' . $username);
            $params = ['errorMessage' => 'Username not found.'];
            return $this->render('login.twig', $params);
            
        }
        if( $params -> getString('password' == $player->getPassword()))

        session_start();
        $_SESSION["screenName"] = $player->getScreenName();
        $_SESSION["isAuthenticated"] = "true";
        $_SESSION["Session_start_time"] = date("m-d-Y h:i:s");

        setcookie('user', $player->getPlayerID());

        $properties =  ['Message' => 'Login Controller says - Welcome '.$player->getFirstName() ,
                        'Player ' => $player,
                        'Session' => $_SESSION,
                        'BASE_URL' => $_SERVER['SERVER_NAME'] 
                    ];
                        
        return $this->render('main.twig',$properties);
    }
}