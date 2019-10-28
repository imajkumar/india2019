<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" type="text/css" href="#" title="colors">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" style="<?php echo wprt_background_css( 'wrapper_background_img' ); ?>">
    <div id="page" class="clearfix <?php echo wprt_preloader_class(); ?>">
    	<div id="site-header-wrap">
			<!-- Top Bar -->
		    <?php get_template_part( 'templates/top'); ?>

			<!-- Header -->
			<header id="site-header">
	            <div id="site-header-inner" class="wprt-container">
	            	<div class="wrap-inner">
				        <?php
				        // Get Header logo
				        get_template_part( 'templates/header-logo' );

				        // Get Header aside
				        get_template_part( 'templates/header-aside' );?>
			        </div>
	            </div><!-- /#site-header-inner -->

	            <?php
	            // If Header is style-2,3
	            get_template_part( 'templates/header-bottom' ); ?>

			</header><!-- /#site-header -->
		</div><!-- /#site-header-wrap -->

		<?php get_template_part( 'templates/featured-title'); ?>

        <!-- Main Content -->
        <div id="main-content" class="site-main clearfix" style="<?php echo wprt_background_css( 'main_content_background_img' ); ?>">