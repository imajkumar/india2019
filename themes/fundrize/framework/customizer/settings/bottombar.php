<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['wprt_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'fundrize' ),
	'panel' => 'wprt_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'fundrize' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'bottom_bar_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Style', 'fundrize' ),
				'type' => 'select',
				'active_callback' => 'wprt_cac_has_bottombar',
				'choices' => array(
					'style-1' => esc_html__( 'Content & Bottom-Menu', 'fundrize' ),
					'style-2' => esc_html__( 'Bottom-Menu & Content', 'fundrize' ),
				),
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => 'Fundrize - Charity WordPress Theme.',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'fundrize' ),
				'type' => 'textarea',
				'active_callback' => 'wprt_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'fundrize' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'fundrize' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'fundrize' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_link_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links', 'fundrize' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => array(
					'#bottom a',
					'#bottom ul.bottom-nav > li > a'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_link_color_hover',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links: Hover', 'fundrize' ),
				'active_callback'=> 'wprt_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => array(
					'#bottom a:hover',
					'#bottom ul.bottom-nav > li > a:hover'
				),
				'alter' => 'color',
			),
		),
	),
);