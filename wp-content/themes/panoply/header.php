<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head();?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50" <?php body_class(); ?>>
<div class="wrapper">
 <header class="header">
    <nav class="navbar main-nav">
      <div class="container"> 
      <?php $logo_placement=get_theme_mod('logo_placement');
	  if(isset($logo_placement)&&$logo_placement=='left')
	  {?>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </button>
          <?php panoply_the_custom_logo(); ?>
          <?php $header_textcolor=get_theme_mod('header_textcolor');if($header_textcolor!=='blank'){?>
          <?php if ( is_front_page() && is_home() ) : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php else : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p><?php echo $description; ?></p>
					<?php endif; ?>
                    <?php }?>
       </div>
       <!-- Collect the nav links, forms, and other content for toggling -->
       <div class="collapse navbar-collapse" id="navbar-collapse">
       <?php wp_nav_menu( array('theme_location'=>'primary','container' => '', 'container_class' => '', 'container_id' => '', 'menu_class'=>'nav navbar-nav','depth'=> 0)); ?>  
       </div>
       <?php }elseif(isset($logo_placement)&&$logo_placement=='right'){?>
        <div class="collapse navbar-collapse right" id="navbar-collapse">
       <?php wp_nav_menu( array('theme_location'=>'primary','container' => '', 'container_class' => '', 'container_id' => '', 'menu_class'=>'nav navbar-nav','depth'=> 0)); ?>  
       </div>
        <div class="navbar-header right">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </button>
          <?php panoply_the_custom_logo(); ?>
          <?php $header_textcolor=get_theme_mod('header_textcolor');if($header_textcolor!=='blank'){?>
          <?php if ( is_front_page() && is_home() ) : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php else : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p><?php echo $description; ?></p>
					<?php endif; ?>
                    <?php }?>
       </div>
       <!-- Collect the nav links, forms, and other content for toggling -->
       <?php }elseif(isset($logo_placement)&&$logo_placement=='full'){?>
       <div class="row">
       <div class="col-lg-12 center">
         <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </button>
          <?php panoply_the_custom_logo(); ?>
          <?php $header_textcolor=get_theme_mod('header_textcolor');if($header_textcolor!=='blank'){?>
          <?php if ( is_front_page() && is_home() ) : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php else : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p><?php echo $description; ?></p>
					<?php endif; ?>
                    <?php }?>
       </div>
       </div>
       <div class="col-lg-12 center">
         <div class="collapse navbar-collapse" id="navbar-collapse">
       <?php wp_nav_menu( array('theme_location'=>'primary','container' => '', 'container_class' => '', 'container_id' => '', 'menu_class'=>'nav navbar-nav','depth'=> 0)); ?>  
       </div>
       </div>
         
         </div>
       <?php }else{?>
               <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </button>
          <?php panoply_the_custom_logo(); ?>
          <?php $header_textcolor=get_theme_mod('header_textcolor');if($header_textcolor!=='blank'){?>
          <?php if ( is_front_page() && is_home() ) : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php else : ?>
						<h2 class="logo-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
					<?php endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p><?php echo $description; ?></p>
					<?php endif; ?>
                    <?php }?>
       </div>
       <!-- Collect the nav links, forms, and other content for toggling -->
       <div class="collapse navbar-collapse" id="navbar-collapse">
       <?php wp_nav_menu( array('theme_location'=>'primary','container' => '', 'container_class' => '', 'container_id' => '', 'menu_class'=>'nav navbar-nav','depth'=> 0)); ?>  
       </div>
       <?php }?>
     </div>
   </nav>
 </header>
 <!--close-header-->