<?php
/**
* The template for displaying comments
*
* The area of the page that contains both current comments
* and the comment form.
*
* @package WordPress
* @subpackage Twenty_Sixteen
* @since Twenty Sixteen 1.0
*/
/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/
if ( post_password_required() ) {
return;
}
?>
<div class="commentsection wow fadeInUp">
  <?php if ( have_comments() ) : ?>
  <h3 class="title2 comment_title">
    <?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( esc_html( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'panoply' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						esc_html(
							'%1$s COMMENTS',
							'%1$s COMMENTS',
							$comments_number,
							'comments title',
							'panoply'
						),
						esc_html(number_format_i18n( $comments_number )),
						get_the_title()
					);
				}
			?>
  </h3>
  <?php the_comments_navigation(); ?>
  <ol class="commentlist">
    <?php
				wp_list_comments( array(
				'callback' => 'panoply_better_comments',
				'style'       => 'ol'
				) );
			?>
  </ol>
  <!-- .comment-list -->
  <?php the_comments_navigation(); ?>
  <?php endif; // Check for have_comments(). ?>
  <?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
  <p class="no-comments">
    <?php esc_html_e( 'Comments are closed.', 'panoply' ); ?>
  </p>
  <?php endif; ?>
  <div class="comment-section wow fadeInUp">
   <?php $comment_args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
           'author' => '<div class="field"><div class="row">' . 
                         '<div class="col-md-6 col-sm-6 col-xs-12"><input placeholder='.esc_attr__('Name','panoply').' class="form-control" id="author" name="author" type="text" value="' . esc_attr( $comment_author ) . '" ' . ( $req ? 'aria-required="true"' : '') . ' /></div>',
            'email'  => '<div class="col-md-6 col-sm-6 col-xs-12"><input placeholder='.esc_attr__('Email','panoply').' class="form-control" type="email" class="text" name="email" id="email" value="' . esc_attr(  $comment_author_email ) . '" ' . ( $req ? 'aria-required="true"' : '') . ' /></div></div></div>',
			'redirect_to' => '<input type="hidden" name="redirect_to" value="'.esc_url(get_permalink()).'"/>',			
            'url'    => '<div class="field"><div class="row"><div class="col-lg-12">' .
                        '<input placeholder='.esc_attr__('Website','panoply').' class="form-control" id="url" name="url" type="url" value="' . esc_attr( $comment_author_url ) . '" /></div></div></div>',
                        ) 
            ),
              'comment_field'        => '<div class="field"><div class="row"><div class="col-lg-12"><textarea placeholder='.esc_attr__('Message','panoply').'  name="comment" class="form-control"  rows="7"  required="required"></textarea> </div></div></div>',
              'comment_notes_before' => '',
              'comment_notes_after'  => '',
              'id_form'              => 'commentform',
              'id_submit'            => 'submit',
              'class_submit'         => 'btn btn-default',
              'name_submit'          => 'submit',             
              'label_submit'         => esc_html_e('Post comment', 'panoply'),
              'submit_button'        => '<input name="%1$s" type="submit" id="comment_btn" class="%3$s" value="'.esc_attr__('Submit','panoply').'" />',
              'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
              'format'               => 'html5',
        );
        comment_form($comment_args); ?>
  </div>
</div>
<!-- .comments-area -->