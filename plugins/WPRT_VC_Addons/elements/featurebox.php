<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'wrap_background' => '#f8f8f8',
	'wrap_padding' => '30px',
	'image' => '',
	'image_crop' => 'rectangle2',
	'image_width' => '',
	'image_right_margin' => '30px',
    'heading' => 'Heading Text',
    'heading_color' => '',
    'content_color' => '',
	'separator' => '',
	'line_full' => 'no',
	'line_width' => '50',
	'line_height' => '2',
	'line_color' => '#ffb500',
	'tag' => 'h3',
    'button_text' => 'READ MORE',
    'button_style' => 'accent',
    'button_size' => 'small',
    'link_style' => 'style-1',
    'button_rounded' => '',
    'button_url' => '',
    'new_tab' => 'yes',
    'show_icon' => '',
    'icon_type' => '',
    'icon' => '',
    'icon_font_size' => '',
    'icon_left_padding' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_font_size' => '',
	'heading_line_height' => '',
	'heading_top_margin' => '',
	'heading_bottom_margin' => '',
	'sep_top_margin' => '',
	'sep_bottom_margin' => '',
	'button_top_margin' => '',
	'button_bottom_margin' => ''
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$wrap_padding = intval( $wrap_padding );
$image_width = intval( $image_width );
$image_right_margin = intval( $image_right_margin );
$line_height = intval( $line_height );

$icon_font_size = intval( $icon_font_size );
$icon_left_padding = intval( $icon_left_padding );

$heading_font_size = intval( $heading_font_size );
$heading_line_height = intval( $heading_line_height );

$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$sep_top_margin = intval( $sep_top_margin );
$sep_bottom_margin = intval( $sep_bottom_margin );
$button_top_margin = intval( $button_top_margin );
$button_bottom_margin = intval( $button_bottom_margin );
$button_rounded = intval( $button_rounded );

$cls = $button_cls = $inner_css = $thumb_css = $heading_css = $sep_css = $content_css = $button_wrap_css = $button_css = $icon_css = '';
$image_html = $heading_html = $sep_html = $content_html = $button_html = $icon_html = '';

if ( $wrap_padding ) $inner_css .= 'padding:'. $wrap_padding .'px;';
if ( $wrap_background ) $inner_css .= 'background-color:'. $wrap_background .';';
if ( $content_color ) $content_css .= 'color:'. $content_color .';';

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

if ( $image ) {
    $img_size = 'wprt-rectangle2';
    if ( $image_crop == 'square' ) $img_size = 'wprt-square';
    if ( $image_crop == 'rectangle' ) $img_size = 'wprt-rectangle';
    if ( $image_crop == 'auto1' ) $img_size = 'wprt-medium-auto';
    if ( $image_crop == 'auto2' ) $img_size = 'wprt-small-auto';
    if ( $image_crop == 'auto3' ) $img_size = 'wprt-xsmall-auto';
    if ( $image_crop == 'full' ) $img_size = 'full';

	if ( $image_width ) $thumb_css .= 'width:'. $image_width .'px;max-width:'. $image_width .'px;';
	if ( $image_right_margin ) $thumb_css .= 'margin-right:'. $image_right_margin .'px;';

    $image_html .= sprintf(
        '<div class="thumb" style="%2$s">%1$s</div>',
         wp_get_attachment_image( $image, $img_size ), $thumb_css
    );
}

if ( $heading ) $heading_html .= sprintf(
	'<%3$s class="heading" style="%2$s"> %1$s </%3$s>',
	$heading,
	$heading_css,
	$tag
);

if ($separator == 'line' ) {
	if ( $line_full == 'yes' ) {
		$sep_css = 'width:100%;';
	} else {
		$line_width = intval( $line_width );
		if ( $line_width ) $sep_css = 'width:'. $line_width .'px;';
	}

	if ( $line_height ) $sep_css .= 'height:'. $line_height .'px;';
	if ( $line_color ) $sep_css .= 'background-color:'. $line_color .';';
	if ( $sep_top_margin ) $sep_css .= 'margin-top:'. $sep_top_margin .'px;';
	if ( $sep_bottom_margin ) $sep_css .= 'margin-bottom:'. $sep_bottom_margin .'px;';
	
	$sep_html .= sprintf( '<div class="clearfix"></div><div class="sep" style="%1$s"></div>', $sep_css );
}

if ( $content )
	$content_html .= sprintf(
	'<div class="content-inner">%1$s</div>',
	$content
);

$new_tab = $new_tab == 'yes' ? '_blank' : '_self'; 

if ( $button_text ) {
    $button_cls = $button_size;
    if ( $button_style == 'simple_link' ) $button_cls .= ' simple-link font-heading '. $link_style;
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
            vc_icon_element_fonts_enqueue( $icon_type );

            if ( $icon_font_size ) $icon_css .= 'font-size:'. $icon_font_size .'px;';
            if ( $icon_left_padding ) $icon_css .= 'padding-left:'. $icon_left_padding .'px;';

            $icon_html = sprintf('<span class="icon" style="%2$s"><i class="%1$s"></i></span>', $icon, $icon_css );
        }
    }

    if ( $button_top_margin ) $button_wrap_css .= 'margin-top:'. $button_top_margin .'px;';
	if ( $button_bottom_margin ) $button_wrap_css .= 'margin-bottom:'. $button_bottom_margin .'px;';
	if ( $button_rounded ) $button_css .= 'border-radius:'. $button_rounded .'px;';

    $button_html .= sprintf(
        '<div class="btn" style="%6$s">
            <a target="%4$s" class="%3$s" href="%2$s" style="%7$s">%1$s %5$s</a>
        </div>',
        esc_html( $button_text ),
        esc_attr( $button_url ),
        $button_cls,
        $new_tab,
        $icon_html,
        $button_wrap_css,
        $button_css
    );
}

printf(
	'<div class="wprt-feature-box clearfix %1$s">
		<div class="inner clearfix" style="%2$s">
			%4$s
			<div class="content-wrap" style="%3$s">
			%5$s %6$s %7$s %8$s
			</div>
		</div>
	</div>',
	$cls,
	$inner_css,
	$content_css,
	$image_html,
	$heading_html,
	$sep_html,
	$content_html,
	$button_html
);