<?php
/**
 * Bottom Bar / Content
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get bottom content
$content = wprt_get_mod( 'bottom_copyright', 'Fundrize - Charity WordPress Theme.' );
?>

<div class="bottom-bar-content">
    <?php
    // Display copyright site
    if ( $content ) : ?>

        <div id="copyright">
            <?php echo do_shortcode( $content ); ?>
        </div><!-- /#copyright -->

    <?php endif; ?>
</div><!-- /.bottom-bar-content -->

