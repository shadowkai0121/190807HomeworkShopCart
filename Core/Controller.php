<?php

class Controller
{
    protected function model($model)
    {
        require_once "Models/$model.php";

        return new $model($model);
    }
    
    protected function view($view, $data=[], $head = "Shared/Head.php", $foot = "Shared/Foot.php")
    {
        include_once "Views/$head";
        include_once "Views/$view.php";
        include_once "Views/$foot";
    }
}
