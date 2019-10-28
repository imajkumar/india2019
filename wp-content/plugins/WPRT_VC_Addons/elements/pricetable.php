<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'heading' => 'STARTER',
	'heading_color' => '',
	'heading_background' => '#f6f6f6',
	'price' => '$19',
	'price_color' => '',
	'price_unit' => 'PER MONTH',
	'unit_color' => '',
	'price_padding' => '78px 0 52px 0',
	'price_background' => '#363636',
	'content_background' => '#ffffff',
	'content_color' => '',
	'content_padding' => '33px 42px 42px 46px',
	'content_style' => 'border',
	'has_border' => '',
	'btn_padding' => '',
	'btn_margin' => '37px 0px 0px 0px',
	'button_style' => 'accent',
	'button_size' => '',
	'btn_rounded' => '',
	'button_text' => 'CHOOSE PLAN',
	'button_url' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
	'heading_line_height' => '',
	'price_font_family' => 'Default',
	'price_font_weight' => 'Default',
	'price_font_size' => '',
	'price_line_height' => '',
	'unit_font_family' => 'Default',
	'unit_font_weight' => 'Default',
	'unit_font_size' => '',
	'unit_line_height' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$heading_line_height = intval( $heading_line_height );
$price_line_height = intval( $price_line_height );
$unit_line_height = intval( $unit_line_height );

$heading_font_size = intval( $heading_font_size );
$price_font_size = intval( $price_font_size );
$unit_font_size = intval( $unit_font_size );
$btn_rounded = intval( $btn_rounded );

$cls = $css = $btn_css = '';
$h_css = $p_css = $pu_css = '';
$heading_css = $price_cls = $price_css = $content_css = $button_css = $button_cls = '';
$h_html = $p_html = $b_html = '';
$h1_html = $p1_html = $p2_html = '';

if ( $content_style == 'border' ) $cls .= ' has-border';
if ( $content_style == 'shadow' ) $cls .= ' has-shadow';

if ( $heading_font_weight != 'Default' ) $h_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_color ) $h_css .= 'color:'. $heading_color .';';
if ( $heading_background ) $h_css .= 'background-color:'. $heading_background .';';
	if ( $heading_font_size ) $h_css .= 'font-size:'. $heading_font_size .'px;';
if ( $heading_line_height ) $h_css .= 'line-height:'. $heading_line_height .'px;';
if ( $heading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $heading_font_family );
	$h_css .= 'font-family:'. $heading_font_family .';';
}

if ( $price_font_weight != 'Default' ) $p_css .= 'font-weight:'. $price_font_weight .';';
if ( $price_color ) $p_css .= 'color:'. $price_color .';';
if ( $price_font_size ) $p_css .= 'font-size:'. $price_font_size .'px;';
if ( $price_line_height ) $p_css .= 'line-height:'. $price_line_height .'px;';
if ( $price_font_family != 'Default' ) {
	wprt_enqueue_google_font( $price_font_family );
	$p_css .= 'font-family:'. $price_font_family .';';
}

if ( $unit_font_weight != 'Default' ) $pu_css .= 'font-weight:'. $unit_font_weight .';';
if ( $unit_color ) $pu_css .= 'color:'. $unit_color .';';
if ( $unit_font_size ) $pu_css .= 'font-size:'. $unit_font_size .'px;';
if ( $unit_line_height ) $pu_css .= 'line-height:'. $unit_line_height .'px;';
if ( $unit_font_family != 'Default' ) {
	wprt_enqueue_google_font( $unit_font_family );
	$pu_css .= 'font-family:'. $unit_font_family .';';
}

if ( $price_padding ) $price_css .= 'padding:'. $price_padding .';';

if ( $price_background == '#f57223' ) {
	$price_cls .= ' accent';
} else {
	if ( $price_background ) $price_css .= 'background-color:'. $price_background .';';
}

if ( $content_padding ) $content_css .= 'padding:'. $content_padding .';';
if ( $content_background ) $content_css .= 'background-color:'. $content_background .';';
if ( $content_color ) $content_css .= 'color:'. $content_color .';';

if ( $btn_padding ) $button_css .= 'padding:'. $btn_padding .';';
if ( $btn_margin ) $button_css .= 'margin:'. $btn_margin .';';
if ( $btn_rounded ) $button_css .= 'border-radius:'. $btn_rounded .'px;';

if ( $heading ) {
	$h1_html .= sprintf( '<div class="title" style="%2$s">%1$s</div>', $heading, esc_attr( $h_css ) );
	$h_html .= sprintf(
		'<div class="price-table-name" style="%2$s">
			%1$s
		</div>',
		$h1_html,
		$heading_css
	);
}

if ( $price ) $p1_html .= sprintf( '<span class="figure" style="%2$s">%1$s</span>', $price, esc_attr( $p_css ) );
if ( $price_unit ) $p2_html .= sprintf( '<span class="term" style="%2$s">%1$s</span>', $price_unit, esc_attr( $pu_css ) );
if ( $price || $price_unit )
	$p_html .= sprintf(
		'<div class="price-table-price %4$s" style="%3$s">
			<div class="price-wrap">%1$s %2$s</div>
		</div>',
		$p1_html,
		$p2_html,
		$price_css,
		$price_cls
	);

if ( $button_text ) {
	$button_cls = $button_size;
    if ( $button_style == 'accent' ) $button_cls .= ' wprt-button accent';
    if ( $button_style == 'dark' ) $button_cls .= ' wprt-button dark';
    if ( $button_style == 'light' ) $button_cls .= ' wprt-button light';
    if ( $button_style == 'very-light' ) $button_cls .= ' wprt-button very-light';
    if ( $button_style == 'white' ) $button_cls .= ' wprt-button white';
    if ( $button_style == 'outline' ) $button_cls .= ' wprt-button outline ol-accent';
    if ( $button_style == 'outline_dark' ) $button_cls .= ' wprt-button outline dark';
    if ( $button_style == 'outline_light' ) $button_cls .= ' wprt-button outline light';
    if ( $button_style == 'outline_very-light' ) $button_cls .= ' wprt-button outline very-light';
    if ( $button_style == 'outline_white' ) $button_cls .= '  wprt-button outline white';

    $b_html .= sprintf(
    	'<div class="price-table-button" style="%1$s">
    		<a target="_blank" class="%2$s" href="%3$s" style="%4$s">%5$s</a>
    	</div>',
    	$btn_css,
    	$button_cls,
    	$button_url,
    	$button_css,
    	$button_text
    );
}

printf(
	'<div class="wprt-price-table %1$s" style="%2$s">
		%5$s %6$s
		<div class="price-table-features" style="%3$s">%4$s %7$s</div>
	</div>',
	$cls,
	$css,
	$content_css,
	$content,
	$h_html,
	$p_html,
	$b_html
);

?>