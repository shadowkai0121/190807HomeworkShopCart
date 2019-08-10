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
        $query = <<<query
            INSERT INTO {$this->table}(userID, productID, quantity)
            VALUES (:userID, :productID, :quantity);
        query;

        $orderDetail = $this->db->prepare($query);

        $orderDetail->bindValue(":userID", $this->userID);
        $orderDetail->bindValue(":productID", $this->productID);
        $orderDetail->bindValue(":quantity", $this->quantity);

        return $orderDetail->execute();
    }

    public function delItem()
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

        if ($orderDetail ->rowCount() === 0) {
            http_response_code(500);
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
}
