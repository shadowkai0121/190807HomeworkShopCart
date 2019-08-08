<?php

require_once "Core/Table.php";

class Product extends Table
{
    public $productID = 0;
    public $productName = "";
    public $unitPrice = 0;
    public $productPhotoS = "";
    public $productPhotoL ="";
    public $productIntroduction ="";
    public $productDescription ="";

    public function __construct($table)
    {
        Parent::__construct($table);
    }

    public function getMenu()
    {
        $query = "SELECT *
        FROM " . $this->table . ";";
    
        $rawData = $this->db->query($query);

        if ($rawData->rowCount()) {
            $menu = [];

            while ($row = $rawData->fetch(PDO::FETCH_ASSOC)) {
                $menu[] = $this->rowToArray($row);
            }
        }

        return $menu;
    }
}
