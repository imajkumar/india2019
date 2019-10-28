<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'style' => 'style-1',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);
ob_start(); ?>

<li class="share-twitter">
	<a href="https://twitter.com/share?text=<?php echo rawurlencode( the_title_attribute( 'echo=0' ) ); ?>&amp;url=<?php echo rawurlencode( esc_url( get_permalink() ) ); ?><?php if ( $handle ) echo '&amp;via='. esc_attr( $handle ); ?>" title="<?php esc_html_e( 'Share on Twitter', 'total' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
		<span class="fa fa-twitter"></span>
		<span class="social-share-button-text"><?php esc_html_e( 'Tweet', 'total' ); ?></span>
	</a>
</li>
<li class="share-facebook">
	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( esc_url( get_permalink() ) ); ?>" title="<?php esc_html_e( 'Share on Facebook', 'total' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
		<span class="fa fa-facebook"></span>
		<span class="social-share-button-text"><?php esc_html_e( 'Share', 'total' ); ?></span>
	</a>
</li>
<li class="share-googleplus">
	<a href="https://plus.google.com/share?url=<?php echo rawurlencode( esc_url( get_permalink() ) ); ?>" title="<?php esc_html_e( 'Share on Google+', 'total' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
		<span class="fa fa-google-plus"></span>
		<span class="social-share-button-text"><?php esc_html_e( 'Plus one', 'total' ); ?></span>
	</a>
</li>
<li class="share-pinterest">
	<a href="https://www.pinterest.com/pin/create/button/?url=<?php echo rawurlencode( esc_url( get_permalink() ) ); ?>&amp;media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>" title="<?php esc_html_e( 'Share on Pinterest', 'total' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
		<span class="fa fa-pinterest"></span>
		<span class="social-share-button-text"><?php esc_html_e( 'Pin It', 'total' ); ?></span>
	</a>
</li>
<li class="share-linkedin">
	<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo rawurlencode( esc_url( get_permalink() ) ); ?>&amp;title=<?php echo rawurlencode( the_title_attribute( 'echo=0' ) ); ?>&amp;source=<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_html_e( 'Share on LinkedIn', 'total' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
		<span class="fa fa-linkedin"></span>
		<span class="social-share-button-text"><?php esc_html_e( 'Share', 'total' ); ?></span>
	</a>
</li>

<?php
$return = ob_get_clean();
echo $return;