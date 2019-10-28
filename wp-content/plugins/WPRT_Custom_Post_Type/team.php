<?php
if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}

add_action('init', 'register_member_post_type');
/**
  * Register member post type
*/
function register_member_post_type() {
    $member_slug = 'member';

    $labels = array(
        'name'               => esc_html__( 'Members', 'fundrize' ),
        'singular_name'      => esc_html__( 'Member Item', 'fundrize' ),
        'add_new'            => esc_html__( 'Add New', 'fundrize' ),
        'add_new_item'       => esc_html__( 'Add New Item', 'fundrize' ),
        'new_item'           => esc_html__( 'New Item', 'fundrize' ),
        'edit_item'          => esc_html__( 'Edit Item', 'fundrize' ),
        'view_item'          => esc_html__( 'View Item', 'fundrize' ),
        'all_items'          => esc_html__( 'All Items', 'fundrize' ),
        'search_items'       => esc_html__( 'Search Items', 'fundrize' ),
        'parent_item_colon'  => esc_html__( 'Parent Items:', 'fundrize' ),
        'not_found'          => esc_html__( 'No items found.', 'fundrize' ),
        'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'fundrize' )
    );

    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug' => $member_slug ),
        'supports'      => array( 'title', 'thumbnail' ),
        'public'        => true
    );

    register_post_type( 'member', $args );
}

add_filter( 'post_updated_messages', 'member_updated_messages' );
/**
  * Member update messages.
*/
function member_updated_messages( $messages ) {
    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    $messages['member'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => esc_html__( 'Member updated.', 'fundrize' ),
        2  => esc_html__( 'Custom field updated.', 'fundrize' ),
        3  => esc_html__( 'Custom field deleted.', 'fundrize' ),
        4  => esc_html__( 'Member updated.', 'fundrize' ),
        5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Member restored to revision from %s', 'fundrize' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => esc_html__( 'Member published.', 'fundrize' ),
        7  => esc_html__( 'Member saved.', 'fundrize' ),
        8  => esc_html__( 'Member submitted.', 'fundrize' ),
        9  => sprintf(
            esc_html__( 'Member scheduled for: <strong>%1$s</strong>.', 'fundrize' ),
            date_i18n( esc_html__( 'M j, Y @ G:i', 'fundrize' ), strtotime( $post->post_date ) )
        ),
        10 => esc_html__( 'Member draft updated.', 'fundrize' )
    );
    return $messages;
}

add_action( 'init', 'register_member_taxonomy' );
/**
  * Register member taxonomy
*/
function register_member_taxonomy() {
    $cat_slug = 'member_category';

    $labels = array(
        'name'                       => esc_html__( 'Member Categories', 'fundrize' ),
        'singular_name'              => esc_html__( 'Category', 'fundrize' ),
        'search_items'               => esc_html__( 'Search Categories', 'fundrize' ),
        'menu_name'                  => esc_html__( 'Categories', 'fundrize' ),
        'all_items'                  => esc_html__( 'All Categories', 'fundrize' ),
        'parent_item'                => esc_html__( 'Parent Category', 'fundrize' ),
        'parent_item_colon'          => esc_html__( 'Parent Category:', 'fundrize' ),
        'new_item_name'              => esc_html__( 'New Category Name', 'fundrize' ),
        'add_new_item'               => esc_html__( 'Add New Category', 'fundrize' ),
        'edit_item'                  => esc_html__( 'Edit Category', 'fundrize' ),
        'update_item'                => esc_html__( 'Update Category', 'fundrize' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'fundrize' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'fundrize' ),
        'not_found'                  => esc_html__( 'No Category found.', 'fundrize' ),
        'menu_name'                  => esc_html__( 'Categories', 'fundrize' ),
    );
    $args = array(
        'labels'        => $labels,
        'rewrite'             => array('slug'=>$cat_slug),
        'hierarchical'  => true,
    );
    register_taxonomy( 'member_category', 'member', $args );
}