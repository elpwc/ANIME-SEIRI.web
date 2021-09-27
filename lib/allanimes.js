$(function () {

});

function item_click(divid, crtitem) {
  $('#' + divid + ' a').each(function () {
    $(this).removeClass('active');
  });
  crtitem.addClass('active');
  goto();
}

function allbtn_item_click(divid) {
  $('#' + divid + ' a').each(function () {
    $(this).removeClass('active');
  });
  $('#' + divid + ' #all').addClass('active');
  goto();
}

function goto() {
  window.location.replace(getgeturl());
  /*
  $.get('./allanimes.php',getdata(),function(data, status){
    alert("suc");
    alert(data);
    alert(status);
  });

  $.ajax({
    url: './allanimes.php',
    type: 'get',
    data: getdata(),
    cache: false,
    success: function (res) {
      alert("suc");
    },
    error: function (e) {
      alert("sippai");
    }
  });
  */
}

function getgeturl() {
  url = "./allanimes.php?";
  var list1 = [], list2 = [];
  $("#selectors .selector").each(function () {
    var crtdiv = $(this);
    var name = crtdiv.attr("data-get-name");
    crtdiv.find('a').each(function () {
      var item = $(this);
      if (item.hasClass('active')) {
        var item_name = item.attr("data-get-name");
        if (item_name != "") {
          list1.push(name);
          list2.push(item_name);
        }
      }
    });
  });
  for (let i = 0; i < list1.length; i++) {
    url += list1[i] + "=" + list2[i];
    if (i != list1.length - 1) {
      url += "&";
    }
  }
  return url;
}

function getdata() {
  data = {};
  $("#selectors .selector").each(function () {
    var crtdiv = $(this);
    var name = crtdiv.attr("data-get-name");
    crtdiv.find('a').each(function () {
      var item = $(this);

      if (item.hasClass('active') && item_name != "") {
        var item_name = item.attr("data-get-name");
        //alert(item_name); 
        data[name] = item_name;
      }
    });
  });
  //alert(JSON.stringify(data));
  return data;
}