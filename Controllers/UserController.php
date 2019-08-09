<?php

class UserController extends Controller
{
    public function index()
    {
        $this->view("User/User", "ya");
    }

    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            header("Location: https://www.iiiedu.org.tw/");
            exit();
        }

        $user = $this->model("User");
        $user->userName = $_POST["account"];
        $user->userPwd = $_POST["pwd"];

        if ($user->vertify()) {
            $_SESSION["user"] = $user->userName;
        }

        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/190807HomeworkShopCart/Product");
    }

    public function Logout()
    {
        unset($_SESSION["user"]);
        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/190807HomeworkShopCart/Product");
    }
}
