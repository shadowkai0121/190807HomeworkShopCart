<?php

class Controller
{
    protected function model($model)
    {
        require_once "Models/$model.php";

        return new $model($model);
    }
    
    public function view($view, $data=[], $head = "Shared/Head.php", $foot = "Shared/Foot.php")
    {
        include_once "Views/$head";
        include_once "Views/$view.php";
        include_once "Views/$foot";
    }

    public function checkLogin()
    {
        if (!isset($_SESSION["user"])) {
            http_response_code("401");
            echo "請先登入再進行操作";
            exit();
        }
    }

    public function checkRequestMethod($request, $types, $errAction)
    {
        $result = false;

        if (!is_array($types)) {
            $result = $request === $types;
        } else {
            foreach ($types as $type) {
                if ($request === $types) {
                    $result = true;
                }
            }
        }

        if (!$result) {
            if (is_numeric($errAction)) {
                http_response_code($errAction);
                exit();
            } else {
                $this->redirect($errAction);
                exit();
            }
        }
    }

    public function redirect($action)
    {
        header("Location: {$this->actionUri($action)}");
    }

    public static function actionUri($action)
    {
        return "http://" . $_SERVER["SERVER_NAME"] . "/190807HomeworkShopCart/" . $action;
    }
}
