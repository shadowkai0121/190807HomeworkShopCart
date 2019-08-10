<?php

class UserController extends Controller
{
    public function index()
    {
        $this->view("User/index");
    }

    public function ShopCart()
    {
        $this->view("User/ShopCart", "ya");
    }

    public function Login()
    {
        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "POST", 404);

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

    public function addItem($data)
    {
        // data[0] = 產品編號
        // data[1] = 產品數量

        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "POST", 404);

        if (count($data) != 2 || !is_numeric($data[0]) || !is_numeric($data[1])) {
            http_response_code("404");
            exit();
        }

        if (!isset($_SESSION["user"])) {
            echo "使用者未登入";
            http_response_code("401");
            exit();
        }

        $shopCart = $this->model("OrderDetail");
    }
}
