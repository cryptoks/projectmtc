<?php

namespace Models\Model;

use PDO;

class Model
{

    protected \Envms\FluentPDO\Query $db;

    public function __construct()
    {
        $pdo = new PDO('mysql:dbname=' . $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);
        $this->db = new \Envms\FluentPDO\Query($pdo);
    }
}