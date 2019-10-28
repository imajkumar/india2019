<?php get_header(); ?>

<div id="content-wrap" class="wprt-container">
    <div id="site-content" class="site-content clearfix archive-gallery">
    	<div id="inner-content" class="inner-content-wrap">
			<?php if ( have_posts() ) : ?>
				<div class="wprt-gallery-grid" data-layout="grid" data-column="3" data-column2="3" data-column3="2" data-column4="1" data-gaph="30" data-gapv="30">
					<div id="galleries" class="cbp">
					    <?php while ( have_posts() ) : the_post();
							wp_enqueue_script( 'wprt-cubeportfolio' ); wp_enqueue_script( 'wprt-magnificpopup' ); ?>

				            <div class="cbp-item">
								<div class="gallery-box">
									<div class="inner">
										<div class="effect-default">
					                		<div class="gallery-image">
						                		<?php if ( has_post_thumbnail() ) {
						                     		echo get_the_post_thumbnail( get_the_ID(), 'rectangle' );
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

					<?php wprt_pagination(); ?>
				</div><!-- /.wprt-gallery -->
			<?php endif; ?>
    	</div>
    </div><!-- /#site-content -->
</div><!-- /#content-wrap -->

<?php get_footer(); ?>