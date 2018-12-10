jQuery(document).ready(function(e){jQuery(".navbar-nav").addClass("main-list"),jQuery("body").addClass("menu-canvas-off"),jQuery("body").prepend('<div class="mobile-menu"></div>'),jQuery(".main-list").clone().appendTo(".mobile-menu")
,jQuery(".header .logo-img").clone().appendTo(".mobile-menu"),jQuery(".mobile-menu .logo-img").insertBefore(".mobile-menu .main-list"),jQuery(".mobile-menu ul.main-list > li").find("ul").before('<span class="dropdown"><i class="fa fa-angle-down"></i><i class="fa fa-angle-right"></i></div>'),jQuery(".mobile-menu").prepend('<div class="cross"><span class="layer one">&nbsp;</span><span class="layer two">&nbsp;</span></div>'),jQuery(".header .logo-img").find("ul").before('<span class="dropdown"><i class="fa fa-angle-down"></i><i class="fa fa-angle-right"></i></div>'),jQuery(".mobile-menu").prepend('<div class="cross"><span class="layer one">&nbsp;</span><span class="layer two">&nbsp;</span></div>'),jQuery(".header .navbar-nav")
.after('<div class="toggle-mobile"><span class="layer one">&nbsp;</span><span class="layer two">&nbsp;</span><span class="layer three">&nbsp;</span></div>'),jQuery(".dropdown").click(function(e){jQuery(this).toggleClass("open"),jQuery(this).next("ul").slideToggle()}),jQuery(document).ready(function(e){var n=!0;jQuery(".toggle-mobile").click(function(){jQuery(".mobile-menu").toggleClass("show-menu"),jQuery(".wrapper").addClass("move-to-right"),jQuery("body").addClass("menu-canvas"),n=!1}),jQuery(".mobile-menu").click(function(){n=!1})
,jQuery("html,.mobile-menu>ul li a,.cross,.logo-img a").click(function(){n&&(jQuery(".mobile-menu").removeClass("show-menu"),jQuery(".wrapper").removeClass("move-to-right"),jQuery("body").removeClass("menu-canvas")),n=!0})})})
.ready(function(e) {
         var n = !0;
         jQuery(".toggle-mobile").click(function() {
             jQuery(".mobile-menu").toggleClass("show"), jQuery(".site-overlay").toggleClass("overlay-show"),jQuery(".toggle-mobile").toggleClass("open"), n = !1
         }), jQuery(".mobile-menu").click(function() {
             n = !1
         }), jQuery("html,.site-overlay,.mobile-menu li a").click(function() {
             n && (jQuery(".mobile-menu").removeClass("show"),jQuery(".toggle-mobile").removeClass("open"),jQuery(".site-overlay").removeClass("overlay-show")), n = !0
         })
		 jQuery(".cross").click(function(){
    jQuery(".toggle-mobile").removeClass("open");
});
})
// Can also be used with $(document).ready()
jQuery(window).load(function() {
  jQuery('.flexslider').flexslider({
    animation: "slide"
  });

jQuery('.header-search .search-btn').click(function(){
	  jQuery('.main-nav .header-search').toggleClass('select-input');
   });
});
jQuery(document).ready(function() {
    jQuery(window).scroll(function() {
        jQuery(this).scrollTop() > 100 ? jQuery(".back-top").fadeIn() : jQuery(".back-top").fadeOut()
    }), jQuery(".back-top").click(function() {
        return jQuery("html, body").animate({
            scrollTop: 0
        }, 800), !1
    })
})
jQuery(function(jQuery) {
    jQuery(window).scroll(function() {
        jQuery(window).scroll(function() {
            var r = jQuery(window).scrollTop();
            r >= 200 ? jQuery('.sticky-nav').addClass('sticky') : jQuery('.sticky-nav').removeClass('sticky');
        });
    });
});
jQuery(window).load(function() {
    jQuery(".se-pre-con").fadeOut("slow");;
});

jQuery(function() {
    jQuery('.nav a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = jQuery(this.hash);
            target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                jQuery('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});
var owl = jQuery('#testimonialslider');
owl.owlCarousel({
    loop: true,
    autoPlay: true,
    slideSpeed: 200,
    nav: true,
    dots: false,
    margin: 30,
    autoHeight: false,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 3
        },
        1000: {
            items: 3
        }
    }
})
jQuery( document ).ready( function( $ ) { 
        $('.fa-spin').hide();   
	$(document).on('click', '.loadmore_post', function(e) {	
	        $('.fa-angle-double-down').hide(); 
	         $('.fa-spin').show();
		var max_page = $( this ).attr( 'max_page' );
                var start_page = $( this ).attr( 'start_page' );
		var currentpaged = parseInt( start_page )+1;	
		jQuery.ajax({
			type: 'POST',
			url: panoply_wp_ajax_url,
			data: {
				action : 'panoply_load_more_posts',
				paged: currentpaged,
				query: panoply_wp_ajax_url.query,
			},
		})
		.done( function( response ) {
			if ( response ) {
			    $( '.loadmore_post' ).attr( 'start_page', currentpaged );
				$( '#section-news-posts' ).append( response );
				 $('.fa-spin').hide(); 
				 $('.fa-angle-double-down').show(); 
			} 
			if(max_page==start_page)
			{
			$('.loadmore_post').hide();
			}
		} );
		e.preventDefault();
	});

});
//shop
jQuery( document ).ready( function( $ ) { 
        $('.shop-load-refresh').hide();   
	$(document).on('click', '.loadmore_shop', function(e) {	
	        $('.shop-load-down').hide(); 
	         $('.shop-load-refresh').show();
		var max_page = $( this ).attr( 'max_page' );
                var start_page = $( this ).attr( 'start_page' );
		var currentpaged = parseInt( start_page )+1;	
		jQuery.ajax({
			type: 'POST',
			url: panoply_wp_ajax_url,
			data: {
				action : 'panoply_load_more_shop',
				paged: currentpaged,
				query: panoply_wp_ajax_url.query,
			},
		})
		.done( function( response ) {
			if ( response ) {
			    $( '.loadmore_shop' ).attr( 'start_page', currentpaged );
				$( '.products' ).append( response );
				 $('.shop-load-refresh').hide(); 
				 $('.shop-load-down').show(); 
			} 
			if(max_page==start_page)
			{
			$('.loadmore_shop').hide();
			}
		} );
		e.preventDefault();
	});

});