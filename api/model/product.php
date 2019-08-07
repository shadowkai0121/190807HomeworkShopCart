<?php
require_once 'config/database.php';

class Product
{
    private $pdo = null;
    private $table = "products";

    public $productID = 0;
    public $productName = "";
    public $unitPrice = 0;
    public $productPhotoS = "";
    public $productPhotoL ="";
    public $productIntroduction ="";
    public $productDescription ="";

    public function __construct($pdo)
    {
        $this->pdo=$pdo;
    }

    public function getMenu()
    {
        $query = "SELECT *
            FROM {$this->table};";
        
        $result = $this->pdo->query($query);

        return $result;
    }
}
