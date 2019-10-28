<?php
/**
 * Header / Aside Content
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get default values
$button_text = wprt_get_mod( 'header_aside_button_text', 'DONATE' );
$button_link = wprt_get_mod( 'header_aside_button_link' );

$content_one = wprt_get_mod( 'header_aside_info_one', '<span class="title">CALL NOW</span><br /><span class="subtitle">8 (800) 250-260-04</span>' );
$content_two = wprt_get_mod( 'header_aside_info_two', '<span class="title">EMAIL US</span><br /><span class="subtitle">hello@ninzio.com</span>' );

// Get header style
$header_style = wprt_get_mod( 'header_site_style', 'style-1' );
if ( is_page() && wprt_metabox('header_style') )
    $header_style = wprt_metabox('header_style');

if ( $header_style == 'style-1' || $header_style == 'style-2' ) :
    get_template_part( 'templates/header-menu' );
endif; ?>

<?php if ( $header_style == 'style-3' || $header_style == 'style-4' ) : ?>
	<div id="header-aside">
        <?php if ( wprt_get_mod( 'header_aside_button', true ) ) : ?>
        <div class="header-aside-btn">
            <a target="_blank" href="<?php echo esc_attr( $button_link ); ?>"><span><?php echo do_shortcode( $button_text ); ?></span></a>
        </div>
        <?php endif; ?>

        <div class="wprt-info">
            <div class="inner">
                <?php
                if ( $content_one )
                printf('
                    <div class="info-one"><div class="info-wrap">
                        <div class="info-i"><span><i class="inf-icon-phone-call"></i></span></div>
                        <div class="info-c">%1$s</div>
                    </div></div>',
                    do_shortcode( $content_one )
                );
                if ( $content_two )
                printf('
                    <div class="info-two"><div class="info-wrap">
                        <div class="info-i"><span><i class="inf-icon-envelope2"></i></span></div>
                        <div class="info-c">%1$s</div>
                    </div></div>',
                    do_shortcode( $content_two )
                );
                ?>
            </div>
        </div>
	</div>
<?php endif; ?>



