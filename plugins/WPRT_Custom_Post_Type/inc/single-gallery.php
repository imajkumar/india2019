<?php
get_header();

$related_title = wprt_get_mod( 'gallery_related_title' );
$related_title   = $related_title ? $related_title : esc_html__( 'YOU MAY ALSO LIKE', 'zupabuilder' );
$related_query = wprt_get_mod( 'gallery_related_query', '4' );
$related_column = wprt_get_mod( 'gallery_related_column', '3' );
$related_item_gap = wprt_get_mod( 'gallery_related_item_spacing', '15' );
$related_item_crop = wprt_get_mod( 'gallery_related_img_crop', 'square' );

$terms = get_the_terms( $post->ID, 'gallery_category' );
$term_ids = wp_list_pluck( $terms, 'term_id' );
?>
<div class="gallery-detail-wrap">
	<div class="wprt-container">
		<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile; ?>
	</div>
</div>

<?php if ( wprt_get_mod( 'gallery_related', false )  ): ?>
<div class="gallery-related-wrap">
	<div class="title-wrap"><h2 class="title"><span><?php echo esc_html( $related_title ); ?></span></h2></div>
	<div class="wprt-container">
		<?php
		$query_args = array(
			'post_type' => 'gallery',
			'tax_query' => array(
				array(
				'taxonomy' => 'gallery_category',
				'field' => 'term_id',
				'terms' => $term_ids,
				'operator'=> 'IN'
				)),
			'ignore_sticky_posts' => 1,
			'post__not_in'=> array( $post->ID )
		);

		$query_args['posts_per_page'] = $related_query;
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) : ?>
			<div class="gallery-related" data-gap="<?php echo esc_html( $related_item_gap ); ?>" data-column="<?php echo esc_html( $related_column ); ?>">
				<div class="owl-carousel owl-theme">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php wp_enqueue_script( 'wprt-owlcarousel' ); ?>

					<div class="gallery-box">
						<div class="inner">
							<div class="effect-default">
		                		<div class="gallery-image">
			                		<?php if ( has_post_thumbnail() ) {
								    	$img_size = 'wprt-rectangle2';
			                     		echo get_the_post_thumbnail( get_the_ID(), $img_size );
			                    	} ?>                    	
								</div>

	                            <div class="text">
		                			<div class="icon">
		                				<a class="zoom-popup" href="<?php echo wprt_get_image( array( 'size' => 'full', 'format' => 'src' ) ); ?>" data-title="<?php echo get_the_title(); ?>"><i class="inf-icon-magnifier8"></i></a>
		                				<a class="link" href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
												<i class="inf-icon-link-symbol"></i></a>
									</div>
                                    <h2><a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
										<?php echo get_the_title(); ?></a>
									</h2>
	                            </div>
	                        </div><!-- /.effect-default -->
		                </div><!--/.inner -->
					</div><!-- /.gallery-box -->
					<?php endwhile; ?>
				</div><!-- /.owl-carousel -->
			</div><!-- /.gallery-related -->
		<?php
		endif; wp_reset_postdata();
		?>
	</div><!-- /.wprt-container -->
</div><!-- /.gallery-related-wrap -->
<?php endif; ?>

<?php get_footer(); ?>