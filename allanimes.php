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

</head>

<body>
  <?php
  require 'topbar.php';

  $page = 1;
  $type = "";
  $year = "";
  $country = "";
  $season = "";
  $episode = "";
  $stat = "";
  $userstat = "";
  $len = "";

  if (isset($_GET["page"]) && $_GET["page"]!="") {
      $page = (Int)$_GET["page"];
  }
  if (isset($_GET["type"]) && $_GET["type"]!="") {
      $type = $_GET["type"];
  }
  if (isset($_GET["year"]) && $_GET["year"]!="") {
      $year = $_GET["year"];
  }
  if (isset($_GET["cntry"]) && $_GET["cntry"]!="") {
      $country = $_GET["cntry"];
  }
  if (isset($_GET["season"]) && $_GET["season"]!="") {
      $season = $_GET["season"];
  }
  if (isset($_GET["epi"]) && $_GET["epi"]!="") {
      $episode = $_GET["epi"];
  }
  if (isset($_GET["stat"]) && $_GET["stat"]!="") {
      $stat = $_GET["stat"];
  }
  if (isset($_GET["userstat"]) && $_GET["userstat"]!="") {
      $userstat = $_GET["userstat"];
  }
  if (isset($_GET["len"]) && $_GET["len"]!="") {
      $len = $_GET["len"];
  }

  //echo($type);
  ?>
  <div class="container-fluid">
    <div class="row">

      <div id="selectors" class="col-sm-2">
        <?php
    require "./php/selector.php";

    $selectors = [];
    array_push($selectors, new Selector("type_sele", "类型", Selector::make_items(
        ['TV','Web','OVA','电影','其他'],
        ['tv','web','ova','movie','other'],
        [],
        [],
        $type
    ), "type"));
    $year1=[];
    $year2=[];
    $oldest = 1980;
    for ($i = (int)date("Y"); $i>=$oldest; $i--) {
        array_push($year1, substr(((string)$i),2,2));
        array_push($year2, (string)$i);
    }
    array_push($selectors, new Selector("year_sele", "年份", Selector::make_items(
        $year1,
        $year2,
        [],
        [],
        $year
    ), "year"));
    array_push($selectors, new Selector("lang_sele", "语言", Selector::make_items(
        ['日语','国语','英语','韩语','其他'],
        ['ja', 'zh-cn', 'en', 'ko', 'other'],
        [],
        [],
        $country
    ), "cntry"));
    array_push($selectors, new Selector("season_sele", "季度", Selector::make_items(
        ['冬季番','春季番','夏季番','秋季番'],
        ['fuyu','haru','natsu','aki'],
        [],
        [],
        $season
    ), "season"));
    array_push($selectors, new Selector("epi_sele", "话数", Selector::make_items(
        ['1话','2-5话','6-19话','20-50话','50话以上'],
        ['kanon','keke','chisato','sumire','ren'],
        [],
        [],
        $episode
    ), "epi"));
    array_push($selectors, new Selector("stat_sele", "放送状态", Selector::make_items(
        ['已完结','放送中','未放送','暂停放送','其他'],
        ['mami', 'madoka', 'sayaka', 'homura', 'kyouko'],
        [],
        [],
        $stat
    ), "stat"));
    array_push($selectors, new Selector("user1_sele", "我...", Selector::make_items(
        ['想看的','还没点“想看！”的','没看完的','看完了的','正在看的','弃番的','暂且不看的'],
        ['mitai','nai','mada','owaru','miteru','akirameta','ichiou'],
        [],
        [],
        $userstat
    ), "userstat"));
    array_push($selectors, new Selector("len_sele", "单集长度", Selector::make_items(
        ['泡面(2min)','短篇(10min)','正常(25min)','长篇(≥40min)'],
        ['koizumi','short','normal','long'],
        [],
        [],
        $len
    ), "len"));

    foreach ($selectors as $sele) {
        $sele->HTML();
    }
    ?>
    <!--
      <div id="type_sele">
        <h6><span class="">类型</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#" id="all">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">TV</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Web</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">OVA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">电影</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">其他</a>
        </li>
        </ul>
      </div>
      <div id="year_sele">
        <h6><span class="">年份</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">2021</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">2020</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">2019</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">2018</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">2017</a>
        </li>
        </ul>
      </div>
      <div id="cntry_sele">
        <h6><span class="">语言</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">日语</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">国语</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">英语</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">韩语</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">其他</a>
        </li>
        </ul>
      </div>
      <div id="season_sele">
        <h6><span class="">季度</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全年</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">冬季</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">春季</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">夏季</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">秋季</a>
        </li>
        </ul>
      </div>
      <div id="epi_sele">
        <h6><span class="">集数</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">10-20话</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">20-30话</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">2-10话</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">1话</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">30-100话</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">100话以上</a>
        </li>
        </ul>
      </div>
      <div id="stat_sele">
        <h6><span class="">放送状态</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">已完结</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">连载中</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">停更</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">即将放送</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">其他</a>
        </li>
        </ul>
      </div>
      <div id="user1_sele">
        <h6><span class="">我....</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">想看的</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">还没点"想看"的</a>
        </li>
        </ul>
      </div>
      <div id="user2_sele">
        <h6><span class=""></span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">看过的</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">没看过的</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">正在看的</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">弃番的</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">没看完的</a>
        </li>
        </ul>
      </div>
      <div id="len_sele">
        <h6><span class="">单集长度</span></h6>
        <ul class="nav nav-pills">
        
        <li class="nav-item">
          <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">25min正常</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">10min短篇</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">2min泡面</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">长篇</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">其他</a>
        </li>
        </ul>
      </div>
    -->
      </div>

      <div id="show-animes-div" class="col-sm-10">
        <style type="text/css">
          .container .card {
            border: 1px solid #EEEEEE;
            padding: 10px;
            margin-bottom: 15px;
          }
        </style>

        <div class="container-fluid">
          <div class="row">
            <?php

          ?>

            <div class="card" style="width: 10rem;">
              <img src="https://lain.bgm.tv/pic/cover/c/cb/57/9717_sAVag.jpg" class="card-img-top" alt="魔法少女小圆">
              <div class="card-body">
                <p class="card-text">魔法少女小圆</p>
              </div>
            </div>

            <div class="card" style="width: 10rem;">
              <img src="https://lain.bgm.tv/pic/cover/c/17/ed/274234_iZ22k.jpg" class="card-img-top" alt="小林家的龙女仆S">
              <div class="card-body">
                <p class="card-text">小林家的龙女仆S</p>
              </div>
            </div>

            <div class="card" style="width: 10rem;">
              <img src="https://lain.bgm.tv/pic/cover/c/0e/14/9912_LZML8.jpg" class="card-img-top" alt="日常">
              <div class="card-body">
                <p class="card-text">日常</p>
              </div>
            </div>
          </div>
        </div>

        <div>

          <nav aria-label="">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">第一页</a></li>
              <li class="page-item"><a class="page-link" href="#">←</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">→</a></li>
              <li class="page-item"><a class="page-link" href="#">最后一页</a></li>
            </ul>
          </nav>
        </div>

      </div>
    </div>


  </div>
  <?php
require "./kanban.php";
?>

</body>

</html>