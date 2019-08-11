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
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->pdo;
    }

    // 確認是否為 view
    public function isView($table)
    {
        $query = <<<query
            SHOW FULL TABLES 
            WHERE TABLE_TYPE = 'view' 
            AND tables_in_homework = :table;
        query;
        $result = $this->pdo->prepare($query);

        $result->bindValue(":table", "vw_" . $table);

        $result->execute();

        return $result->rowCount() > 0;
    }
}
