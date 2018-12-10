<?php
$contact_section_id=get_theme_mod('contact_section_id');
$contact_title=get_theme_mod('contact_title');
$contact_email=get_theme_mod('contact_email');
$contact_address=get_theme_mod('contact_address');
$contact_phone=get_theme_mod('contact_phone');
$panoply_contact_cf7=get_theme_mod('panoply_contact_cf7');
$contact_sub_title=get_theme_mod('contact_sub_title');
?>
<?php
      if(isset($contact_email)&&$contact_email==''&&$contact_address!==''&&$contact_address!==''){
			 $class='col-lg-6 col-md-6 col-sm-6';
		 }
		 elseif(isset($contact_address)&&$contact_address==''&&$contact_email!==''&&$contact_phone!==''){
			 $class='col-lg-6 col-md-6 col-sm-6';
		 }
		 elseif(isset($contact_phone)&&$contact_phone==''&&$contact_email!==''&&$contact_address!==''){
			 $class='col-lg-6 col-md-6 col-sm-6';
		 }
		 elseif(isset($contact_email)&&$contact_email==''&&$contact_address==''&&$contact_phone!==''){
			 $class='col-lg-12 col-md-12 col-sm-12';
		 }
		 elseif(isset($contact_address)&&$contact_address==''&&$contact_phone==''&&$contact_email!==''){
			 $class='col-lg-12 col-md-12 col-sm-12';
		 }
		  elseif(isset($contact_phone)&&$contact_phone==''&&$contact_email==''&&$contact_address!==''){
			 $class='col-lg-12 col-md-12 col-sm-12';
		 }
		 else
		 {
			 $class='col-lg-4 col-md-4 col-sm-4';
		 }
	  ?>
<?php if($contact_section_id){?>
<section class="section-row home-contact wow fadeInDown" id="<?php echo esc_attr($contact_section_id);?>">
     <div class="container">
       <div class="page-title">
         <h2 class="main-title"><?php echo esc_html($contact_title);?></h2>
          <?php if(isset($contact_sub_title)&&$contact_sub_title){?>
         <p class="subtitle"><?php echo esc_html($contact_sub_title);?></p>
         <?php }?>
       </div>
       <div class="contact-add">
       <?php if(!empty($contact_email)){?>
          <div class="<?php echo esc_attr($class);?> wow fadeInUp">
           <address>
            <span class="eml"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <strong><?php echo esc_html($contact_email);?></strong>
           </address>
          </div>
          <?php }?>
          <?php if(!empty($contact_address)){?>
          <div class="<?php echo esc_attr($class);?> wow fadeInUp">
           <address>
            <span class="loc"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
            <strong><?php echo esc_html($contact_address);?></strong>
           </address>
          </div>
          <?php }?>
          <?php if(!empty($contact_phone)){?>
          <div class="<?php echo esc_attr($class);?> wow fadeInUp">
           <address>
            <span class="phn"><i class="fa fa-phone" aria-hidden="true"></i></span>
            <strong><?php echo esc_html($contact_phone);?></strong>
          </address>
          </div>
          <?php }?>
         </div>
         <?php $map=get_theme_mod('contact_map');?>
         <?php if(isset($map)&&$map!==''){
			$mapclass="col-sm-7"; 
		 }
		 else{
			 $mapclass='col-sm-12';
		 }
		 ?>
         <div class="row">
         <div class="<?php echo esc_attr($mapclass);?>">
         <?php echo do_shortcode(wp_kses_post($panoply_contact_cf7)); ?>
         </div>
         <?php if(isset($map)&&$map!==''){?>
         <div class="col-sm-5">
         <?php echo $map; ?>
         </div>
         <?php }?>
         </div>
         <span class="sending"></span>
         <div id="message_success"></div>
     </div>
   </section>
   <?php }?>