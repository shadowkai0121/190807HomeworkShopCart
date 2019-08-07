<?php
require_once 'config/database.php';

class User
{
    private $pdo = null;
    private $table = "users";

    public $userID = 0;
    public $userName = "";
    public $userPwd = "";
    public $userEmail = "";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login()
    {
        $query = "SELECT userID, userName, userPwd
        FROM {$this->table}
        WHERE userName = :userName
        AND userPwd = :userPwd
        LIMIT 1;";

        $result = $this->pdo->prepare($query);

        $result->bindValue(":userName", $this->userName);
        $result->bindValue(":userPwd", $this->userPwd);

        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->userID = $row["userID"];
            return true;
        }

        return false;
    }

    public function register()
    {
        if (!$this->check()) {
            return false;
        }

        return true;
    }

    private function check()
    {
        $query = "SELECT userName
            FROM  {$this->table} 
            WHERE userName = :userName
            LIMIT 1";

        $result = $this->pdo->prepare($query);

        $result->bindValue(":userName", $this->userName);

        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return false;
        }
        return true;
    }
}
