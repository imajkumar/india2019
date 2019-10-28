<?php
/**
 * Woocommerce
 *
 * @package fundrize
 * @version 3.6.8
 */

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Removes the "shop" title on the main shop page
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Remove Heading Text Tab
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

// Change gravatar size
add_filter( 'woocommerce_review_gravatar_size', 'wprt_woocommerce_gravatar_size', 10 );
function wprt_woocommerce_gravatar_size() { return 100; }

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Fix html on item product 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'wprt_before_shop_loop_item' );
add_action( 'wprt_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'wprt_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );

function wprt_before_shop_loop_item() {
	echo '<div class="product-thumbnail">';
	do_action( 'wprt_before_shop_loop_item' );
	echo '</div><div class="product-info">';
}
add_action( 'woocommerce_after_shop_loop_item', function() {
	echo '</div>';
}, 99 );

// Add short description to product item
add_filter( 'woocommerce_short_description', 'wprt_woocommerce_short_description', 10 );
function wprt_woocommerce_short_description( $post_excerpt ) {
	if ( $word = wprt_get_mod('shop_item_products_desc') ) {
	    if ( ! is_product() ) $post_excerpt = wprt_trim_words( $post_excerpt, $word );
		return '<div class="short-desc">'. $post_excerpt . '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);

// Order elements on single page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11 );

// Update the number on cart icon
add_filter( 'add_to_cart_fragments', 'wprt_cart_fragments', 100 );
function wprt_cart_fragments( $fragments ) {
	$cart_items = \WooCommerce::instance()->cart->get_cart_contents_count();
	$fragments['script#shopping-cart-items-updater'] = sprintf( '
		<script id="shopping-cart-items-updater" type="text/javascript">
			( function( $ ) {
				"use strict";

				$( document ).trigger( \'woocommerce-cart-changed\', { items_count: %d } );
			} ).call( this, jQuery );
		</script>
	', $cart_items );

	return $fragments;
}

// Output the script placeholder for cart updater
add_action( 'wp_footer', 'wprt_cart_fragments_placeholder', 100 );
function wprt_cart_fragments_placeholder() {
	echo '<script id="shopping-cart-items-updater" type="text/javascript"></script>';
}

// Display products per page
add_filter( 'loop_shop_per_page', 'wprt_products_per_page', 20 );
function wprt_products_per_page() {
	if ( ! $items = wprt_get_mod('shop_products_per_page') ) {
		return 6;
	} else {
		return $items;
	}
}

// Change columns in product loop
add_filter( 'loop_shop_columns', 'wprt_shop_loop_columns', 20 );
function wprt_shop_loop_columns() {

	if ( ! $cols = wprt_get_mod('shop_columns') ) {
		return 3;
	} else {
		if ( $cols == '2' ) return 2;
		if ( $cols == '3' ) return 3;
		if ( $cols == '4' ) return 4;
		if ( $cols == '5' ) return 5;
	}
}

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Change columns in related products output to 4
add_filter( 'woocommerce_output_related_products_args', 'wprt_related_products' );
function wprt_related_products() {
	$args = array(
		'posts_per_page' => 4,
		'columns'        => 10,
	);
	return $args;
}

// Change product thumbnails columns to 6
add_filter('woocommerce_product_thumbnails_columns','wprt_custom_storefront_gallery' );
function wprt_custom_storefront_gallery( $column ) {
	$column  = 6;
	return $column ;
}

// Register product's image sizes
add_filter( 'woocommerce_get_image_size_shop_thumbnail', 'wprt_thumbnail_image_size' );
add_filter( 'woocommerce_get_image_size_shop_catalog', 'wprt_catalog_image_size' );
add_filter( 'woocommerce_get_image_size_shop_single', 'wprt_single_image_size' );

// Return the image size for the shop thumbnail
function wprt_thumbnail_image_size( $size ) {
	$size['width'] = 170;
	$size['height'] = 170;
	$size['crop']   = true;

	return $size;
}

// Return the image size for the catalog page
function wprt_catalog_image_size( $size ) {
	$size['width']  = 367;
	$size['height'] = 269;
	$size['crop']   = true;

	return $size;
}

// Return the image size for the single product page
function wprt_single_image_size( $size ) {
	$size['width'] = 568;
	$size['height'] = 579;
	$size['crop']   = true;

	return $size;
}