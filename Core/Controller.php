<?php

class Controller
{
    protected function model($model)
    {
        require_once "Models/$model.php";

        return new $model($model);
    }
    
    protected function view($view, $data=[])
    {
        require_once "Views/$view.php";
    }
}
