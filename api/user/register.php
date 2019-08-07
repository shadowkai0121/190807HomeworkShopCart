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
$user->userEmail = "";

if ($user->register()) {
    echo "帳號註冊成功！";
} else {
    http_response_code(500);
    echo "帳號已經被使用，請重新輸入。";
}
