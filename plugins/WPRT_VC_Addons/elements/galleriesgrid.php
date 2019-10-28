<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'image_crop' => 'rectangle2',
	'items'			=> '8',
	'cat_slug'	=> '',
	'pagination' => 'false',
	'gapv'			=> '0',
	'gaph'			=> '0',
	'show_filter'	=> 'true',
	'filter_by_default' => '',
	'filter_cat_slug' => '',
	'filter_button_all' => 'All',
	'bottom_filter' => '',
	'column'		=> '4c',
	'column2'		=> '3c',
	'column3'		=> '2c',
	'column4'		=> '1c',
	'filter_font_family' => 'Default',
	'filter_font_weight' => 'Default',
	'filter_font_size' => '',
	'filter_line_height' => '',
	'filter_letter_spacing' => '',
	'filter_text_tranform' => 'uppercase'
), $atts ) );

$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );
$column4 = intval( $column4 );
$items = intval( $items );
$gapv = intval( $gapv );
$gaph = intval( $gaph );
$bottom_filter = intval( $bottom_filter );
$filter_font_size = intval( $filter_font_size );
$filter_line_height = intval( $filter_line_height );
$filter_letter_spacing = intval( $filter_letter_spacing );

if ( empty( $items ) ) $item = -1;

if ( empty( $gapv ) ) $gapv = 0;
if ( empty( $gaph ) ) $gaph = 0;

$filter_css = $filter_wrap_css  = $filter_data = $cls ='';
if ( $bottom_filter ) $filter_wrap_css = 'margin-bottom:'. $bottom_filter . 'px;';

$filter_css .= 'text-transform:'. $filter_text_tranform .';';
if ( $filter_font_weight != 'Default' ) $filter_css .= 'font-weight:'. $filter_font_weight .';';
if ( $filter_font_size ) $filter_css .= 'font-size:'. $filter_font_size .'px;';
if ( $filter_line_height ) $filter_css .= 'line-height:'. $filter_line_height .'px;';
if ( $filter_letter_spacing ) $filter_css .= 'letter-spacing:'. $filter_letter_spacing .'px;';
if ( $filter_font_family != 'Default' ) {
	wprt_enqueue_google_font( $filter_font_family );
	$filter_css .= 'font-family:'. $filter_font_family .';';
}

if ( ! empty( $filter_cat_slug ) && $filter_by_default  )
	$filter_data = strtolower( $filter_cat_slug );

if ( get_query_var('paged') ) {
   $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
   $paged = get_query_var('page');
} else {
   $paged = 1;
}

$query_args = array(
    'post_type' => 'gallery',
    'posts_per_page' => $items,
    'paged'     => $paged
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

<div class="wprt-gallery-grid <?php echo esc_attr( $cls ); ?>" data-column="<?php echo esc_attr( $column ); ?>" data-column2="<?php echo esc_attr( $column2 ); ?>" data-column3="<?php echo esc_attr( $column3 ); ?>" data-column4="<?php echo esc_attr( $column4 ); ?>" data-gaph="<?php echo esc_attr( $gaph ); ?>" data-gapv="<?php echo esc_attr( $gapv ); ?>" data-filter="<?php echo esc_attr( $filter_data ); ?>">

	<?php if ( $query->have_posts() ) :
		$terms = get_terms("gallery_category");
	    if ( count( $terms ) > 0 && $show_filter == 'true' ) {
	        echo '<div id="gallery-filter" style="'. esc_attr( $filter_wrap_css ) .'"><div class="inner">';
	        	if ( ! empty( $filter_button_all ) )
	        		echo '<div data-filter="*" class="cbp-filter-item" style="'. $filter_css .'"><span>'. esc_html( $filter_button_all ) .'</span></div>';

		        foreach ( $terms as $term ) {
		            $termname = strtolower( $term->name );
		            $termname = str_replace( ' ', '-', $termname );
		            echo '<div data-filter=".'. esc_attr( $termname ) .'" class="cbp-filter-item" title="'. esc_attr( $term->name ) .'" style="'. $filter_css .'"><span>'. $term->name . '</span></div>';
		        }
	        echo '</div></div>';
	    } ?>

		<div id="galleries" class="cbp">
		    <?php while ( $query->have_posts() ) : $query->the_post();
				wp_enqueue_script( 'wprt-cubeportfolio' ); wp_enqueue_script( 'wprt-magnificpopup' );
				
			    global $post;
				$term_list = '';
			    $terms = get_the_terms( $post->ID, 'gallery_category' );

			    if ( $terms ) {
			        foreach ( $terms as $term ) {
			            $term_list .= $term->slug .' ';
			        }
			    } ?>

	            <div class="cbp-item <?php echo esc_attr( $term_list ); ?>">
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
	            </div><!-- /.cbp-item -->
			<?php endwhile; ?>
		</div><!-- /#galleries -->

		<?php if ( 'true' == $pagination ) {
			echo '<div class="gallery-nav">';
			wprt_pagination( $query );
			echo '</div>';
		}
		?>
	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

</div><!-- /.wprt-gallery -->
<?php
$return = ob_get_clean();
echo $return;