<?php
/**
 * Entry Content / Meta
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! wprt_get_mod( 'blog_single_meta', true ) )
	return;

?>

<div class="post-meta <?php echo wprt_element_classes( 'blog_entry_meta_item_style' ); ?>">
	<div class="post-meta-content">
		<div class="post-meta-content-inner">
			<?php wprt_entry_meta(); ?>
		</div>
	</div>
</div>



