<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'image_crop' => 'square2',
	'items'			=> '8',
	'gap'			=> '0',
	'cat_slug'	=> '',
	'auto_scroll' => 'false',
	'column'		=> '3c',
	'column2'		=> '2c',
	'column3'		=> '1c',
	'show_bullets' => '',
	'show_arrows' => '',
	'bullet_show' => 'bullet-square',
	'bullet_between' => '50',
    'arrow_offset' => 'center',
    'arrow_offset_v' => '0',
), $atts ) );

$items = intval( $items );
$gap = intval( $gap );
$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );

if ( empty( $items ) ) $item = -1;

$cls = 'arrow-center '. $bullet_show .' ';
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

$query_args = array(
    'post_type' => 'gallery',
    'posts_per_page' => $items
);

if ( ! empty( $cat_slug ) ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'gallery_category',
			'field'    => 'slug',
			'terms'    => $cat_slug
		),
	);
}

$query = new WP_Query( $query_args );
if ( ! $query->have_posts() ) { echo "Portfolio item not found!"; return; }
ob_start(); ?>

<div class="wprt-gallery <?php echo esc_attr( $cls ); ?>" data-auto="<?php echo esc_attr( $auto_scroll ); ?>" data-column="<?php echo esc_attr( $column ); ?>" data-column2="<?php echo esc_attr( $column2 ); ?>" data-column3="<?php echo esc_attr( $column3 ); ?>" data-gap="<?php echo esc_html( $gap ); ?>">

<?php if ( $query->have_posts() ) : ?>
	<?php wp_enqueue_script( 'wprt-owlcarousel' ); wp_enqueue_script( 'wprt-magnificpopup' ); ?>

	<div class="owl-carousel owl-theme">
	    <?php while ( $query->have_posts() ) : $query->the_post(); global $post; ?>
			<div class="gallery-box">
				<div class="inner">
					<div class="effect-default">
                		<div class="gallery-image">
	                		<?php if ( has_post_thumbnail() ) {
						    	$img_size = 'wprt-rectangle2';
								if ( $image_crop == 'full' ) $img_size = 'full';
								if ( $image_crop == 'square' ) $img_size = 'wprt-square';
								if ( $image_crop == 'square2' ) $img_size = 'wprt-square2';
								if ( $image_crop == 'rectangle' ) $img_size = 'wprt-rectangle';
								if ( $image_crop == 'auto2' ) $img_size = 'wprt-small-auto';

	                     		echo get_the_post_thumbnail( get_the_ID(), $img_size );
	                    	} ?>                    	
						</div>

                        <div class="text">
                			<div class="icon">
                				<a class="zoom-popup cbp-lightbox" href="<?php echo wprt_get_image( array( 'size' => 'full', 'format' => 'src' ) ); ?>" data-title="<?php echo get_the_title(); ?>"><i class="inf-icon-magnifier8"></i></a>
                				<a class="link" href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
										<i class="inf-icon-link-symbol"></i></a>
							</div>
                            <h2><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
								<?php echo get_the_title(); ?></a>
							</h2>
                        </div>
                    </div><!-- /.effect-default -->
                </div>
			</div><!-- /.gallery-box -->
		<?php endwhile; ?>
	</div><!-- /.owl-carousel -->

<?php endif; ?>
<?php wp_reset_postdata(); ?>

</div><!-- /.wprt-gallery -->
<?php
$return = ob_get_clean();
echo $return;