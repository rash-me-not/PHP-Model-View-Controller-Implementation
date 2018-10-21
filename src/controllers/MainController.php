<?php
namespace AztecGameStudios\controllers;

class MainController extends AbstractController {

    public function get(): string {
        $properties = ['Message' => 'Main page Hello World!'];
        return $this-> render('login.twig',$properties);
    }

    //About Controller
    public function about(): string {
        $properties = ['Message' => 'Main::About() page Hello World!'];
        return $this-> render('about.twig',[]);
    }

    //Game Release Controller
    public function game_release(): string {
        $today = time();

        //B: RECORDS Date And Time OF YOUR EVENT
        $event = mktime(14,30,0,10,20,2018);
        
        //C: COMPUTES THE DAYS UNTIL THE EVENT.
        $countdown = round(($event - $today)/86400);
        
        //D: DISPLAYS COUNTDOWN UNTIL EVENT
            $properties = ['Message' => $countdown.' day for the next game release',
                            'Release_date' => date('M-d-Y H:i:s',$event)];
            return $this-> render('game_release.twig',$properties);
    }}
?>