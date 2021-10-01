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
      <div class="ml-auto" style="text-align: right;"><span ><a href="./forgotpass.php">忘记密码点这里处理捏</a></span></div>
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
