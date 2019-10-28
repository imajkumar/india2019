<?php
/**
 * Layout setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['wprt_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'fundrize' ),
	'panel' => 'wprt_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','fundrize' ),
					'boxed' => esc_html__( 'Boxed','fundrize' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'fundrize' ),
				'type' => 'checkbox',
				'active_callback' => 'wprt_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'fundrize' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_border_color',
			'control' => array(
				'label' => esc_html__( 'Wrapper Border Color', 'fundrize' ),
				'type' => 'color',
				'active_callback' => 'wprt_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #page',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'fundrize' ),
				'type' => 'color',
				'active_callback' => 'wprt_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'fundrize' ),
				'type' => 'image',
				'active_callback' => 'wprt_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'inner_wrapper_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Inner Background Color', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #page',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'fundrize' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'fundrize' ),
					'cover'        => esc_html__( 'Cover', 'fundrize' ),
					'center-top'        => esc_html__( 'Center Top', 'fundrize' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'fundrize' ),
					'fixed'        => esc_html__( 'Fixed Center', 'fundrize' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'fundrize' ),
					'repeat'       => esc_html__( 'Repeat', 'fundrize' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'fundrize' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'fundrize' ),
				),
				'active_callback' => 'wprt_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['wprt_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'fundrize' ),
	'panel' => 'wprt_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'fundrize' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'fundrize' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'fundrize' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'fundrize' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'fundrize' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'fundrize' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'fundrize' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'fundrize' )
			),
		),
	),
);

// Layout Widths
$this->sections['wprt_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'fundrize' ),
	'panel' => 'wprt_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'fundrize' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1180px', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .wprt-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'fundrize' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'fundrize' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 23%', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);