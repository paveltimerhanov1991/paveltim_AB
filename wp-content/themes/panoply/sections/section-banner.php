<?php
/**
 *
 * @package panoply
 */
?>
<?php 
$banner_hero_Section_display = get_theme_mod( 'banner_hero_Section_display');
$slider_items = get_theme_mod( 'slider_items');
if($banner_hero_Section_display==1){?>
<div class="home-slider flexslider">
   <ul class="slides">
   <?php foreach($slider_items as $slider_items_fetch){?>
     <li>
       <div class="slide-image cover" style="background-image:url(<?php echo esc_url($slider_items_fetch['media']['url']);?>)"></div>
       <div class="slider-content">
         <div class="slide-content">
           <h1 class="banner-title"><?php if($slider_items_fetch['content_layout_1']){echo esc_html($slider_items_fetch['content_layout_1']);}?></h1>
           <p><?php if($slider_items_fetch['content_layout_2']){echo esc_html($slider_items_fetch['content_layout_2']);}?></p>
           <?php if($slider_items_fetch['button_label_2']){?>
           <a href="<?php if($slider_items_fetch['button_url_2']){echo esc_url($slider_items_fetch['button_url_2']);}?>" class="btn left-btn"><?php if($slider_items_fetch['button_label_2']){echo esc_html($slider_items_fetch['button_label_2']);}?></a>
           <?php }?>
           <?php if($slider_items_fetch['button_label']){?>
           <a href="<?php if($slider_items_fetch['button_url']){echo esc_url($slider_items_fetch['button_url']);}?>" class="btn"><?php if($slider_items_fetch['button_label']){echo esc_html($slider_items_fetch['button_label']);}?></a>
           <?php }?>
         </div>
       </div>
     </li>
     <?php }?>
   </ul>
 </div>
 <?php }?> 