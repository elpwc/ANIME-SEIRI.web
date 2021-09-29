<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8" />
  <title>忘记密码处理</title>
  <!--link rel="stylesheet" href="./lib/allanimes.css" /-->
  <link rel="icon" href="./src/favicon.ico" sizes="32x32" />
  <!--link rel="stylesheet" href="./lib/bootstrap.min.css" /-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!--script src="./lib/jquery-3.3.1.min.js"></script-->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
  <script src="./lib/forgotpass.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-color:azure;">
  <?php
  require 'topbar.php';
  ?>
  <div class="container" style="background-color: white;">
  <div class="ml-5 mr-5">
  <br/>
  <div>
    <h5><span>忘记密码的处理页<br/><small class="text-muted">&nbsp;密码是加密储存的就算开发者也是找不回来的所以只能麻烦新设置一个密码了（）这次要记好咯</small></span></h5>
  </div>
  <br/>
  
  <form action="#" class='LoginForm' method="post">


  <div class="form-group">
        <label for="register_emailinput">邮箱</label>
        <input type="email" class="form-control" id="register_emailinput" name="register_email">
        <small id='register_email-tips-message' class="form-text text-muted"></small>
      </div>

      <div class="form-group">
        <label for="register_verifyinput">邮箱验证码</label>
        <div class="input-group">
          <input type="text" class="form-control" id="register_verifyinput" name="register_emailverify">
          <span class="input-group-btn">
            <button id="register_serify_btn" class="btn btn-primary" type="button">
              发送验证码
            </button>
          </span>
        </div>
      </div>

      <div class="form-group">
        <label for="register_passwordinput">新密码</label>
        <input type="password" class="form-control" id="register_passwordinput" name="register_password">
        <small class="form-text text-muted">6-18位数字字母特殊符号组合，至少包含数字和字母</small>
      </div>

      <div class="form-group">
        <label for="register_password2input">再重复输一遍新密码</label>
        <input type="password" class="form-control" id="register_password2input" name="register_password2">
      </div>
      <br />

      <div class="g-recaptcha" data-callback="botverify" data-sitekey="6Ld7BHQcAAAAAIXgLrclWJIj5S2BErHyC_wLUHTK"></div>

      <div style="text-align: center; width: 100%;">
        <button id="newpass_btn" type="button" class="btn btn-primary m-auto" style="width: 200px;">修改密码</button>
      </div>

      <br />
      <small class="form-text text-muted" id='register_tips-message'></small>


  </form>
  </div>

  </div>
  <?php
require "./kanban.php";
?>

</body>

</html>