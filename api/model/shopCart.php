<?php
require_once 'config/database.php';

class ShopCart
{
    private $pdo = null;
    private $cartTable = "vw_shopcart";
    private $orderDetails = "orderdetails";

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getItem()
    {
        $query = "SELECT *
            FROM {$this->cartTable}";
        
        $result = $this->pdo->query($query);

        return $result;
    }
}
