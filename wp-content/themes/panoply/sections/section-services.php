<?php
$panoply_services_id=get_theme_mod('panoply_services_id');
$panoply_services_title=get_theme_mod('panoply_services_title');
$panoply_services_bgimg=get_theme_mod('panoply_services_bgimg');
$panoply_services_sub_title=get_theme_mod('panoply_services_sub_title');
?>
<?php if($panoply_services_id){?>
<section class="section-row home-services parallax-bg <?php if($panoply_services_bgimg==''){ echo esc_attr('servicesbg');}?>" id="<?php echo esc_attr($panoply_services_id);?>" <?php if($panoply_services_bgimg!==''){?>style="background-image:url(<?php echo esc_url($panoply_services_bgimg);?>);"<?php }?>>
     <div class="container">
       <div class="page-title">
         <h2 class="main-title"><?php echo esc_html($panoply_services_title);?></h2>
         <?php if(isset($panoply_services_sub_title)&&$panoply_services_sub_title){?>
         <p class="subtitle"><?php echo esc_html($panoply_services_sub_title);?></p>
         <?php }?>
       </div>
       <div class="row">
       <?php 
	     $panoply_service_page=get_theme_mod('panoply_service_page');
				foreach ($panoply_service_page as $item) {					
					?>
                    <?php 
					if($panoply_service_page){
						$args = array( 'page_id' => $item['page_id'] );
						$query = new WP_Query($args);
						if($query->have_posts()):
							while($query->have_posts()) : $query->the_post();							
						?>
         <div class="col-md-3 col-sm-3 col-xs-6 wow fadeInDown">
           <div class="services-box">
             <div class="icon">
               <i class="fa <?php echo esc_attr($item['icon']);?>" aria-hidden="true"></i>
             </div>
             <?php if($item['linksingle']==1){?>
             <h6><a href="<?php the_permalink();?>"><?php the_title();?></a></h6>
             <?php }else{?>
             <h6><?php the_title();?></h6>
             <?php }?>
             <?php the_content();?>
           </div>
         </div>
         <?php 
		 endwhile;
	     endif;	
         wp_reset_postdata();
		 }}?>
         
         
       </div>
     </div>
   </section>
   <?php }?>