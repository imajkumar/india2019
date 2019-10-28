<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'column'		=> '3c',
	'column2'		=> '2c',
	'column3'		=> '1c',
	'auto_scroll' => 'false',
	'loop' => 'false',
	'box_shadow' => '',
	'items'		=> '5',
	'cat_slug' => '',
	'gap'		=> '10',
	'show_bullets' => '',
	'show_arrows' => '',
	'arrow_between' => '50',
	'bullet_show' => 'bullet-square',
	'bullet_between' => '50',
    'arrow_offset' => 'center',
    'arrow_offset_v' => '0',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$items = intval( $items );
$gap = intval( $gap );
$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );

if ( empty( $items ) )
	return;

$cls = '';
$cls .= 'arrow-center '. $bullet_show .' offset'. $arrow_offset .' offset-v'. $arrow_offset_v;
if ( $show_bullets ) $cls .= ' has-bullets'; 
if ( $show_arrows ) $cls .= ' has-arrows';
if ( $box_shadow ) $cls .= ' has-shadow';

if ( $bullet_between == '45' ) $cls .= ' bullet45';
if ( $bullet_between == '40' ) $cls .= ' bullet40';
if ( $bullet_between == '35' ) $cls .= ' bullet35';
if ( $bullet_between == '30' ) $cls .= ' bullet30';
if ( $bullet_between == '25' ) $cls .= ' bullet25';
if ( $bullet_between == '20' ) $cls .= ' bullet20';
if ( $bullet_between == '15' ) $cls .= ' bullet15';
if ( $bullet_between == '10' ) $cls .= ' bullet10';

$query_args = array(
    'post_type' => 'partner',
    'posts_per_page' => $items
);

if ( ! empty( $cat_slug ) ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'partner_category',
			'field'    => 'slug',
			'terms'    => $cat_slug
		),
	);
}

$query = new WP_Query( $query_args );
if ( ! $query->have_posts() ) { echo "Partner post not found!"; return; }
ob_start(); ?>

<div class="wprt-partner <?php echo esc_attr( $cls ); ?>" data-auto="<?php echo esc_attr( $auto_scroll ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-column="<?php echo esc_attr( $column ); ?>" data-column2="<?php echo esc_attr( $column2 ); ?>" data-column3="<?php echo esc_attr( $column3 ); ?>" data-gap="<?php echo esc_html( $gap ); ?>">
<?php if ( $query->have_posts() ) : ?>
	<?php wp_enqueue_script( 'wprt-owlcarousel' ); ?>

	<div class="owl-carousel owl-theme">
	    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        	<div class="partner-item clearfix">
        		<div class="inner">
		            <?php if ( has_post_thumbnail() ) : ?>
		            	<a target="_blank" href="<?php echo esc_html( wprt_metabox( 'partner_hyperlink' ) ); ?>">
	    				<div class="thumb">
		    				<?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
	    				</div>
	    				</a>
	         		<?php endif; ?>
        		</div>
            </div>
		<?php endwhile; ?>
	</div><!-- /.owl-carousel -->

<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div><!-- /.wprt-partner -->

<?php
$return = ob_get_clean();
echo $return;