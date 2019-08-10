<?php

class UserController extends Controller
{
    public function index()
    {
        $this->view("User/User");
    }

    public function ShopCart()
    {
        if (!$this->isLogin()) {
            $this->redirect("User");
            return;
        }
        
        $shopCart = $this->model("ShopCart");
        $data = $shopCart->getShopCart();
        
        $this->view("User/ShopCart", $data);
    }

    public function Login()
    {
        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "POST");

        if (strlen($_POST["account"]) >= 20 || strlen($_POST["pwd"]) >= 20) {
            $this->errorHandler();
        }

        $user = $this->model("User");
        $user->userName = $_POST["account"];
        $user->userPwd = $_POST["pwd"];

        if ($user->vertify()) {
            $_SESSION["user"] = $user->userID;
            $this->redirect("Product");
            return;
        }

        $this->redirect("User");
    }

    public function Logout()
    {
        unset($_SESSION["user"]);
        $this->redirect("User");
    }

    public function addItem($data)
    {
        // data[0] = 產品編號
        // data[1] = 產品數量
        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "POST");

        if (!$this->isLogin()) {
            $this->errorHandler(401, "請先登入再進行操作");
        }
        
        if (count($data) != 2 || !is_numeric($data[0]) || !is_numeric($data[1])) {
            $this->errorHandler();
        }

        $orderDetail = $this->model("OrderDetail");

        $orderDetail->userID = $_SESSION["user"];
        $orderDetail->productID = $data[0];
        $orderDetail->quantity = $data[1];

        $orderDetail->putItem();
    }

    public function delItem($data)
    {
        // data[0] = 產品編號
        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "DELETE");

        if (!$this->isLogin()) {
            $this->errorHandler(401, "請先登入再進行操作");
        }
        
        if (count($data) != 1 || !is_numeric($data[0])) {
            $this->errorHandler();
        }

        $orderDetail = $this->model("OrderDetail");

        $orderDetail->userID = $_SESSION["user"];
        $orderDetail->productID = $data[0];

        $orderDetail->delItem();
    }

    public function checkOut()
    {
        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "POST");

        if (!$this->isLogin() || !is_numeric($_SESSION["user"])) {
            $this->errorHandler();
        }
        
        $checkout = $this->model("ShopCart");

        $checkout->userID = $_SESSION["user"];

        $checkout->checkOut();
    }
}
