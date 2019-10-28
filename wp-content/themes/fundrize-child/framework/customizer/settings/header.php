<?php
/**
 * Header-1 setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header 1,2 General
$this->sections['wprt_header_general'] = array(
	'title' => esc_html__( 'General', 'fundrize' ),
	'panel' => 'wprt_header',
	'settings' => array(
		// Header 1
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one',
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header-inner'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'header_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header-inner'
				),
				'alter' => 'padding-bottom',
			),
		),
		// Header 2
		array(
			'id' => 'headertwo_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two',
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'headertwo_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header-inner'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'headertwo_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header-inner'
				),
				'alter' => 'padding-bottom',
			),
		),
	)
);

// Header 3,4 General
$this->sections['wprt_header_aside_general'] = array(
	'title' => esc_html__( 'General', 'fundrize' ),
	'panel' => 'wprt_header',
	'settings' => array(
		// Header 3
		array(
			'id' => 'headerthree_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Header Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #site-header'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'headerthree_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #site-header-inner'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'headerthree_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #site-header-inner'
				),
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'menuwrapthree_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Menu Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #site-header .site-navigation-wrap'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'menuthree_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #site-header .site-navigation-wrap #main-nav > ul > li > a',
					'.header-style-3 #site-header .site-navigation-wrap .header-search-icon',
					'.header-style-3 #site-header .site-navigation-wrap .nav-cart-trigger'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menuthree_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-3 #site-header .site-navigation-wrap #main-nav > ul > li > a:hover',
					'.header-style-3 #site-header .site-navigation-wrap .header-search-icon:hover',
				),
				'alter' => 'color',
			),
		),
		// Header 4
		array(
			'id' => 'headerfour_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Header Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-4 #site-header'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'headerfour_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-4 #site-header-inner'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'headerfour_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-4 #site-header-inner'
				),
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'menuwrapfour_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Menu Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-4 #site-header .site-navigation-wrap'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'menufour_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-4 #site-header .site-navigation-wrap #main-nav > ul > li > a',
					'.header-style-4 #site-header .site-navigation-wrap .header-search-icon',
					'.header-style-4 #site-header .site-navigation-wrap .nav-cart-trigger'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menufour_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-4 #site-header .site-navigation-wrap #main-nav > ul > li > a:hover',
					'.header-style-4 #site-header .site-navigation-wrap .header-search-icon:hover',
				),
				'alter' => 'color',
			),
		),
	)
);

// Header Logo
$this->sections['wprt_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'fundrize' ),
	'panel' => 'wprt_header',
	'settings' => array(
		// Logo 1
		array(
			'id' => 'logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Logo Margin', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px 0px 0px 0px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one_and_three',
			),
			'inline_css' => array(
				'target' => '.header-style-1 #site-logo-inner, .header-style-3 #site-logo-inner',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'fundrize' ),
				'type' => 'image',
				'active_callback' => 'wprt_cac_has_header_one_and_three',
			),
		),
		array(
			'id' => 'logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'fundrize' ),
				'description' => esc_html__( 'This should be exactly the same as the width of the logo.', 'fundrize' ),
				'type' => 'text',
				'active_callback' => 'wprt_cac_has_custom_logo',
			),
		),
		array(
			'id' => 'logo_height',
			'control' => array(
				'label' => esc_html__( 'Logo Height', 'fundrize' ),
				'type' => 'text',
				'description' => esc_html__( 'This should be exactly the same as the height of the logo.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_custom_logo',
			),
		),
		array(
			'id' => 'retina_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Retina Logo Image', 'fundrize' ),
				'type' => 'image',
				'description' => esc_html__('2x times your logo dimension.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_custom_logo',
			),
		),
		// Logo 2
		array(
			'id' => 'logotwo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Logo Margin', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px 0px 0px 0px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two_and_four',
			),
			'inline_css' => array(
				'target' => '.header-style-2 #site-logo-inner, .header-style-4 #site-logo-inner',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'custom_logotwo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'fundrize' ),
				'type' => 'image',
				'active_callback' => 'wprt_cac_has_header_two_and_four',
			),
		),
		array(
			'id' => 'logotwo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'fundrize' ),
				'description' => esc_html__( 'This should be exactly the same as the width of the logo.', 'fundrize' ),
				'type' => 'text',
				'active_callback' => 'wprt_cac_has_custom_logotwo',
			),
		),
		array(
			'id' => 'logotwo_height',
			'control' => array(
				'label' => esc_html__( 'Logo Height', 'fundrize' ),
				'type' => 'text',
				'description' => esc_html__( 'This should be exactly the same as the height of the logo.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_custom_logotwo',
			),
		),
		array(
			'id' => 'retina_logotwo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Retina Logo Image', 'fundrize' ),
				'type' => 'image',
				'description' => esc_html__('2x times your logo dimension.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_custom_logotwo',
			),
		),
	)
);

// Header 1,2 Menu
$this->sections['wprt_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'fundrize' ),
	'panel' => 'wprt_header',
	'settings' => array(
		// Header 1
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header #main-nav > ul > li > a',
					'.header-style-1 #site-header .header-search-icon',
					'.header-style-1 #site-header .nav-top-cart-wrapper .nav-cart-trigger'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header #main-nav > ul > li > a:hover',
					'.header-style-1 #site-header .header-search-icon:hover',
				),
				'alter' => 'color',
			),
		),
		// Header 2
		array(
			'id' => 'menutwo_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header #main-nav > ul > li > a',
					'.header-style-2 #site-header .header-search-icon',
					'.header-style-2 #site-header .nav-top-cart-wrapper .nav-cart-trigger'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menutwo_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header #main-nav > ul > li > a:hover',
					'.header-style-2 #site-header .header-search-icon:hover',
				),
				'alter' => 'color',
			),
		),
	)
);

// Information
$this->sections['wprt_header_information'] = array(
	'title' => esc_html__( 'Information', 'fundrize' ),
	'panel' => 'wprt_header',
	'settings' => array(
		array(
			'id' => 'header_aside_info_one',
			'default' => '<span class="title">CALL NOW</span><br /><span class="subtitle">8 (800) 250-260-04</span>',
			'control' => array(
				'label' => esc_html__( 'Info 1', 'fundrize' ),
				'type' => 'wprt_textarea',
				'rows' => 5,
				'active_callback' => 'wprt_cac_header_has_aside',
			),
		),
		array(
			'id' => 'header_aside_info_two',
			'default' => '<span class="title">EMAIL US</span><br /><span class="subtitle">hello@ninzio.com</span>',
			'control' => array(
				'label' => esc_html__( 'Info 2', 'fundrize' ),
				'type' => 'wprt_textarea',
				'rows' => 5,
				'active_callback' => 'wprt_cac_header_has_aside',
			),
		),
		array(
			'id' => 'header_aside_info_one_right_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Info 1: Right Margin', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_header_has_aside',
			),
			'inline_css' => array(
				'target' => '#site-header .wprt-info .inner > div.info-one',
				'alter' => 'margin-right',
			),
		),
		array(
			'id' => 'header_aside_info_two_right_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Info 2: Right Margin', 'fundrize' ),
				'description' => esc_html__( 'Example: 50px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_header_has_aside',
			),
			'inline_css' => array(
				'target' => '#site-header .wprt-info .inner > div.info-two',
				'alter' => 'margin-right',
			),
		),
		// Header 3
		array(
			'id' => 'headerthree_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => '.header-style-3 #site-header .wprt-info .info-i span',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'headerthree_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => '.header-style-3 #site-header .wprt-info .info-c > .title',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'headerthree_subtitle_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Subtitle Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_three',
			),
			'inline_css' => array(
				'target' => '.header-style-3 #site-header .wprt-info .info-c > .subtitle',
				'alter' => 'color',
			),
		),
		// Header 4
		array(
			'id' => 'headerfour_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Icon Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => '.header-style-4 #site-header .wprt-info .info-i span',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'headerfour_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => '.header-style-4 #site-header .wprt-info .info-c > .title',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'headerfour_subtitle_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Subtitle Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_four',
			),
			'inline_css' => array(
				'target' => '.header-style-4 #site-header .wprt-info .info-c > .subtitle',
				'alter' => 'color',
			),
		),
	)
);

// Button
$this->sections['wprt_header_button'] = array(
	'title' => esc_html__( 'Button', 'fundrize' ),
	'panel' => 'wprt_header',
	'settings' => array(
		array(
			'id' => 'header_aside_button',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'fundrize' ),
				'type' => 'checkbox',
				'active_callback' => 'wprt_cac_header_has_aside',
			),
		),
		array(
			'id' => 'header_aside_button_text',
			'default' => esc_html__( 'DONATE', 'fundrize' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'fundrize' ),
				'type' => 'text',
				'active_callback' => 'wprt_cac_header_has_aside_button',
			),
		),
		array(
			'id' => 'header_aside_button_link',
			'control' => array(
				'label' => esc_html__( 'Button Link', 'fundrize' ),
				'type' => 'text',
				'active_callback' => 'wprt_cac_header_has_aside_button',
			),
		),
		array(
			'id' => 'header_aside_button_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Button Margin', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 20px 0px 20px', 'fundrize' ),
				'active_callback' => 'wprt_cac_header_has_aside_button',
			),
			'inline_css' => array(
				'target' => '#site-header .header-aside-btn',
				'alter' => 'margin',
			),
		),
	)
);