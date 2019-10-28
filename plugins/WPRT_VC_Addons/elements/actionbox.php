<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'heading_text' => '',
	'heading_color' => '',
	'heading_tag' => 'h2',
	'subheading_text' => '',
	'subheading_color' => '',
	'padding' => '',
	'background' => '',
	'button_size' => '',
	'button_style' => 'accent',
	'button_rounded' => '',
	'button_text' => 'READ MORE',
	'button_url' => '',
	'button_padding' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
	'heading_line_height' => '',
	'subheading_font_family' => 'Default',
	'subheading_font_weight' => 'Default',
	'subheading_font_size' => '',
	'subheading_line_height' => '',
	'button_font_family' => 'Default',
	'button_font_weight' => 'Default',
	'button_font_size' => '',
	'button_line_height' => '',
	'heading_top_margin' => '',
	'heading_bottom_margin' => '',
	'button_top_margin' => '',
	'button_bottom_margin' => '',
	'show_icon' => '',
	'icon_type' => '',
	'icon' => '',
	'icon_color' => '',
	'icon_font_size' => '',
	'icon_right_padding' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$heading_line_height = intval( $heading_line_height );
$button_line_height = intval( $button_line_height );
$subheading_line_height = intval( $subheading_line_height );
$heading_font_size = intval( $heading_font_size );
$subheading_font_size = intval( $subheading_font_size );
$icon_font_size = intval( $icon_font_size );
$icon_right_padding = intval( $icon_right_padding );
$button_font_size = intval( $button_font_size );
$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$button_top_margin = intval( $button_top_margin );
$button_bottom_margin = intval( $button_bottom_margin );
$button_rounded = intval( $button_rounded );

$heading_wrap_cls = '';
$button_wrap_cls = '';

$cls = $css = $heading_css = $subheading_css = $button_css = '';
$icon_wrap_css = $icon_cls = $icon_css = $sub_html = $html = $icon_html = '';

if ( $padding ) $css .= 'padding:'. $padding .';';
if ( $background == '#f57223') { $cls .= ' accent'; }
else { if ( $background ) $css .= 'background-color:'. $background .';'; }

if ( $heading_font_weight != 'Default' ) $heading_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_color ) $heading_css .= 'color:'. $heading_color .';';
if ( $heading_font_size ) $heading_css .= 'font-size:'. $heading_font_size .'px;';
if ( $heading_line_height ) $heading_css .= 'line-height:'. $heading_line_height .'px;';
if ( $heading_top_margin ) $heading_css .= 'margin-top:'. $heading_top_margin .'px;';
if ( $heading_bottom_margin ) $heading_css .= 'margin-bottom:'. $heading_bottom_margin .'px;';
if ( $heading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $heading_font_family );
	$heading_css .= 'font-family:'. $heading_font_family .';';
}

if ( $subheading_font_weight != 'Default' ) $subheading_css .= 'font-weight:'. $subheading_font_weight .';';
if ( $subheading_color ) $subheading_css .= 'color:'. $subheading_color .';';
if ( $subheading_font_size ) $subheading_css .= 'font-size:'. $subheading_font_size .'px;';
if ( $subheading_line_height ) $subheading_css .= 'line-height:'. $subheading_line_height .'px;';
if ( $subheading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $subheading_font_family );
	$subheading_css .= 'font-family:'. $subheading_font_family .';';
}

if ( $button_font_weight != 'Default' ) $button_css .= 'font-weight:'. $button_font_weight .';';
if ( $button_font_size ) $button_css .= 'font-size:'. $button_font_size .'px;';
if ( $button_rounded ) $button_css .= 'border-radius:'. $button_rounded .'px;';
if ( $button_line_height ) $button_css .= 'line-height:'. $button_line_height .'px;';
if ( $button_top_margin ) $button_css .= 'margin-top:'. $button_top_margin .'px;';
if ( $button_bottom_margin ) $button_css .= 'margin-bottom:'. $button_bottom_margin .'px;';
if ( $button_padding ) $button_css .= 'padding:'. $button_padding .';';
if ( $button_font_family != 'Default' ) {
	wprt_enqueue_google_font( $button_font_family );
	$button_css .= 'font-family:'. $button_font_family .';';
}

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

if ( $show_icon ) {
	$icon = wprt_get_icon_class( $atts, 'icon' );
	if ( $icon && $icon_type != '' ) {
		$cls .= ' has-icon';
		vc_icon_element_fonts_enqueue( $icon_type );

		if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px;';
		
		if ( $icon_right_padding ) $icon_wrap_css .= 'padding-left:'. $icon_right_padding .'px;';

		if ( $icon_color == '#f57223' ) $icon_cls .= ' accent';
		else { if ( $icon_color ) $icon_css .= 'color:'. $icon_color .';'; }

		$icon_html = sprintf('<span class="icon %3$s" style="%2$s"><i class="%1$s"></i></span>', $icon, $icon_css, $icon_cls );
	}
}

if ( $subheading_text ) {
	$sub_html .= sprintf('
		<div class="sub-heading" style="%1$s">
			%2$s
		</div>',
		$subheading_css,
		$subheading_text
	);	
}

if ( $heading_text ) {
	$html .= sprintf('
		<div class="heading-wrap %1$s">
			<div class="text-wrap" style="%6$s">
				<%4$s class="heading" style="%2$s">
					%3$s
				</%4$s>
				%5$s %7$s
			</div>
		</div>',
		$heading_wrap_cls,
		$heading_css,
		$heading_text,
		$heading_tag,
		$icon_html,
		$icon_wrap_css,
		$sub_html
	);
}

$button_link = $button_url ? $button_url : '';
if ( $button_text ) {
	$html .= sprintf('
		<div class="button-wrap %1$s">
			<a href="%5$s" class="%2$s" style="%3$s">
				%4$s
			</a>
		</div>',
		$button_wrap_cls,
		$button_cls,
		$button_css,
		esc_html( $button_text ),
		$button_link
	);
}

printf(
	'<div class="wprt-action-box %3$s" style="%2$s">
		<div class="inner">%s</div>
	</div>', $html, $css, $cls );