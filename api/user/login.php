<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../model/user.php";

$data = json_decode(file_get_contents("php://input"));

$db = new Database();

$user = new User($db->startConnection());
$user->userName = "admin";
$user->userPwd = "admin";

if ($user->login()) {
    http_response_code(200);
    echo json_encode(["userID"=>$user->userID]);
} else {
    http_response_code(500);
    echo "帳戶或密碼錯誤請重新輸入";
}
