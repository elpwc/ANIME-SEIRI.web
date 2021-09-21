<!DOCTYPE html>
<html>

<head>
  <title>user</title>
  <meta charset="utf-8" />

  <link rel="stylesheet" href="lib/topbar.css" />

  <script src="http://www.recaptcha.net/recaptcha/api.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!--script src="./lib/jquery-3.3.1.min.js"></script-->
  <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
  <!--script src="./lib/user_main.js"></script-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top navbar-light shadow" id='navbar'>
    <div class="container-fluid">
      <!-- Brand/logo -->
      <a class="navbar-brand" href="./index.php">
        <img src="./src/logo.png" alt="" id='logoimg' />
      </a>

      <!-- Links -->
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-5">
          <li class="nav-item active">
            <a class="nav-link" href="#">我的番剧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">所有番剧</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">当季番剧</a>
          </li>

        </ul>

        <form class="form-inline mr-auto">
          <input class="form-control" type="text" placeholder="动画名">
          <button class="btn btn-success" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
              viewBox="0 0 16 16">
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
            搜索
          </button>
        </form>

        <div class="mr-auto">
        <img src="./src/bgi.jpg" height="70"/>
        </div>

        <div id='userinfo'>
          <?php
            session_start();

            if(empty($_SESSION["login"])){
              if(empty($_COOKIE["login"])){
                //没有登录
                not_logined();
              }else{
                //保存了密码 但是是首次打开浏览器
                $_SESSION['login'] = true;
                $_SESSION['uid'] = $uid;
                logined();
              }
            }else{
              //一直开着浏览器 只是跳转网页
              logined();
            }

            function logined(){
              //echo("".."");
          ?>
          <span>username</span>
          <span>阅番指数：n/a</span>
          <button class="btn btn-light" type="button">个人设置</button>
          <?php
            }

            function not_logined(){
          ?>
          <div class="btn-group shadow-sm" role="group">
            <button class="btn btn-primary regbtn" type="button" data-toggle="modal"
              data-target="#register_modal">注册</button>
            <button class="btn btn-link loginbtn" type="button" data-toggle="modal"
              data-target="#login_modal">登录</button>
          </div>

          <?php
            }
          ?>

        </div>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="register_modal" tabindex="-1" aria-labelledby="register_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">注册</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
        require "user.php";
        ?>
        </div>
        <!--div class="modal-footer">
      </div-->
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">登录</h5>
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