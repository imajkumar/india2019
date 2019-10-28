<?php
/**
 * Featured Title
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer or Metabox
if ( ! wprt_get_mod( 'featured_title', true ) || wprt_metabox('hide_featured_title') )
    return;

// Get text more
$blog_title = wprt_get_mod( 'blog_featured_title' );
$blog_title   = $blog_title ? $blog_title : esc_html__( 'BLOG', 'fundrize' );

$shop_title = wprt_get_mod( 'shop_featured_title' );
$shop_title   = $shop_title ? $shop_title : esc_html__( 'Shop', 'fundrize' );

$title = esc_html__( 'Archives', 'fundrize' );

if ( is_post_type_archive('gallery') ) {
    $title = esc_html__( 'Galleries', 'fundrize' );
}

if ( wprt_is_woocommerce_shop() )
    $title = $shop_title;
if ( is_home() or is_singular('post') ) {
    $title = $blog_title;
} elseif ( is_singular() ) {
    $title = get_the_title();
} elseif ( is_search() ) {
    $title = sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'fundrize' ), get_search_query() );
} elseif ( is_404() ) {
    $title = esc_html__( 'Not Found', 'fundrize' );
} elseif ( is_author() ) {
    the_post();
    $title = sprintf( esc_html__( 'Author Archives: %s', 'fundrize' ), get_the_author() );
    rewind_posts();
} elseif ( is_day() ) {
    $title = sprintf( esc_html__( 'Daily Archives: %s', 'fundrize' ), get_the_date() );
} elseif ( is_month() ) {
    $title = sprintf( esc_html__( 'Monthly Archives: %s', 'fundrize' ), get_the_date( 'F Y' ) );
} elseif ( is_year() ) {
    $title = sprintf( esc_html__( 'Yearly Archives: %s', 'fundrize' ), get_the_date( 'Y' ) );
} elseif ( is_tax() || is_category() || is_tag() ) {
    $title = single_term_title( '', false );
}

// Return array to order contents
$featured_title_content = wprt_get_mod( 'featured_title_style' )
    ? explode( '_', wprt_get_mod( 'featured_title_style' ) )
    : array( "heading", "breadcrumbs" );
?>

<div id="featured-title" class="<?php echo wprt_feature_title_classes(); ?>" style="<?php echo wprt_background_css( 'featured_title_background_img' ); ?>">
    <div id="featured-title-inner" class="wprt-container clearfix">
        <div class="featured-title-inner-wrap">
            <?php
            foreach ( $featured_title_content as $content ) :
                // Get heading
                if ( 'heading' == $content ) {
                    // Dont load if disabled via Customizer
                    if ( wprt_get_mod( 'featured_title_heading', true ) ) : ?>
                        <div class="featured-title-heading-wrap">
                            <h1 class="featured-title-heading <?php echo wprt_feature_title_heading_classes(); ?>">
                                <?php echo esc_html( $title ); ?></h1>
                        </div>
                    <?php endif;
                }

                // Get breadcrumbs
                if ( 'breadcrumbs' == $content ) {
                    // Dont load if disabled via Customizer
                    if ( wprt_get_mod( 'featured_title_breadcrumbs', true ) ) : ?>
                        <div id="breadcrumbs">
                            <div class="breadcrumbs-inner">
                                <div class="breadcrumb-trail">
                                    <?php wprt_breadcrumbs(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                } 
            endforeach; ?>
        </div>
    </div>
</div><!-- /#featured-title -->

