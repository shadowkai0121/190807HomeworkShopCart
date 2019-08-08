<?php

class Table
{
    protected $db = null;
    protected $table = "";

    public function __construct($table)
    {
        require_once "Core/Database.php";

        $pdo = new Database();

        $this->db = $pdo->startConnection();

        $this->table = $table . "s";
    }

    protected function rowToArray($row)
    {
        $arr = [];

        foreach ($row as $field => $value) {
            $arr[$field] = $value;
        }

        return $arr;
    }
}
