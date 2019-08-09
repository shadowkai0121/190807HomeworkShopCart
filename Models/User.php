<?php
require_once "Core/Table.php";

class User extends Table
{
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

        return $user->rowCount() === 1;
    }
}
