<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
    'style' => 'style-1',
    'auto_scroll' => 'false',
    'number' => '4',
    'gap' => '30',
    'column'        => '3c',
    'column2'       => '2c',
    'column3'       => '1c',
    'show_bullets' => '',
    'show_arrows' => '',
    'bullet_show' => 'bullet-square',
    'bullet_between' => '50',
    'arrow_offset' => 'center',
    'arrow_offset_v' => '0',

), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

if ( ! class_exists( 'woocommerce' ) ) { return; }

$number = intval( $number );
$gap = intval( $gap );
$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );

$cls = 'arrow-center '. $bullet_show .' '. $style .' ';
$cls .= 'offset'. $arrow_offset .' offset-v'. $arrow_offset_v;
if ( $show_bullets ) $cls .= ' has-bullets'; 
if ( $show_arrows ) $cls .= ' has-arrows';

if ( $bullet_between == '45' ) $cls .= ' bullet45';
if ( $bullet_between == '40' ) $cls .= ' bullet40';
if ( $bullet_between == '35' ) $cls .= ' bullet35';
if ( $bullet_between == '30' ) $cls .= ' bullet30';
if ( $bullet_between == '25' ) $cls .= ' bullet25';
if ( $bullet_between == '20' ) $cls .= ' bullet20';
if ( $bullet_between == '15' ) $cls .= ' bullet15';
if ( $bullet_between == '10' ) $cls .= ' bullet10';

// Define vars
$atts['post_type'] = 'product';
$atts['taxonomy']  = 'product_cat';
$atts['tax_query'] = '';
$atts['posts_per_page'] = $number;

// Build the WordPress query
$wpex_query = new WP_Query( $atts );
ob_start();

// Output posts
if ( $wpex_query->have_posts() ) :
    wp_enqueue_script( 'wprt-owlcarousel' );
    echo '<div class="wprt-products clearfix '. $cls .'" data-auto="'. $auto_scroll .'" data-column="'. $column .'" data-column2="'. $column2 .'" data-column3="'. $column3 .'" data-gap="'. $gap .'">';
    echo '<ul class="owl-carousel owl-theme products">';
    while ( $wpex_query->have_posts() ) :
        // Get post from query
        $wpex_query->the_post();

        // Get woocommerce template part
        echo wc_get_template_part( 'content', 'product' );
    endwhile;
    echo '</ul>';
    echo '</div>';
endif;
wp_reset_postdata(); ?>

<?php
$return = ob_get_clean();
echo $return;
