<?php
$calltoaction_Section_display=get_theme_mod('calltoaction_Section_display');
$calltoaction_Section_title=get_theme_mod('calltoaction_Section_title');
$calltoaction_Section_subtitle=get_theme_mod('calltoaction_Section_subtitle');
$calltoaction_button_name=get_theme_mod('calltoaction_button_name');
$calltoaction_button_url=get_theme_mod('calltoaction_button_url');
$calltoaction_bgimg=get_theme_mod('calltoaction_bgimg');
?>
<?php if($calltoaction_Section_display==1){?>
<section class="section-row call-to-action parallax-bg" id="call-to-action" <?php if(!empty($calltoaction_bgimg)){?>style="background-image:url(<?php echo esc_url($calltoaction_bgimg);?>)"<?php }?>>
     <div class="container">
       <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 call-text">
            <h2><?php echo esc_html($calltoaction_Section_title);?></h2>
            <p><?php echo esc_html($calltoaction_Section_subtitle);?></p>
          </div><!--col-->
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 call-btn">
            <a href="<?php echo esc_url($calltoaction_button_url);?>" class="btn"><?php echo esc_html($calltoaction_button_name);?></a>
          </div><!--col-->
        </div>
     </div>
     <div class="setimg overlay-cover"></div>
   </section>
   <?php }?>