$(function(){
  $("#user_quit_btn").click(function(){
    $.ajax({
      url:"./phps/user_quit.php",
      type:"post",
      data: {},
      cache: false,
      success:function(res){
        setTimeout(window.location = 'index.php', 500);
      },
      error:function(e){
        //TODO:弹窗 服务器响应失败

      }
    });
  });
});