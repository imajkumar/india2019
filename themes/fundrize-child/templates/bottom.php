<?php
/**
 * Bottom Bar
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! wprt_get_mod( 'bottom_bar', true ) ) return false;

$bottom_style = wprt_get_mod( 'bottom_bar_style', 'style-1' );

if ( $bottom_style == 'style-1') { $top_content = array( "content", "menu" ); }
else { $top_content = array( "menu", "content" ); }
?>

<div id="bottom" class="clearfix <?php echo wprt_element_classes( 'bottom_bar_style' ); ?>">
<div id="bottom-bar-inner" class="wprt-container">
    <div class="bottom-bar-inner-wrap">
        <?php
        foreach ( $top_content as $content ) : 
            // Get bottom content
            if ( 'content' == $content ) 
                get_template_part( 'templates/bottom-content' );
            
            // Get bottom socials
            if ( 'menu' == $content ) 
                get_template_part( 'templates/bottom-menu' );
        endforeach; ?>
    </div>
</div>
</div><!-- /#bottom -->