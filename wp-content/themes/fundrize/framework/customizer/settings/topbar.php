<?php
/**
 * Top Bar setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Top Bar Light General
$this->sections['wprt_topbar_general_one_three'] = array(
	'title' => esc_html__( 'General: Light Header', 'fundrize' ),
	'panel' => 'wprt_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one_and_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #top-bar',
					'.header-style-3 #top-bar'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_text',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one_and_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #top-bar',
					'.header-style-3 #top-bar'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one_and_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #top-bar a',
					'.header-style-3 #top-bar a'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_social_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Socials: Background Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one_and_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #top-bar .top-bar-socials .icons a',
					'.header-style-3 #top-bar .top-bar-socials .icons a'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_social_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Socials: Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_one_and_three',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #top-bar .top-bar-socials .icons a',
					'.header-style-3 #top-bar .top-bar-socials .icons a'
				),
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Dark General
$this->sections['wprt_topbar_general_two_four'] = array(
	'title' => esc_html__( 'General: Dark Header', 'fundrize' ),
	'panel' => 'wprt_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_dark_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two_and_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #top-bar',
					'.header-style-4 #top-bar'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_dark_text',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two_and_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #top-bar',
					'.header-style-4 #top-bar'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_dark_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two_and_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #top-bar a',
					'.header-style-4 #top-bar a'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'top_bar_dark_social_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Socials: Background Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two_and_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #top-bar .top-bar-socials .icons a',
					'.header-style-4 #top-bar .top-bar-socials .icons a'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'top_bar_dark_social_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Socials: Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_header_two_and_four',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #top-bar .top-bar-socials .icons a',
					'.header-style-4 #top-bar .top-bar-socials .icons a'
				),
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Content
$this->sections['wprt_topbar_content'] = array(
	'title' => esc_html__( 'Content', 'fundrize' ),
	'panel' => 'wprt_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_content_welcome',
			'default' => 'Welcome to Fundrize - Charity theme',
			'control' => array(
				'label' => esc_html__( 'Welcome Text', 'fundrize' ),
				'type' => 'wprt_textarea',
				'rows' => 3,
			),
		),
		array(
			'id' => 'top_bar_content_time',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Working Time', 'fundrize' ),
				'type' => 'wprt_textarea',
				'rows' => 3,
			),
		),
		array(
			'id' => 'top_bar_content_phone',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Phone', 'fundrize' ),
				'type' => 'wprt_textarea',
				'rows' => 3,
			),
		),
		array(
			'id' => 'top_bar_content_address',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Address', 'fundrize' ),
				'type' => 'wprt_textarea',
				'rows' => 3,
			),
		),
	),
);

// Top Bar Socials
$this->sections['wprt_topbar_social'] = array(
	'title' => esc_html__( 'Social', 'fundrize' ),
	'panel' => 'wprt_topbar',
	'settings' => array(
		array(
			'id' => 'top_bar_social_text',
			'control' => array(
				'label' => esc_html__( 'Text', 'fundrize' ),
				'type' => 'textarea',
			),
		),
		array(
			'id' => 'top_bar_social_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Width', 'fundrize' ),
				'description' => esc_html__( 'Example: 30px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#top-bar .top-bar-socials .icons a',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'top_bar_social_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Height', 'fundrize' ),
				'description' => esc_html__( 'Example: 30px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#top-bar .top-bar-socials .icons a',
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'top_bar_social_space_between',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Space Between Items', 'fundrize' ),
				'description' => esc_html__( 'Example: 10px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#top-bar .top-bar-socials .icons a',
				'alter' => 'margin-left',
			),
		),
		array(
			'id' => 'top_bar_social_font_size',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Icon Size', 'fundrize' ),
				'description' => esc_html__( 'Example: 20px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#top-bar .top-bar-socials .icons a',
				'alter' => 'font-size',
			),
		),
	),
);

// Social settings
$social_options = wprt_topbar_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['wprt_topbar_social']['settings'][] = array(
		'id' => 'top_bar_social_profiles[' . $key .']',
		'control' => array(
			'label' => $val['label'],
			'type' => 'text',
		),
	);
}

// Remove var from memory
unset( $social_options );