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

<body>
<?php
  require 'topbar.php';

  $keyword = "";

  if (isset($_GET['keyword'])) {
      $keyword = $_GET['keyword'];
      $link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
      //mysqli_select_db($link, DBNAME);
      mysqli_set_charset($link, 'utf8');

      //$sql = "SELECT COUNT(name) FROM anime WHERE name LIKE '%".$keyword."%';";
      //$result = mysqli_query($link, $sql);


      $sql = "SELECT name FROM anime WHERE name LIKE '%".$keyword."%';";
      $result = mysqli_query($link, $sql);

      while ($row = $result->fetch_array()) {
        $name = $row[0];
        echo($name.PHP_EOL);
    }
  }
  ?>




<?php
require "./kanban.php";
?>


</body></html>