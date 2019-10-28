<?php
/**
 * Entry Content / Media
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! wprt_get_mod( 'blog_single_media', true ) )
	return;

$html = $thumb = '';
$the_cat = get_the_category();

if ( $the_cat ) {
	$category_name = $the_cat[0]->cat_name;
	$category_link = get_category_link( $the_cat[0]->cat_ID );
}

switch ( get_post_format() ) {
	case 'gallery':
		$icon = 'post-gallery';
		$size = 'wprt-post-standard';
		$images = wprt_metabox( 'gallery_images', "type=image&size=$size" );

		if ( empty( $images ) )
			break;

		$html = '<div class="blog-gallery">';

		foreach ( $images as $image ) {
			$html .= sprintf(
				'<div><img src="%s" alt="gallery"></div>',
				esc_url( $image['url'] )
			);
		}
		$html .= '</div>';
		break;
	case 'video':
		$icon = 'post-video';
		$video = wprt_metabox( 'video_url' );
		if ( ! $video )
			break;

		if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
			// If URL: show oEmbed HTML
			if ( $oembed = @wp_oembed_get( $video ) )
				$html .= $oembed;
		} else {
			// If embed code: just display
			$html .= $video;
		}
		break;
	default:
		$icon = 'post-standard"';
		$size = 'wprt-post-standard';
		$thumb = get_the_post_thumbnail( get_the_ID(), $size );
		if ( empty( $thumb ) )
			return;

		$html .= '<a href="' . esc_url( get_permalink() ) . '">';
		$html .= $thumb;
		$html .= '</a>';
}

if ( $thumb && $category_name && $category_name != 'Uncategorized' )
	$html .= '<span class="post-cat"><a href="'. $category_link .'">'. $category_name .'</a></span>';

if ( $html )
	printf( '<div class="post-media clearfix">%1$s</div>', $html );
