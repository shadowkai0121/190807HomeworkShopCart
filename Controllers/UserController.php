<?php

class UserController extends Controller
{
    public function index()
    {
        $this->view("User/User");
    }

    public function ShopCart()
    {
        if (!isset($_SESSION["user"])) {
            $this->redirect("User");
            exit();
        }
        
        $shopCart = $this->model("ShopCart");
        $data = $shopCart->getShopCart();
        
        $this->view("User/ShopCart", $data);
    }

    public function Login()
    {
        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "POST", 404);

        $user = $this->model("User");
        $user->userName = $_POST["account"];
        $user->userPwd = $_POST["pwd"];

        if ($user->vertify()) {
            $_SESSION["user"] = $user->userID;
            $this->redirect("Product");
            exit();
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
        $this->checkRequestMethod($_SERVER['REQUEST_METHOD'], "POST", 404);

        if (count($data) != 2 || !is_numeric($data[0]) || !is_numeric($data[1])) {
            http_response_code("404");
            exit();
        }

        if (!isset($_SESSION["user"])) {
            http_response_code("401");
            echo "請先登入再進行操作";
            exit();
        }

        $orderDetail = $this->model("OrderDetail");

        $orderDetail->userID = $_SESSION["user"];
        $orderDetail->productID = $data[0];
        $orderDetail->quantity = $data[1];

        if ($orderDetail->putItem()) {
            echo "加入購物車成功！";
        } else {
            http_response_code(500);
            echo "加入購物車失敗，請再試一次";
        }
    }
}
