$.fn.profilemenu=function(e){function r(){$(".profilemenu").find("li, a").unbind();if(window.innerWidth<=800){o();s();if(n==0){$(".profilemenu > li:not(.showhide)").hide(0)}}else{u();i()}}function i(){$(".profilemenu li").bind("mouseover",function(){$(this).children(".dropdown, .profilepanel").stop().fadeIn(t.interval)}).bind("mouseleave",function(){$(this).children(".dropdown, .profilepanel").stop().fadeOut(t.interval)})}function s(){$(".profilemenu > li > a").bind("click",function(e){if($(this).siblings(".dropdown, .profilepanel").css("display")=="none"){$(this).siblings(".dropdown, .profilepanel").slideDown(t.interval);$(this).siblings(".dropdown").find("ul").slideDown(t.interval);n=1}else{$(this).siblings(".dropdown, .profilepanel").slideUp(t.interval)}})}function o(){$(".profilemenu > li.showhide").show(0);$(".profilemenu > li.showhide").bind("click",function(){if($(".profilemenu > li").is(":hidden")){$(".profilemenu > li").slideDown(300)}else{$(".profilemenu > li:not(.showhide)").slideUp(300);$(".profilemenu > li.showhide").show(0)}})}function u(){$(".profilemenu > li").show(0);$(".profilemenu > li.showhide").hide(0)}var t={interval:250};var n=0;$(".profilemenu").prepend("<li class='showhide'><span class='title'>PROFILE</span><span class='icon1'></span><span class='icon2'></span></li>");r();$(window).resize(function(){r()})}

var logo = document.getElementById('logo2');
if(window.innerWidth<=800){

logo.style.diplay='block';
}

