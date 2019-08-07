<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../model/shopCart.php';

$db = new Database();

$shopCart = new ShopCart($db->startConnection());

$items = $shopCart->getItem();

if ($items->rowCount()) {
    $list=[];
    $total = 0;
    // 將所有資料行組合成二維陣列
    while ($row = $items->fetch(PDO::FETCH_ASSOC)) {
        $tmpList = [
            "productID" => $row["productID"],
            "userID" => $row["userID"],
            "productName" => $row["productName"],
            "unitPrice" => $row["unitPrice"],
            "quantity" => $row["quantity"],
            "sum" => $row["sum"],
            "productPhotoS" => $row["productPhotoS"]
        ];
        $total += $row["sum"];
        $list[] = $tmpList;
    }
    $list["total"] = $total;
    echo json_encode($list);
} else {
    http_response_code(404);
    echo "菜單讀取失敗";
}
