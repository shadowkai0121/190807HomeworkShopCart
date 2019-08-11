<?php

// 處理 Route
class App
{
    private $url = [];

    public function __construct()
    {
        if (isset($_GET["url"])) {
            $this->parseURL();

            $this->callController();
        } else {
            Controller::redirect("Product");
        }
    }

    private function parseURL()
    {
        $this->url = explode(
            "/",
            rtrim($_GET["url"])
        );
    }

    private function callController()
    {
        $controllerName = $this->url[0]."Controller";
        
        require_once "Controllers/$controllerName.php";

        $controller = new $controllerName();

        $method = "no method";
        if (isset($this->url[1])) {
            $method = $this->url[1];
        }

        // 如果方法不存在則直接回傳預設頁面
        if (!method_exists($controller, $method)) {
            $controller->index();
            return;
        }

        // 去除陣列內的控制器項，剩下的就是參數
        unset($this->url[0]);
        unset($this->url[1]);
       
        // 整理參數陣列，原本參數在 $url[2] 之後變成 $params[0] 開始算
        $params = $this->url ? array_values($this->url) : array();
       
        call_user_func([$controller, $method], $params);
    }
}
