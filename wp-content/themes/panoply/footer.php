 <?php
 $footer_tagline=get_theme_mod('footer_tagline' );
 $fb_link=get_theme_mod('fb_link');
 $tw_link=get_theme_mod('tw_link');
 $gp_link=get_theme_mod('gp_link');
 $insta_link=get_theme_mod('insta_link');
 $pin_link=get_theme_mod('pin_link');
 $vimeo_link=get_theme_mod('vimeo_link');
 $youtube_link=get_theme_mod('youtube_link');
 $dribbble_link=get_theme_mod('dribbble_link');
 $linkedin_link=get_theme_mod('linkedin_link');
 $tumblr_link=get_theme_mod('tumblr_link');
 $rss_link=get_theme_mod('rss_link');
 $skype_link=get_theme_mod('skype_link');
 ?>
 <footer class="footer">
   <div class="container">
     <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="social">
           <ul>
<?php if(!empty($pin_link)){?> 
          <li><a href="<?php echo esc_url($pin_link);?>" class="" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
          <?php }?>
          <?php if(!empty($tw_link)){?>
          <li><a href="<?php echo esc_url($tw_link);?>" class="" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <?php }?>
          <?php if(!empty($linkedin_link)){?>
          <li><a href="<?php echo esc_url($linkedin_link);?>" class="" target="_blank"><i class="fa fa-linkedin"></i></a></li>
          <?php }?>
          <?php if(!empty($fb_link)){?>
         <li><a href="<?php echo esc_url($fb_link);?>" class="" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <?php }?>
           <?php if(!empty($insta_link)){?>
          <li><a href="<?php echo esc_url($insta_link);?>" class="" target="_blank"><i class="fa fa-instagram"></i></a></li>
          <?php }?>
           <?php if(!empty($youtube_link)){?>
          <li><a href="<?php echo esc_url($youtube_link);?>" class="" target="_blank"><i class="fa fa-youtube"></i></a></li>
          <?php }?>
           <?php if(!empty($gp_link)){?>
          <li><a href="<?php echo esc_url($gp_link);?>" class=""target="_blank"><i class="fa fa-google-plus"></i></a></li>
          <?php }?>
           <?php if(!empty($skype_link)){?>
          <li><a href="<?php echo esc_url($skype_link);?>" class="" target="_blank"><i class="fa fa-skype"></i></a></li>
          <?php }?>
           <?php if(!empty($rss_link)){?>
          <li><a href="<?php echo esc_url($rss_link);?>" class="" target="_blank"><i class="fa fa-rss"></i></a></li>
          <?php }?> 
          <?php if(!empty($tumblr_link)){?>
          <li><a href="<?php echo esc_url($tumblr_link);?>" class="" target="_blank"><i class="fa fa-tumblr"></i></a></li>
          <?php }?>
          <?php if(!empty($vimeo_link)){?>
          <li><a href="<?php echo esc_url($vimeo_link);?>" class="" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
          <?php }?> 
          <?php if(!empty($dribbble_link)){?>
          <li><a href="<?php echo esc_url($dribbble_link);?>" class="" target="_blank"><i class="fa fa-dribbble"></i></a></li>
          <?php }?> 
</ul>
         </div><!--social-->
         <p class="text-uppercase"><?php if($footer_tagline!==''){echo esc_html($footer_tagline);}?></p>
         <p class="copyright">
         <?php
         $copyright=get_theme_mod('footer_copyright' );
		  if(isset($copyright) && $copyright!='')
		  {
			  echo esc_html($copyright);
			  
		  }else {$footertext = '[copyright] [the-year] [site-name] [theme-credit]';
       		$footertext = str_replace('[copyright]',__('Copyright','panoply').'&copy;',$footertext);
       		$footertext = str_replace('[the-year]',date_i18n(__('Y','panoply')),$footertext);
       		$footertext = str_replace('[site-name]',get_bloginfo('name'),$footertext);
       		$footertext = str_replace('[theme-credit]','-'.__('WordPress Theme by','panoply').' <a href="'.esc_url(__( 'https://wordpress.org/', 'panoply')).'" target="_blank">'.__('Y Design Services','panoply').'</a>',$footertext);
       		echo do_shortcode($footertext); } ?>
         </p>
       </div>
     </div>
   </div>
 </footer>
</div>
<?php wp_footer();?></body>
</html>