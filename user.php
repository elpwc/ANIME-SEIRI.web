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

  <iframe>

  </iframe>
  <div>
    <form action="#" class='RegistorForm' method="post">
      <p>邮箱</p><span id='email-tips-message'></span>
      <input type="text" class="form-control" name="email"><br />
      <p>邮箱验证码</p>
      <div class="input-group">
        <input type="text" class="form-control" name="emailverify">
        <span class="input-group-btn">
          <button id="serify_btn" class="btn btn-primary" type="button">
            发送验证码</button>
        </span>
      </div><!-- /input-group -->
      <p>用户名</p>
      <input type="text" class="form-control" name="username"><br />
      <p>密码</p><span>6-18位数字字母特殊符号组合，至少包含数字和字母</span>
      <input type="password" class="form-control" name="password"><br />
      <p>重复再输一遍，请</p>
      <input type="password" class="form-control" name="password2"><br />

      <div class="g-recaptcha" data-callback="botverify" data-sitekey="6Ld7BHQcAAAAAIXgLrclWJIj5S2BErHyC_wLUHTK"></div>

      <input id='u_checkbox' type="checkbox"><span>不同意<a href="#" target="_blank">用户协议</a></span>
      <br />
      <button id="register_btn" type="button" class="btn btn-primary">注册</button>
      <br />
      <span id='tips-message'></span>
      <br />


    </form>


  </div>


</body>

</html>