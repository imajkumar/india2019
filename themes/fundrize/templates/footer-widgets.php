<?php
/**
 * Footer Widgets
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! wprt_get_mod( 'footer_widgets', true ) ) return false;

// Get options
$classes = '';
$columns = wprt_get_mod( 'footer_columns', '4' );
$grid_cls = 'span_1_of_'. $columns;
$gutter = wprt_get_mod( 'footer_column_gutter', '30' );

if ( $gutter )
	$classes .= ' gutter-'. $gutter; ?>


<?php
if ( is_active_sidebar( 'sidebar-footer-1' ) ||
	 is_active_sidebar( 'sidebar-footer-2' ) ||
	 is_active_sidebar( 'sidebar-footer-3' ) ||
	 is_active_sidebar( 'sidebar-footer-4' ) ) :
?>
<footer id="footer">
<div id="footer-widgets" class="wprt-container">
	<div class="wprt-row <?php echo esc_attr( $classes ); ?>">
		<?php
		// Footer widget 1 ?>
		<div class="<?php echo esc_attr( $grid_cls ); ?> col">
			<?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) dynamic_sidebar( 'sidebar-footer-1' ); ?>
		</div>

		<?php
		// Footer widget 2
		if ( $columns > '1' ) : ?>
			<div class="<?php echo esc_attr( $grid_cls ); ?> col">
				<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) dynamic_sidebar( 'sidebar-footer-2' ); ?>
			</div>
		<?php endif; ?>
		
		<?php
		// Footer widget 3
		if ( $columns > '2' ) : ?>
			<div class="<?php echo esc_attr( $grid_cls ); ?> col">
				<?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) dynamic_sidebar( 'sidebar-footer-3' ); ?>
			</div>
		<?php endif; ?>

		<?php
		// Footer widget 4
		if ( $columns > '3' ) : ?>
			<div class="<?php echo esc_attr( $grid_cls ); ?> col">
				<?php if ( is_active_sidebar( 'sidebar-footer-4' ) ) dynamic_sidebar( 'sidebar-footer-4' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div><!-- /#footer-widgets -->
</footer>
<?php endif; ?>