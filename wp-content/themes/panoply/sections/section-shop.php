<?php
$shoppage_Section_id=get_theme_mod('shoppage_Section_id');
$shoppage_Section=get_theme_mod('shoppage_Section');
$panoply_shop_page_count=get_theme_mod('panoply_shop_page_count');
$shoppage_Section_sub_title=get_theme_mod('shoppage_Section_sub_title');
?>
<?php if($shoppage_Section_id){?>
<section class="section-row home-shop" id="<?php echo esc_attr($shoppage_Section_id);?>">
     <div class="container">
       <div class="page-title">
         <h2 class="main-title"><?php echo esc_html($shoppage_Section);?></h2>
          <?php if(isset($shoppage_Section_sub_title)&&$shoppage_Section_sub_title){?>
         <p class="subtitle"><?php echo esc_html($shoppage_Section_sub_title);?></p>
         <?php }?>
       </div>
       <div class="home-products row">
         <ul class="products">
         <?php
		 $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
		 if(!empty($panoply_shop_page_count))
		 {
              $params = array('posts_per_page' =>$panoply_shop_page_count, 'post_type' => 'product','orderby' => 'DESC','paged' => $paged);
		 }else
		 {
			 $params = array('posts_per_page' =>4, 'post_type' => 'product','orderby' => 'DESC','paged' => $paged);
		 }
$wc_query = new WP_Query($params);
global $product; 
?>
<?php if ($wc_query->have_posts()) : ?>
<?php while ($wc_query->have_posts()) :
                $wc_query->the_post(); 
				$product = new WC_Product(get_the_ID());
				?>
           <li class="col-md-3 col-sm-3 col-xs-6 wow fadeInDown">
             <div class="product">
             <a href="<?php echo esc_url(get_permalink( $wc_query->post->ID )); ?>" title="<?php echo esc_attr($wc_query->post->post_title ? $wc_query->post->post_title : $wc_query->post->ID); ?>">
             <?php if($product->is_on_sale()) : ?>
<span class="onsale"><?php esc_html_e('Sale!', 'panoply'); ?></span><?php endif; ?>
               <?php if (has_post_thumbnail( $wc_query->post->ID )) echo get_the_post_thumbnail($wc_query->post->ID);?>
               <h3><?php the_title(); ?></h3>
	           <span class="price">
                 <?php echo $product->get_price_html(); ?>
               </span>
             </a>
             <?php woocommerce_template_loop_add_to_cart( $wc_query->post); ?>
             </div>
           </li>
           <?php endwhile; endif;?>
         </ul>
       </div>
       <?php $shop_loadmore = get_theme_mod( 'panoply_shop_loadmore');
	   if($shop_loadmore=='ajax')
	   {
		   $loadclas='loadmore_shop';
	   }
	   else
	   {
		   $loadclas='loadmore_shop_link';
	   }
	   ?>
      <?php 
	   if ( $shop_loadmore != 'hide' ) {
	   $label = get_theme_mod( 'shop_more_text' );
	   ?>
      <?php if ($wc_query->max_num_pages > 1) {?>
         <div class="<?php echo esc_attr($loadclas);?>" max_page="<?php echo $wc_query->max_num_pages?>" start_page="1"> 
         	<a class="btn" href="<?php echo ( $shop_loadmore == 'link' ) ? esc_url( get_theme_mod( 'shop_more_link' ) ) : '#'; ?>"><?php echo esc_html( $label ); ?><i aria-hidden="true" class="fa fa-angle-double-down shop-load-down"></i><i class="fa fa-refresh fa-spin shop-load-refresh"></i></a>
         </div>
         <?php }}?>
         </div>
     </div>
   </section>
   <?php }?>