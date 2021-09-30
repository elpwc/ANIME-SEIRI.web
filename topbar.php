<!DOCTYPE html>
<?php
require "./private/dbcfg.php";

$user_stat = "not_logined";

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
    }elseif (isset($_SESSION['rempw']) && $_SESSION['rempw']=="no_but_dont_quit") {
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
        }

        else {
            //没密码保存 新用户首次进入网页
            $user_stat = "not_logined";
            //echo"114514";
        }
    }
}

function logined()
{
    include "./php/escape.php";
    $username ="N/A";

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

<div class="" >
<ul class="navbar-nav">
  <a class="navbar-brand shadow-sm" href="">
    <img src="./users/avatar/default.jpg" alt="" id='logoimg' />
  </a>
  <span class='nav-item'><a href=''>
      <?php echo($username); ?>
    </a></span>

  <span class='nav-item'>阅番指数:n/a</span>

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
  注册
</button>
<button class="btn btn-link loginbtn" type="button" data-toggle="modal" data-target="#login_modal"
  data-backdrop="static">
  登录
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
<html>

<head>
  <title>user</title>
  <meta charset="utf-8" />

  <link rel="stylesheet" href="lib/topbar.css" />

  <!--去掉注释会导致index.php里各个文件被引入两次而出现神必bug e.g.:DropDownMenu不能显示-->
  <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script-->
  <!--jq必须比bs更早地引入-->
  <script src="./lib/topbar.js"></script>
  <!--script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script-->

</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light shadow" id='navbar'>
      <!-- Brand/logo -->
      <a class="navbar-brand" href="./index.php">
        <img src="./src/logo.png" alt="" id='logoimg' />
      </a>

      <button id="collapse_btn" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="mainnav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="mainnav">
        <ul class="navbar-nav mr-5">
          <li class="nav-item <?php if($current_li == 0){echo ("active selected_li");} ?>" id="myanimes_li">
            <a class="nav-link" href="index.php" target = "_top" id="myanimes">我的番剧</a>
            
          </li>
          <li class="nav-item <?php if($current_li == 1){echo ("active selected_li");} ?>"id="allanimes_li">
            <a class="nav-link" href="allanimes.php?type=tv&cntry=ja" target = "_top" id="allanimes">所有番剧</a>
          </li>
          <li class="nav-item <?php if($current_li == 2){echo ("active selected_li");} ?>"id="crtanimes_li">
            <a class="nav-link" href="#" target = "_top" id="crtanimes">当季番剧</a>
          </li>
          <?php
          if ($user_stat == 'logined') {
              ?>
            <li class="nav-item dropdown <?php if($current_li == 3){echo ("active selected_li");} ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-expanded="false">
              个人设置
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="./user.php">个人资料</a>
              <a class="dropdown-item" href="#">我的消息</a>
              <div class="dropdown-divider"></div>
              <a id="user_quit_btn" class="dropdown-item" href="#">退出登录</a>
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

        <form class="form-inline">
          <input class="form-control" type="text" placeholder="动画名/用户名" id="search_input">
          <button class="btn btn-success" type="button" id="search_btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
              viewBox="0 0 16 16">
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
            搜索
          </button>
        </form>


      </div><!-- /.navbar-collapse -->
  </nav>


  <!-- Modal -->
  <div class="modal fade" id="register_modal" tabindex="-1" aria-labelledby="register_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="register_modalLabel">注册</h5>
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
          <h5 class="modal-title" id="login_modalLabel">登录</h5>
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


</body>

</html>