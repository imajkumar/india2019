<?php
/**
 * Entry Content / Author
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! get_the_author_meta( 'description' ) )
	return;
?>

<div class="post-author cleafix">
    <div class="author-avatar">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" rel="author">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wprt_author_bio_avatar_size', 103 ) ); ?>
        </a>
    </div>
    <div class="author-desc">
        <h4 class="name"><?php the_author_meta( 'nickname' ); ?></h4>
        <p><?php the_author_meta( 'description' ); ?></p>
    </div>
</div>




