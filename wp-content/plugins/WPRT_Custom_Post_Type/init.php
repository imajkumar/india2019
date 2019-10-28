<?php 
/*
Plugin Name: WPRT Custom Post Type
Plugin URI: http://rollthemes.com/plugins
Description: This plugin register Custom Post Type.
Version: 3.6.8
Author: RollThemes
Author URI: http://RollThemes.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPRT_CPT' ) ) {
	class WPRT_CPT {
		function __construct() {
			require_once dirname( __FILE__ ) . '/galleries.php';
			require_once dirname( __FILE__ ) . '/team.php';
			require_once dirname( __FILE__ ) . '/partner.php';

			add_filter( 'single_template', array( $this,'wprt_single_gallery' ) );	    
			add_filter( 'archive_template', array( $this,'wprt_archive_gallery' ) );	    
	    }

		function wprt_single_gallery( $single_template ) {
			global $post;
			if ( $post->post_type == 'gallery' ) $single_template = dirname( __FILE__ ) . '/inc/single-gallery.php';
			return $single_template;
		}

		function wprt_archive_gallery( $archive_template ) {
			global $post;
			if ( $post->post_type == 'gallery' ) $archive_template = dirname( __FILE__ ) . '/inc/archive-gallery.php';
			return $archive_template;
		}
	}
}
new WPRT_CPT;