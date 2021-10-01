$(function () {
  $("#forgot_serify_btn").click(function () {

    $("#forgot_serify_btn").attr("disabled", "true");

    var email = String($("input[name='forgot_email']").val());

    //非法字符检查
    if (check_if_js_css_injection(email)) {
      $("#forgot_email-tips-message").html('邮箱不对捏');
      $("#forgot_serify_btn").removeAttr("disabled");
    } else {
      var check_res = email_check(email);
      switch (check_res) {//check mail address
        case 0://ok
          $.ajax({//邮箱是否已经被注册
            url: './php/mailexist.php',
            type: 'post',
            //dataType: 'json',
            data: {
              'email': email
            },
            cache: false,
            success: function (res) {
              console.log('email judge suc');
              console.log(res.exist);

              if (res.exist == 'no') {//没被注册
                $("#forgot_email-tips-message").html('这个邮箱还没被注册捏，如果事你的邮箱的话快去注册一个新账号8');
                $("#forgot_serify_btn").removeAttr("disabled");
              } else if (res.exist == 'yes') {//有注册

                $("#forgot_serify_btn").html("发送中...");

                $("#forgot_email-tips-message").text('');
                verify_code = getVerifyCode();
                var data = {
                  'email': email,
                  'verify': verify_code
                };

                $.ajax({//发邮件
                  url: './php/mail.php',
                  type: 'post',
                  //dataType: 'json',
                  data: data,
                  cache: false,
                  success: function (res) {
                    $("#forgot_email-tips-message").text('已发送, 请进行一个查收');
                    suc_email = email;
                    console.log(res);
                    //验证码倒计时
                    max_sec = 40;
                    $("#forgot_serify_btn").html(String(max_sec) + "秒后可重发");//第一秒的显示
                    timer1 = setInterval("countdown_forgot()", 1000);
                  },
                  error: function (e) {
                    $("#forgot_serify_btn").removeAttr("disabled");
                  }
                });
              } else {
                $("#forgot_serify_btn").removeAttr("disabled");
              }

            },
            error: function (e) {
              console.log('email judge failed');
              $("#forgot_serify_btn").removeAttr("disabled");
            }
          });

          break;
        case 1://empty
          $("#forgot_email-tips-message").text('请输入邮箱捏');
          $("#forgot_serify_btn").removeAttr("disabled");
          break;
        case 2://error
          $("#forgot_email-tips-message").text('格式不对喔');
          $("#forgot_serify_btn").removeAttr("disabled");
          break;
        default:
          $("#forgot_tips-message").text('未知错误捏');
          $("#forgot_serify_btn").removeAttr("disabled");
          break;

      }
    }

  });

  $("#forgot_btn").click(function () {

    $("#forgot_btn").attr("disabled", "true");

    var email = String($("input[name='forgot_email']").val());
    var password = String($("input[name='forgot_password']").val());
    var password2 = String($("input[name='forgot_password2']").val());
    var input_verify_code = String($("input[name='forgot_emailverify']").val());

    //非法字符检查
    if (check_if_js_css_injection(email) ||  check_if_js_css_injection(password)) {
      $("#forgot_tips-message").html('不能出现<>等符号捏');
      $("#forgot_btn").removeAttr("disabled");
    } else {
      if (password != password2) {//判断密码是否一致
        $("#forgot_tips-message").text('密码不一致捏');
        $("#forgot_btn").removeAttr("disabled");
      } else {
        var passcheck = password_check(password);
        switch (passcheck) {//密码检查
          case 0:

            if (email != suc_email) {//邮箱检查
              $("#forgot_tips-message").text('邮箱不对，用刚才验证邮箱的那个，请');
              $("#forgot_btn").removeAttr("disabled");
            } else {

              if (input_verify_code != verify_code) {//验证码检查
                $("#forgot_tips-message").text('验证码不对');
                $("#forgot_btn").removeAttr("disabled");
              } else {

                if (!verified) {//RECAPTCHA检查
                  $("#forgot_tips-message").text('没有通过人机身份验证捏');
                  $("#forgot_btn").removeAttr("disabled");
                } else {
                  //冲！
                  $.ajax({
                    url: './php/modifypass.php',
                    type: 'post',
                    //dataType: 'json',
                    data: {
                      'email': email,
                      'password': password
                    },
                    cache: false,
                    success: function (res) {
                      $("#forgot_tips-message").html('修改成功了，马上跳转首页');

                      console.log(res);

                      setTimeout(window.location = 'index.php', 2000);


                    },
                    error: function (e) {
                      $("#forgot_tips-message").text('出错惹');
                      $("#forgot_btn").removeAttr("disabled");
                    }
                  });
                }
              }
            }
            break;
          case 1:
            $("#forgot_tips-message").text('请输一下密码捏球球了');
            $("#forgot_btn").removeAttr("disabled");
            break;
          case 2:
            $("#forgot_tips-message").text('密码不符合标准捏');
            $("#forgot_btn").removeAttr("disabled");
            break;
          default:
            $("#forgot_tips-message").text('未知错误捏');
            $("#forgot_btn").removeAttr("disabled");
            break;
        }
      }
    }


  });


});

var verify_code = ''; //邮箱验证码
var last_send_time = ''; //上次发送验证码的时间
var suc_email = ''; //成功发送的邮箱
var verified = false;//是否已经通过RECAPTCHA

function botverify() {//recaptcha callback function
  //$("#tips-message").text('not bot!');
  verified = true;
}


function getVerifyCode() {
  return String(randomNum(0, 999999)).padStart(6, '0');
}

//生成从minNum到maxNum的随机数
function randomNum(minNum, maxNum) {
  switch (arguments.length) {
    case 1:
      return parseInt(Math.random() * minNum + 1, 10);
      break;
    case 2:
      return parseInt(Math.random() * (maxNum - minNum + 1) + minNum, 10);
      break;
    default:
      return 0;
      break;
  }
}

function email_check(email) {//0 ok, 1 empty, 2 error
  var reg = new RegExp(/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/); //正则表达式
  if (email === "") { //输入不能为空
    return 1;
  } else if (!reg.test(email)) { //正则验证不通过，格式不对
    return 2;
  } else {
    return 0;
  }
}

function password_check(pw) {//0 ok, 1 empty, 2 error
  var reg = new RegExp(/^(?=.*\d)(?=.*[a-zA-Z])[\da-zA-Z~!@#$%^&*]{6,18}$/); //正则表达式
  if (pw === "") { //输入不能为空
    return 1;
  } else if (!reg.test(pw)) { //正则验证不通过，格式不对
    return 2;
  } else {
    return 0;
  }
}

//验证码按钮倒计时
var max_sec = 40;
function countdown_forgot() {
  if (max_sec > 1) {
    max_sec--;
    $("#forgot_serify_btn").html(String(max_sec) + "秒后可重发");
  } else {
    clearInterval(timer1);
    $("#forgot_serify_btn").removeAttr("disabled");
    $("#forgot_serify_btn").html("发送验证码");
  }

}

function check_if_js_css_injection(text) {
  if (text.indexOf(/</ig) != -1 || text.indexOf(/>/ig) != -1 || text.indexOf(/\r/ig) != -1 || text.indexOf(/\n/ig) != -1) {
    return true;
  } else {
    return false;
  }
}