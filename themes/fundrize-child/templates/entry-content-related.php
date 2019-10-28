<?php
/**
 * Entry Content / Related
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! has_tag() ) { return; }
$tags = wp_get_post_tags( $post->ID );
$first_tag = $tags[0]->term_id;
$query_args = array(
    'tag__in' => array( $first_tag ),
    'post__not_in' => array( $post->ID ),
    'posts_per_page' => -1
);

$query = new WP_Query( $query_args );
if ( $query->have_posts() ) : ?>
    <h3 class="related-title">Related Posts</h3>
    <div class="post-related">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="post-item">
            <div class="inner">
                <?php
                $the_cat = get_the_category();
                $category_name = $the_cat[0]->cat_name;
                $category_link = get_category_link( $the_cat[0]->cat_ID );
                $size = 'wprt-post-related';
                $thumb = get_the_post_thumbnail( get_the_ID(), $size );
                if ( $thumb )
                    echo '<div class="post-thumb"><a href="' . esc_url( get_permalink() ) . '">'. $thumb .'</a><span class="post-cat-related"><a href="'. esc_url($category_link) .'">'. esc_html( $category_name ) .'</a></span></div>';
                ?>
                <div class="post-content">
                    <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                </div>
            </div>
            </div>
        <?php endwhile; ?>
    </div><!-- /.post-related -->
<?php endif; wp_reset_postdata(); ?>



