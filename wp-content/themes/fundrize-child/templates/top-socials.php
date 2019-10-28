<?php
/**
 * Top Bar / Socials
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="top-bar-socials">
    <?php
    // Top Languages
    if ( class_exists( 'SitePress' ) ) {
        echo '<div class="languages-switcher">';
        $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');

        foreach ( $languages as $l ) {
            $url =  $l['url'];
            $active = $l['active'];
            $name = $l['native_name'];
            $langs = array();

            if ( $active == 1 ) { ?>
                <a class="active" href="<?php echo esc_url( $url ); ?>">
                    <?php echo esc_html( $name ); ?>
                </a>
            <?php }
        }
        if ( 1 < count( $languages ) ) {
            echo '<div class="sub-lang">';
            foreach( $languages as $l ) {
                if ( !$l['active'] )
                    $langs[] = '<a href="'. esc_url( $l['url'] ) .'">'. esc_html( $l['translated_name'] ) .'</a>';
            }

            echo join(' ', $langs);
            echo '</div>';
        }
        echo '</div>';
    }

    // Exit if disabled via Customizer
    if ( ! wprt_get_mod( 'top_bar_social', 'false' ) ) return false;

    // Get content
    $content = wprt_get_mod( 'top_bar_social_text', '' ); ?>

    <div class="inner">
    <span class="texts">
        <?php echo do_shortcode( $content ); ?>
    </span>
    <span class="icons">
    <?php
    // Get social options array
    $profiles =  wprt_get_mod( 'top_bar_social_profiles' );
    $social_options = wprt_topbar_social_options();

    foreach ( $social_options as $key => $val ) :
        // Get URL from the theme mods
        $url = isset( $profiles[$key] ) ? $profiles[$key] : '';

        if ( $url ) :
            // Display link
            echo '<a href="'. $url .'" title="'. $val['label'] .'"><span class="'. $val['icon_class'] .'" aria-hidden="true"></span><span class="screen-reader-text">'. $val['label'] .' '. esc_html__( 'Profile', 'fundrize' ) .'</span></a>';
        endif;
    endforeach; ?>
    </span>
    </div>
</div><!-- /.top-bar-socials -->