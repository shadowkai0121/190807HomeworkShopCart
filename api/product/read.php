<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "../model/product.php";

$db = new Database();

$product = new Product($db->startConnection());

$rawMenu = $product->getMenu();

if ($rawMenu->rowCount()) {
    $menu=[];
    // 將所有資料行組合成二維陣列
    while ($row = $rawMenu->fetch(PDO::FETCH_ASSOC)) {
        $tmpMenu = [
            "productID" => $row["productID"],
            "productName" => $row["productName"],
            "unitPrice" => $row["unitPrice"],
            "productPhotoS" => $row["productPhotoS"],
            "productPhotoL" => $row["productPhotoL"],
            "productIntroduction" => $row["productIntroduction"],
            "productDescribtion" => $row["productDescription"]
        ];

        $menu[] = $tmpMenu;
    }
    echo json_encode($menu);
} else {
    http_response_code(404);
    echo "菜單讀取失敗";
}
