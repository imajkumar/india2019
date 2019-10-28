<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'alignment' => '',
    'image'    => '',
    'image_crop' => 'rectangle',
    'content_padding' => '',
    'background_color' => '#f7f7f7',
    'box_shadow' => '',
    'tag' => 'h3',
    'heading' => 'Heading Text',
    'heading_color' => '',
    'separator' => '',
    'line_full' => 'no',
    'line_width' => '50',
    'line_height' => '2',
    'line_color' => '#eee',
    'description' => '',
    'desc_color' => '',
    'button_text' => 'READ MORE',
    'button_style' => 'accent',
    'button_size' => 'small',
    'button_rounded' => '',
    'link_color' => '',
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
    'heading_top_margin' => '',
    'heading_bottom_margin' => '',
    'desc_top_margin' => '',
    'desc_bottom_margin' => '',
    'sep_top_margin' => '',
    'sep_bottom_margin' => '',
    'link_url' => '',
    'new_tab' => 'yes',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$line_height = intval( $line_height );
$heading_line_height = intval( $heading_line_height );
$desc_line_height = intval( $desc_line_height );
$button_line_height = intval( $button_line_height );
$heading_font_size = intval( $heading_font_size );
$desc_font_size = intval( $desc_font_size );
$button_font_size = intval( $button_font_size );
$button_rounded = intval( $button_rounded );
$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$sep_top_margin = intval( $sep_top_margin );
$sep_bottom_margin = intval( $sep_bottom_margin );
$desc_top_margin = intval( $desc_top_margin );
$desc_bottom_margin = intval( $desc_bottom_margin );

$css = $image_css = $heading_css = $sep_css = $desc_css = $button_cls = $button_css = $inner_css = $thumb_css = $content_css = '';
$image_html = $heading_html = $sep_html = $desc_html = $button_html = '';

$cls = $alignment;
if ( $box_shadow ) $cls .= ' has-shadow'; 

if ( $background_color ) $inner_css .= 'background-color: '. $background_color .';';
if ( $content_padding ) $content_css .= 'padding:'. $content_padding .';';

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
if ( $button_font_family != 'Default' ) {
    wprt_enqueue_google_font( $button_font_family );
    $button_css .= 'font-family:'. $button_font_family .';';
}

if ( $image ) {
    $img_size = 'wprt-rectangle';
    if ( $image_crop == 'square' ) $img_size = 'wprt-square';
    if ( $image_crop == 'rectangle2' ) $img_size = 'wprt-rectangle2';
    if ( $image_crop == 'auto1' ) $img_size = 'wprt-medium-auto';
    if ( $image_crop == 'auto2' ) $img_size = 'wprt-small-auto';
    if ( $image_crop == 'auto3' ) $img_size = 'wprt-xsmall-auto';

    $image_html .= sprintf(
        '<div class="thumb" style="%2$s">%1$s</div>',
         wp_get_attachment_image( $image, $img_size ), $thumb_css
    );
}

$new_tab = $new_tab == 'yes' ? '_blank' : '_self'; 

if ( $heading )
    $heading_html .= sprintf(
    '<%5$s class="title" style="%2$s">
        <a target="%4$s" href="%3$s">%1$s</a>
    </%5$s>',
    esc_html( $heading ),
    $heading_css,
    esc_attr( $link_url ),
    $new_tab,
    $tag
);

if ($separator == 'line' ) {
    if ( $line_full == 'yes' ) {
        $sep_css = 'width:100%;';
    } else {
        $line_width = intval( $line_width );
        if ( $line_width ) $sep_css = 'width:'. $line_width .'px;';
    }

    if ( $alignment == 'text-center' ) $sep_css .= 'margin: 0 auto;';

    if ( $line_height ) $sep_css .= 'height:'. $line_height .'px;';
    if ( $line_color ) $sep_css .= 'background-color:'. $line_color .';';
    if ( $sep_top_margin ) $sep_css .= 'margin-top:'. $sep_top_margin .'px;';
    if ( $sep_bottom_margin ) $sep_css .= 'margin-bottom:'. $sep_bottom_margin .'px;';
    
    $sep_html .= sprintf( '<div class="clearfix"></div><div class="sep" style="%1$s"></div>', $sep_css );
}

if ( $description )
    $desc_html .= sprintf(
    '<div class="desc" style="%2$s">%1$s</div>',
    $description, $desc_css
);

if ( $button_text ) {
    $button_cls = $button_size;
    if ( $button_style == 'simple_link' ) $button_cls .= ' simple-link font-heading';
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

    $button_html .= sprintf(
        '<div class="btn">
            <a target="%4$s" class="%3$s" href="%2$s" style="%5$s">%1$s</a>
        </div>',
        esc_html( $button_text ),
        esc_attr( $link_url ),
        $button_cls,
        $new_tab,
        $button_css
    );
}

printf(
    '<div class="wprt-image-box clearfix %7$s" style="%8$s">
        <div class="item">
            <div class="inner" style="%5$s">
                %1$s
                <div class="text-wrap" style="%6$s">
                    %2$s %9$s %3$s %4$s
                </div>
            </div>
        </div>
    </div>', 
    $image_html,
    $heading_html,
    $desc_html,
    $button_html,
    $inner_css,
    $content_css,
    $cls,
    $css,
    $sep_html
);