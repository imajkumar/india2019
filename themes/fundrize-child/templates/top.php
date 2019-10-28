<?php
/**
 * Top Bar
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div id="top-bar">
    <div id="top-bar-inner" class="wprt-container">
        <div class="top-bar-inner-wrap">
            <?php
            // Get topbar content
            get_template_part( 'templates/top-content' );
            
            // Get topbar socials
            get_template_part( 'templates/top-socials' );
            ?>
        </div>
    </div>
</div><!-- /#top-bar -->