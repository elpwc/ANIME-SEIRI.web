<?php

$user_stat = "not_logined";//用户登录状态
$crt_lang = 'zh-cn';//当前界面语言，通过COOKIE设置，COOKIE通过topbar.js设置，topbar.js由语言选择栏调用
$username ="N/A";
//$current_li = 0;

session_start();
if (isset($_SESSION['rempw']) && $_SESSION['rempw']=="yes") {
    //一直开着浏览器 只是跳转网页
    //echo '114';
    setcookie("login", "yes", time()+60*60*24*30);
    setcookie("uid", $_SESSION['uid'], time()+60*60*24*30);
    setcookie("pwmd5", $_SESSION['pwmd5'], time()+60*60*24*30);

    //登陆后第一次跳转setcookie失效的处理
    if (!isset($_COOKIE['login'])) {
        header("Refresh:0");
    }
    $user_stat = "logined";
//echo($_COOKIE['login'].$_COOKIE['uid'].$_COOKIE['pwmd5']);
} else {
    //echo '514'.$_SESSION['rempw'];
    if (isset($_SESSION['rempw']) && $_SESSION['rempw']=="no") {
        //退出登录
        //echo '810';
        setcookie("login", "", 0);
        setcookie("uid", "", 0);
        setcookie("pwmd5", "", 0);
        $user_stat = "not_logined";
        $_SESSION['rempw']=="";
    } elseif (isset($_SESSION['rempw']) && $_SESSION['rempw']=="no_but_dont_quit") {
        //echo 'yajuu';
        //不保存密码登录
        $_SESSION['login'] = true;
        $_SESSION['rempw'] = "no_but_dont_quit";
        $user_stat = "logined";
        $_SESSION['rempw']=="";
    } else {
        //第一次打开浏览器
        if (isset($_COOKIE['login']) && $_COOKIE['login'] == "yes") {
            //保存了密码
            //echo '1919';
            setcookie("login", "yes", time()+60*60*24*30);
            setcookie("uid", $_COOKIE['uid'], time()+60*60*24*30);
            setcookie("pwmd5", $_COOKIE['pwmd5'], time()+60*60*24*30);
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $_COOKIE['uid'];
            $_SESSION['pwmd5'] = $_COOKIE['pwmd5'];
            $_SESSION['rempw'] = "yes";
            if (!isset($_COOKIE['login'])) {
                header("Refresh:0");
            }

            //验证Cookie储存的用户信息(顺便刷新Cookie时长捏
            $uid = $_SESSION['uid'];

            $post_data = array(
              'uid'=> $uid,
              'password'=> $_COOKIE['pwmd5'],
              'pwway'=> 'md5',
              'way'=> 'uid',
              'rempw'=> 'yes'
            );
            $res = send_post('http://localhost/animeseiri/php/login_verify.php', $post_data);
            //$json_data = json_decode($res);
            //var_dump($res);
            $json_obj = json_decode($res);

            if ($json_obj->result == 'success') {
                //验证成功
                //echo "2";
                $user_stat = "logined";
            } else {
                //验证失败
                //echo "3";
                $user_stat = "not_logined";
            }
        } else {
            //没密码保存 新用户首次进入网页
            $user_stat = "not_logined";
            //echo"114514";
        }
    }
}


if (isset($_SESSION['lang']) && $_SESSION['lang'] != "") {
    $crt_lang = $_SESSION['lang'];
    setcookie("lang", $crt_lang, time()+60*60*24*30);
} else {
    if (isset($_COOKIE['lang']) && $_COOKIE['lang'] != "") {
        $_SESSION['lang'] = $_COOKIE['lang'];
    }
}

function logined()
{
    include "./php/escape.php";
    global $username;

    //获取用户名
    
    $uid = $_SESSION['uid'];
    $link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
    //mysqli_select_db($link, DBNAME);
    mysqli_set_charset($link, 'utf8');
    $sql = "SELECT username FROM users WHERE id=".$uid.";";
    $result = mysqli_query($link, $sql);
    
    while ($row = $result->fetch_array()) {
        $username = $row[0];
        break;
    }
    //还原转义
    $username = re_escape_characters_if_sql_injection($username); ?>

<div class="">

  <ul class="navbar-nav">
    <a class="navbar-brand shadow-sm" href="">
      <img src="./users/avatar/default.jpg" alt="" id='logoimg' />
    </a>
    <span class='nav-item mr-3 my-auto'><a href='./user.php'>
        <?php echo($username); ?>
      </a>
      <lang key='TOPBAR_SAN'>さん</lang>
    </span>
    <div class="my-auto"
      style="vertical-align: center;background-color:rgb(255, 115, 138); border-radius: 5px; color:white; height:fit-content; width:fit-content;">
      <span class='nav-item' style="vertical-align: center;"><small>&nbsp;&nbsp;<lang key='TOPBAR_WATCHINGINDEX'>阅番指数
          </lang>:n/a&nbsp;&nbsp;</small></span>
    </div>
    <span class="my-auto" style="color:gray;"><a href="#">&nbsp;<sup>?</sup></a></span>


  </ul>
</div>

<?php
}

function not_logined()
{
    ?>
<div class="btn-group shadow-sm" role="group">
  <button class="btn btn-primary regbtn" type="button" data-toggle="modal" data-target="#register_modal"
    data-backdrop="static">
    <lang key='TOPBAR_REGISTERBTN'>注册</lang>
  </button>
  <button class="btn btn-link loginbtn" type="button" data-toggle="modal" data-target="#login_modal"
    data-backdrop="static">
    <lang key='TOPBAR_LOGINBTN'>登录</lang>
  </button>
</div>

<?php
}

function send_post($url, $post_data_)
{
    $postdata = http_build_query($post_data_);
    $options = array(
        'http' => array(
            'method' => 'POST',
            //'header' => 'Content-type:application/x-www-form-urlencoded\r\n',
            'header' => "Content-type:application/x-www-form-urlencoded\r\nUser-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:86.0) Gecko/20100101 Firefox/86.0\r\nAccept:*/*\r\nAccept-Language:zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2\r\nX-Requested-With:XMLHttpRequest\r\nConnection:keep-alive\r\n",
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}

?>

<link rel="stylesheet" href="lib/topbar.css" />
<script src="./lib/topbar.js"></script>
<script src="./lang/lang.js"></script>
<script src="http://www.recaptcha.net/recaptcha/api.js"></script>
<script src="./lib/register.js"></script>
<script src="./lib/login_main.js"></script>

<nav class="navbar navbar-expand-lg fixed-top navbar-light shadow" id='navbar'>
  <!-- Brand/logo -->
  <a class="navbar-brand" href="./index.php">
    <img src="./src/logo.png" alt="" id='logoimg' />
  </a>

  <button id="collapse_btn" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav"
    aria-controls="mainnav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Links -->
  <div class="collapse navbar-collapse" id="mainnav">
    <ul class="navbar-nav mr-5">
      <li class="nav-item <?php if ($current_li == 0) {
    echo(" active selected_li"); } ?>" id="myanimes_li">
        <a class="nav-link" href="index.php" target="_top" id="myanimes">
          <lang key='TOPBAR_MYANIMES'>我的番剧</lang>
        </a>

      </li>
      <li class="nav-item <?php if ($current_li == 1) {
    echo(" active selected_li"); } ?>"id="allanimes_li">
        <a class="nav-link" href="allanimes.php?type=tv&cntry=ja" target="_top" id="allanimes">
          <lang key='TOPBAR_ALLANIMES'>所有番剧</lang>
        </a>
      </li>
      <li class="nav-item <?php if ($current_li == 2) {
    echo(" active selected_li"); } ?>"id="crtanimes_li">
        <a class="nav-link" href="#" target="_top" id="crtanimes">
          <lang key='TOPBAR_SEASONANIMES'>当季番剧</lang>
        </a>
      </li>
      <?php
          if ($user_stat == 'logined') {
              ?>
      <li class="nav-item dropdown <?php if ($current_li == 3) {
                  echo(" active selected_li"); } ?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-expanded="false">
          <lang key='TOPBAR_USERSETTINGS'>个人设置</lang>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./user.php">
            <lang key='TOPBAR_USERPROFILE'>个人资料</lang>
          </a>
          <a class="dropdown-item" href="#">
            <lang key='TOPBAR_MYMESSAGES'>我的消息</lang>
          </a>
          <div class="dropdown-divider"></div>
          <a id="user_quit_btn" class="dropdown-item" href="#">
            <lang key='TOPBAR_QUIT'>退出登录</lang>
          </a>
        </div>
      </li>
      <?php
          }
          ?>

    </ul>

    <div id='userinfo' class="mr-auto" style="vertical-align: middle;">
      <?php
            switch ($user_stat) {
              case 'logined':
                logined();
              break;
              case 'not_logined':
                not_logined();
              break;
              default:
              break;
            }
          ?>

    </div>

    <div class="mr-auto">
      <img src="./src/bgi.jpg" height="70" />
    </div>
    <div>
      <ul class="navbar-nav mr-1">

        <?php

        print_lang($crt_lang);
            
        function print_lang($crt_lang)
        {
            $lang_json_string = file_get_contents('./json/lang.json');
   
            $langjson = json_decode($lang_json_string, true); ?>
        <li class="nav-item dropdown langli">

          <a class="nav-link dropdown-toggle langlimaina" href="#" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-expanded="false" data-lang='<?php echo($crt_lang); ?>'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe2"
              viewBox="0 0 16 16">
              <path
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z" />
            </svg>
            <?php echo($langjson[$crt_lang]); ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
              foreach ($langjson as $key => $value) {
                  if ($key != $crt_lang) {
                      ?>
            <a class="dropdown-item" href="#" data-lang='<?php echo($key); ?>'>
              <?php echo($value); ?>
            </a>
            <?php
                  }
              } ?>
          </div>
        </li>
        <?php
        }
            ?>
      </ul>
    </div>

    <form class="form-inline">
      <input class="form-control" type="text" placeholder="动画名/用户名" id="search_input">
      <button class="btn btn-success" type="button" id="search_btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
          viewBox="0 0 16 16">
          <path
            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg>
        <lang key='TOPBAR_SEARCHBTN'>搜索</lang>
      </button>
    </form>


  </div><!-- /.navbar-collapse -->
</nav>


<!-- Modal -->
<div class="modal fade" id="register_modal" tabindex="-1" aria-labelledby="register_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="register_modalLabel">
          <lang key='TOPBAR_REGISTERBTN'>注册</lang>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        require "register.php";
        ?>
      </div>
      <!--div class="modal-footer">
        </div-->
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="login_modalLabel">
          <lang key='TOPBAR_LOGINBTN'>登录</lang>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        require "login.php";
        ?>
      </div>
      <!--div class="modal-footer">
        </div-->
    </div>
  </div>
</div>