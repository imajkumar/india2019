<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'alignment' => 'text-center',
    'heading' => '',
    'heading_color' => '',
    'subheading' => '',
    'subheading_color' => '',
    'subheading_width' => '',
	'separator' => '',
	'sep_position' => 'between',
	'line_width' => '50',
	'line_height' => '2',
	'line_right_margin' => '20',
	'line_color' => '',
	'image' => '',
	'image_width' => '',
	'tag' => 'h2',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
    'heading_font_size_mobile' => '',
	'heading_line_height' => '',
	'subheading_font_family' => 'Default',
	'subheading_font_weight' => 'Default',
	'subheading_font_size' => '',
	'subheading_line_height' => '',
	'subheading_font_style' => 'normal',
	'heading_top_margin' => '',
	'heading_bottom_margin' => '',
	'subheading_top_margin' => '',
	'subheading_bottom_margin' => '',
), $atts ) );

$image_width = intval( $image_width );
$subheading_width = intval( $subheading_width );
$line_width = intval( $line_width );
$line_height = intval( $line_height );
$line_right_margin = intval( $line_right_margin );

$heading_font_size = intval( $heading_font_size );
$heading_font_size_mobile = intval( $heading_font_size_mobile );
$heading_line_height = intval( $heading_line_height );
$subheading_font_size = intval( $subheading_font_size );
$subheading_line_height = intval( $subheading_line_height );

$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$subheading_top_margin = intval( $subheading_top_margin );
$subheading_bottom_margin = intval( $subheading_bottom_margin );

$cls = $alignment;
$css = $data = $heading_css = $subheading_css = '';
$subheading_css .= 'font-style:'. $subheading_font_style .';';

if ( $heading_font_weight != 'Default' ) $heading_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_color ) $heading_css .= 'color:'. $heading_color .';';
if ( $heading_line_height ) $heading_css .= 'line-height:'. $heading_line_height .'px;';
if ( $heading_top_margin ) $heading_css .= 'margin-top:'. $heading_top_margin .'px;';
if ( $heading_bottom_margin ) $heading_css .= 'margin-bottom:'. $heading_bottom_margin .'px;';
if ( $heading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $heading_font_family );
	$heading_css .= 'font-family:'. $heading_font_family .';';
}

if ( $heading_font_size ) {
	$heading_css .= 'font-size:'. $heading_font_size .'px;';
    $data .= 'data-font='. $heading_font_size;
}
if ( $heading_font_size_mobile ) $data .= ' data-mfont='. $heading_font_size_mobile;

if ( $subheading_font_weight != 'Default' ) $subheading_css .= 'font-weight:'. $subheading_font_weight .';';
if ( $subheading_color ) $subheading_css .= 'color:'. $subheading_color .';';
if ( $subheading_font_size ) $subheading_css .= 'font-size:'. $subheading_font_size .'px;';
if ( $subheading_line_height ) $subheading_css .= 'line-height:'. $subheading_line_height .'px;';
if ( $subheading_top_margin ) $subheading_css .= 'margin-top:'. $subheading_top_margin .'px;';
if ( $subheading_bottom_margin ) $subheading_css .= 'margin-bottom:'. $subheading_bottom_margin .'px;';
if ( $subheading_width ) $subheading_css .= 'max-width:'. $subheading_width .'px; margin-left: auto; margin-right: auto;';
if ( $subheading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $subheading_font_family );
	$subheading_css .= 'font-family:'. $subheading_font_family .';';
}

$html = $heading_html = $sub_html = $sep_html = '';
if ( $heading ) $heading_html .= sprintf(
	'<%3$s class="heading clearfix" style="%2$s">
		%1$s
	</%3$s>',
	$heading,
	$heading_css,
	$tag
);

if ( $subheading ) $sub_html .= sprintf(
	'<p class="sub-heading clearfix" style="%2$s">
		%1$s
	</p>',
	$subheading,
	$subheading_css
);

$line_css = $image_css = '';
if ( $separator == 'line' ) {
	if ( empty( $line_width ) ) $line_width = 50;
	if ( empty( $line_height ) ) $line_height = 2;

	$line_css .= 'width:'. $line_width .'px;height:'. $line_height .'px;';
	if ( $line_color ) $line_css .= 'background-color:'. $line_color .';';

	$sep_html .= sprintf( '<div class="sep clearfix" style="%1$s"></div>', $line_css );
}

if ( $separator == 'image' ) {
	if ( $image_width ) $image_css = 'width:'. $image_width .'px;';

	if ( $image )
	$sep_html = sprintf(
		'<div class="sep clearfix" style="%2$s">
			<img alt="image" src="%1$s">
		</div>',
		wp_get_attachment_image_src( $image, 'full' )[0],
		$image_css
	);
}

if ( $sep_position == 'between' ) {
	$html = $heading_html . $sep_html . $sub_html;
} elseif ( $sep_position == 'top' ) {
	$html = $sep_html . $heading_html . $sub_html;
} else { $html = $heading_html . $sub_html . $sep_html; }

if ( $line_right_margin && $sep_position == 'left' ) {
	$css .= 'padding-left:'. $line_right_margin .'px';
	$cls .= ' left-sep';
}

printf( '<div class="wprt-headings clearfix %2$s" %3$s style="%4$s">%1$s</div>',
	$html,
	$cls,
	$data,
	$css
);