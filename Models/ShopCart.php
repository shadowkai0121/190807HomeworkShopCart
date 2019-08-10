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
        $query = "call pro_checkout({$this->userID});";

        $this->db->beginTransaction();

        // $test = $this->db->prepare($query);
        // $test->bindParam(1, $this->userID, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4000);
        // $test->execute();
        $this->db->query($query);
        $this->db->commit();
        
        // $this->haveItem();
        
        // $query = "call pro_checkout(:userID);";
        // try {
        // $user = $this->db->prepare($query);

        // $user->bindValue(":userID", $this->userID);

        // $user->execute();


        // $this->db->commit();

        // } catch (Exception $e) {
        //     $this->db->rollBack();
        //     throw $e;
        // }
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
