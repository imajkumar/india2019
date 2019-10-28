<?php
/* Headers
-------------------------------------------------------------- */
function wprt_cac_has_header_one() {
	$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');

	if ( 'style-1' == $header_style ) { return true;
	} else { return false; }
}

function wprt_cac_has_header_two() {
	$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');

	if ( 'style-2' == $header_style ) { return true;
	} else { return false; }
}

function wprt_cac_has_header_three() {
	$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');

	if ( 'style-3' == $header_style ) { return true;
	} else { return false; }
}

function wprt_cac_has_header_four() {
	$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');

	if ( 'style-4' == $header_style ) { return true;
	} else { return false; }
}

function wprt_cac_has_header_one_and_three() {
	$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');

	if ( 'style-1' == $header_style || 'style-3' == $header_style ) { return true;
	} else { return false; }
}

function wprt_cac_has_header_two_and_four() {
	$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');

	if ( 'style-2' == $header_style || 'style-4' == $header_style ) { return true;
	} else { return false; }
}

function wprt_cac_header_has_aside() {
	$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && wprt_metabox('header_style') )
		$header_style = wprt_metabox('header_style');

	if ( 'style-3' == $header_style || 'style-4' == $header_style ) { return true;
	} else { return false; }
}

function wprt_cac_header_has_aside_button() {
	if ( wprt_cac_header_has_aside() && get_theme_mod( 'header_aside_button' ) ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_header_search_icon() {
	return get_theme_mod( 'header_search_icon', true );
}

function wprt_cac_header_cart_icon() {
	if ( class_exists( 'woocommerce' ) && get_theme_mod( 'header_cart_icon', true ) ) {
		return true;	
	} else {
		return false;
	}
}

function wprt_cac_has_header_fixed() {
	return get_theme_mod( 'header_fixed', true );
}

/* Logo
-------------------------------------------------------------- */
function wprt_cac_has_custom_logo() {
	if ( wprt_cac_has_header_one_and_three() && get_theme_mod( 'custom_logo' ) ) { return true;
	} else { return false; }
}

function wprt_cac_has_custom_logotwo() {
	if ( wprt_cac_has_header_two_and_four() && get_theme_mod( 'custom_logotwo' ) ) { return true;
	} else { return false; }
}

/* WooCommerce
-------------------------------------------------------------- */
function wprt_cac_has_woo() {
	if ( class_exists( 'woocommerce' ) ) { return true;	}
	else { return false; }
}

/* Scroll Top Button
-------------------------------------------------------------- */
function wprt_cac_has_scroll_top() {
	return get_theme_mod( 'scroll_top', true );
}

/* Sidebar Widget
-------------------------------------------------------------- */
function wprt_cac_hasnt_title_widget_search_three() {
	$style = get_theme_mod( 'sidebar_widget_search_style' );
	if ( 'style-3' != $style ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_title_widget_twitter_one() {
	$style = get_theme_mod( 'sidebar_widget_twitter_style' );
	if ( 'style-1' == $style ) {
		return true;
	} else {
		return false;
	}
}

/* Layout
-------------------------------------------------------------- */
function wprt_cac_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'site_layout_style', 'full-width' ) ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		return true;
	} else {
		return get_theme_mod( 'breadcrumbs', true );
	}
}

/* Featured Title
-------------------------------------------------------------- */
function wprt_cac_has_featured_title() {
	return get_theme_mod( 'featured_title', true );
}

function wprt_cac_has_featured_title_breadcrumbs() {
	if ( wprt_cac_has_featured_title() && get_theme_mod( 'featured_title_breadcrumbs' ) ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_featured_title_bcrums_center1() {
	if ( wprt_cac_has_featured_title_breadcrumbs()
		&& 'heading_breadcrumbs_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_featured_title_bcrums_center2() {
	if ( wprt_cac_has_featured_title_breadcrumbs()
		&& 'breadcrumbs_heading_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_featured_title_heading() {
	if ( wprt_cac_has_featured_title() && get_theme_mod( 'featured_title_heading' ) ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_featured_title_heading_center1() {
	if ( wprt_cac_has_featured_title_heading()
		&& 'heading_breadcrumbs_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_featured_title_heading_center2() {
	if ( wprt_cac_has_featured_title_heading()
		&& 'breadcrumbs_heading_centered' == get_theme_mod( 'featured_title_style' ) ) {
		return true;
	} else {
		return false;
	}
}

// Gallery Single Page
function wprt_cac_has_single_gallery() {
	if ( is_singular('gallery') ) {
		return true;
	} else {
		return false;
	}
}

function wprt_cac_has_related_gallery() {
	if ( wprt_get_mod( 'gallery_related', true ) && wprt_cac_has_single_gallery() ) {
		return true;
	};
}

/* Footer
-------------------------------------------------------------- */
function wprt_cac_has_footer_widgets() {
	return get_theme_mod( 'footer_widgets', true );
}

/* Bottom Bar
-------------------------------------------------------------- */
function wprt_cac_has_bottombar() {
	return get_theme_mod( 'bottom_bar', true );
}