<?php
/**
 * Entry Content / Title
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get post title
if ( ! ( $title = get_the_title() ) )
	return;

$html = '<h2 class="post-title"><a href="%2$s" rel="bookmark">%1$s</a></h2>';

if ( is_single() ) {
	if ( wprt_get_mod( 'blog_single_title', true ) ) {
		$html = '<h1 class="post-title">%1$s</h1>';
	} else { $html = ''; }
}

printf( $html, $title, esc_url( get_permalink() ) );