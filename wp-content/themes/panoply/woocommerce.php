<?php get_header();?>
  <div class="inner-page-bg parallax-bg">
     <div class="container">
        <div class="inner-page-title">
          <h1 class="title"><?php woocommerce_page_title(); ?></h1>
        </div>
     </div>
   </div>
   <!--close-inner-page-bg-->
  <div class="content">
    <div class="container shop-page">
      
      <?php woocommerce_content(); ?>
    </div>
  </div>
<?php get_footer();?>