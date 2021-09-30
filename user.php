<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <title>ANIME SEIRI.web</title>
  <link rel="stylesheet" href="./lib/allanimes.css" />
  <link rel="icon" href="./src/favicon.ico" sizes="32x32" />
  <!--link rel="stylesheet" href="./lib/bootstrap.min.css" /-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!--script src="./lib/jquery-3.3.1.min.js"></script-->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
  <script src="./lib/allanimes.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-color:azure;">
<?php
  $current_li = 3;
  require 'topbar.php';


  ?>

  <div class="container shadow-lg" style="background-color: white;">
    <p>user</p>
  </div>


<?php
require "./kanban.php";
?>


</body></html>