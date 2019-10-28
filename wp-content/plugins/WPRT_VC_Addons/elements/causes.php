<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
	'number' => '',
	'orderby' => 'post_date',
	'cat_slug' => '',
	'box_shadow' => '',
	'gap' => '30',
	'auto_scroll' => 'false',
	'show_bullets' => '',
	'show_arrows' => '',
	'bullet_show' => 'bullet-square',
	'bullet_between' => '50',
    'arrow_offset' => 'center',
    'arrow_offset_v' => '0',
	'column'		=> '3c',
	'column2'		=> '2c',
	'column3'		=> '1c',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

if ( ! shortcode_exists( 'campaigns' ) ) {
	echo "Charitable plugin not found.";
	return;
}

wp_enqueue_script( 'wprt-owlcarousel' );

$number = intval( $number );
$gap = intval( $gap );
$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );

$cls = 'arrow-center '. $bullet_show .' '. $style .' ';
$cls .= 'offset'. $arrow_offset .' offset-v'. $arrow_offset_v;
if ( $show_bullets ) $cls .= ' has-bullets'; 
if ( $show_arrows ) $cls .= ' has-arrows';
if ( $box_shadow) $cls .= ' has-shadow';

if ( $bullet_between == '45' ) $cls .= ' bullet45';
if ( $bullet_between == '40' ) $cls .= ' bullet40';
if ( $bullet_between == '35' ) $cls .= ' bullet35';
if ( $bullet_between == '30' ) $cls .= ' bullet30';
if ( $bullet_between == '25' ) $cls .= ' bullet25';
if ( $bullet_between == '20' ) $cls .= ' bullet20';
if ( $bullet_between == '15' ) $cls .= ' bullet15';
if ( $bullet_between == '10' ) $cls .= ' bullet10';

$shortcode = 'button=0 columns=1 orderby='. $orderby;
if ( $cat_slug ) $shortcode .= ' category='. $cat_slug;
if ( $number ) $shortcode .= ' number='. $number;
$shortcode = '[campaigns '. $shortcode .']';

printf( '<div class="wprt-causes carousel clearfix %2$s" data-auto="%3$s" data-column="%4$s" data-column2="%5$s" data-column3="%6$s" data-gap="%7$s">%1$s</div>', do_shortcode($shortcode), $cls, $auto_scroll, $column, $column2, $column3, $gap );