$(function(){

// ヘッダ固定
 var headerHight = $('#pc_header').height(); //ヘッダの高さ
  $('a[href^=#]').click(function(){
    var href= $(this).attr("href");
    var target2 = $(href == "#" || href == "" ? 'html' : href);
    var position = target2.offset().top-(headerHight); //ヘッダの高さ分位置をずらす
     $("html, body").animate({scrollTop:position}, 550, "swing");
        return false;
  });
});



var url = $(location).attr('href');
if(url.indexOf("?id=") != -1){
var id = url.split("?id=");
var $target = $('#' + id[id.length - 1]);
if($target.length){
var pos = $target.offset().top;
$("html, body").animate({scrollTop:pos}, 1500);
}
}