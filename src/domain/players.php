<?php
namespace AztecGameStudios\domain;
class players {

    private $player_id;
    public $first_name;
    private $last_name;
    private $dob;
    private $role;
    private $last_login;
    private $username;
    private $password;
    private $screenName;

    public function __construct() {
    }

    public static function create(){
        $instance = new self();
        return $instance;
    }

    public function getPlayerID() { return $this->player_id; }
    public function setPlayerID($player_id) { $this->player_id = $player_id; return $this;  }

    public function getFirstName() { return $this->first_name; }
    public function setFirstName($first_name) { $this->first_name = $first_name; return $this;  }

    public function getLastName() { return $this->last_name; }
    public function setLastName($last_name) { $this->last_name = $last_name; return $this;  }

    public function getDOB() { return $this->dob; }
    public function setDOB($dob) { $this->dob = $dob; return $this;  }

    public function getRole() { return $this->role; }
    public function setRole($role) { $this->role = $role; return $this;  }

    public function getLastLogin() { return $this->last_login; }
    public function setLastLogin($last_login) { $this->last_login = $last_login; return $this;  }

    public function getUserName() { return $this->username; }
    public function setUserName($username) { $this->username = $username; return $this;  }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; return $this;  }

    public function getScreenName() { return $this->screenName; }
    public function setScreenName($screenName) { $this->screenName = $screenName; return $this;  }
}

?>