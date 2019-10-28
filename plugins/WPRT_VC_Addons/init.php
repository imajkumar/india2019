<?php 
/*
Plugin Name: WPRT Addons for Visual Composer 
Plugin URI: http://rollthemes.com/plugins/
Description: Extend Visual Composer with Advanced Shortcodes.
Version: 3.6.8
Author: RollThemes
Author URI: http://rollthemes.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include files
foreach ( glob( plugin_dir_path( __FILE__ ) . '/elements/*.php' ) as $file ) {
	$filename = basename( $file );
	$tagname  = str_replace( '-', '_', pathinfo( $file, PATHINFO_FILENAME ) );

	add_shortcode( $tagname, function( $atts, $content = '' ) use( $file, $filename ) {
		ob_start();
		include $file;
		return ob_get_clean();
	} );
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'loadCssAndJs', 999999 );
function loadCssAndJs() {
	wp_enqueue_style( 'wprt-flexslider', plugins_url('assets/flexslider.css', __FILE__), array(), '2.3.6' );
	wp_register_script( 'wprt-flexslider', plugins_url('assets/flexslider.min.js', __FILE__), array('jquery'), '2.3.6', true );
	wp_enqueue_style( 'wprt-owlcarousel', plugins_url('assets/owl.carousel.css', __FILE__), array(), '2.2.1' );
	wp_register_script( 'wprt-owlcarousel', plugins_url('assets/owl.carousel.min.js', __FILE__), array('jquery'), '2.2.1', true );
	wp_enqueue_style( 'wprt-cubeportfolio', plugins_url('assets/cubeportfolio.min.css', __FILE__), array(), '3.4.0' );
	wp_register_script( 'wprt-cubeportfolio', plugins_url('assets/cubeportfolio.min.js', __FILE__), array('jquery'), '3.4.0', true );
	wp_register_script( 'wprt-countto', plugins_url('assets/countto.js', __FILE__), array('jquery'), '1.0.0', true );
	wp_enqueue_style( 'wprt-magnificpopup', plugins_url('assets/magnific.popup.css', __FILE__), array(), '1.0.0' );
	wp_register_script( 'wprt-magnificpopup', plugins_url('assets/magnific.popup.min.js', __FILE__), array('jquery'), '1.0.0', true );
	wp_enqueue_style( 'wprt-vegas', plugins_url('assets/vegas.css', __FILE__), array(), '2.3.1' );
	wp_register_script( 'wprt-vegas', plugins_url('assets/vegas.js', __FILE__), array('jquery'), '2.3.1', true );
	wp_enqueue_style( 'wprt-ytplayer', plugins_url('assets/ytplayer.css', __FILE__), array(), '3.0.2' );
	wp_register_script( 'wprt-ytplayer', plugins_url('assets/ytplayer.js', __FILE__), array('jquery'), '3.0.2', true );
	wp_enqueue_script( 'wprt-waypoints', plugins_url('assets/waypoints.js', __FILE__), array('jquery'), '2.0.4', true );
	wp_register_script( 'wprt-fittext', plugins_url('assets/fittext.js', __FILE__), array('jquery'), '1.1.0', true );
	wp_register_script( 'wprt-flowtype', plugins_url('assets/flowtype.js', __FILE__), array('jquery'), '1.3.0', true );
	wp_register_script( 'wprt-typed', plugins_url('assets/typed.js', __FILE__), array('jquery'), '1.1.0', true );
	wp_enqueue_style( 'wprt-shortcode', plugins_url('assets/shortcodes.css', __FILE__), array(), '1.0' );
	wp_enqueue_script( 'wprt-shortcode', plugins_url('assets/shortcodes.js', __FILE__), array('jquery'), '1.0', true );
	wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js', array(), 'v3');
}

// Add image sizes
add_action( 'after_setup_theme', 'add_image_sizes' );
function add_image_sizes() {
	add_image_size( 'wprt-square', 600, 600, true );
	add_image_size( 'wprt-square2', 400, 400, true );
	add_image_size( 'wprt-rectangle', 600, 500, true );
	add_image_size( 'wprt-rectangle2', 600, 390, true );
	add_image_size( 'wprt-medium-auto', 870, 9999 );
	add_image_size( 'wprt-small-auto', 600, 9999 );
	add_image_size( 'wprt-xsmall-auto', 480, 9999 );
}

// Shortcode functions and map
require_once __DIR__ . '/map.php';
require_once __DIR__ . '/google-api.php';

?>