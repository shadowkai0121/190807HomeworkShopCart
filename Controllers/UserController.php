<?php

class UserController extends Controller
{
    public function index()
    {
        $this->view("User/index");
    }

    public function ShopCart()
    {
        $this->view("User/ShopCart");
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
            $_SESSION["user"] = $user->userID;
        }

        $this->redirect("Product");
    }

    public function Logout()
    {
        unset($_SESSION["user"]);
        $this->redirect("Product");
    }
}
