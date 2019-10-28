<?php
/**
 * Header / Bottom
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get header style
$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
if ( is_page() && wprt_metabox('header_style') )
	$header_style = wprt_metabox('header_style');

if ( $header_style == 'style-1' || $header_style == 'style-2' ) 
	return;
?>

<div class="site-navigation-wrap">
<div class="wprt-container inner">
	<?php
	// Get Header menu
	get_template_part( 'templates/header-menu' ); ?>
</div>
</div>