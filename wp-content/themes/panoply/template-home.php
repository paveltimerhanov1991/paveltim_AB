<?php 
/*
Template name:Home page
*/
get_header();?> 
 <!--close-slider-->
 <div id="content">
 <?php
 $panoply_home_sections=panoply_home_section();
 foreach ($panoply_home_sections as $panoply_sections) {
 get_template_part( 'sections/section', $panoply_sections );
}
 ?>
</div>
<?php get_footer();?>