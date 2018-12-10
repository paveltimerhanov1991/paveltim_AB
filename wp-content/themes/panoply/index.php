 <?php get_header();?>
  <div class="inner-page-bg parallax-bg">
     <div class="container">
        <div class="inner-page-title">
        <h1 class="title"><?php if ( is_home() && ! is_front_page() ) : ?><?php single_post_title(); ?></h1><?php else : ?><?php _e( 'Posts', 'panoply' ); ?>
	<?php endif; ?></h1>
        </div>
     </div>
   </div>
   <?php $blog_sidebar_settings=get_theme_mod('blog_sidebar_settings');?>
   <!--close-inner-page-bg-->
  <div class="content">
    <div class="container">
      <div class="row">
      <?php if(isset($blog_sidebar_settings)&&$blog_sidebar_settings=='left'){?>
      <?php get_sidebar();?>
      <?php }?>
      <?php if(isset($blog_sidebar_settings)&&$blog_sidebar_settings=='full'){
		  $full='col-md-12 col-sm-12';
      }
	  else
	  {
		  $full='col-md-8 col-sm-8';
	  }
	  ?>
        <div class="<?php echo esc_attr($full);?> col-xs-12">
          <div class="left-bar" id="primary">
          <?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content');
				?>

			<?php endwhile; ?>

			<?php the_posts_pagination(array(
								    'prev_text' => __( 'Prev', 'panoply' ),
								    'next_text' => __( 'Next', 'panoply' ),
								)); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
          </div>
          <!--close-left-bar-->
        </div>
      <?php if(isset($blog_sidebar_settings)&&$blog_sidebar_settings=='right'){?>
      <?php get_sidebar();?>
      <?php }?>
      </div>
    </div>
  </div>
 <?php get_footer();?>