<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'style' => 'style-1',
    'title_width' => 'w190',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$cls = $style;

if ( $style == 'style-3' || $style == 'style-4' )
	$cls .= ' title-'. $title_width;

printf( '
	<div class="wprt-tabs clearfix %2$s"><ul class="tab-title clearfix"></ul><div class="tab-content-wrap">%1$s</div></div>',
	do_shortcode($content),
	$cls
);