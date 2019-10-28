<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'padding' => '',
    'background_color' => '',
    'border_color' => '',
    'border_width' => '',
    'rounded' => '',
    'hide_boder' => '',
    'margin' => '',
    'hide_on_mobile' => '',
    'mobile_margin' => '',
    'bg_image' => '',
    'bg_position' => 'lt',
    'bg_repeat' => 'no-repeat',
    'horizontal' => '',
    'vertical' => '',
    'blur' => '',
    'spread' => '',
    'shadow_color' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$rounded = intval( $rounded );

if ( $bg_position == 'lt' ) $bg_position = 'left top';
if ( $bg_position == 'rt' ) $bg_position = 'right top';
if ( $bg_position == 'ct' ) $bg_position = 'center top';
if ( $bg_position == 'cc' ) $bg_position = 'center center';
if ( $bg_position == 'cb' ) $bg_position = 'center bottom';
if ( $bg_position == 'lb' ) $bg_position = 'left bottom';
if ( $bg_position == 'rb' ) $bg_position = 'right bottom';

$css = $cls = '';
if ( $padding) $css .= 'padding:'. $padding .';';
if ( $rounded) $css .= 'border-radius:'. $rounded .'px;';
if ( $border_color && $border_width ) $css .= 'border-style:solid;border-width:'. $border_width .';border-color:'. $border_color .';';
if ( $bg_image ) $css .= 'background:url('. wp_get_attachment_image_src( $bg_image, 'full' )[0] .') '. $bg_position .' '. $bg_repeat .';';
if ( $background_color) $css .= 'background-color:'. $background_color .';';
if ( $horizontal && $vertical && $blur && $spread && $shadow_color )
	$css .= 'box-shadow:'. $horizontal .' '. $vertical .' '. $blur .' '. $spread .' '. $shadow_color .';';

if ( $hide_boder ) $cls .= ' hide-border';
if ( $hide_on_mobile ) $cls .= ' hide-on-mobile';

printf(
	'<div class="wprt-content-box clearfix %3$s" data-margin="%4$s" data-mobimargin="%5$s">
		<div class="inner" style="%2$s">
			%1$s
		</div>
	</div>',
	do_shortcode($content),
	$css,
    $cls,
	esc_attr( $margin ),
	esc_attr( $mobile_margin )
);