<?php
/**
 * WooCommerce setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// WooCommerce General
$this->sections['wprt_woocommerce_general'] = array(
	'title' => esc_html__( 'General', 'fundrize' ),
	'panel' => 'wprt_woocommerce',
	'settings' => array(
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Shop', 'fundrize' ),
			'control' => array(
				'label' => esc_html__( 'Shop Featured Title', 'fundrize' ),
				'type' => 'text',
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 9,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'fundrize' ),
				'type' => 'number',
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_products_desc',
			'default' => 20,
			'control' => array(
				'label' => esc_html__( 'Product Item: Desciption', 'fundrize' ),
				'type' => 'number',
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'fundrize' ),
				'description' => esc_html__( 'Example: 30px.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.woocommerce-page .content-woocommerce .products li',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'fundrize' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'fundrize' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'fundrize' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'fundrize' )
			),
		),
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'fundrize' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'fundrize' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'fundrize' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'fundrize' ),
				'active_callback' => 'wprt_cac_has_woo',
			),
		),
	),
);