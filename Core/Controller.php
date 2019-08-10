<?php

class Controller
{
    protected function model($model)
    {
        require_once "Models/$model.php";

        return new $model($model);
    }
    
    public function view($view, $data=[], $head = "Shared/Head", $foot = "Shared/Foot")
    {
        include_once "Views/$head.php";
        include_once "Views/$view.php";
        include_once "Views/$foot.php";
    }

    public function isLogin()
    {
        if (isset($_SESSION["user"])) {
            return true;
        }

        return false;
    }

    public function redirect($action)
    {
        header("Location: {$this->actionUri($action)}");
    }

    public static function actionUri($action)
    {
        return "http://" . $_SERVER["SERVER_NAME"] . "/190807HomeworkShopCart/" . $action;
    }

    // 比對允許的請求，不符合時以 errAction 回應
    public function checkRequestMethod($request, $types, $message = "", $errAction = null)
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
            $this->errorHandler($errAction, $message);
        }
    }

    public function errorHandler($errAction = null, $message = "")
    {
        if (is_null($errAction)) {
            http_response_code(404);
        } elseif (is_numeric($errAction)) {
            http_response_code($errAction);
        } else {
            $errAction();
        }

        echo $message;
        exit();
    }
}
