<?php
require_once "Core/Table.php";

class OrderDetail extends Table
{
    public $userID = 0;
    public $productID = 0;
    public $quantity = 0;

    public function __construct($table)
    {
        Parent::__construct($table);
    }

    public function putItem()
    {
        if ($this->isExists()) {
            echo "is exists";
            $query = <<<query
                UPDATE orderdetails SET
                quantity = :quantity
                WHERE userID = :userID
                AND productID = :productID
                AND isPaid = 0;
            query;

            if ($this->insertOrUpdate($query)) {
                echo "數量修改成功";
            } else {
                http_response_code(500);
                echo "數量修改失敗";
            }
        }

        $query = <<<query
            INSERT INTO {$this->table}(userID, productID, quantity)
            VALUES (:userID, :productID, :quantity);
        query;

        if ($this->insertOrUpdate($query)) {
            echo "新增購物車成功";
        } else {
            http_response_code(500);
            echo "新增購物車失敗";
        }
    }

    public function delItem()
    {
        if (!$this->isExists()) {
            http_response_code(400);
            echo "沒有此項產品在購物車內";
            exit();
        }

        $query = <<<query
            DELETE FROM {$this->table}
            WHERE userID = :userID
            AND productID = :productID
            AND isPaid = 0;
        query;

        $orderDetail = $this->db->prepare($query);

        $orderDetail->bindValue(":userID", $this->userID);
        $orderDetail->bindValue(":productID", $this->productID);

        return $orderDetail->execute();
    }

    private function isExists()
    {
        $query = <<<query
            SELECT * FROM {$this->table}
            WHERE userID = :userID
            AND productID = :productID
            AND isPaid = 0;
        query;

        $orderDetail = $this->db->prepare($query);

        $orderDetail->bindValue(":userID", $this->userID);
        $orderDetail->bindValue(":productID", $this->productID);

        $orderDetail->execute();

        return $orderDetail ->rowCount() !== 0;
    }

    private function insertOrUpdate($query)
    {
        $orderDetail = $this->db->prepare($query);

        $orderDetail->bindValue(":userID", $this->userID);
        $orderDetail->bindValue(":productID", $this->productID);
        $orderDetail->bindValue(":quantity", $this->quantity);

        return $orderDetail->execute();
    }
}
