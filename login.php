<!DOCTYPE html>
<html>

<head>
  <title>user</title>
  <meta charset="utf-8" />
  <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
    crossorigin="anonymous"></script-->
    <script src="./lib/login_main.js"></script>
</head>

<body>
  <div>
    <form action="#" class='LoginForm' method="post">

      <div class="form-group">
        <label for="login_emailinput">邮箱</label>
        <input type="email" class="form-control" id="login_emailinput" name="login_email">
        <small id='login_email-tips-message' class="form-text text-muted"></small>
      </div>

      <div class="form-group">
        <label for="login_passwordinput">密码</label>
        <input type="password" class="form-control" id="login_passwordinput" name="login_password">
      </div>

      <br />
      <div class="ml-auto" style="text-align: right;"><span ><a href="#">忘记密码点这里处理捏</a></span></div>
      <br/>
      <div class="form-group form-check">
        <input id='login_u_checkbox' class="form-check-input" type="checkbox">
        <label class="form-check-label" for="login_u_checkbox">
          <span class="mr-auto">记住密码以后自动登录(在用别人的电脑的话就别记了|∀°)</span><br/>
          
          <!--span><a href="#">注册账号</a></span-->
        </label>
        
      </div>
      

      <div style="text-align: center; width: 100%;">
        <button id="login_btn" type="button" class="btn btn-primary m-auto" style="width: 200px;">登录</button>
      </div>

      <br />
      <small class="form-text text-muted" id='login_tips-message'></small>

    </form>

  </div>

</body>

</html>