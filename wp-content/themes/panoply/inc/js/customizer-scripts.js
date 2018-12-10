jQuery(document).ready(function($) {
    "use strict";

    //FontAwesome Icon Control JS
    jQuery('body').on('click', '.panoply-icon-list li', function(){
        var icon_class = jQuery(this).find('i').attr('class');
        jQuery(this).addClass('icon-active').siblings().removeClass('icon-active');
        jQuery(this).parent('.panoply-icon-list').prev('.panoply-selected-icon').children('i').attr('class','').addClass(icon_class);
        jQuery(this).parent('.panoply-icon-list').next('input').val(icon_class).trigger('change');
    });  
    
    // News load more posts
    var new_load_more_settings = function( t ){
        if ( t == 'hide' ) {
            jQuery( '#customize-control-news_more_text, #customize-control-news_more_link' ).hide();
        } else if ( t == 'ajax' ) {
            jQuery( '#customize-control-news_more_text' ).show();
            jQuery( '#customize-control-news_more_link' ).hide();
        } else if ( t == 'link' ) {
            jQuery( '#customize-control-news_more_text' ).show();
            jQuery( '#customize-control-news_more_link' ).show();
        }

    };
    new_load_more_settings( jQuery( '#customize-control-panoply_blog_loadmore select' ).val() );
    jQuery( '#customize-control-panoply_blog_loadmore select' ).on( 'change', function ()  {
        new_load_more_settings( jQuery( this ).val() );
    } );
// shop load more posts
    var shop_load_more_settings = function( t ){
        if ( t == 'hide' ) {
            jQuery( '#customize-control-shop_more_text, #customize-control-shop_more_link' ).hide();
        } else if ( t == 'ajax' ) {
            jQuery( '#customize-control-shop_more_text' ).show();
            jQuery( '#customize-control-shop_more_link' ).hide();
        } else if ( t == 'link' ) {
            jQuery( '#customize-control-shop_more_text' ).show();
            jQuery( '#customize-control-shop_more_link' ).show();
        }

    };
    shop_load_more_settings( jQuery( '#customize-control-panoply_shop_loadmore select' ).val() );
    jQuery( '#customize-control-panoply_shop_loadmore select' ).on( 'change', function ()  {
        shop_load_more_settings( jQuery( this ).val() );
    } );
});
