/*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 2.1.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v2.1/admin/html/
*/var handleLoginPageChangeBackground=function(){$('[data-click="change-bg"]').live("click",function(a){a.preventDefault();var b='[data-id="login-cover-image"]',c=$(this).find("img").attr("src"),d='<img src="'+c+'" data-id="login-cover-image" />';$(".login-cover-image").prepend(d),$(b).not('[src="'+c+'"]').fadeOut("slow",function(){$(this).remove()}),$('[data-click="change-bg"]').closest("li").removeClass("active"),$(this).closest("li").addClass("active")})},LoginV2=function(){"use strict";return{init:function(){handleLoginPageChangeBackground()}}}();