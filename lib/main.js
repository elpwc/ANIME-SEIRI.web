$(function () {
  $("#btn1").click(function () {
    if (String($("input[name='anime_name']").val()) == "") {
      //$("#tips-message").text('请先输入学号()');
    } else {
      //$("#tips-message").text('开始申请，正在取回结果，请假天数越多等待时间越久（大概一天1秒(?)），请稍等...');
      $("#btn1").attr("disabled", "true");
      var data = getData();

      $.ajax({
        url: './main.php',
        type: 'post',
        //dataType: 'json',
        data: data,
        cache: false,
        success: function (res) {
          $("#tips-message").text('申请完毕，学校接口返回的结果如下:');
          var restext = res.split("|")[1];
          $("#result-message").html(restext);
        },
        error: function (e) {
        }
      });

      $("#btn1").removeAttr("disabled");
    }
  });
});

function getData() {
  data = {
    'anime_name': String($("input[name='anime_name']").val()).replace(/<script/ig, "<scribble"),
    'anime_type': String($("input[name='anime_type']").val()),
    'anime_stat': String($("input[name='anime_stat']").val())
  };
  return data;
}