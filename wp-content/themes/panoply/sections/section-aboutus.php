<?php
$panoply_page = '';
$panoply_page_array = get_pages();
if(is_array($panoply_page_array)){
	$panoply_page = $panoply_page_array[0]->ID;
}
$panoply_about_section_id=get_theme_mod('panoply_about_section_id');
$panoply_about_section_title=get_theme_mod('panoply_about_section_title');
$panoply_aboutus=get_theme_mod('panoply_aboutus');
$panoply_aboutus_var=get_theme_mod('panoply_aboutus_var');
$panoply_about_section_subtitle=get_theme_mod('panoply_about_section_subtitle');
?>
<?php if($panoply_about_section_id){?>
<section class="section-row home-about" id="<?php echo esc_attr($panoply_about_section_id);?>">
<?php 
			$args = array(
				'page_id' => absint( get_theme_mod('panoply_aboutus' , $panoply_page ) )
				);
			$query = new WP_Query($args);
			if($query->have_posts()):
				while($query->have_posts()) : $query->the_post();
			?>
     <div class="container">
       <div class="page-title">
         <h2 class="main-title"><?php if($panoply_about_section_title!==''){echo esc_html($panoply_about_section_title);}else{the_title();}?></h2>
         <?php if(isset($panoply_about_section_subtitle)&&$panoply_about_section_subtitle){?>
         <p class="subtitle"><?php echo esc_html($panoply_about_section_subtitle);?></p>
         <?php }?>
       </div>
       <div class="row">
       <?php if(isset($panoply_aboutus_var)&&$panoply_aboutus_var=='hideimg'){
		   $colclass='col-md-12 col-sm-12';
	   }
	   else
	   {
		    $colclass='col-md-6 col-sm-6';
	   }
	   ?>
       <?php if(isset($panoply_aboutus_var)&&$panoply_aboutus_var=='leftimg'){?>
       <?php if(isset($panoply_aboutus_var)&&$panoply_aboutus_var!=='hideimg'){?>
         <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft">
           <div class="image_section">
             <?php panoply_post_thumbnail(); ?>
           </div><!--image_section-->
         </div><!--col-->
         <?php }?>
         <div class="<?php echo esc_attr($colclass);?> col-xs-12 wow fadeInRight">
           <div class="text-block">
             <?php the_content(); ?>
           </div>
         </div><!--col-->
         <?php }else{?>
         <div class="<?php echo esc_attr($colclass);?> col-xs-12 wow fadeInRight">
           <div class="text-block">
             <?php the_content(); ?>
           </div>
         </div><!--col-->
          <?php if(isset($panoply_aboutus_var)&&$panoply_aboutus_var!=='hideimg'){?>
         <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft">
           <div class="image_section">
             <?php panoply_post_thumbnail(); ?>
           </div><!--image_section-->
         </div><!--col-->
         <?php }?>
         <?php }?>
       </div>
     </div>
     <?php
			endwhile;
			endif;	
			wp_reset_postdata();
			?>
   </section>
   <?php }?>