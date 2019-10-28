<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
	'image' => '',
	'image_crop' => 'full',
	'video_url' => '',
	'icon_size' => 'w50',
	'link_url' => '',
	'new_tab' => 'yes',
	'tag' => 'h3',
	'heading' => 'Heading Text',
	'heading_color' => '#ffffff',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
), $atts ) );

wp_enqueue_script( 'wprt-magnificpopup' );

$heading_font_size = intval( $heading_font_size );

$cls = $icon_cls = $image_html = $heading_html = $heading_css  = '';

if ( $image ) {
    $img_size = 'full';
    if ( $image_crop == 'square' ) $img_size = 'wprt-square';
    if ( $image_crop == 'rectangle' ) $img_size = 'wprt-rectangle';
    if ( $image_crop == 'rectangle2' ) $img_size = 'wprt-rectangle2';

	$image_html = sprintf(
		'<img alt="image" src="%1$s" />',
		wp_get_attachment_image_src( $image, $img_size )[0]
	);
} else { return; }

if ( $heading_font_weight != 'Default' ) $heading_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_color ) $heading_css .= 'color:'. $heading_color .';';
if ( $heading_font_size ) $heading_css .= 'font-size:'. $heading_font_size .'px;';
if ( $heading_font_family != 'Default' ) {
    wprt_enqueue_google_font( $heading_font_family );
    $heading_css .= 'font-family:'. $heading_font_family .';';
}

if ( $style == 'style-1' ) {
	printf(
		'<div class="wprt-image-video %3$s">
			%1$s
			<a class="icon-wrap popup-video" href="%2$s"></a>
		</div>',
		$image_html,
		$video_url,
		$icon_size
	);
} else if ( $style == 'style-2' ) {
	$new_tab = $new_tab == 'yes' ? '_blank' : '_self';
	$heading_html = sprintf( '<%1$s class="heading" style="%3$s">%2$s</%1$s>', $tag, esc_html( $heading ), $heading_css );

	if ( $link_url )
		$heading_html = sprintf(
			'<%1$s class="heading"><a target="%3$s" href="%2$s" style="%5$s">
				%4$s
			</a></%1$s>',
			$tag,
			$link_url,
			$new_tab,
			esc_html( $heading ),
			$heading_css
		);

	printf(
		'<div class="wprt-image-heading">
			%1$s %2$s
		</div>',
		$image_html,
		$heading_html
	);
}

