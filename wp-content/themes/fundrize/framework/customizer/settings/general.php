<?php
/**
 * General setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['wprt_accent_colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#f57223',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'fundrize' ),
				'type' => 'color',
			),
		),
	)
);

// Favicon
$this->sections['wprt_favicon'] = array(
	'title' => esc_html__( 'Favicon', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'favicon',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Site Icon', 'fundrize' ),
				'type' => 'image',
				'description' => esc_html__( 'The Site Icon is used as a browser and app icon for your site. Icons must be square, and at least 512 pixels wide and tall.', 'fundrize' ),
			),
		),
	)
);

// PreLoader
$this->sections['wprt_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','fundrize' ),
					'' => esc_html__( 'Disable','fundrize' )
				),
			),
		),
	)
);

// Header Site
$this->sections['wprt_header_site'] = array(
	'title' => esc_html__( 'Header Site', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Style 1','fundrize' ),
					'style-2' => esc_html__( 'Style 2','fundrize' ),
					'style-3' => esc_html__( 'Style 3','fundrize' ),
					'style-4' => esc_html__( 'Style 4','fundrize' ),
				),
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'fundrize' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'fundrize' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'header_fixed_opacity',
			'transport' => 'postMessage',
			'default' => '1',
			'control' => array(
				'label'  => esc_html__( 'Opacity', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_fixed',
				'type' => 'select',
				'choices' => array(
					'1' => esc_html__( '1', 'fundrize' ),
					'0.9' => esc_html__( '0.9', 'fundrize' ),
					'0.8' => esc_html__( '0.8', 'fundrize' ),
					'0.7' => esc_html__( '0.7', 'fundrize' ),
					'0.6' => esc_html__( '0.6', 'fundrize' ),
					'0.5' => esc_html__( '0.5', 'fundrize' ),
					'0.4' => esc_html__( '0.4', 'fundrize' ),
					'0.3' => esc_html__( '0.3', 'fundrize' ),
					'0.2' => esc_html__( '0.2', 'fundrize' ),
					'0.1' => esc_html__( '0.1', 'fundrize' ),
				),
			),
			'inline_css' => array(
				'target' => '.header-style-1 #site-header.is-fixed, .header-style-2 #site-header.is-fixed, .header-style-3 .site-navigation-wrap.is-fixed, .header-style-4 .site-navigation-wrap.is-fixed',
				'alter' => 'opacity',
			),
		),
	),
);

// Menu Extra Icons
$this->sections['wprt_menu_search_icon'] = array(
	'title' => esc_html__( 'Menu Extra Icons', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		// Search Icon
		array(
			'id' => 'header_search_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Menu: Search Icon', 'fundrize' ),
				'type' => 'checkbox',
			),
		),
		// Cart Icon
		array(
			'id' => 'header_cart_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Menu: Cart Icon', 'fundrize' ),
				'type' => 'checkbox',
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
	)
);

// Scroll to top
$this->sections['wprt_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'fundrize' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'scroll_top_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Width', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 30px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'scroll_top_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Height', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 30px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top',
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'scroll_top_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:after',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'scroll_top_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:before',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'scroll_top_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Rounded', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 50%. 0px is square.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top:before',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'scroll_top_icon_size',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Icon Size', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
				'description' => esc_html__( 'Example: 16px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#scroll-top:after',
				'alter' => 'font-size',
			),
		),
		array(
			'id' => 'scroll_top_background_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color: Hover', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:hover:before',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'scroll_top_icon_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color: Hover', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_scroll_top',
			),
			'inline_css' => array(
				'target' => '#scroll-top:hover:after',
				'alter' => 'color',
			),
		),
	),
);

// Forms
$this->sections['wprt_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'fundrize' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 20px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['wprt_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'fundrize' ),
	'panel' => 'wprt_general',
	'settings' => array(
		// Mobile Button
		array(
			'id' => 'heading_mobile_button',
			'control' => array(
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Mobile Button', 'fundrize' ),
			),
		),
		array(
			'id' => 'mobile_button_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Mobile Button Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.mobile-button:before, .mobile-button:after, .mobile-button span',
				'alter' => 'background-color'
			),
		),
		// Mobile Header
		array(
			'id' => 'heading_mobile_header',
			'control' => array(
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Mobile Header', 'fundrize' ),
			),
		),
		array(
			'id' => 'mobile_header_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 0px.', 'fundrize' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 959px)',
				'target' => array(
					'#site-header #site-header-inner'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'mobile_header_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 0px.', 'fundrize' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 959px)',
				'target' => array(
					'#site-header #site-header-inner'
				),
				'alter' => 'padding-bottom',
			),
		),
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Mobile Logo', 'fundrize' ),
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'fundrize' ),
				'description' => esc_html__( 'Default: 200px.', 'fundrize' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 959px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Mobile Menu', 'fundrize' ),
			),
		),
		array(
			'id' => 'mobile_menu_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul > li > a',
				'alter' => 'color'
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'fundrize' ),
				'description' => esc_html__( 'Example: 40px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Item Background', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul li',
				'alter' => 'background-color'
			),
		),
		array(
			'id' => 'mobile_menu_border',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Item Border', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul li',
				'alter' => 'border-color'
			),
		),
	)
);