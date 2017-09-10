$(function(){

// Config ================================================== //
var $header = $('#header'),
headerHight;

// ロード・リサイズ処理 ================================================== //
var timer = false,
resizeW,
winW = window.innerWidth ? window.innerWidth: $(window).width(),
viewMode = _getViewMode(winW);

if(viewMode=='PC'){
_pcMode();
}else{
_spMode();
}

// resize
$(window).on('resize',function(){
  if (timer !== false){
    clearTimeout(timer);
  }
  timer = setTimeout(function(){
    resizeW = window.innerWidth ? window.innerWidth: $(window).width();
    if(winW != resizeW){
      winW = resizeW;
      viewMode = _getViewMode(winW);
      if(viewMode=='PC'){
        _pcMode();
      }else{
        _spMode();
      }
    }
  },200);
});

// scroll load
$(window).on('scroll load',function(){
  onFloatingButton();
  if(viewMode=='SP'){
    _spMode();
  }
});


// 画面判定 ================================================== //
function _getViewMode(winW){
  var BreakPoint_PC = 768;
  if(winW >= BreakPoint_PC){
    return 'PC';
  }else{
    return 'SP';
  }
}

// _pcMode ================================================== //
function _pcMode(headerHight){
}

// _spMode ================================================== //
function _spMode(headerHight){

// ヘッダ固定
  var sp_scrollHeight = $(this).scrollTop();
  if(sp_scrollHeight >= 10){
    headerHight = 40; //ヘッダの高さスクロール時
    $('#sp_header .inner').hide();
    $('#sp_header ul#menuBtn li#hidden_logo').show();
    $('#sp_header ul#menuBtn li span').hide();
    $('#sp_header ul#menuBtn li:nth-child(2),#sp_header ul#menuBtn li:nth-child(3)').css('width','12%');
    $('#sp_header ul#menuBtn li i').css('margin-right','0');
  }else{
    headerHight = 160; //ヘッダの高さ初期
    $('#sp_header .inner').show();
    $('#sp_header ul#menuBtn li#hidden_logo').hide();
    $('#sp_header ul#menuBtn li span').show();
    $('#sp_header ul#menuBtn li:nth-child(2),#sp_header ul#menuBtn li:nth-child(3)').css('width','50%');
    $('#sp_header ul#menuBtn li i').css('margin-right','5px');
  }
  $header.css({'height':headerHight});
  $('#container').css({'padding-top':headerHight});

// バーガーメニュー
  $('#sp_header #menuBtn #openMenu').click(function(){
    $('ul#menu').slideDown('10');
  });
  $('#sp_header #menu #closeBtn').click(function(){
    $('ul#menu').slideUp('10');
  });
  $('ul#menu li a[href^=#]').click(function(){
    $('ul#menu').hide();
  });
}


	// グローバルメニューhover効果 ==================================================
	$('#globalNav ul li a').hover(function(){
		$(this).next('span').css('visibility','visible');
	}).click(function(){
		$('#globalNav ul li a').css('opacity','1');
		$(this).css('opacity','0.7');
	});
	$('#globalNav ul li a').mouseout(function(){
		$(this).next('span').css('visibility','hidden');
	});


	// pageTop ================================================== //

	function init(){
		$page_top.hide();
	}


	// _positionSet
	function _positionSet(){
		if(viewMode=='PC'){
			headerHight = _pcMode(headerHight);
		}else{
			headerHight = _spMode(headerHight);
		}
	}


// FloatingButton
  var $page_top = $('#pageTop');
  function onFloatingButton(){
    var scroll_top = $(window).scrollTop();
    if(scroll_top>100){
      $page_top.fadeIn();
    }else{
      if($page_top.is(':visible')){
        $page_top.fadeOut();
      }
    }
  }

function scrollPage(){
  // ヘッダ固定
  headerHight = $('#header').height(); //ヘッダの高さ
  $header.css({'height':headerHight});
  $('#container').css({'padding-top':headerHight});
/*ページ内＃リンク*/
 $('a[href^=#]').click(function(){
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'body' : href);
    var position = target.offset().top-headerHight;
//ヘッダの高さ分位置をずらす
    $("html, body").animate({scrollTop:position}, 550, "swing");
    });
 /*ページ外＃リンク*/
    var url = $(location).attr('href');
      if (url.indexOf("?id=") != -1) {
  // スムーズスクロールの処理
        var url_sp = url.split("?id=");
        var hash = '#' + url_sp[url_sp.length - 1];
        var target2 = $(hash);
        var position2 = target2.offset().top-headerHight;
        $("html, body").animate({scrollTop:position2},550,"swing");
      }
  }

scrollPage();

	// init ================================================== //
	function init(){
		$page_top.hide();
	}

}); // $(function(){ End ================================================== //


/**
* jquery.matchHeight-min.js master
* http://brm.io/jquery-match-height/
* License: MIT
*/
$(function(){
	$('').matchHeight();
});
(function(c){var n=-1,f=-1,g=function(a){return parseFloat(a)||0},r=function(a){var b=null,d=[];c(a).each(function(){var a=c(this),k=a.offset().top-g(a.css("margin-top")),l=0<d.length?d[d.length-1]:null;null===l?d.push(a):1>=Math.floor(Math.abs(b-k))?d[d.length-1]=l.add(a):d.push(a);b=k});return d},p=function(a){var b={byRow:!0,property:"height",target:null,remove:!1};if("object"===typeof a)return c.extend(b,a);"boolean"===typeof a?b.byRow=a:"remove"===a&&(b.remove=!0);return b},b=c.fn.matchHeight=
function(a){a=p(a);if(a.remove){var e=this;this.css(a.property,"");c.each(b._groups,function(a,b){b.elements=b.elements.not(e)});return this}if(1>=this.length&&!a.target)return this;b._groups.push({elements:this,options:a});b._apply(this,a);return this};b._groups=[];b._throttle=80;b._maintainScroll=!1;b._beforeUpdate=null;b._afterUpdate=null;b._apply=function(a,e){var d=p(e),h=c(a),k=[h],l=c(window).scrollTop(),f=c("html").outerHeight(!0),m=h.parents().filter(":hidden");m.each(function(){var a=c(this);
a.data("style-cache",a.attr("style"))});m.css("display","block");d.byRow&&!d.target&&(h.each(function(){var a=c(this),b=a.css("display");"inline-block"!==b&&"inline-flex"!==b&&(b="block");a.data("style-cache",a.attr("style"));a.css({display:b,"padding-top":"0","padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px"})}),k=r(h),h.each(function(){var a=c(this);a.attr("style",a.data("style-cache")||"")}));c.each(k,function(a,b){var e=c(b),
f=0;if(d.target)f=d.target.outerHeight(!1);else{if(d.byRow&&1>=e.length){e.css(d.property,"");return}e.each(function(){var a=c(this),b=a.css("display");"inline-block"!==b&&"inline-flex"!==b&&(b="block");b={display:b};b[d.property]="";a.css(b);a.outerHeight(!1)>f&&(f=a.outerHeight(!1));a.css("display","")})}e.each(function(){var a=c(this),b=0;d.target&&a.is(d.target)||("border-box"!==a.css("box-sizing")&&(b+=g(a.css("border-top-width"))+g(a.css("border-bottom-width")),b+=g(a.css("padding-top"))+g(a.css("padding-bottom"))),
a.css(d.property,f-b+"px"))})});m.each(function(){var a=c(this);a.attr("style",a.data("style-cache")||null)});b._maintainScroll&&c(window).scrollTop(l/f*c("html").outerHeight(!0));return this};b._applyDataApi=function(){var a={};c("[data-match-height], [data-mh]").each(function(){var b=c(this),d=b.attr("data-mh")||b.attr("data-match-height");a[d]=d in a?a[d].add(b):b});c.each(a,function(){this.matchHeight(!0)})};var q=function(a){b._beforeUpdate&&b._beforeUpdate(a,b._groups);c.each(b._groups,function(){b._apply(this.elements,
this.options)});b._afterUpdate&&b._afterUpdate(a,b._groups)};b._update=function(a,e){if(e&&"resize"===e.type){var d=c(window).width();if(d===n)return;n=d}a?-1===f&&(f=setTimeout(function(){q(e);f=-1},b._throttle)):q(e)};c(b._applyDataApi);c(window).bind("load",function(a){b._update(!1,a)});c(window).bind("resize orientationchange",function(a){b._update(!0,a)})})(jQuery);
