$(function () {
  $("#user_quit_btn").click(function () {
    $.ajax({
      url: "./php/user_quit.php",
      type: "post",
      data: {},
      cache: false,
      success: function (res) {
        setTimeout(window.location = 'index.php', 500);
      },
      error: function (e) {
        //TODO:弹窗 服务器响应失败

      }
    });
  });

  $("#collapse_btn_"/*因为没有动画效果 暂且关掉了*/).click(function () {
    //修复collapse不能正常折叠的问题
    var item = $('#mainnav');
    var itemClass = item.attr("class");
    if (itemClass === "navbar-collapse collapse show") {
      $(item).attr("class", "navbar-collapse collapse").css("height", "auto");
      //$(".collapse.in").collapse('hide'); 
    }else{
      //$(item).attr("class", "navbar-collapse collapse show").css("height", "auto");
    }
    return false;//停止运行bootstrap自带的函数
  });
});