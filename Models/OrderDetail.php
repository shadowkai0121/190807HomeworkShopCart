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
}
