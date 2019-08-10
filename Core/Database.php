<?php
class Database
{

    // 連線設定
    private $host = "localhost";
    private $dbName = "homework";
    private $account = "root";
    private $password = "";
    private $pdo;

    // 開始連線
    public function startConnection()
    {
        $this->pdo = null;

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};
                dbname={$this->dbName}",
                $this->account,
                $this->password
            );

            // 設定輸出編碼
            $this->pdo->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->pdo;
    }

    // 確認是否為 view
    public function isView($table)
    {
        $result = $this->pdo->query(
            "
            SHOW FULL TABLES 
            WHERE TABLE_TYPE = 'view' 
            AND tables_in_homework = 'vw_{$table}';"
        );

        return $result->rowCount() > 0;
    }
}
