<!DOCTYPE html>
<?php
require "./private/dbcfg.php";
?>

<html>

<head>
  <meta charset="utf-8" />
  <title>ANIME SEIRI.web</title>
  <link rel="icon" href="./src/favicon.ico" sizes="32x32" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./lib/allanimes.js"></script>
  <link rel="stylesheet" href="./lib/allanimes.css" />
</head>

<body>
  <?php
  $current_li = 1;
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
        $type//默认选中的
    ), "type"));
    $year1=[];
    $year2=[];
    $oldest = 1980;
    for ($i = (int)date("Y"); $i>=$oldest; $i--) {
        array_push($year1, substr(((string)$i), 2, 2));
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
        ['1话','2-5话','6-19话','20-59话','50话以上'],
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
        //print筛选列表
        $sele->HTML();
    }
    ?>
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
          <div class="">
            <?php
            
            require "./php/filter.php"
            ?>

            <div class="row">
              <?php
                      $current_page = 1;
                      $perpage=100;
                      $page_max = (int)ceil(((double)$count) / ((double)$perpage));
                      if(isset($_GET['page']) && $_GET['page']!=""){
                        $current_page = (int)$_GET['page'];
                      }

                      $anishow_i = 0;
                        while ($row = $result->fetch_array()) {
                          $anishow_i++;
                          if($anishow_i >= ($current_page-1) * $perpage && $anishow_i <= ($current_page) * $perpage){
                            ani_card($row[0], $row[2]);
                        }
                        }
                    

                        function ani_card($name, $image_url)
                        {
                            ?>

                        <div class="card" style="width: 10rem;">
                          <img src="
                                  <?php
                                  if ($image_url == "") {
                                      echo(" ./src/no_image.jpg"); } else { echo("https://lain.bgm.tv/pic/cover/c/".$image_url);
                            } ?>"
                          class="card-img-top" alt="
                          <?php echo($name); ?>" width="150" height="216"/>
                          <div class="card-body"style="padding: 0px;position:relative;">
                            <p class="card-text">
                              <?php echo($name); ?>
                            </p>
                            <div class="btn-toolbar" role="toolbar" style="position:absolute;bottom:0px;"aria-label="Toolbar with button groups">
                              <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button type="button" id="allani_addbtn" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus-fill" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm6.5-11a.5.5 0 0 0-1 0V6H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V7H10a.5.5 0 0 0 0-1H8.5V4.5z"/>
                                </svg>追加
                                </button>
                                <button type="button" id="allani_bukanbtn" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>不看
                              </button>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div>
                          TODO : 弹出框
                        </div>

                        <?php
                        }

                      ?>

              <!--div class="card" style="width: 10rem;">
              <img src="https://lain.bgm.tv/pic/cover/c/cb/57/9717_sAVag.jpg" class="card-img-top" alt="魔法少女小圆">
              <div class="card-body">
                <p class="card-text">魔法少女小圆</p>
              </div>
              </div-->
            </div>
          </div>
        </div>

      </div>

      
      <div id="page_selector">
        <div style="bottom: 0px;">
        <nav aria-label="">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <span>...</span>
            <li class="page-item"><a class="page-link" href="#"><?php echo($current_page-2);?></a></li>
            <li class="page-item"><a class="page-link" href="#"><?php echo($current_page-1);?></a></li>
            <li class="page-item active"><a class="page-link" href="#"><?php echo($current_page);?></a></li>
            <li class="page-item"><a class="page-link" href="#"><?php echo($current_page+1);?></a></li>
            <li class="page-item"><a class="page-link" href="#"><?php echo($current_page+2);?></a></li>
            <span>...</span>
            <li class="page-item"><a class="page-link" href="#"><?php echo($page_max);?></a></li>
          </ul>
        </nav>
        </div>
      </div>

    </div>
  </div>



  </div>
  <?php
require "./kanban.php";
?>

</body>

</html>