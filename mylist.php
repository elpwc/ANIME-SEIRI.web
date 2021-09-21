<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>ANIME SEIRI.web</title>
  <link rel="stylesheet" href="./lib/main.css" />
  <link rel="icon" href="./src/favicon.ico" sizes="32x32" />
  <!--link rel="stylesheet" href="./lib/bootstrap.min.css" /-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!--script src="./lib/jquery-3.3.1.min.js"></script-->
  <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
  <script src="./lib/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script>
</head>

<body>

<?php
require 'topbar.php';
?>
  <div>
  <h3>test page</h3>
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
</body>

</html>