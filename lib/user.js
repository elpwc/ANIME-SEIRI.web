$(document).ready(function(){
  $('.hide').hide();
  //console.log($('.hide span').text());
  //console.log('1');
  $(".avatar").mouseenter(function(){
    $(".hide").show();
    //console.log('enter');
  });
  $(".avatar").mouseleave(function(){
    $(".hide").hide();
    //console.log('leave');
  });
  
});
