<?php
$panoply_testimonials_title=get_theme_mod('panoply_testimonials_title');
$panoply_testimonials_id=get_theme_mod('panoply_testimonials_id');
$panoply_testimonials_sub_title=get_theme_mod('panoply_testimonials_sub_title');
?>
<?php if($panoply_testimonials_id){?>
<section class="section-row testimonial" id="<?php echo esc_attr($panoply_testimonials_id);?>">
     <div class="container">
     <div class="page-title">
         <h2 class="main-title"><?php echo esc_html($panoply_testimonials_title);?></h2>
         <?php if(isset($panoply_testimonials_sub_title)&&$panoply_testimonials_sub_title){?>
         <p class="subtitle"><?php echo esc_html($panoply_testimonials_sub_title);?></p>
         <?php }?>
       </div>
       <div id="testimonialslider" class="owl-carousel owl-theme">
       <?php 
				for( $i = 1; $i < 9; $i++ ){					
					$panoply_user_name = get_theme_mod('panoply_user_name'.$i);
					$panoply_user_desig = get_theme_mod('panoply_user_desig'.$i);
					$panoply_user_text = get_theme_mod('panoply_user_text'.$i);
					$client_image = get_theme_mod('client_image'.$i);
					?>
                    <?php
                    if($panoply_user_name)
					{
					?>
       <div class="item">
         <div class="item_box">
         <img class="img-responsive img-circle" src="<?php echo esc_url($client_image);?>" alt="<?php echo esc_attr($panoply_user_name);?>">
           <P><?php echo esc_html($panoply_user_text);?></P>
           <h4><?php echo esc_html($panoply_user_name);?></h4>
          <h6><?php echo esc_html($panoply_user_desig);?></h6>
         </div><!--item_box-->
        </div>
        <?php }}?>
       </div><!--owl-carousel-->     
     </div><!--container-->
    </section>
    <?php }?>