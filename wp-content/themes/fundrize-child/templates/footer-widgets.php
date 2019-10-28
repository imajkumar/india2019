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
$columns = wprt_get_mod( 'footer_columns', '6' );
$grid_cls = 'span_1_of_'. $columns;
$gutter = wprt_get_mod( 'footer_column_gutter', '30' );

if ( $gutter )
	$classes .= ' gutter-'. $gutter; ?>


<?php

// Display our stored footer widgets
$show_footer_sidebar_footer_1 = get_site_transient( 'wds_footer_widgets_footer_1' );
$show_footer_sidebar_footer_2 = get_site_transient( 'wds_footer_widgets_footer_2' );
$show_footer_sidebar_footer_3 = get_site_transient( 'wds_footer_widgets_footer_3' );
$show_footer_sidebar_footer_4 = get_site_transient( 'wds_footer_widgets_footer_4' );
$show_footer_sidebar_footer_5 = get_site_transient( 'wds_footer_widgets_footer_5' );
$show_footer_sidebar_footer_6 = get_site_transient( 'wds_footer_widgets_footer_6' );

global $blog_id;
if( $blog_id != 1 ) {
	?>
	<footer id="footer">
	<div id="footer-widgets" class="wprt-container">
		<div class="wprt-row <?php echo esc_attr( $classes ); ?>">
			<?php
			// Footer widget 1 ?>
			<div class="<?php echo esc_attr( $grid_cls ); ?> col">
				<?php echo $show_footer_sidebar_footer_1; ?>
			</div>

				<div class="<?php echo esc_attr( $grid_cls ); ?> col">
					<?php echo $show_footer_sidebar_footer_2; ?>
				</div>
			

			
				<div class="<?php echo esc_attr( $grid_cls ); ?> col">
					<?php echo $show_footer_sidebar_footer_3; ?>
				</div>


	

				<div class="<?php echo esc_attr( $grid_cls ); ?> col">
					<?php echo $show_footer_sidebar_footer_4; ?>
				</div>
	

				<div class="<?php echo esc_attr( $grid_cls ); ?> col">
					<?php echo $show_footer_sidebar_footer_5; ?>
				</div>



				<div class="<?php echo esc_attr( $grid_cls ); ?> col">
					<?php echo $show_footer_sidebar_footer_6; ?>
				</div>


		</div>
	</div><!-- /#footer-widgets -->
	</footer>
<?php
} else {
	if ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) 
	|| is_active_sidebar( 'sidebar-footer-3' ) || is_active_sidebar( 'sidebar-footer-4' ) 
	|| is_active_sidebar( 'sidebar-footer-5') || is_active_sidebar( 'sidebar-footer-6') ) {
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

			<?php
			// Footer widget 5
			if ( $columns > '3' ) : ?>
				<div class="<?php echo esc_attr( $grid_cls ); ?> col">
					<?php if ( is_active_sidebar( 'sidebar-footer-5' ) ) dynamic_sidebar( 'sidebar-footer-5' ); ?>
				</div>
			<?php endif; ?>

			<?php
			// Footer widget 6
			if ( $columns > '3' ) : ?>
				<div class="<?php echo esc_attr( $grid_cls ); ?> col">
					<?php if ( is_active_sidebar( 'sidebar-footer-6' ) ) dynamic_sidebar( 'sidebar-footer-6' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div><!-- /#footer-widgets -->
	</footer>
<?php } 
} ?>