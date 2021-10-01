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
  <script src="./lib/main.js"></script>
  <link rel="stylesheet" href="./lib/main.css" />
</head>

<body>

<?php
$current_li = 0;
require 'topbar.php';
?>
  <div>

  
  <h3>
  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-hammer" viewBox="0 0 22 22">
  <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
</svg>
Building...</h3>


<div>
    <input type="text" class="form-control" placeholder="name" name="anime_name">
    <input type="text" class="form-control" placeholder="type" name="anime_type">
    <input type="text" class="form-control" placeholder="stat" name="anime_stat">
    <button id="btn1" class="btn btn-primary">add</button>

  </div>
  <div>
    <div class="year-box">
      <span>2021年</span><br/>
      <div class="season-list">
        <span>冬</span>
        
        <table>
          
          <caption></caption>

          <tbody>
            <tr class="season-list-wu_red">
              <th class="season-list-name">魔法少女小圆</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">无</th>
            </tr>
            <tr class="season-list-wei_yellow">
              <th class="season-list-name">初音岛</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">未</th>
            </tr>
            <tr class="season-list-wan_green">
              <th class="season-list-name">CLANNED</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">完</th>
            </tr>
            <tr class="season-list-zheng_purple">
              <th class="season-list-name">命运石之门0</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">正</th>
            </tr>
            <tr class="season-list-lian_blue">
              <th class="season-list-name">小林家的龙女仆</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">连</th>
            </tr>
            <tr class="season-list-qi_gray">
              <th class="season-list-name">爱吃拉面的小泉同学</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">弃</th>
            </tr>
            <tr class="season-list-dai_white">
              <th class="season-list-name">加帕里公园</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">待</th>
            </tr>
            <tr class="season-list-zan_white">
              <th class="season-list-name">摇曳露营△</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">暂</th>
            </tr>
          </tbody>
        </table>


      </div>

      
      <div class="season-list">
        <span>春</span>
        
        <table>
          
          <caption></caption>

          <tbody>
            <tr class="season-list-wu_red">
              <th class="season-list-name">魔法少女小圆</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">无</th>
            </tr>
            <tr class="season-list-wei_yellow">
              <th class="season-list-name">初音岛</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">未</th>
            </tr>
            <tr class="season-list-wan_green">
              <th class="season-list-name">CLANNED</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">完</th>
            </tr>
            <tr class="season-list-zheng_purple">
              <th class="season-list-name">命运石之门0</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">正</th>
            </tr>
            <tr class="season-list-lian_blue">
              <th class="season-list-name">小林家的龙女仆</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">连</th>
            </tr>
            <tr class="season-list-qi_gray">
              <th class="season-list-name">爱吃拉面的小泉同学</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">弃</th>
            </tr>
            <tr class="season-list-dai_white">
              <th class="season-list-name">加帕里公园</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">待</th>
            </tr>
            <tr class="season-list-zan_white">
              <th class="season-list-name">摇曳露营△</th>
              <th class="season-list-type">test1</th>
              <th class="season-list-para">暂</th>
            </tr>
          </tbody>
        </table>


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