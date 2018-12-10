<?php
if( !function_exists('panoply_home_section') ){
	function panoply_home_section(){
		$allsection=get_theme_mod('allsection');
		if(isset($allsection)&&$allsection)
		{
			foreach($allsection as $allsectionnum)
		{
			$reorder[]=$allsectionnum['order_type'];
			$order=$reorder;
		}
		}
		else
		{
			$order=array(
			'banner',
			'aboutus',
			'services',
			'shop',
			'testimonials',
			'blog',
			'calltoaction',
			'contactus',
			'gallery'			
			);
		}
		
		$panoply_home_sections = apply_filters('panoply_home_sections',$order);

		return $panoply_home_sections;
	}
}
function panoply_post_thumbnail() {
    if(is_singular()) :
 ?>
  <?php if (post_password_required() || is_attachment() || ! has_post_thumbnail() ) { } else {the_post_thumbnail('panoply-post-thumbnail', array('class'=>'img-responsive','alt' => esc_attr(get_the_title()) )); ?> 
<?php } ?>
 <?php else : ?>
  <a href="<?php the_permalink(); ?>">
   <?php if (post_password_required() || is_attachment() || ! has_post_thumbnail() ) { } else {the_post_thumbnail('panoply-post-thumbnail', array('class'=>'img-responsive','alt' => esc_attr(get_the_title()) )); ?> 
<?php } ?>
  </a>
<?php endif; // End is_singular()
}
//Panoply contact form
function panoply_woocommerce_page_title() {
return false;
}
add_filter('woocommerce_show_page_title', 'panoply_woocommerce_page_title');

if ( ! function_exists( 'panoply_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Twenty Sixteen 1.2
 */
function panoply_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {?>
		<div class="logo-img"><?php the_custom_logo();?></div>
	<?php }
}
endif;
function panoply_hook_css() {
	$heading_h1=get_theme_mod('heading_h1');
	$heading_h2=get_theme_mod('heading_h2');
	$heading_h3=get_theme_mod('heading_h3');
	$heading_h4=get_theme_mod('heading_h4');
	$heading_h5=get_theme_mod('heading_h5');
	$heading_h6=get_theme_mod('heading_h6');
        ?>
            <style>
			  <?php if(isset($heading_h1)&&$heading_h1!==''){?>
                h1 {font-size:<?php echo esc_attr($heading_h1);?>px !important;}
				<?php }?>
				 <?php if(isset($heading_h2)&&$heading_h2!==''){?>
                h2 {font-size:<?php echo esc_attr($heading_h2);?>px !important;}
				<?php }?>
				 <?php if(isset($heading_h3)&&$heading_h3!==''){?>
                h3 {font-size:<?php echo esc_attr($heading_h3);?>px !important;}
				<?php }?>
				 <?php if(isset($heading_h4)&&$heading_h4!==''){?>
                h4 {font-size:<?php echo esc_attr($heading_h4);?>px !important;}
				<?php }?>
				 <?php if(isset($heading_h5)&&$heading_h5!==''){?>
                h5 {font-size:<?php echo esc_attr($heading_h5);?>px !important;}
				<?php }?>
				 <?php if(isset($heading_h6)&&$heading_h6!==''){?>
                h5 {font-size:<?php echo esc_attr($heading_h6);?>px !important;}
				<?php }?>
            </style>
        <?php
    }
add_action('wp_head', 'panoply_hook_css');
function panoply_individual_layout_metabox() {
			add_meta_box(
				'panoply-individual-layout', esc_html__( 'Layout', 'panoply' ), 'panoply_individual_layout_metabox_content', array('page'), 'side', 'low'
			);
}
add_action( 'add_meta_boxes', 'panoply_individual_layout_metabox' );
function panoply_individual_layout_metabox_content() {
	global $post;
	$values   = get_post_custom( $post->ID );
	$selected = isset( $values['panoply_layout_select'] ) ? esc_attr( $values['panoply_layout_select'][0] ) : '';
	wp_nonce_field( 'panoply_individual_layout_nonce', 'individual_layout_nonce' );
	?>
	<p>
		<select name="panoply_layout_select" id="panoply_layout_select">
			<option value="default" <?php selected( $selected, 'default' ); ?>><?php echo esc_html__( 'Default', 'panoply' ); ?></option>
			<option value="full-width" <?php selected( $selected, 'full-width' ); ?>><?php echo esc_html__( 'Full Width', 'panoply' ); ?></option>
			<option value="sidebar-left" <?php selected( $selected, 'sidebar-left' ); ?>><?php echo esc_html__( 'Left Sidebar', 'panoply' ); ?></option>
			<option value="sidebar-right" <?php selected( $selected, 'sidebar-right' ); ?>><?php echo esc_html__( 'Right Sidebar', 'panoply' ); ?></option>
		</select>
	</p>
	<?php
}
function panoply_individual_layout_metabox_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! isset( $_POST['individual_layout_nonce'] ) || ! wp_verify_nonce( $_POST['individual_layout_nonce'], 'panoply_individual_layout_nonce' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post' ) ) {
		return;
	}
	if ( isset( $_POST['panoply_layout_select'] ) ) {
		update_post_meta( $post_id, 'panoply_layout_select', esc_attr( $_POST['panoply_layout_select'] ) );
	}
}
add_action( 'save_post', 'panoply_individual_layout_metabox_save' );
//post
function panoply_individual_postlayout_metabox() {
			add_meta_box(
				'panoply-individual-postlayout', esc_html__( 'Layout', 'panoply' ), 'panoply_individual_postlayout_metabox_content', array('post'), 'side', 'low'
			);
}
add_action( 'add_meta_boxes', 'panoply_individual_postlayout_metabox' );
function panoply_individual_postlayout_metabox_content() {
	global $post;
	$values   = get_post_custom( $post->ID );
	$selected = isset( $values['panoply_postlayout_select'] ) ? esc_attr( $values['panoply_postlayout_select'][0] ) : '';
	wp_nonce_field( 'panoply_individual_postlayout_nonce', 'individual_postlayout_nonce' );
	?>
	<p>
		<select name="panoply_postlayout_select" id="panoply_postlayout_select">
			<option value="default" <?php selected( $selected, 'default' ); ?>><?php echo esc_html__( 'Default', 'panoply' ); ?></option>
			<option value="full-width" <?php selected( $selected, 'full-width' ); ?>><?php echo esc_html__( 'Full Width', 'panoply' ); ?></option>
			<option value="sidebar-left" <?php selected( $selected, 'sidebar-left' ); ?>><?php echo esc_html__( 'Left Sidebar', 'panoply' ); ?></option>
			<option value="sidebar-right" <?php selected( $selected, 'sidebar-right' ); ?>><?php echo esc_html__( 'Right Sidebar', 'panoply' ); ?></option>
		</select>
	</p>
	<?php
}
function panoply_individual_postlayout_metabox_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! isset( $_POST['individual_postlayout_nonce'] ) || ! wp_verify_nonce( $_POST['individual_postlayout_nonce'], 'panoply_individual_postlayout_nonce' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post' ) ) {
		return;
	}
	if ( isset( $_POST['panoply_postlayout_select'] ) ) {
		update_post_meta( $post_id, 'panoply_postlayout_select', esc_attr( $_POST['panoply_postlayout_select'] ) );
	}
}
add_action( 'save_post', 'panoply_individual_postlayout_metabox_save' );
function panoply_get_standard_fonts() {
		    $font=array(
			'Arial, Helvetica, sans-serif',
			'Arial Black, Gadget, sans-serif',
			'Bookman Old Style, serif',
			'Comic Sans MS, cursive',
			'Courier, monospace',
			'Georgia, serif',
			'Garamond, serif',
			'Impact, Charcoal, sans-serif',
			'Lucida Console, Monaco, monospace',
			'Lucida Sans Unicode, Lucida Grande, sans-serif',
			'MS Sans Serif, Geneva, sans-serif',
			'MS Serif, New York, sans-serif',
			'Palatino Linotype, Book Antiqua, Palatino, serif',
			'Tahoma, Geneva, sans-serif',
			'Times New Roman, Times, serif',
			'Trebuchet MS, Helvetica, sans-serif',
			'Verdana, Geneva, sans-serif',
			'Paratina Linotype',
			'Trebuchet MS',		
	);
	return $font;
}
function panoply_typography_font() {
	$panoply_h1_font=get_theme_mod('panoply_h1_font');
	$panoply_h2_font=get_theme_mod('panoply_h2_font');
	$panoply_h3_font=get_theme_mod('panoply_h3_font');
	$panoply_h4_font=get_theme_mod('panoply_h4_font');
	$panoply_h5_font=get_theme_mod('panoply_h5_font');
	$panoply_h6_font=get_theme_mod('panoply_h6_font');
	if(isset($panoply_h1_font)&&$panoply_h1_font!=='')
	{?>
	<style>
    h1{font-family: <?php echo esc_attr($panoply_h1_font);?> !important;}
    </style>
	<?php }
	if(isset($panoply_h2_font)&&$panoply_h2_font!=='')
	{?>
	<style>
    h2{font-family: <?php echo esc_attr($panoply_h2_font);?> !important;}
    </style>
	<?php }
	if(isset($panoply_h3_font)&&$panoply_h3_font!=='')
	{?>
	<style>
   h3{font-family: <?php echo esc_attr($panoply_h3_font);?> !important;}
    </style>
	<?php }
	if(isset($panoply_h4_font)&&$panoply_h4_font!=='')
	{?>
	<style>
   h4{font-family: <?php echo esc_attr($panoply_h5_font);?> !important;}
    </style>
	<?php }
	if(isset($panoply_h5_font)&&$panoply_h5_font!=='')
	{?>
	<style>
    h5{font-family: <?php echo esc_attr($panoply_h5_font);?> !important;}
    </style>
	<?php }
	if(isset($panoply_h6_font)&&$panoply_h6_font!=='')
	{?>
	<style>
    h6{font-family: <?php echo esc_attr($panoply_h6_font);?> !important;}
    </style>
	<?php }
	}
	add_action('wp_head', 'panoply_typography_font');
?>