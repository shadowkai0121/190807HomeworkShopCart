<?php

class UserController extends Controller
{
    public function index()
    {
        $this->view("User/User", "ya");
    }

    public function Login()
    {
        $user = $this->model("User");
        $user->userName = $_POST["account"];
        $user->userPwd = $_POST["pwd"];

        if ($user->vertify()) {
            echo "ok";
        }
    }
}
