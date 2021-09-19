$(function () {
  $("#register_btn").click(function () {

    $("#register_btn").attr("disabled", "true");

    var name = String($("input[name='name']").val()).replace(/<script/ig, "<scribble");
    var type = String($("select[name='type']").get(0).selectedIndex);
    var year = String($("input[name='year']").val());
    var month = String($("input[name='month']").val());
    var episode_count = String($("input[name='episode_count']").val()).replace(/<script/ig, "<scribble");
    var housou_stat = String($("select[name='housou_stat']").get(0).selectedIndex);
    var link = String($("input[name='link']").val()).replace(/<script/ig, "<scribble");
    var image = String($("input[name='image']").val()).replace(/<script/ig, "<scribble");
    var ova = $('#ova_checkbox').prop('checked');

    //冲！
    $.ajax({
      url: './phps/addanime.php',
      type: 'post',
      //dataType: 'json',
      data: {
        'name': name,
        'type': type,
        'year': year,
        'month': month,
        'episode_count': episode_count,
        'housou_stat': housou_stat,
        'link': link,
        'image': image,
        'ova' : ova
      },
      cache: false,
      success: function (res) {
        $("#tips-message").text('成功');

        clear_all();
        $("#register_btn").removeAttr("disabled");
      },
      error: function (e) {
        $("#tips-message").text('出错惹');
        $("#register_btn").removeAttr("disabled");

        clear_all();
      }
    });


  });


});

function clear_all(){
  $("input[name='name']").val('');
  $("select[name='type']").get(0).selectedIndex=0;
  $("input[name='year']").val('');
  $("input[name='month']").val('');
  $("input[name='episode_count']").val('');
  $("select[name='housou_stat']").get(0).selectedIndex=0;
  $("input[name='link']").val('');
  $("input[name='image']").val('');
  $('#ova_checkbox').attr("checked",'');
}