<?php
/**
 * Footer setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['wprt_footer_general'] = array(
	'title' => esc_html__( 'General', 'fundrize' ),
	'panel' => 'wprt_footer',
	'settings' => array(
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
					'1' => '1',
				),
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '30',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 60px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'fundrize' ),
				'description' => esc_html__( 'Example: 60px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-bottom',
			),
		),
	),
);

// Footer Subscribe
$this->sections['wprt_footer_subscribe'] = array(
	'title' => esc_html__( 'Subscribe Form', 'fundrize' ),
	'panel' => 'wprt_footer',
	'settings' => array(
		array(
			'id' => 'subscribe',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'fundrize' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'subscribe_title',
			'default' => esc_html__( 'Newsletter Subscribe', 'fundrize' ),
			'control' => array(
				'label' => esc_html__( 'Subscribe Title', 'fundrize' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'subscribe_subtitle',
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing ', 'fundrize' ),
			'control' => array(
				'label' => esc_html__( 'Subscribe Sub-Title', 'fundrize' ),
				'type' => 'text',
			),
		),
	),
);