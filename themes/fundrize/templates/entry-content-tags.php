<?php
/**
 * Entry Content / Tags
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! wprt_get_mod( 'blog_single_tags', true ) )
	return;

the_tags( '<div class="post-tags clearfix"><span>Tags</span>','','</div>' );




