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
            $noUseData = ["userID", "productPhotoS"];
            $total = 0;

            while ($row = $rawData->fetch(PDO::FETCH_ASSOC)) {
                $list[] = array_filter(
                    $row,
                    function ($key) use ($noUseData) {
                        return !in_array($key, $noUseData);
                    },
                    ARRAY_FILTER_USE_KEY
                );
                $total += $row["sum"];
            }
            $list["total"] = $total;
            return $list;
        }
    }

    public function checkOut()
    {
        $query = "call pro_checkout(:userID);";

        try {
            $this->db->beginTransaction();
        
            $checkout = $this->db->prepare($query);
            $checkout->bindValue(":userID", $this->userID);

            if (!$checkout->execute()) {
                $this->db->rollBack() ;
                echo "結帳失敗";
            }
            $checkout->closeCursor();

            if ($this->db->commit()) {
                echo "結帳成功";
            }
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw $e;
        } catch (Exeception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function haveItem()
    {
        $query = <<<query
            SELECT * FROM {$this->table}
            WHERE userID = :userID;
        query;

        $result = $this->db->prepare($query);

        $result->bindValue(":userID", $this->userID);

        $result->execute();

        if ($result->rowCount() < 1) {
            http_response_code(404);
            exit();
        }
    }
}
