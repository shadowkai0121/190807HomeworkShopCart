<?php

  function isLogged()
  {
      if (!isset($_SESSION["user"])) {
          $str = "Login";
          $url = "/190807HomeworkShopCart/User/User";
      } else {
          $str = "Logout";
          $url = "/190807HomeworkShopCart/User/Logout";
      }

      $template = <<<template
        <a href="$url">
          <span class="glyphicon glyphicon-log-in"></span>
          $str
        </a>
      template;

      echo $template;
  }

  function changeActiveTab($url, $tab)
  {
      echo strpos($url, $tab) ? "active" : "";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css'/>
    <link rel="stylesheet" href="<?=Controller::actionUri("Views/Shared/css/style.css")?>">

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js'></script>
</head>
<body>
    <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Homework</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="<?php changeActiveTab($_SERVER['REQUEST_URI'], "Product/Product")?>">
              <a href="/190807HomeworkShopCart/Product/Product">Menu</a>
            </li>
            <li class="<?php changeActiveTab($_SERVER['REQUEST_URI'], "User/ShopCart")?>">
              <a href="/190807HomeworkShopCart/User/ShopCart">ShopCart</a>
            </li>
          </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li>
              <?php isLogged()?>
            </li>
          </ul>
        </div>
      </nav>