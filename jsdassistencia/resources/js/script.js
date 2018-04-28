//LOADER/SPINNER
$(window).bind("load", function() {

    "use strict";
    
    $(".spn_hol").fadeOut(1000);
});

/*
 * Sets the Css for nav-bar (navigation bar).  
 */
function setNavBarCss () {
	$(".navbar").css({
        'margin-top': '0px',
        'opacity': '0.8'
    })
        
	if (parseInt($(window).width()) >= 992) {
		$(".navbar-nav>li>a").css({'padding-top': '25px'});
	} else {
		$(".navbar-nav>li>a").addClass("link-padding");	
	}
	
	$(".navbar-brand img").css({
        'height': '35px'
    });
    $(".navbar-brand img").css({
        'padding-top': '0px'
    });
    $(".navbar-default").css({
        'background-color': 'rgba(255, 255, 255, 0.8)'
    });
}

//CONFIGS nav-bar (navigation bar)
$(document).ready (function() {

	setNavBarCss ();
    
    $(window).scroll(function() {
        "use strict";        
        setNavBarCss ();        
    });
});


// MENU SECTION ACTIVE
$(document).ready(function() {

    "use strict";
    
    $(".navbar-nav li a").click(function() {

        "use strict";
        
        $(".navbar-nav li a").parent().removeClass("active");
        $(this).parent().addClass("active");
    });
});



// Hilight MENU on SCROLL

$(document).ready(function() {

    "use strict";
    
    $(window).scroll(function() {

        "use strict";
        
        $(".page").each(function() {

            "use strict";
            
            var bb = $(this).attr("id");
            var hei = $(this).outerHeight();
            var grttop = $(this).offset().top - 70;
            if ($(window).scrollTop() > grttop - 1 && $(window).scrollTop() < grttop + hei - 1) {
                var uu = $(".navbar-nav li a[href='#" + bb + "']").parent().addClass("active");
            } else {
                var uu = $(".navbar-nav li a[href='#" + bb + "']").parent().removeClass("active");
            }
        });
    });
});



//SMOOTH MENU SCROOL
$(function() {
	
	"use strict";

  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});



// FIX HOME SCREEN HEIGHT
$(document).ready(function() {

    "use strict";
    
    setInterval(function() {

        "use strict";
        
        var widnowHeight = $(window).height();
        var containerHeight = $(".home-container").height();
        var padTop = widnowHeight - containerHeight;
        $(".home-container").css({
            'padding-top': Math.round(padTop / 2) + 'px',
            'padding-bottom': Math.round(padTop / 2) + 'px'
        });
    }, 10)
});


//PARALLAX
$(document).ready(function() {

    "use strict";
    
    $(window).bind('load', function() {
        "use strict";
        parallaxInit();
    });

    function parallaxInit() {
        "use strict";
        $('.home-parallax').parallax("30%", 0.1);
        $('.subscribe-parallax').parallax("30%", 0.1);
        $('.testimonial').parallax("10%", 1);
        /*add as necessary*/
    }
});


//PRETTYPHOTO

$(document).ready(function() {

    "use strict";

    $("a[rel^='prettyPhoto']").prettyPhoto({
        show_title: false,
        /* true/false */
    });
});



//WOW JS
$(document).ready(function() {

    "use strict";
 
    new WOW().init();
});


//MAILCHIMP
$(document).ready(function() {

    "use strict";
    
    $('#mc-form').ajaxChimp({
        callback: mailchimpCallback,
        url: "https://themerocks.us9.list-manage.com/subscribe/post?u=f04c804868966b1b4509daa9b&amp;id=ad7b6aba65"
    });

    function mailchimpCallback(resp) {

        "use strict";
        
        if (resp.result === 'success') {
            $('.subscription-success').html('<i class="pe-7s-check"></i><br/>' + resp.msg).fadeIn(1000);
            $('.subscription-error').fadeOut(500);
        } else if (resp.result === 'error') {
            $('.subscription-error').html('<i class="pe-7s-close-circle"></i><br/>' + resp.msg).fadeIn(1000);
        }
    }
});
 
/// SMOOTH SCROLL           

$(document).ready(function() {

    "use strict";
    
    var scrollAnimationTime = 1200,
        scrollAnimation = 'easeInOutExpo';
    $('a.scrollto').bind('click.smoothscroll', function(event) {
        event.preventDefault();
        var target = this.hash;
        $('html, body').stop().animate({
            'scrollTop': $(target).offset().top
        }, scrollAnimationTime, scrollAnimation, function() {
            window.location.hash = target;
        });
    });
    //COUNTER
    $('.counter_num').counterUp({
        delay: 10,
        time: 2000
    });
});

