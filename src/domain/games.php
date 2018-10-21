
<?php

namespace AztecGameStudios\domain;

class games

{
    private $game_id;
    private $title;
    private $genre;
    private $description;
    private $release_date;
    private $logo;

    public function __construct() {
    }

    public static function create(){
        $instance = new self();
        return $instance;
    }

    public function getPlayerID() { return $this->game_id; }
    public function setPlayerID($game_id) { $this->game_id = $game_id; return $this;  }

    public function getFirstName() { return $this->title; }
    public function setFirstName($title) { $this->title = $title; return $this;  }

    public function getPlayerID() { return $this->genre; }
    public function setPlayerID($genre) { $this->genre = $genre; return $this;  }

    public function getPlayerID() { return $this->description; }
    public function setPlayerID($description) { $this->description = $description; return $this;  }

    public function getPlayerID() { return $this->release_date; }
    public function setPlayerID($release_date) { $this->release_date = $release_date; return $this;  }

    public function getPlayerID() { return $this->logo; }
    public function setPlayerID($logo) { $this->logo = $logo; return $this;  }

}