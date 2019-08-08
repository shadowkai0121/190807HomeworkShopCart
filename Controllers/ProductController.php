<?php

class ProductController extends Controller
{
    public function index()
    {
        $products = $this->model("Product");

        $data = $products->getMenu();

        $this->view("Product/Product", $data);
    }
    
    public function test()
    {
        echo "test ok";
    }
}
