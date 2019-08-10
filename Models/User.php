<?php
require_once "Core/Table.php";

class User extends Table
{
    public $userID = 0;
    public $userName = "";
    public $userPwd = "";
   
    public function __construct($table)
    {
        Parent::__construct($table);
    }

    public function vertify()
    {
        $query = <<<query
            SELECT * 
            FROM {$this->table} 
            WHERE userName = :userName
            AND userPwd = :userPwd
            LIMIT 1;
        query;

        $user = $this->db->prepare($query);

        $user->bindValue(":userName", $this->userName);
        $user->bindValue(":userPwd", $this->userPwd);

        $user->execute();

        $row = $user->fetch(PDO::FETCH_ASSOC);
        
        $this->userID = $row["userID"];

        return $user->rowCount() === 1;
    }
}
