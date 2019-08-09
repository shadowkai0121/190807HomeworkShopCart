<?php

  function isLogged()
  {
      if (!isset($_SESSION["user"])) {
          $str = "Login";
          $url = "User/User";
      } else {
          $str = "Logout";
          $url = "User/Logout";
      }

      $template = <<<template
        <a href="$url">
          <span class="glyphicon glyphicon-log-in"></span>
          $str
        </a>
      template;

      echo $template;
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
    <link rel="stylesheet" href="Views/Shared/css/style.css">

    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js'></script>
</head>
<body>
    <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
          </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li>
              <?php isLogged()?>
            </li>
          </ul>
        </div>
      </nav>
