function drags(e,a,s){e.on("mousedown touchstart",function(t){e.addClass("draggable"),a.addClass("resizable");var o=t.pageX?t.pageX:t.originalEvent.touches[0].pageX,i=e.outerWidth(),r=e.offset().left+i-o,n=s.offset().left,l=s.outerWidth();minLeft=n+10,maxLeft=n+l-i-10,e.parents().on("mousemove touchmove",function(e){var s=e.pageX?e.pageX:e.originalEvent.touches[0].pageX;leftValue=s+r-i,leftValue<minLeft?leftValue=minLeft:leftValue>maxLeft&&(leftValue=maxLeft),widthValue=100*(leftValue+i/2-n)/l+"%",$(".draggable").css("left",widthValue).on("mouseup touchend touchcancel",function(){$(this).removeClass("draggable"),a.removeClass("resizable")}),$(".resizable").css("width",widthValue)}).on("mouseup touchend touchcancel",function(){e.removeClass("draggable"),a.removeClass("resizable")}),t.preventDefault(),t.stopPropagation()}).on("mouseup touchend touchcancel",function(s){e.removeClass("draggable"),a.removeClass("resizable")})}if(function(e){"use strict";e(window).on("load",function(){e("body").addClass("loaded").delay(1e3).queue(function(){e(".preloader").addClass("d-none").dequeue()})}),e(window).scroll(function(){e(this).scrollTop()>100?e("#scroll-top").addClass("show"):e("#scroll-top").removeClass("show")}),e("#scroll-top").click(function(){return e("html, body").animate({scrollTop:0},600),!1}),e(".sl_header .mainmenu a,.navbar .navbar-nav .nav-link,.side-nav .navbar-nav .nav-link").click(function(){return e(".header-menu .active").removeClass("active"),e(this).addClass("active"),e("html, body").stop().animate({scrollTop:e(e(this).attr("href")).offset().top-80},300),!1}),e(window).on("load",function(){if(e(".isotope-item").length>0){e(".isotope-item").isotope({itemSelector:".item",layoutMode:"fitRows"});e(".nav-item").click(function(){e(".nav-item").removeClass("active"),e(this).addClass("active");var a=e(this).attr("data-filter");return e(".isotope-item").isotope({filter:a}),!1})}if(e(".page-item").length>0){e(".page-item").isotope({itemSelector:".item",layoutMode:"fitRows"});e(".filter-item").click(function(){e(".filter-item").removeClass("active"),e(this).addClass("active");var a=e(this).attr("data-filter");return e(".page-item").isotope({filter:a}),!1})}}),e(window).scroll(function(){e(this).scrollTop()>100?e(".header-unpinned").addClass("static"):e(".header-pinned").removeClass("show")}),e(window).on("load",function(){e(".masonry-activation").imagesLoaded(function(){e(".masonry-wrap").isotope({itemSelector:".masonary-item",percentPosition:!0,transitionDuration:"0.7s",masonry:{columnWidth:1}});e(".nav-item").click(function(){e(".nav-item").removeClass("active"),e(this).addClass("active");var a=e(this).attr("data-filter");return e(".gallery-wrapper").isotope({filter:a}),!1})})});var a=e("html"),s=e(".demo-option-container"),t=e("body");function o(){t.removeClass("page-search-popup-opened"),a.css({overflow:""})}function i(){e(".header-black-to-white").each(function(){e(window).width()<992?(e(this).removeClass("header-black-version"),e(this).addClass("header-light-version"),e("#change-logo").attr("src","img/logo/logo-white.svg"),e(".popup-mobile-click").removeClass("dark-version"),e(".popup-mobile-click").addClass("light-version")):(e(this).removeClass("header-light-version"),e(this).addClass("header-black-version"),e("#change-logo").attr("src","img/logo/logo-black.svg"),e(".popup-mobile-click").removeClass("light-version"),e(".popup-mobile-click").addClass("dark-version"))})}function r(){e(".header-white-to-black").each(function(){e(window).width()>992?(e(this).removeClass("header-light-version"),e(this).addClass("header-black-version"),e("#change-logo").attr("src","img/logo/logo-black.svg"),e(".popup-mobile-click").removeClass("light-version"),e(".popup-mobile-click").addClass("dark-version")):(e(this).removeClass("header-black-version"),e(this).addClass("header-light-version"),e("#change-logo").attr("src","img/logo/logo-white.svg"),e(".popup-mobile-click").removeClass("dark-version"),e(".popup-mobile-click").addClass("light-version"))})}function n(){t.removeClass("popup-mobile-menu-wrapper"),a.css({overflow:""})}if(e(".btn-search-click").on("click",function(s){s.preventDefault(),function(){t.addClass("page-search-popup-opened"),a.css({overflow:"hidden"});var s=e(".sl-search-popup").find("form input[type='search']");setTimeout(function(){s.focus()},500)}()}),e(".search-close").on("click",function(e){e.preventDefault(),o()}),e(".sl-search-popup").on("click",function(e){e.target===this&&o()}),e(".header-full-menu .inner-header").length&&e(window).on("scroll",function(){e(this).scrollTop()>260?e(".header-full-menu .inner-header").addClass("header-full-active"):e(".header-full-menu .inner-header").removeClass("header-full-active")}),e("#sidemenu_toggle").length&&(e("#sidemenu_toggle").on("click",function(){e(".side-menu").removeClass("side-menu-opacity"),e(".pushwrap").toggleClass("active"),e(".side-menu").addClass("side-menu-active"),e("#close_side_menu").fadeIn(700)}),e("#close_side_menu").on("click",function(){e(".side-menu").removeClass("side-menu-active"),e(this).fadeOut(200),e(".pushwrap").removeClass("active"),setTimeout(function(){e(".side-menu").addClass("side-menu-opacity")},500)}),e(".side-nav .navbar-nav .nav-link").on("click",function(){e(".side-menu").removeClass("side-menu-active"),e("#close_side_menu").fadeOut(200),e(".pushwrap").removeClass("active"),setTimeout(function(){e(".side-menu").addClass("side-menu-opacity")},500)}),e("#btn_sideNavClose").on("click",function(){e(".side-menu").removeClass("side-menu-active"),e("#close_side_menu").fadeOut(200),e(".pushwrap").removeClass("active"),setTimeout(function(){e(".side-menu").addClass("side-menu-opacity")},500)})),e(".header-sticky").headroom(),e(".quick-option").on("click",function(a){a.preventDefault(),s.toggleClass("open"),setTimeout(function(){e(".quick-option i").hasClass("fa-sliders-h")?(e(".quick-option i").addClass("ti-close"),e(".quick-option i").removeClass("fa fa-sliders-h")):(e(".quick-option i").removeClass("ti-close"),e(".quick-option i").addClass("fa fa-sliders-h"))},800)}),e(document).ready(function(){i(),r(),e(window).resize(function(){i(),r()})}),e(".minicart-trigger").on("click",function(a){a.stopPropagation(),e(this).siblings(".shopping-cart").slideToggle("400"),e(this).siblings(".shopping-cart").toggleClass("show");e(this).parents(".mini-cart").siblings().children(".shopping-cart");e(this).parents(".mini-cart").siblings().children(".shopping-cart").slideUp("400")}),e(".popup-mobile-click").on("click",function(e){e.preventDefault(),t.addClass("popup-mobile-menu-wrapper"),a.css({overflow:"hidden"})}),e(".mobile-close").on("click",function(e){e.preventDefault(),n()}),e(".popup-mobile-visiable").on("click",function(e){e.target===this&&n()}),e(".js-rotating").length&&e(".js-rotating").Morphext({animation:"flipInY",separator:",",speed:5e3,complete:function(){}}),e(".hamberger-trigger").on("click",function(a){a.preventDefault(),e(".open-hamberger-wrapper").addClass("is-visiable")}),e(".page-close").on("click",function(a){a.preventDefault(),e(".open-hamberger-wrapper").removeClass("is-visiable")}),e(".object-custom-menu > li.has-mega-menu > a").on("click",function(a){a.preventDefault(),e(this).siblings(".object-submenu").slideToggle("400"),e(this).toggleClass("active").siblings(".object-submenu").toggleClass("is-visiable")}),e(".componant-slider").slick({centerMode:!0,centerPadding:"60px",slidesToShow:3,dots:!0,responsive:[{breakpoint:768,settings:{arrows:!1,centerMode:!0,centerPadding:"40px",slidesToShow:3}},{breakpoint:480,settings:{arrows:!1,centerMode:!0,centerPadding:"40px",slidesToShow:1}}]}),e(".slider").length>0&&(e(".slider").slick({autoplay:!0,speed:800,lazyLoad:"progressive",arrows:!0,dots:!1,prevArrow:'<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',nextArrow:'<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>'}).slickAnimation(),e(".slick-nav").on("click touch",function(a){a.preventDefault();var s=e(this);s.hasClass("animate")||(s.addClass("animate"),setTimeout(()=>{s.removeClass("animate")},1600))})),e("#datetimepickerdark, #datetimepickerdark2").datetimepicker({datepicker:!0,format:"d-m-y H:i",theme:"dark"}),e("#datetimepicker, #datetimepicker2").datetimepicker({datepicker:!0,format:"d-m-y H:i"}),e(window).on("load",function(){e("#npgallery2").justifiedGallery({rowHeight:320,maxRowHeight:null,margins:2,border:0,rel:"npgallery2",lastRow:"nojustify",captions:!0,randomize:!1,sizeRangeSuffixes:{lt100:"_t",lt240:"_m",lt320:"_n",lt500:"",lt640:"_z",lt1024:"_b"}})}),ScrollReveal().reveal(".npreveal",{delay:500,useDelay:"onload",reset:!0}),e("#sticky").theiaStickySidebar({MarginTop:80}),e(window).scroll(function(){e(this).scrollTop()>100?e("#GotoTop").fadeIn():e("#GotoTop").fadeOut()}),e("#GotoTop").click(function(){return e("html, body").animate({scrollTop:0},600),!1}),e("#cursor").length>0)new NodeCursor({cursor:!0,node:!0,cursor_velocity:0,node_velocity:.75,native_cursor:"none",element_to_hover:".nodeHover",cursor_class_hover:"disable",node_class_hover:"expand",hide_mode:!0,hide_timing:2e3});if(e("a").on("mouseleave",function(){e("#cursor").removeClass("active"),e("#cursor").removeClass("active")}),e(".count").counterUp({delay:10,time:3500}),e("[data-countdown]").each(function(){var a=e(this),s=e(this).data("countdown");a.countdown(s,function(e){a.html(e.strftime('<span class="sl-count days"><span class="count-inner"><span class="time-count">%-D</span> <p>Days</p></span></span> <span class="sl-count hour"><span class="count-inner"><span class="time-count">%-H</span> <p>Hours</p></span></span> <span class="sl-count minutes"><span class="count-inner"><span class="time-count">%M</span> <p>Minutes</p></span></span> <span class="sl-count second"><span class="count-inner"><span class="time-count">%S</span> <p>Seconds</p></span></span>'))})}),e("#DateCountdown").TimeCircles({animation:"smooth",bg_width:.6,fg_width:.033,circle_bg_color:"#eeeeee",time:{Days:{text:"Days",color:"#0038E3",show:!0},Hours:{text:"Hours",color:"#0038E3",show:!0},Minutes:{text:"Minutes",color:"#0038E3",show:!0},Seconds:{text:"Seconds",color:"#0038E3",show:!0}}}),e("#commingsoon").TimeCircles({animation:"smooth",bg_width:.6,fg_width:.033,circle_bg_color:"#8a8a8a",time:{Days:{text:"Days",color:"#ffffff",show:!0},Hours:{text:"Hours",color:"#ffffff",show:!0},Minutes:{text:"Minutes",color:"#ffffff",show:!0},Seconds:{text:"Seconds",color:"#ffffff",show:!0}}}),e(document).on("click","[data-bs-toggle-class]",function(a){var s=e(this),t=s.attr("data-bs-toggle-class"),o=s.attr("data-bs-toggle-class-target")||s.attr("data-target"),i=s.attr("data-target-closest"),r=t&&t.split(",")||"",n=o&&o.split(",")||Array(s),l=0;e.each(r,function(a,t){var o=i?s.closest(n[1==n.length?0:l]):e(n[1==n.length?0:l]),c=o.attr("data-class"),d=r[a];c!=d&&o.removeClass(o.attr("data-class")),o.toggleClass(r[a]),o.attr("data-class",d),l++}),s.toggleClass("active"),"#"==s.attr("href")&&a.preventDefault()}),e("audio").audioPlayer(),(new WOW).init(),e("select.nice-select").niceSelect(),e(function(){e(".field-wrapper .field-placeholder").on("click",function(){e(this).closest(".field-wrapper").find("input").focus(),e(this).closest(".field-wrapper").find("textarea").focus()}),e(".field-wrapper input,.field-wrapper textarea").on("change",function(){e.trim(e(this).val())?e(this).closest(".field-wrapper").addClass("hasValue"):e(this).closest(".field-wrapper").removeClass("hasValue")})}),e.fn.owlCarousel){var l=e(".welcome-slides");l.owlCarousel({items:1,loop:!0,autoplay:!0,smartSpeed:1e3,autoplayTimeout:1e4,nav:!0,dots:!1,responsive:{0:{nav:!1},769:{nav:!0}},navText:['<i class="fa fa-arrow-left"></i>','<i class="fa fa-arrow-right"></i>']}),l.on("translate.owl.carousel",function(){e("[data-animation]").each(function(){var a=e(this).data("animation");e(this).removeClass("animated "+a).css("opacity","0")})}),e("[data-delay]").each(function(){var a=e(this).data("delay");e(this).css("animation-delay",a)}),e("[data-duration]").each(function(){var a=e(this).data("duration");e(this).css("animation-duration",a)}),l.on("translated.owl.carousel",function(){l.find(".owl-item.active").find("[data-animation]").each(function(){var a=e(this).data("animation");e(this).addClass("animated "+a).css("opacity","1")})})}var c=!0,d="M11,10 L18,13.74 18,22.28 11,26 M18,13.74 L26,18 26,18 18,22.28",u="M11,10 L17,10 17,26 11,26 M20,10 L26,10 26,26 20,26",p=e("#animation");function m(){var a=0;e("body").on("mouseenter",".fancybox-hover-block",function(){a=parseInt(e(this).find(".fancy-box-info").outerHeight(!0)),e(this).find(".fancy-box-header").css("transform","translateY(-"+a+"px)")}),e("body").on("mouseleave",".fancybox-hover-block",function(){e(this).find(".fancy-box-header").css("transform","translateY(0)")})}function m(){var a=0;e("body").on("mouseenter",".fancybox-hover-block",function(){a=parseInt(e(this).find(".fancy-box-info").outerHeight(!0)),e(this).find(".fancy-box-header").css("transform","translateY(-"+a+"px)")}),e("body").on("mouseleave",".fancybox-hover-block",function(){e(this).find(".fancy-box-header").css("transform","translateY(0)")})}e(".ytp-play-button").on("click",function(){c=!c,p.attr({from:c?d:u,to:c?u:d}).get(0).beginElement()}),e(".video-popup").magnificPopup({type:"iframe"}),m(),m(),"[data-typed]".length>0&&e("[data-typed]").each(function(a,s){new Typed(s,{strings:JSON.parse(e(s).attr("data-typed")),typeSpeed:200,backSpeed:150,backDelay:1e3,loop:!0})}),e(document).ready(function(){e("#sl-testimonial-slider").owlCarousel({items:1,loop:!0,autoplay:!0,margin:10,dots:!1,nav:!1})}),e(".slide-one-item").length>0&&e(".slide-one-item").owlCarousel({items:1,loop:!0,stagePadding:0,margin:0,autoplay:!0,animateOut:"fadeOutUp",animateIn:"fadeIn",pauseOnHover:!1,nav:!0,navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e(".restaurant-testimonial").length>0&&e(".restaurant-testimonial").owlCarousel({items:1,loop:!0,stagePadding:0,margin:0,autoplay:!0,pauseOnHover:!1,nav:!0,dots:!0,navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e(".portfolio-multi-image-slider").length>0&&e(".portfolio-multi-image-slider").owlCarousel({items:1,loop:!0,stagePadding:0,margin:0,autoplay:!0,pauseOnHover:!0,nav:!1,dots:!0}),e(".portfolio-testimonial").length>0&&e(".portfolio-testimonial").owlCarousel({items:1,loop:!0,stagePadding:0,margin:0,autoplay:!0,pauseOnHover:!1,nav:!1,dots:!0,navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e(".architect-project-carousel").length>0&&e(".architect-project-carousel").owlCarousel({items:1,loop:!0,margin:10,autoplay:!0,pauseOnHover:!1,nav:!0,dots:!1,navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e(".customNextBtn").click(function(e){e.preventDefault(),owl.trigger("next.owl.carousel")}),e(".customPrevBtn").click(function(e){e.preventDefault(),owl.trigger("prev.owl.carousel")}),e(".basic-client-carousel").length>0&&e(".basic-client-carousel").owlCarousel({items:6,loop:!0,stagePadding:0,margin:30,autoplay:!0,animateOut:"fadeOut",animateIn:"fadeIn",pauseOnHover:!1,dots:!1,nav:!1,responsive:{0:{items:1},480:{items:1},560:{items:2},760:{items:4},990:{items:4},1200:{items:6},1500:{items:6}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e(".app-alider").length>0&&e(".app-alider").owlCarousel({items:2,loop:!0,stagePadding:0,margin:30,autoplay:!0,animateOut:"fadeOut",animateIn:"fadeIn",pauseOnHover:!1,dots:!1,nav:!1,responsive:{0:{items:1},480:{items:1},560:{items:1},760:{items:1},990:{items:2},1200:{items:2},1500:{items:2}}}),e(".feature-slider").length>0&&e(".feature-slider").owlCarousel({items:1.5,loop:!0,stagePadding:20,margin:20,dots:!1,autoplay:!0,animateOut:"fadeOut",animateIn:"fadeIn",pauseOnHover:!1,nav:!0,responsive:{0:{items:1},480:{items:1},560:{items:1},760:{items:1},990:{items:2},1200:{items:3},1500:{items:3}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e(".wedding-blog-item").length>0&&e(".wedding-blog-item").owlCarousel({items:1.5,loop:!0,stagePadding:0,margin:0,dots:!1,autoplay:!0,animateOut:"fadeOut",animateIn:"fadeIn",pauseOnHover:!1,nav:!0,responsive:{0:{items:1},480:{items:1},560:{items:2},760:{items:1},990:{items:1},1200:{items:1},1500:{items:1}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e("#blogslide4").length>0&&e("#blogslide4").owlCarousel({slideBy:2,loop:!0,margin:20,autoplay:!0,pauseOnHover:!1,nav:!1,dots:!1,responsive:{0:{items:1,margin:0},480:{items:1,margin:0},560:{items:2},760:{items:3},990:{items:3},1200:{items:4},1500:{items:4}}}),e(".testimonial-item").length>0&&e(".testimonial-item").owlCarousel({items:2.5,loop:!0,stagePadding:0,margin:0,dots:!1,autoplay:!0,animateOut:"zoomOut",animateIn:"zoomIn",pauseOnHover:!1,nav:!0,responsive:{0:{items:1},480:{items:1},560:{items:2},770:{items:2},990:{items:2.5},1200:{items:2.5},1500:{items:2.5}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e(".blog-half-slider").length>0&&e(".blog-half-slider").owlCarousel({items:2.5,loop:!0,stagePadding:0,margin:40,dots:!1,autoplay:!0,animateOut:"zoomOut",animateIn:"zoomIn",pauseOnHover:!1,nav:!1,responsive:{0:{items:1},480:{items:1},560:{items:2},770:{items:2},990:{items:2.5},1200:{items:2.5},1500:{items:2.5}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e("#video-box").length>0&&e("#video-box").owlCarousel({items:4,loop:!0,stagePadding:0,margin:20,singleItem:!0,dots:!1,autoplay:!0,pauseOnHover:!1,nav:!1,responsive:{0:{items:1},480:{items:2},560:{items:2},770:{items:3},990:{items:3},1200:{items:4},1500:{items:4}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e("#instagram").length>0&&e("#instagram").owlCarousel({items:5,loop:!0,stagePadding:0,margin:20,singleItem:!0,dots:!1,autoplay:!0,pauseOnHover:!1,nav:!1,responsive:{0:{items:2},480:{items:2},560:{items:4},770:{items:4},990:{items:5},1200:{items:5},1500:{items:5}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e("#team-carousel-1").length>0&&e("#team-carousel-1").owlCarousel({items:4,loop:!0,stagePadding:0,margin:20,singleItem:!0,autoplay:!0,pauseOnHover:!1,dots:!1,nav:!1,responsive:{0:{items:1},480:{items:1},560:{items:2},770:{items:3},990:{items:4},1200:{items:4},1500:{items:4}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']}),e("#team-carousel-2").length>0&&e("#team-carousel-2").owlCarousel({items:4,loop:!0,stagePadding:0,margin:20,singleItem:!0,autoplay:!0,pauseOnHover:!1,dots:!1,nav:!1,responsive:{0:{items:1},480:{items:1},560:{items:2},770:{items:3},990:{items:4},1200:{items:4},1500:{items:4}},navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']});new Swiper(".services-carousel",{slidesPerGroup:1,loop:!0,speed:1e3,parallax:!0,autoplay:3e3,speed:800,spaceBetween:30,navigation:!1,pagination:!1,breakpoints:{2500:{slidesPerView:3.5},2000:{slidesPerView:3.5},1499:{slidesPerView:3.5},1200:{slidesPerView:2.5},991:{slidesPerView:2},767:{slidesPerView:1},300:{slidesPerView:1}}});e(".testimonial-classic").length>0&&e(".testimonial-classic").owlCarousel({items:1,loop:!0,stagePadding:0,margin:0,dots:!0,autoplay:!0,pauseOnHover:!1,nav:!1,navText:['<span class="ti-arrow-left">','<span class="ti-arrow-right">']});for(var h=[],v=document.querySelectorAll(".parallax-scene"),f=0;f<v.length;f++)h[f]=new Parallax(v[f]);e(".sl-hero-has-animation").length>0&&setTimeout(function(){e(".sl-hero-has-animation").addClass("sl-hero-animate")},100);var g=1;e(".sl-hero-props-carousel-1 .carousel-item").each(function(a,s){0==a&&e(".sl-hero-props-carousel-1-prices").addClass("sl-price-active sl-first-time"),e(".sl-hero-props-carousel-1-prices .sl-carousel-ticker-counter").append("<span>0"+g+"</span>"),g+=1}),e(".sl-hero-props-carousel-1-prices .sl-carousel-ticker-total").append("<span>0"+e(".sl-hero-props-carousel-1 .carousel-item").length+"</span>"),e(".sl-hero-props-carousel-1").on("slide.bs.carousel",function(a){e(".sl-hero-props-carousel-1-prices").removeClass("sl-first-time"),e(".sl-hero-props-carousel-1-prices").carousel(a.to)}),e(".sl-hero-props-carousel-1").on("slid.bs.carousel",function(a){var s=13*a.to;e(".sl-hero-props-carousel-1-prices .sl-carousel-ticker-counter > span").css("transform","translateY(-"+s+"px)")}),e(".sl-hero-props-carousel-1 .sl-carousel-control-next").click(function(a){e(".sl-hero-props-carousel-1").carousel("next")}),e(".sl-hero-props-carousel-1 .sl-carousel-control-prev").click(function(a){e(".sl-hero-props-carousel-1").carousel("prev")}),e(".sl-hero-props-carousel-2-right").on("slide.bs.carousel",function(a){"left"==a.direction?e(".sl-hero-props-carousel-2-left").carousel("next"):e(".sl-hero-props-carousel-2-left").carousel("prev")}),e(".sl-hero-props-carousel-2 .sl-carousel-control-next").click(function(a){e(".sl-hero-props-carousel-2-right").carousel("next")}),e(".sl-hero-props-carousel-2 .sl-carousel-control-prev").click(function(a){e(".sl-hero-props-carousel-2-right").carousel("prev")});var w=1;e(".sl-hero-props-carousel-2-right .carousel-item").each(function(a,s){e(".sl-hero-props-carousel-2 .sl-carousel-ticker-counter").append("<span>0"+w+"</span>"),w+=1}),e(".sl-hero-props-carousel-2 .sl-carousel-ticker-total").append("<span>0"+e(".sl-hero-props-carousel-2-right .carousel-item").length+"</span>"),e(".sl-hero-props-carousel-2-right").on("slid.bs.carousel",function(a){var s=13*a.to;e(".sl-hero-props-carousel-2 .sl-carousel-ticker-counter > span").css("transform","translateY(-"+s+"px)")}),e("[data-bg-image]").each(function(){e(this).data("image",e(this).css("background-image"));var a="url('"+e(this).attr("data-bg-image")+"')";e(this).css("background-image",a)}),e("[data-opacity]").each(function(){e(this).data("opacity",e(this).css("opacity"));var a=e(this).attr("data-opacity");e(this).css("opacity",a)}),e("[data-height]").each(function(){e(this).data("height",e(this).css("height"));var a=e(this).attr("data-height");e(this).css("height",a)}),window.sr=ScrollReveal({reset:!1}),sr.reveal(".block-reveal",{viewFactor:.5}),sr.reveal(".text-block",{viewFactor:.5}),e.fn.visible=function(a){var s=e(this),t=e(window),o=t.scrollTop(),i=o+t.height(),r=s.offset().top,n=r+s.height();return(!0===a?r:n)<=i&&(!0===a?n:r)>=o};var b=e(".block-reveal");if(b.each(function(a,s){(s=e(s)).visible(!0)&&s.addClass("already-visible")}),e(window).scroll(function(a){b.each(function(a,s){(s=e(s)).visible(!0)&&s.addClass("block-reveal-inner")})}),e(window).scroll(function(a){b.each(function(a,s){(s=e(s)).visible(!0)&&s.addClass("block-reveal-inner")})}),e(".radial-progress").waypoint(function(){e(".radial-progress").easyPieChart({lineWidth:5,scaleLength:0,rotate:-45,trackColor:!1,lineCap:"square",size:200})},{triggerOnce:!0,offset:"bottom-in-view"}),e("#slider-range").slider({range:!0,min:10,max:500,values:[110,400],slide:function(a,s){e("#amount").val("$"+s.values[0]+" - $"+s.values[1])}}),e("#amount").val("$"+e("#slider-range").slider("values",0)+" - $"+e("#slider-range").slider("values",1)),e(".pro-qty").prepend('<span class="dec qtybtn">-</span>'),e(".pro-qty").append('<span class="inc qtybtn">+</span>'),e(".qtybtn").on("click",function(){var a=e(this),s=a.parent().find("input").val();if(a.hasClass("inc"))var t=parseFloat(s)+1;else if(s>0)t=parseFloat(s)-1;else t=0;a.parent().find("input").val(t)}),e(".google-map-area").length>0);function C(a){a.matches?e("#vanta-globe").length>0&&VANTA.GLOBE({el:"#vanta-globe",mouseControls:!1,touchControls:!0,gyroControls:!1,minHeight:300,minWidth:50,scale:1,scaleMobile:.5,color:16749824,color2:16761600,size:1,backgroundColor:16119285}):e("#vanta-globe").length>0&&VANTA.GLOBE({el:"#vanta-globe",mouseControls:!1,touchControls:!0,gyroControls:!1,minHeight:700,minWidth:400,scale:.9,scaleMobile:1,color:16749824,color2:16761600,size:.9,backgroundColor:16119285})}e(window).on("scroll",function(){e(this).scrollTop()>220?e(".creative-st-header").addClass("header-appear"):e(".creative-st-header").removeClass("header-appear")}),e(window).on("scroll",function(){e(this).scrollTop()>500?e(".scroll-top-arrow").fadeIn("slow"):e(".scroll-top-arrow").fadeOut("slow")}),e(document).on("click",".scroll-top-arrow",function(){return e("html, body").animate({scrollTop:0},800),!1}),e(".scroll").on("click",function(a){a.preventDefault(),e("html,body").animate({scrollTop:e(this.hash).offset().top-60},1200)}),e(window).width()>992&&e(".studio-parallax").parallaxie({speed:.55,offset:0}),e(window).on("load",function(){e(".side-menu.hidden").removeClass("hidden")}),e("#sidemenu_toggle").length&&(e("#sidemenu_toggle").on("click",function(){e(".pushwrap").toggleClass("active"),e(".side-menu").addClass("side-menu-active"),e("#close_side_menu").fadeIn(700)}),e("#close_side_menu").on("click",function(){e(".side-menu").removeClass("side-menu-active"),e(this).fadeOut(200),e(".pushwrap").removeClass("active")}),e(".side-nav .navbar-nav .nav-link").on("click",function(){e(".side-menu").removeClass("side-menu-active"),e("#close_side_menu").fadeOut(200),e(".pushwrap").removeClass("active")}),e("#btn_sideNavClose").on("click",function(){e(".side-menu").removeClass("side-menu-active"),e("#close_side_menu").fadeOut(200),e(".pushwrap").removeClass("active")})),e(".comparision-slider").each(function(){var a=e(this),s=a.width()+"px";a.find(".resize img").css("width",s),drags(a.find(".handle"),a.find(".resize"),a)}),e(window).resize(function(){e(".comparision-slider").each(function(){var a=e(this),s=a.width()+"px";a.find(".resize img").css("width",s)})}),document.getElementById("marketsChartBtcLight")&&am4core.ready(function(){var e=am4core.create("marketsChartBtcLight",am4charts.XYChart);e.data=function(){var e=[],a=new Date;a.setMinutes(a.getDate()-500);for(var s=500,t=0;t<500;t++){var o=new Date(a);o.setMinutes(o.getMinutes()+t),s+=Math.round((Math.random()<.5?1:-1)*Math.random()*10),e.push({date:o,prices:s})}return e}();var a=e.xAxes.push(new am4charts.DateAxis);a.baseInterval={timeUnit:"minute",count:1},a.tooltip.disabled=!0,a.renderer.grid.template.disabled=!0,a.renderer.labels.template.disabled=!0,a.renderer.ticks.template.disabled=!0,a.renderer.paddingBottom=15;var s=e.yAxes.push(new am4charts.ValueAxis);s.tooltip.disabled=!0,s.renderer.grid.template.disabled=!0,s.renderer.labels.template.disabled=!0,s.renderer.ticks.template.disabled=!0;var t=e.series.push(new am4charts.LineSeries);t.dataFields.dateX="date",t.dataFields.valueY="prices",t.tooltipText="prices: [bold]{valueY}[/]",t.fillOpacity=.1,t.fill=am4core.color("#00cc93"),t.stroke=am4core.color("#00cc93"),t.tooltip.getFillFromObject=!1,t.tooltip.background.fill=am4core.color("#2a2e39"),t.tooltip.background.stroke=am4core.color("#2a2e39"),e.cursor=new am4charts.XYCursor,e.cursor.lineY.opacity=1,a.start=0,a.keepSelection=!0,e.zoomOutButton.background.fill=am4core.color("rgba(0, 0, 0, 0.09)"),e.zoomOutButton.icon.stroke=am4core.color("rgba(0, 0, 0, 0.40)"),e.zoomOutButton.background.states.getKey("hover").properties.fill=am4core.color("#00cc93")}),document.getElementById("marketsChartEthLight")&&am4core.ready(function(){var e=am4core.create("marketsChartEthLight",am4charts.XYChart);e.data=function(){var e=[],a=new Date;a.setMinutes(a.getDate()-500);for(var s=500,t=0;t<500;t++){var o=new Date(a);o.setMinutes(o.getMinutes()+t),s+=Math.round((Math.random()<.5?1:-1)*Math.random()*10),e.push({date:o,prices:s})}return e}();var a=e.xAxes.push(new am4charts.DateAxis);a.baseInterval={timeUnit:"minute",count:1},a.tooltip.disabled=!0,a.renderer.grid.template.disabled=!0,a.renderer.labels.template.disabled=!0,a.renderer.ticks.template.disabled=!0,a.renderer.paddingBottom=15;var s=e.yAxes.push(new am4charts.ValueAxis);s.tooltip.disabled=!0,s.renderer.grid.template.disabled=!0,s.renderer.labels.template.disabled=!0,s.renderer.ticks.template.disabled=!0;var t=e.series.push(new am4charts.LineSeries);t.dataFields.dateX="date",t.dataFields.valueY="prices",t.tooltipText="prices: [bold]{valueY}[/]",t.fillOpacity=.1,t.fill=am4core.color("#f74745"),t.stroke=am4core.color("#f74745"),t.tooltip.getFillFromObject=!1,t.tooltip.background.fill=am4core.color("#2a2e39"),t.tooltip.background.stroke=am4core.color("#2a2e39"),e.cursor=new am4charts.XYCursor,e.cursor.lineY.opacity=1,a.start=0,a.keepSelection=!0,e.zoomOutButton.background.fill=am4core.color("rgba(0, 0, 0, 0.09)"),e.zoomOutButton.icon.stroke=am4core.color("rgba(0, 0, 0, 0.40)"),e.zoomOutButton.background.states.getKey("hover").properties.fill=am4core.color("#f74745")}),document.getElementById("marketsChartLtcLight")&&am4core.ready(function(){var e=am4core.create("marketsChartLtcLight",am4charts.XYChart);e.data=function(){var e=[],a=new Date;a.setMinutes(a.getDate()-500);for(var s=500,t=0;t<500;t++){var o=new Date(a);o.setMinutes(o.getMinutes()+t),s+=Math.round((Math.random()<.5?1:-1)*Math.random()*10),e.push({date:o,prices:s})}return e}();var a=e.xAxes.push(new am4charts.DateAxis);a.baseInterval={timeUnit:"minute",count:1},a.tooltip.disabled=!0,a.renderer.grid.template.disabled=!0,a.renderer.labels.template.disabled=!0,a.renderer.ticks.template.disabled=!0,a.renderer.paddingBottom=15;var s=e.yAxes.push(new am4charts.ValueAxis);s.tooltip.disabled=!0,s.renderer.grid.template.disabled=!0,s.renderer.labels.template.disabled=!0,s.renderer.ticks.template.disabled=!0;var t=e.series.push(new am4charts.LineSeries);t.dataFields.dateX="date",t.dataFields.valueY="prices",t.tooltipText="prices: [bold]{valueY}[/]",t.fillOpacity=.1,t.fill=am4core.color("#00cc93"),t.stroke=am4core.color("#00cc93"),t.tooltip.getFillFromObject=!1,t.tooltip.background.fill=am4core.color("#2a2e39"),t.tooltip.background.stroke=am4core.color("#2a2e39"),e.cursor=new am4charts.XYCursor,e.cursor.lineY.opacity=1,a.start=0,a.keepSelection=!0,e.zoomOutButton.background.fill=am4core.color("rgba(0, 0, 0, 0.09)"),e.zoomOutButton.icon.stroke=am4core.color("rgba(0, 0, 0, 0.40)"),e.zoomOutButton.background.states.getKey("hover").properties.fill=am4core.color("#00cc93")}),e("#vanta-globe").length>0&&VANTA.GLOBE({el:"#vanta-globe",mouseControls:!1,touchControls:!0,gyroControls:!1,minHeight:700,minWidth:400,scale:.9,scaleMobile:1,color:16749824,color2:16761600,size:.9,backgroundColor:16119285});var k=window.matchMedia("(max-width: 768px)");C(k),k.addListener(C),e(".portfolio-carousel").owlCarousel({loop:!0,margin:10,slideSpeed:5e3,slideTransition:"linear",nav:!1,dots:!1,autoplay:!1,autoplayTimeout:8e3,autoplayHoverPause:!0,responsive:{0:{items:1},600:{items:1},1000:{items:1}}}),e(".portfolio-right-arr").click(function(){var a=e(".portfolio-carousel");a.owlCarousel(),a.trigger("next.owl.carousel")}),e(".portfolio-left-arr").click(function(){var a=e(".portfolio-carousel");a.owlCarousel(),a.trigger("prev.owl.carousel")}),e.fn.jPushMenu=function(a){var s=e.extend({},e.fn.jPushMenu.defaultOptions,a);e("body").addClass(s.pushBodyClass),e(this).addClass("jPushMenuBtn"),e(this).click(function(a){a.stopPropagation();var t="",o="";e(this).is("."+s.showLeftClass)?(t=".cbp-spmenu-left",o="toright"):e(this).is("."+s.showRightClass)?(t=".cbp-spmenu-right",o="toleft"):e(this).is("."+s.showTopClass)?t=".cbp-spmenu-top":e(this).is("."+s.showBottomClass)&&(t=".cbp-spmenu-bottom"),""!=t&&(e(this).toggleClass(s.activeClass),e(t).toggleClass(s.menuOpenClass),e(this).is("."+s.pushBodyClass)&&""!=o&&e("body").toggleClass(s.pushBodyClass+"-"+o),e(".jPushMenuBtn").not(e(this)).toggleClass("disabled"))});var t=function(a){e(".jPushMenuBtn,body,.cbp-spmenu").removeClass("disabled "+a.activeClass+" "+a.menuOpenClass+" "+a.pushBodyClass+"-toleft "+a.pushBodyClass+"-toright")};s.closeOnClickOutside&&e(document).click(function(){t(s)})},e.fn.jPushMenu.defaultOptions={pushBodyClass:"push-body",showLeftClass:"menu-left",showRightClass:"menu-right",showTopClass:"menu-top",showBottomClass:"menu-bottom",activeClass:"menu-active",menuOpenClass:"menu-open",closeOnClickOutside:!0,closeOnClickLink:!0};new Swiper(".columned-slider-inner",{slidesPerView:4,spaceBetween:0,breakpoints:{1250:{slidesPerView:4},1050:{slidesPerView:3},768:{slidesPerView:2},750:{slidesPerView:2},550:{slidesPerView:1},0:{slidesPerView:1}}})}(jQuery),$("#creative_studio_menu").length){new bootstrap.ScrollSpy(document.body,{target:"#creative_studio_menu"})}function openNav(){document.getElementById("mySidenav").style.width="250px"}function closeNav(){document.getElementById("mySidenav").style.width="0"}jQuery(".testimonial-slider2").owlCarousel({items:1,loop:!0,margin:30,nav:!1,dots:!1,autoplay:!0,smartSpeed:1e3,autoplayTimeout:3e3,autoplayHoverPause:!0}),$(".progress-bar").each(function(){$(this).appear(function(){$(this).animate({width:$(this).attr("aria-valuenow")+"%"},3e3)})}),$("#sidemenu_toggle").length&&($("#sidemenu_toggle").on("click",function(){$(".pushwrap").toggleClass("active"),$(".side-menu-portfolio").addClass("side-menu-active"),$("#close_side_menu").fadeIn(700)}),$("#close_side_menu").on("click",function(){$(".side-menu-portfolio").removeClass("side-menu-active"),$(this).fadeOut(200),$(".pushwrap").removeClass("active")}),$(".side-nav .navbar-nav .nav-link").on("click",function(){$(".side-menu-portfolio").removeClass("side-menu-active"),$("#close_side_menu").fadeOut(200),$(".pushwrap").removeClass("active")}),$("#btn_sideNavClose").on("click",function(){$(".side-menu-portfolio").removeClass("side-menu-active"),$("#close_side_menu").fadeOut(200),$(".pushwrap").removeClass("active")})),$(window).width()>992?$(window).on("scroll",function(){$(this).scrollTop()>260?($("header").addClass("header-appear"),$("#slider-social").addClass("slider-social-fixed")):($("header").removeClass("header-appear"),$("#slider-social").removeClass("slider-social-fixed"))}):$(window).on("scroll",function(){$(this).scrollTop()>260?$("header").addClass("header-appear"):$("header").removeClass("header-appear")}),$(".mini-custom-box.bg-blue-cyan").on("mouseenter",function(){$(".arrow-box").addClass("arrow-box-hidden"),$(".arrow-box .las").addClass("las-hidden"),$(".arrow-box1").addClass("arrow-box1-display"),$(".arrow-box1 .las").addClass("las-visible")}),$(".mini-custom-box").on("mouseleave",function(){$(".arrow-box").removeClass("arrow-box-hidden"),$(".arrow-box .las").removeClass("las-hidden"),$(".arrow-box1").removeClass("arrow-box1-display"),$(".arrow-box1 .las").removeClass("las-visible")}),anime.timeline({loop:!0}).add({targets:".Text-zoom-in .Text-zoom-word",scale:[14,1],opacity:[0,1],easing:"easeOutCirc",duration:800,delay:(e,a)=>800*a}).add({targets:".Text-zoom-in",opacity:0,duration:1e3,easing:"easeOutExpo",delay:1e3}),$("#toggle-btn").on("mouseover",function(){$("#toggle-btn").on("click",function(){$(".broad").removeClass("reverse-nav"),setTimeout(function(){$(".broad").addClass("broad-nav")},200),$("#toggle-btn").addClass("close_nav"),$("#toggle-btn").attr("id","close_nav"),$("#close_nav").removeClass("toggle-btn")}),$("#close_nav").on("click",function(){$(".broad").addClass("reverse-nav"),$("#close_nav").removeClass("close_nav"),$("#close_nav").attr("id","toggle-btn"),$("#toggle-btn").removeClass("close_nav"),setTimeout(function(){$(".broad").removeClass("broad-nav"),$(".broad").removeClass("reverse-nav")},200)})}),$(window).on("load",function(){var e=$("#sync1"),a=$("#sync2"),s=!0;e.owlCarousel({center:!0,autoWidth:!0,singleItem:!0,items:3,slideSpeed:3e3,nav:!0,dots:!1,loop:!0,margin:0,autoplay:!1,responsiveRefreshRate:200,transitionStyle:"fade",0:{items:1},480:{items:1},800:{items:1}}).on("changed.owl.carousel",function(e){var s=e.item.count-1,t=Math.round(e.item.index-e.item.count/2-.5);t<0&&(t=s);t>s&&(t=0);a.find(".owl-item").removeClass("current").eq(t).addClass("current");var o=a.find(".owl-item.active").length-1,i=a.find(".owl-item.active").first().index(),r=a.find(".owl-item.active").last().index();t>r&&a.data("owl.carousel").to(t,100,!0);t<i&&a.data("owl.carousel").to(t-o,100,!0)}),a.on("initialized.owl.carousel",function(){a.find(".owl-item").eq(0).addClass("current")}).owlCarousel({items:4,dots:!1,nav:!1,smartSpeed:200,slideSpeed:500,slideBy:4,responsiveRefreshRate:100}).on("changed.owl.carousel",function(a){if(s){var t=a.item.index;e.data("owl.carousel").to(t,100,!0)}}),a.on("click",".owl-item",function(a){a.preventDefault();var s=$(this).index();e.data("owl.carousel").to(s,300,!0)})}),$(".menu-btn").on("click",function(){$(".outer-wrapper").removeClass("end-anm1"),$(".outer-wrapper").addClass("inner-wrapper-top"),$(".main-content").addClass("main-content-hide"),$("body").css({overflow:"hidden"}),$(".outer-wrapper").addClass("start-anm1")}),$(".close-outerwindow").on("click",function(){$(".outer-wrapper").removeClass("start-anm1"),$(".outer-wrapper").addClass("end-anm1"),$("body").css({overflow:"visible"}),$(".main-content").removeClass("main-content-hide"),setTimeout(function(){$(".outer-wrapper").removeClass("inner-wrapper-top")},800)}),$(".outer-wrapper ul li a").click(function(){$(".outer-wrapper").removeClass("inner-wrapper-top")});