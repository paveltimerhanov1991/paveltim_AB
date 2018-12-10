<?php get_header();
global $post;
?>
  <div class="inner-page-bg parallax-bg">
     <div class="container">
        <div class="inner-page-title">
          <?php the_title( '<h1 class="title">', '</h1>' ); ?>
        </div>
     </div>
   </div>
   <!--close-inner-page-bg-->
  <div class="content">
    <div class="container">
      <div class="row">
      <?php 
	 $page_template = get_post_meta( $post->ID, 'panoply_postlayout_select', true );
	if ( ! empty( $page_template ) && $page_template !== 'default' ) {
	$panoply_page_sidebar_layout = $page_template;
}
	if (isset($panoply_page_sidebar_layout)&&$panoply_page_sidebar_layout=== 'sidebar-left' ) {
	get_sidebar();
	}
	?>
    <?php 
	$pageclass='';
	if (isset($page_template)&&$page_template=='sidebar-left') {
		$pageclass='col-md-8 col-sm-8 col-xs-12';
	}
	else if(isset($page_template)&&$page_template=='sidebar-right') {
		$pageclass='col-md-8 col-sm-8 col-xs-12';
	}
	else if(isset($page_template)&&$page_template=='default' || $page_template=='full-width') {
		$pageclass='col-md-12 col-sm-12 col-xs-12';
	}
	else
	{
		$pageclass='col-md-12 col-sm-12 col-xs-12';
	}
	?>
        <div class="<?php echo esc_attr($pageclass);?>">
          <div class="left-bar" id="primary">
              <?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content'); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
		<?php endwhile; // End of the loop. ?>
            <!--close-entry-post-->
          </div>
          <!--close-left-bar-->
        </div>
<?php 
  if (isset($panoply_page_sidebar_layout)&&$panoply_page_sidebar_layout === 'sidebar-right' ) {
	get_sidebar();
	}
	?>
      </div>
    </div>
  </div>
 <?php get_footer();?>