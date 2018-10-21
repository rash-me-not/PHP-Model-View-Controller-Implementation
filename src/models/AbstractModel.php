<?php

namespace AztecGameStudios\models;

use PDO;

abstract class AbstractModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
}