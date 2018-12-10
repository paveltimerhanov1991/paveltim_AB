<?php get_header();?>
<div class="inner-page-bg parallax-bg">
     <div class="container">
        <div class="inner-page-title">
          <h1 class="title"><?php esc_html_e('Error Page','panoply');?></h1>
        </div>
     </div>
   </div>
<div class="page-404">
  <div class="content">
    <div class="container text-center">
    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="left-bar" id="primary">
      <h1><?php esc_html_e( 'Oops!', 'panoply' ); ?></h1>
			<h2><?php esc_html_e( 'Page Not Found', 'panoply' ); ?></h2>
			<div class="error-details">
				<p> <?php esc_html_e( 'Sorry, an error has occured, Requested page not found!', 'panoply' ); ?></p> 
			</div>
			<p><a href="<?php echo esc_url( home_url( '/' )); ?>"><span class="fa fa-home"></span><?php esc_html_e('Take Me Home', 'panoply'); ?></a></p>
            </div>
            <?php get_search_form(); ?>
            </div>
            <?php get_sidebar();?>
    </div>
  </div>
  </div>
  </div>
  <!--close-content-->
 <?php get_footer();?>