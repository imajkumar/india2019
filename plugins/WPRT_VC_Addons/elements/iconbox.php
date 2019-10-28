<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'icon-top',
	'icon_display' => 'icon-font',
	'image' => '',
	'image_width' => '',
	'icon_showcase' => 'accent-bg',
	'text_align' => 'align-left',
	'icon_type' => '',
	'icon' => '',
	'icon_color' => '',
	'icon_width' => 'w60',
	'icon_rounded' => '',
	'icon_font_size' => '30px',
	'tag' => 'h3',
	'heading' => '',
	'heading_color' => '',
	'description' => '',
	'desc_color' => '',
	'show_button' => '',
	'button_style' => 'accent',
	'button_size' => '',
	'button_rounded' => '',
	'link_color' => '',
	'button_text' => 'READ MORE',
	'link_url' => '',
	'new_tab' => 'yes',
	'button_padding' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
	'heading_line_height' => '',
	'desc_font_family' => 'Default',
	'desc_font_weight' => 'Default',
	'desc_font_size' => '',
	'desc_line_height' => '',
	'button_font_family' => 'Default',
	'button_font_weight' => 'Default',
	'button_font_size' => '',
	'button_line_height' => '',
	'content_left_padding' => '85px',
	'content_right_padding' => '85px',
	'heading_left_margin' => '85px',
	'heading_top_margin' => '',
	'heading_bottom_margin' => '',
	'desc_top_margin' => '',
	'desc_bottom_margin' => '',
), $atts ) );

$image_width = intval( $image_width );
$icon_font_size = intval( $icon_font_size );

$content_left_padding = intval( $content_left_padding );
$content_right_padding = intval( $content_right_padding );
$heading_left_margin = intval( $heading_left_margin );
$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$desc_top_margin = intval( $desc_top_margin );
$desc_bottom_margin = intval( $desc_bottom_margin );

$heading_font_size = intval( $heading_font_size );
$heading_line_height = intval( $heading_line_height );
$desc_font_size = intval( $desc_font_size );
$desc_line_height = intval( $desc_line_height );
$button_font_size = intval( $button_font_size );
$button_line_height = intval( $button_line_height );
$button_rounded = intval( $button_rounded );

$cls = $style .' '. $icon_width .' '. $icon_showcase .' '. $text_align .' '. $icon_rounded;
$cls .= ( $icon_showcase != 'simple' ) ? ' has-width' : ' simple';

$heading_css = $desc_css = $button_wrap_css = $button_css = $button_cls = '';
$text_css = $content_css = $icon_css = $image_css = $icon_html = $content_html = '';

if ( $style == 'icon-left2' ) {
	$heading_css .= 'margin-left:'. $heading_left_margin .'px;';
}
if ( $content_left_padding && $style == 'icon-left' ) {
	$heading_css = $desc_css = $button_wrap_css = 'padding-left:'. $content_left_padding .'px;';
} 
if ( $content_right_padding && $style == 'icon-right' ) {
	$heading_css = $desc_css = $button_wrap_css = 'padding-right:'. $content_right_padding .'px;';
}

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

if ( $desc_font_weight != 'Default' ) $desc_css .= 'font-weight:'. $desc_font_weight .';';
if ( $desc_color ) $desc_css .= 'color:'. $desc_color .';';
if ( $desc_font_size ) $desc_css .= 'font-size:'. $desc_font_size .'px;';
if ( $desc_line_height ) $desc_css .= 'line-height:'. $desc_line_height .'px;';
if ( $desc_top_margin ) $desc_css .= 'margin-top:'. $desc_top_margin .'px;';
if ( $desc_bottom_margin ) $desc_css .= 'margin-bottom:'. $desc_bottom_margin .'px;';
if ( $desc_font_family != 'Default' ) {
	wprt_enqueue_google_font( $desc_font_family );
	$desc_css .= 'font-family:'. $desc_font_family .';';
}

if ( $button_font_weight != 'Default' ) $button_css .= 'font-weight:'. $button_font_weight .';';
if ( $link_color ) $button_css .= 'color:'. $link_color .';';
if ( $button_font_size ) $button_css .= 'font-size:'. $button_font_size .'px;';
if ( $button_rounded ) $button_css .= 'border-radius:'. $button_rounded .'px;';
if ( $button_line_height ) $button_css .= 'line-height:'. $button_line_height .'px;';
if ( $button_padding ) $button_css .= 'padding:'. $button_padding .';';
if ( $button_font_family != 'Default' ) {
	wprt_enqueue_google_font( $button_font_family );
	$button_css .= 'font-family:'. $button_font_family .';';
}

if ( $icon_display == 'icon-font' ) {
	$icon = wprt_get_icon_class( $atts, 'icon' );
	if ( $icon && $icon_type != '' ) {
		vc_icon_element_fonts_enqueue( $icon_type );

		if ( $icon_color ) $icon_css .= 'color:'. $icon_color .';';
		if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px;';
		if ( $icon_showcase == 'accent-outline'
			|| $icon_showcase == 'dark-outline'
			|| $icon_showcase == 'grey-outline'
		) {
			$line_height = substr( $icon_width, 1 );
			$icon_css .= 'line-height:'. (intval( $line_height ) - 4) .'px;';
		}

		$icon_html = sprintf(
			'<div class="icon-wrap" style="%2$s">
				<i class="%1$s"></i>
			</div>',
			$icon,
			$icon_css
		);
	}
} else {
	if ( $image_width )
		$image_css = 'width:'. $image_width .'px;';

	if ( $image )
		$icon_html = sprintf(
			'<div class="image-wrap" style="%2$s">
				<img alt="image" src="%1$s">
			</div>',
			wp_get_attachment_image_src( $image, 'full' )[0],
			$image_css
		);
}

$new_tab = $new_tab == 'yes' ? '_blank' : '_self'; 
		
if ( $heading ) $content_html .= sprintf(
	'<%5$s class="heading" style="%2$s">
		<a target="%4$s" href="%3$s">
			<span>%1$s</span>
		</a>
	</%5$s>',
	$heading,
	esc_attr( $heading_css ),
    esc_attr( $link_url ),
    $new_tab,
	$tag
);

if ( $description ) $content_html .= sprintf(
	'<p class="desc" style="%2$s">
		<span>%1$s</span>
	</p>',
	$description,
	esc_attr( $desc_css )
);

$button_cls = $button_size;
if ( $show_button && $button_text && $link_url ) {
	if ( $button_style == 'simple_link' ) $button_cls .= ' simple-link font-heading';
	if ( $button_style == 'accent' ) $button_cls .= ' wprt-button accent small';
	if ( $button_style == 'dark' ) $button_cls .= ' wprt-button small dark';
	if ( $button_style == 'light' ) $button_cls .= ' wprt-button small light';
	if ( $button_style == 'very-light' ) $button_cls .= ' wprt-button small very-light';
	if ( $button_style == 'white' ) $button_cls .= ' wprt-button small white';
	if ( $button_style == 'outline' ) $button_cls .= ' wprt-button small outline ol-accent';
	if ( $button_style == 'outline_dark' ) $button_cls .= ' wprt-button small outline dark';
	if ( $button_style == 'outline_light' ) $button_cls .= ' wprt-button small outline light';
	if ( $button_style == 'outline_very-light' ) $button_cls .= ' wprt-button small outline very-light';
	if ( $button_style == 'outline_white' ) $button_cls .= '  wprt-button small outline white';

	$content_html .= sprintf(
		'<div class="btn" style="%7$s">
			<span style="%5$s"><a target="%6$s" class="%3$s" href="%2$s" style="%4$s">%1$s</a></span>
		</div>',
		esc_html( $button_text ),
		esc_attr( $link_url ),
		$button_cls,
		$button_css,
		$content_css,
		$new_tab,
		$button_wrap_css
	);
}

printf( '<div class="wprt-icon-box clearfix %1$s">%2$s %3$s</div>',
	esc_attr( $cls ),
	$icon_html,
	$content_html
);
