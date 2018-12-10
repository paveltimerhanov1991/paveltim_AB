<?php
$blog_Section_id=get_theme_mod('blog_Section_id');
$blog_Section=get_theme_mod('blog_Section');
$panoply_blog_count=get_theme_mod('panoply_blog_count');
$blog_Section_sub_title=get_theme_mod('blog_Section_sub_title');
?>
<?php if($blog_Section_id){?>
<section class="section-row home-blog" id="<?php echo esc_attr($blog_Section_id);?>">
     <div class="container">
       <div class="page-title">
         <h2 class="main-title"><?php echo esc_html($blog_Section);?></h2>
          <?php if(isset($blog_Section_sub_title)&&$blog_Section_sub_title){?>
         <p class="subtitle"><?php echo esc_html($blog_Section_sub_title);?></p>
         <?php }?>
       </div>
       <div class="row">
       <div class="content-grid" id="section-news-posts">
       <?php
	   $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
	   if(!empty($panoply_blog_count))
{
$params = array('posts_per_page' =>$panoply_blog_count, 'post_type' => 'post','orderby' => 'DESC','paged' => $paged);
}
else
{
	$params = array('posts_per_page' =>3, 'post_type' => 'post','orderby' => 'DESC','paged' => $paged);
}
$wc_query = new WP_Query($params);
?>
<?php if ($wc_query->have_posts()) : ?>
<?php while ($wc_query->have_posts()) :
                $wc_query->the_post(); 
				?>
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeInDown">
           <div class="blog-post">
             <article>
               <header class="entry-header">
                 <div class="entry-thumbnail">
                   <?php the_post_thumbnail('panoply-blog-image', array( 'class'=> "img-responsive",'alt'=>esc_attr(get_the_title()))); ?>
                 </div>
                 <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                 <div class="entry-meta">
                   <?php the_category(); ?>
                 </div>
               </header>
               <div class="entry-summary">
                <?php the_excerpt();?>
                 <a class="btn" href="<?php the_permalink();?>"><?php esc_html_e('Read More', 'panoply'); ?></a>
               </div>
             </article>
           </div>
         </div>        
       <?php endwhile; endif;?>
       </div>
       </div>
       <?php $news_loadmore = get_theme_mod( 'panoply_blog_loadmore');
	   if($news_loadmore=='ajax')
	   {
		   $loadclas='loadmore_post';
	   }
	   else
	   {
		   $loadclas='loadmore_post_link';
	   }
	   ?>
       <?php 
	   if ( $news_loadmore != 'hide' ) {
	   $label = get_theme_mod( 'news_more_text' );
	   ?>
         <?php if ($wc_query->max_num_pages > 1) {?>
         <div class="<?php echo esc_attr($loadclas);?>" max_page="<?php echo $wc_query->max_num_pages?>" start_page="1"> 
         	<a class="btn" href="<?php echo ( $news_loadmore == 'link' ) ? esc_url( get_theme_mod( 'news_more_link' ) ) : '#'; ?>"><?php echo esc_html( $label ); ?><i aria-hidden="true" class="fa fa-angle-double-down"></i><i class="fa fa-refresh fa-spin"></i></a>
         </div>
         <?php }}?>
     </div>
   </section>
   <?php }?>