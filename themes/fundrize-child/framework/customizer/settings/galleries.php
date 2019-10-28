<?php
/**
 * Galleries setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project Related General
$this->sections['wprt_galleries_general'] = array(
	'title' => esc_html__( 'General', 'fundrize' ),
	'panel' => 'wprt_galleries',
	'settings' => array(
		array(
			'id' => 'gallery_related',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'fundrize' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'gallery_related_title',
			'default' => esc_html__( 'YOU MAY ALSO LIKE', 'fundrize' ),
			'control' => array(
				'label' => esc_html__( 'Gallery Related Title', 'fundrize' ),
				'type' => 'text',
				'active_callback' => 'wprt_cac_has_related_gallery',
			),
		),
		array(
			'id' => 'gallery_related_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrap Padding', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 100px 0px 100px 0px', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_related_gallery',
			),
			'inline_css' => array(
				'target' => '.gallery-related-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'gallery_related_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Wrap Background', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_related_gallery',
			),
			'inline_css' => array(
				'target' => '.gallery-related-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'gallery_related_query',
			'default' => 4,
			'control' => array(
				'label' => esc_html__( 'Number of items', 'fundrize' ),
				'type' => 'number',
				'active_callback' => 'wprt_cac_has_related_gallery',
			),
		),
		array(
			'id' => 'gallery_related_column',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Columns', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
				'active_callback' => 'wprt_cac_has_related_gallery',
			),
		),
		array(
			'id' => 'gallery_related_item_spacing',
			'default' => 15,
			'control' => array(
				'label' => esc_html__( 'Spacing between items', 'fundrize' ),
				'type' => 'number',
				'active_callback' => 'wprt_cac_has_related_gallery',
			),
		),
		array(
			'id' => 'gallery_related_img_crop',
			'default' => 'square',
			'control' => array(
				'label' => esc_html__( 'Image Size', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'square' => '600 x 600',
					'rectangle' => '600 x 500',
					'rectangle2' => '600 x 390',
				),
				'active_callback' => 'wprt_cac_has_related_gallery',
			),
		),

	),
);