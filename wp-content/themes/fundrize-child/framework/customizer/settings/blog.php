<?php
/**
 * Blog setting for Customizer
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['wprt_blog_post'] = array(
	'title' => esc_html__( 'General', 'fundrize' ),
	'panel' => 'wprt_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'BLOG', 'fundrize' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'fundrize' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Border Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Border Width', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 2px 0px', 'fundrize' ),
				'active_callback' => '',
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_content_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'fundrize' ),
				'description' => esc_html__( 'Example: 30px.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'title,meta,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'fundrize' ),
				'type' => 'wprt-sortable',
				'object' => 'WPRT_Customize_Control_Sorter',
				'choices' => array(
					'title'           => esc_html__( 'Title', 'fundrize' ),
					'meta'            => esc_html__( 'Meta', 'fundrize' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'fundrize' ),
					'readmore'        => esc_html__( 'Read More', 'fundrize' ),
				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'fundrize' ),
			),
		),
	),
);

// Blog Posts Title
$this->sections['wprt_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'fundrize' ),
	'panel' => 'wprt_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title',
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['wprt_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'fundrize' ),
	'panel' => 'wprt_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'date', 'author', 'comments' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'fundrize' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'fundrize' ),
				'type' => 'wprt-sortable',
				'object' => 'WPRT_Customize_Control_Sorter',
				'choices' => array(
					'date'       => esc_html__( 'Date', 'fundrize' ),
					'author'     => esc_html__( 'Author', 'fundrize' ),
					'comments' => esc_html__( 'Comments', 'fundrize' ),
					'categories' => esc_html__( 'Categories', 'fundrize' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'wprt-heading',
				'label' => esc_html__( 'Item Meta', 'fundrize' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Style', 'fundrize' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Style 1', 'fundrize' ),
					'style-2' => esc_html__( 'Style 2', 'fundrize' ),
				),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Separate Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-meta .post-meta-content .item .inner:before',
				),
				'alter' => array(
					'color',
				),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['wprt_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'fundrize' ),
	'panel' => 'wprt_blog',
	'settings' => array(
		array(
			'id' => 'blog_excerpt_length',
			'default' => '55',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'fundrize' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['wprt_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'fundrize' ),
	'panel' => 'wprt_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'READ MORE', 'fundrize' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'fundrize' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_read_more_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Read More Margin', 'fundrize' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'fundrize' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-read-more',
				'alter' => 'margin',
			),
		),
	),
);

