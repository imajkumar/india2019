<?php
/**
 * Header / Menu
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<nav id="main-nav" class="main-nav">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'fallback_cb' => 'wprt_menu_fallback',
		'container' => false
	) );
	?>
</nav>

<ul class="nav-extend active">
	<li class="ext"><?php get_search_form(); ?></li>

	<?php if ( class_exists( 'woocommerce' ) ) : ?>
	<li class="ext"><a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr( 'View your shopping cart', 'fundrize' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'fundrize' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?></a></li>
	<?php endif; ?>
</ul>

<?php
if ( wprt_get_mod( 'header_cart_icon', false ) )
	echo wprt_header_cart();

if ( wprt_get_mod( 'header_search_icon', false ) )
	echo wprt_header_search();
?>

