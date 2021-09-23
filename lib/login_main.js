$(function () {
  $("#login_btn").click(function () {
    $("#login_btn").attr("disabled", "true");

    var email = String($("#login_emailinput").val());
    var password = String($("#login_passwordinput").val());
    var rempw = "no";

    if ($('#login_u_checkbox').prop('checked')) {
      rempw = "yes";
    }

    var check_res = email_check(email);
    switch (check_res) {//check mail address
      case 0://ok
        if (password.length < 6) {//check pw
          $("#login_tips-message").text("请输入完整的密码捏");
          $("#login_btn").removeAttr("disabled");
        } else {
          $.ajax({
            url: './phps/login_verify.php',
            type: 'post',
            data: {
              'email': email,
              'password': password,
              'way': 'email',
              'rempw': rempw,
              'pwway': 'original'
            },
            cache: false,
            success: function (res) {
              console.log('data take back success');
              console.log(res);
              var obj = JSON.parse(res);
              console.log(obj.result);

              switch (obj.result) {
                case "illegal way name":
                  $("#login_tips-message").text("内部错误，请联系网站管理员修bug捏");
                  $("#login_btn").removeAttr("disabled");
                  break;
                case "not exist":
                  $("#login_tips-message").text("这个邮箱没被注册捏");
                  $("#login_btn").removeAttr("disabled");
                  break;
                case "password incorrect":
                  $("#login_tips-message").text("密码不对捏");
                  $("#login_btn").removeAttr("disabled");
                  break;
                case "success":
                  $("#login_tips-message").text("登录成功捏！！！！！");
                  setTimeout(window.location = 'index.php', 2000);
                  break;
                default:
                  $("#login_tips-message").text("未知错误捏");
                  $("#login_btn").removeAttr("disabled");
                  break;
              }
            },
            error: function (e) {
              $("#login_tips-message").text("服务器响应失败捏");
              $("#login_btn").removeAttr("disabled");
            }
          });
        }
        break;
      case 1://empty
        $("#login_tips-message").text("请输入邮箱捏");
        $("#login_btn").removeAttr("disabled");
        break;
      case 2://error
        $("#login_tips-message").text('邮箱格式不对喔');
        $("#login_btn").removeAttr("disabled");
        break;
      default:
        $("#login_tips-message").text('未知错误捏');
        $("#login_btn").removeAttr("disabled");
        break;

    }

  });
});

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