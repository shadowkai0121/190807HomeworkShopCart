<?php
require_once "Core/Table.php";

class ShopCart extends Table
{
    public $productID = 0;
    public $userID = 0;
    public $productName = "";
    public $unitPrice = 0;
    public $sum = 0;
    public $productPhotoS = "";

    public function __construct($table)
    {
        Parent::__construct($table);
    }

    public function getShopCart()
    {
        $query = "SELECT *
            FROM " . $this->table . ";";
    
        $rawData = $this->db->query($query);

        if ($rawData->rowCount()) {
            $list = [];

            while ($row = $rawData->fetch(PDO::FETCH_ASSOC)) {
                $list[] = $this->rowToArray($row);
            }
        }

        return $list;
    }
}
