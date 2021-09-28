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
  require 'topbar.php';

  $keyword = "";

  function ani_tab($name, $ori_name, $image_url,$epi, $housou_date ){
    ?>
        <div class="card mb-3" style="max-width: 100%; right: 5px; left: 5px;">
          <div class="row no-gutters">
            <div class="col-md-2">
              <img src="
              <?php
              if($image_url == ""){
                echo("./src/np_image.jpg"); 
              }else{
                echo("https://lain.bgm.tv/pic/cover/c/".$image_url); 
              }
              
              ?>" alt="...">
            </div>
            <div class="col-md-10">
              <div class="card-body">
                <h4 class="card-title"><?php echo($name); ?><small class="text-muted">&nbsp;&nbsp;&nbsp;<?php echo($ori_name); ?></small></h4>
                
                <p class="card-text"><?php echo($epi); ?>话 / <?php echo($housou_date); ?></p>
              </div>
            </div>
          </div>
        </div>

<?php
  }
  ?>

  <script type="text/javascript">

  </script>

  <div class="container shadow-lg" style="background-color: white;">
    <div>
      <div class="text-center">
        <div class="spinner-border" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

      <div>
        <?php
          if (isset($_GET['keyword']) && ($_GET['keyword']!="" || $_GET['keyword']!=" ")) {
            $keywords = explode(' ',$_GET['keyword']);
            $link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
            //mysqli_select_db($link, DBNAME);
            mysqli_set_charset($link, 'utf8');
      
            $where = "name LIKE '%".$keywords[0]."%'";
      
            for($i = 1; $i < sizeof($keywords); $i++){
              $where .= " AND name LIKE '%".$keywords[$i]."%'";
            }
            $where .=" ORDER BY bangumi_rank;";
      
            $sql = "SELECT COUNT(name) FROM anime WHERE ".$where;
            $count = mysqli_query($link, $sql)->fetch_array()[0];
            
            $sql = "SELECT name,ori_name,country,image_url,episode,housou_date FROM anime WHERE ".$where;
            //echo($sql);
            $result = mysqli_query($link, $sql);
      
            while ($row = $result->fetch_array()) {
              ani_tab($row[0],$row[1],$row[3],$row[4],$row[5]);
          }
        }
        ?>

        <div class="card mb-3" style="max-width: 100%; right: 5px; left: 5px;">
          <div class="row no-gutters">
            <div class="col-md-2">
              <img src="https://lain.bgm.tv/pic/cover/c/cb/57/9717_sAVag.jpg" alt="...">
            </div>
            <div class="col-md-10">
              <div class="card-body">
                <h4 class="card-title">魔法少女小圆<small class="text-muted">&nbsp;&nbsp;&nbsp;魔法少女まどか☆マギカ</small></h4>
                
                <p class="card-text">12话 / 2011年x月x日 / 日语</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3" style="max-width: 100%; right: 5px; left: 5px;">
          <div class="row no-gutters">
            <div class="col-md-2">
              <img src="https://lain.bgm.tv/pic/cover/c/17/ed/274234_iZ22k.jpg" alt="...">
            </div>
            <div class="col-md-10">
              <div class="card-body">
                <h4 class="card-title">小林家的龙女仆S<small class="text-muted">&nbsp;&nbsp;&nbsp;小林さんちのメイドラゴンS</small></h4>
                
                <p class="card-text">12话 / 2021年x月x日 / 日语</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>


<?php
require "./kanban.php";
?>


</body></html>