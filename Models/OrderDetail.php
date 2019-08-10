<?php
require_once "Core/Table.php";

class OrderDetail extends Table
{
    public $orderID = 0;
    public $userID = 0;
    public $productID = 0;
    public $quantity = 0;
    public $isPaid = 0;

    public function __construct($table)
    {
        Parent::__construct($table);
    }

    public function putItem()
    {
        if ($this->isExists()) {
            $query = <<<query
                UPDATE {$this->table} SET
                quantity = :quantity
                WHERE userID = :userID
                AND productID = :productID
                AND isPaid = 0;
            query;
        } else {
            $query = <<<query
                INSERT INTO {$this->table}(userID, productID, quantity)
                VALUES (:userID, :productID, :quantity);
            query;
        }

        if ($this->queryExecutor($query, true)) {
            echo "修改購物車成功";
        } else {
            http_response_code(500);
            echo "修改購物車失敗";
        }
    }

    public function delItem()
    {
        if (!$this->isExists()) {
            http_response_code(400);
            echo "沒有此項產品在購物車內";
            return;
        }

        $query = <<<query
            DELETE FROM {$this->table}
            WHERE userID = :userID
            AND productID = :productID
            AND isPaid = 0;
        query;

        if ($this->queryExecutor($query)) {
            echo "刪除成功";
        } else {
            http_response_code(500);
            echo "刪除發生錯誤";
        }
    }

    private function isExists()
    {
        $query = <<<query
            SELECT * FROM {$this->table}
            WHERE userID = :userID
            AND productID = :productID
            AND isPaid = 0;
        query;

        $result = $this->queryExecutor($query);

        return $result->rowCount() !== 0;
    }

    private function queryExecutor($query, $haveQuantity = false)
    {
        $orderDetail = $this->db->prepare($query);

        $orderDetail->bindValue(":userID", $this->userID);
        $orderDetail->bindValue(":productID", $this->productID);
        
        if ($haveQuantity) {
            $orderDetail->bindValue(":quantity", $this->quantity);
        }

        $orderDetail->execute();
        return $orderDetail;
    }
}
