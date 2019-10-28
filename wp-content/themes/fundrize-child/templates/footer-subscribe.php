<?php
/**
 * Footer Subscribe
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! wprt_get_mod( 'subscribe', false ) ) return false;

$title = wprt_get_mod( 'subscribe_title', 'Newsletter Subscribe' );
$subtitle = wprt_get_mod( 'subscribe_subtitle', 'Lorem ipsum dolor sit amet, consectetuer adipiscing' );

if ( class_exists('MC4WP_MailChimp') ) {
	echo '<div class="footer-subscribe clearfix"><div class="wprt-container">';
	echo '<div class="text-wrap"><div class="heading-wrap">';
		if ( $title ) echo '<h5 class="heading">'. $title .'</h5>';
		if ( $subtitle) echo '<div class="subheading">'. $subtitle .'</div>';
	echo '</div></div>';
	echo '<div class="form-wrap">';
		mc4wp_show_form(0);
	echo '</div>';
	echo '</div></div>';
}