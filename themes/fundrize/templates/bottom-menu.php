<?php
/**
 * Bottom Bar / Menu
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="bottom-bar-menu">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'bottom',
        'fallback_cb'    => false,
        'container'      => false,
        'menu_class'     => 'bottom-nav',
    ) );
    ?>
</div><!-- /.bottom-bar-menu -->

