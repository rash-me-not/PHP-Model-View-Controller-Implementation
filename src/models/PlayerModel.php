<?php

namespace AztecGameStudios\models;

use AztecGameStudios\domain\players;
use AztecGameStudios\Exceptions\NotFoundException;
use PDO;

class PlayerModel extends AbstractModel {

    public function get(int $player_id): players {
        // $query = 'SELECT * FROM players WHERE player_id = :player';
        // $sth = $this->db->prepare($query);
        $sth = $this->db->query('SELECT * FROM players WHERE player_id = :player');
        $sth->execute(['player' => $player_id]);

        $row = $sth->fetch();

        if (empty($row)) {
            throw new NotFoundException();
        }

        $player = players::create()->setPlayerID($row["player_id"])->
        setFirstName($row["first_name"])->setLastName($row["last_name"])->
        setDOB($row["dob"])->setRole($row["role"])->
        setLastLogin($row["last_login"])->setUserName($row["username"])->
        setPassword($row["password"]);
    
        return $player;
    }

    public function insert() {
        // $query = 'SELECT * FROM players WHERE player_id = :player';
        // $sth = $this->db->prepare($query);
        $this->db = new PDO(
            'mysql:host=127.0.0.1;dbname=aztecgames',
            'root',
            'root@1234');
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $password = $_POST['password'];
        $fav_game = $_POST['fav_game'];
        $phone_type = $_POST['phone_type'];
        $_SESSION['username'] = $username;
        $data= ['username'=>$username, 'first_name'=>$first_name, 'last_name'=>$last_name,'fav_game' => $fav_game, 'phone'=>$phone,'phone_type'=>$phone_type,'dob'=>$dob, 'password'=>$password];
        $query = ('INSERT INTO players(username,first_name,last_name,fav_game,phone,phone_type,dob,password) VALUES (:username,:first_name,:last_name,:fav_game,:phone,:phone_type,:dob,:password)');
        $sth = $this->db->prepare($query)->execute($data);

    }

    public function getbyUsername(string $username): players {
        $query = 'SELECT * FROM players WHERE username = :player';
        $this->db = new PDO(
            'mysql:host=127.0.0.1;dbname=aztecgames',
            'root',
            'root@1234');
        $sth = $this->db->prepare($query);
        // $sth = $this->db->query('SELECT * FROM players WHERE username = :player');
        $sth->execute(['player' => $username]);

        $row = $sth->fetch();

        if (empty($row)) {
            throw new NotFoundException();
        }

        $player = players::create()->setPlayerID($row["player_id"])->
        setFirstName($row["first_name"])->setLastName($row["last_name"])->
        setDOB($row["dob"])->setRole($row["role"])->
        setLastLogin($row["last_login"])->setUserName($row["username"])->
        setPassword($row["password"]);
    
        return $player;
    }
}