<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="entry-header">
              <?php if(is_single()){?>
			<?php
			if ( has_post_thumbnail( ) ) {
				the_post_thumbnail( 'panoply-blog-standard' );
			}?>
        <?php }else{?>
        <a href="<?php echo esc_url( get_permalink() ); ?>">        
			<?php
			if ( has_post_thumbnail( ) ) {
				the_post_thumbnail( 'panoply-blog-standard' );
			} else {
				
			}
			?>
            </a>		
        <?php }?>
              </div>
              <div class="entry-info">
              <?php if(is_single()){}else{?>
              <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
              <?php }?>
                <div class="entry-meta <?php if(is_single()){echo esc_attr('singleclass','panoply');}?>">
                  <span class="byline"><span class="author"><i class="fa fa-user"></i>&nbsp;&nbsp; <?php the_author_posts_link() ?></span></span>
                  <span class="cat-links"><a href="<?php comments_link(); ?>"><i class="fa fa-comments" aria-hidden="true"></i>
<?php comments_number(__('0 COMMENTS','panoply'), __('1 COMMENT', 'panoply'), __('% Comments', 'panoply')); ?>
    </a></span>
                  <span class="cat-links"><?php echo get_the_date(); ?></span>
                </div>
              </div>
              <div class="entry-content">
              <?php if(is_single()){the_content();?>
		 <?php  }else{the_excerpt();}?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'panoply' ),
					'after'  => '</div>',
				) );
			?>
            <?php if(is_single()){}else{?>
                <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','panoply');?></a>
                <?php }?>
              </div>
            </div>
            <div class="tags">
                <?php the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?> 
              </div>

