<?php
/**
 * Top Bar / Content
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get top content
$welcome = wprt_get_mod( 'top_bar_content_welcome', 'Welcome to Fundrize - Charity theme' );
$time = wprt_get_mod( 'top_bar_content_time', '' );
$phone = wprt_get_mod( 'top_bar_content_phone', '' );
$address = wprt_get_mod( 'top_bar_content_address', '' );
?>

<div class="top-bar-content">
    <?php
    // Top content
    if ( $welcome ) : ?>
        <span class="welcome content">
            <?php echo do_shortcode( $welcome ); ?>
        </span>
    <?php endif;
    if ( $time ) : ?>
        <span class="time content">
            <?php echo do_shortcode( $time ); ?>
        </span>
    <?php endif;

    if ( $phone ) : ?>
        <span class="phone content">
            <?php echo do_shortcode( $phone ); ?>
        </span>
    <?php endif;

    if ( $address ) : ?>
        <span class="address content">
            <?php echo do_shortcode( $address ); ?>
        </span>
    <?php endif; ?>

    <?php
    // Top menu
    wp_nav_menu( array(
        'theme_location' => 'top',
        'fallback_cb'    => false,
        'container'      => false,
        'menu_class'     => 'top-bar-menu',
    ) );
    ?>
</div><!-- /.top-bar-content -->

