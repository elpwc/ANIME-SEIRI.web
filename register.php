

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
        <input id='register_u_checkbox2' class="form-check-input" type="checkbox">
        <label class="form-check-label" for="register_u_checkbox2">
          <span>我知道ANIME-SEIRI是一款提供<b>追番进度管理</b>的网站，<b>不提供动画资源</b></a></span>
        </label>
      </div>
      <!--div class="form-group form-check">
        <input id='register_u_checkbox3' class="form-check-input" type="checkbox">
        <label class="form-check-label" for="register_u_checkbox">
          <span>我知道ANIME-SEIRI是一款提供<b>追番进度管理</b>的网站，<b>不提供动画资源</b></a></span>
        </label>
      </div>
      <div class="form-group form-check">
        <input id='register_u_checkbox4' class="form-check-input" type="checkbox">
        <label class="form-check-label" for="register_u_checkbox">
          <span>我知道ANIME-SEIRI是一款提供<b>追番进度管理</b>的网站，<b>不提供动画资源</b></a></span>
        </label>
      </div-->
      <div class="form-group form-check">
        <input id='register_u_checkbox' class="form-check-input" type="checkbox">
        <label class="form-check-label" for="register_u_checkbox">
          <span>我未满16岁</a></span>
        </label>
      </div>

      <div style="text-align: center; width: 100%;">
        <button id="register_btn" type="button" class="btn btn-primary m-auto" style="width: 200px;">注册</button>
      </div>

      <br />
      <small class="form-text text-muted" id='register_tips-message'></small>

    </form>

  </div>

