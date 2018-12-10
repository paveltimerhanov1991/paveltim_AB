<?php $page_id=get_theme_mod('gallery_source_page');
$gallery_col=get_theme_mod('gallery_col');
$panoply_gallery_id=get_theme_mod('panoply_gallery_id');
$panoply_gallery_title=get_theme_mod('panoply_gallery_title');
$gallery_display=get_theme_mod('gallery_display');
$mobileclass=get_theme_mod('gallery_responsivecol');
$activelightbox=get_theme_mod('lightbox');
$panoply_gallery_sub_title=get_theme_mod('panoply_gallery_sub_title');
$gallery = get_post_gallery( $page_id , false );
if ( $gallery ) {
	$images = $gallery['ids'];
        $item_spacing = get_theme_mod( 'item_spacing' );
}
if(isset($item_spacing)&&$item_spacing!=='')
{
	echo'<style>.normal-gallery{padding: '.$item_spacing.'px;}</style>';
}
if(isset($gallery_col)&&$gallery_col==1)
{
	$colclass='col-xs-12';
	$resclass='resclass-one';
}
elseif(isset($gallery_col)&&$gallery_col==2)
{
	$colclass='col-xs-6';
	$resclass='resclass-two';
}
elseif(isset($gallery_col)&&$gallery_col==3)
{
	$colclass='col-xs-4';
	$resclass='resclass-three';
}
elseif(isset($gallery_col)&&$gallery_col==4)
{
	$colclass='col-xs-3';
	$resclass='resclass-four';
}
elseif(isset($gallery_col)&&$gallery_col==5)
{
	$colclass='col-xs-2 five-col';
	$resclass='resclass-five';
}
elseif(isset($gallery_col)&&$gallery_col==6)
{
	$colclass='col-sm-2';
	$resclass='resclass-six';
}
?>
<section class="section-row page-gallery" id="<?php echo esc_attr($panoply_gallery_id);?>">
     <div class="container">
     <div class="page-title">
         <h2 class="main-title"><?php echo esc_html($panoply_gallery_title);?></h2>
         <?php if(isset($panoply_gallery_sub_title)&&$panoply_gallery_sub_title){?>
         <p class="subtitle"><?php echo esc_html($panoply_gallery_sub_title);?></p>
         <?php }?>
       </div>
       <div id="gallery" class="custom-gallery">
       <div class="item">
         <div class="item_box">
         
          <?php if ( ! empty( $images ) ) {
					$images = explode( ',', $images );
					$inc=1;
					if(isset($gallery_display)&&$gallery_display=='carousel' || $gallery_display=='slider'){?>
					 <div id="carousel-gallery" class="owl-carousel owl-theme carousel-slider <?php echo esc_attr($resclass);?> mobile-<?php echo esc_attr($mobileclass);?>">
                     <?php }
					foreach ( $images as $post_id ) {?>
                    <?php 
						
						$post = get_post( $post_id );
						if ( $post ) {						

							$img_full = wp_get_attachment_image_src( $post_id, 'full' );
							if ($img_full) {?>
                            <?php if(isset($gallery_display)&&$gallery_display=='grid')
							{?>
                            <div class="<?php echo esc_attr($colclass);?>  normal-gallery">
                            <?php if(isset($activelightbox)&&$activelightbox==1){?>
                            <a href="<?php echo esc_url($img_full[0]);?>" data-fancybox="group">
<img class="img-responsive" src="<?php echo esc_url($img_full[0]);?>" alt="">
</a>
<?php }else{?>
<img class="img-responsive" src="<?php echo esc_url($img_full[0]);?>" alt="">
<?php }?>
</div>
<?php if($inc++%$gallery_col==0){?>
<div class="clearfix"></div>
<?php }?>
                            <?php }elseif(isset($gallery_display)&&$gallery_display=='carousel'){?>
                           
  <div class="item">
  <?php if(isset($activelightbox)&&$activelightbox==1){?>
  <a href="<?php echo esc_url($img_full[0]);?>" data-fancybox="group"><img src="<?php echo esc_url($img_full[0]);?>" alt=""></a>
  <?php }else{?>
  <img src="<?php echo esc_url($img_full[0]);?>" alt="">
  <?php }?>
  </div>

                            <?php }elseif(isset($gallery_display)&&$gallery_display=='slider'){?>
                            <div class="item">
                            <?php if(isset($activelightbox)&&$activelightbox==1){?>
<a href="<?php echo esc_url($img_full[0]);?>" data-fancybox="group"><img src="<?php echo esc_url($img_full[0]);?>" alt=""></a>
<?php }else{?>
<img src="<?php echo esc_url($img_full[0]);?>" alt="">
<?php }?></div>
                            <?php }?>
                            <?php }}?>
                          <?php }
						  if(isset($gallery_display)&&$gallery_display=='carousel' || $gallery_display=='slider'){?>
						  </div>
                          <?php } }?>
         
</div><!--item_box-->

        </div>
       </div><!--owl-carousel-->     
     </div><!--container-->
    </section>