 <?php get_header();?>
  <div class="inner-page-bg parallax-bg">
     <div class="container">
        <div class="inner-page-title">
        <?php the_archive_title( '<h1 class="title">', '</h1>' );?>
        </div>
     </div>
   </div>
   <!--close-inner-page-bg-->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">
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
        <?php get_sidebar();?>
      </div>
    </div>
  </div>
 <?php get_footer();?>