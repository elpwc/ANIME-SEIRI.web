<!DOCTYPE html>
<html>

<head>
  <title>user</title>
  <meta charset="utf-8" />
  <script src="http://www.recaptcha.net/recaptcha/api.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!--script src="./lib/jquery-3.3.1.min.js"></script-->
  <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
  <script src="./lib/user_main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script>
</head>

<body>
  <div>
    <form action="#" class='RegistorForm' method="post">

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
        <label for="register_usernameinput">昵称</label>
        <input type="text" class="form-control" id="register_usernameinput" name="register_username">
      </div>

      <div class="form-group">
        <label for="register_passwordinput">密码</label>
        <input type="password" class="form-control" id="register_passwordinput" name="register_password">
        <small class="form-text text-muted">6-18位数字字母特殊符号组合，至少包含数字和字母</small>
      </div>

      <div class="form-group">
        <label for="register_password2input">再重复输一遍密码</label>
        <input type="password" class="form-control" id="register_password2input" name="register_password2">
      </div>
      <br />

      <div class="g-recaptcha" data-callback="botverify" data-sitekey="6Ld7BHQcAAAAAIXgLrclWJIj5S2BErHyC_wLUHTK"></div>

      <br />
      <div class="form-group form-check">
        <input id='register_u_checkbox' class="form-check-input" type="checkbox">
        <label class="form-check-label" for="register_u_checkbox">
          <span>不同意<a href="#" target="_blank">用户协议</a></span>
        </label>
      </div>

      <div style="text-align: center; width: 100%;">
        <button id="register_btn" type="button" class="btn btn-primary m-auto" style="width: 200px;">注册</button>
      </div>

      <br />
      <small class="form-text text-muted" id='register_tips-message'></small>

    </form>

  </div>

</body>

</html>