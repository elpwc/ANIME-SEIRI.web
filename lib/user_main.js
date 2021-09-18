$(function () {
  $("#serify_btn").click(function () {
    var email = String($("input[name='email']").val()).replace(/<script/ig, "<scribble");

    var check_res = email_check(email);

    switch (check_res) {//check mail address
      case 0://ok
        $.ajax({//邮箱是否已经被注册
          url: './phps/mailexist.php',
          type: 'post',
          //dataType: 'json',
          data: {
            'email': email
          },
          cache: false,
          success: function (res) {
            console.log('email judge suc');
            console.log(res);
            console.log(res.exist);

            if (res.exist == 'yes') {//被注册了
              $("#email-tips-message").html('已经有人用过了捏，如果确实这是你的邮箱请点击<a href="#">这里</a>进行一个处理');
            } else if (res.exist == 'no') {//没被注册

              $("#email-tips-message").text('');
              verify_code = getVerifyCode();
              var data = {
                'email': email,
                'verify': verify_code
              };

              $.ajax({//发邮件
                url: './phps/mail.php',
                type: 'post',
                //dataType: 'json',
                data: data,
                cache: false,
                success: function (res) {
                  $("#email-tips-message").text('已发送, 请进行一个查收');
                  suc_email = email;
                },
                error: function (e) {
                }
              });
            } else {
            }

          },
          error: function (e) {
            console.log('email judge failed');
          }
        });

        break;
      case 1://empty
        $("#email-tips-message").text('请输入邮箱捏');
        break;
      case 2://error
        $("#email-tips-message").text('格式不对喔');
        break;
      default:
        $("#tips-message").text('未知错误捏');
        break;

    }

  });

  $("#register_btn").click(function () {

    $("#register_btn").attr("disabled", "true");

    var email = String($("input[name='email']").val()).replace(/<script/ig, "<scribble");
    var password = String($("input[name='password']").val()).replace(/<script/ig, "<scribble");
    var password2 = String($("input[name='password2']").val()).replace(/<script/ig, "<scribble");
    var username = String($("input[name='username']").val()).replace(/<script/ig, "<scribble");
    var input_verify_code = String($("input[name='emailverify']").val());

    if (password != password2) {//判断密码是否一致
      $("#tips-message").text('密码不一致捏');
      $("#register_btn").removeAttr("disabled");
    } else {
      var passcheck = password_check(password);
      switch (passcheck) {//密码检查
        case 0:

          if (email != suc_email) {//邮箱检查
            $("#tips-message").text('邮箱不对，用刚才验证邮箱的那个，请');
            $("#register_btn").removeAttr("disabled");
          } else {

            if (input_verify_code != verify_code) {//验证码检查
              $("#tips-message").text('验证码不对');
              $("#register_btn").removeAttr("disabled");
            } else {
              var uncheck = username_check(username);
              switch (uncheck) {//用户名检查
                case 0:
                  if (!verified) {//RECAPTCHA检查
                    $("#tips-message").text('没有通过人机身份验证捏');
                    $("#register_btn").removeAttr("disabled");
                  } else {
                    if ($('#u_checkbox').prop('checked')) {//用户协议检查
                      $("#tips-message").text('请同意用户协议捏');
                      $("#register_btn").removeAttr("disabled");
                    } else {

                      //冲！
                      $.ajax({
                        url: './phps/register.php',
                        type: 'post',
                        //dataType: 'json',
                        data: {
                          'email': email,
                          'username': username,
                          'password': password
                        },
                        cache: false,
                        success: function (res) {
                          $("#tips-message").text('注册成功了8, 进行一个跳转');
                          
                          window.location='regst_suc.php';

                        },
                        error: function (e) {
                          $("#tips-message").text('出错惹');
                          $("#register_btn").removeAttr("disabled");
                        }
                      });
                    }
                  }

                  break;
                case 1:
                  $("#tips-message").text('请输入用户名捏');
                  $("#register_btn").removeAttr("disabled");
                  break;
                default:
                  break;
              }

            }

          }

          break;
        case 1:
          $("#tips-message").text('请输一下密码捏球球了');
          $("#register_btn").removeAttr("disabled");
          break;
        case 2:
          $("#tips-message").text('密码不符合标准捏');
          $("#register_btn").removeAttr("disabled");
          break;
        default:
          $("#tips-message").text('未知错误捏');
          $("#register_btn").removeAttr("disabled");
          break;
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

function getData() {
  data = {
    'email': String($("input[name='email']").val()).replace(/<script/ig, "<scribble"),
    'code': String($("input[name='anime_type']").val()),
    'anime_stat': String($("input[name='anime_stat']").val())
  };
  return data;
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

function username_check(name) {
  if (name == '') {
    return 1;
  } else {
    return 0;
  }
}
