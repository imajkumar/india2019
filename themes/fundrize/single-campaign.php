<?php get_header();
$campaign = charitable_get_current_campaign();
$currency_helper = charitable_get_currency_helper();
?>

    <div id="content-wrap" class="wprt-container">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
                    <div class="single-thumb">
                    <?php if ( has_post_thumbnail( $campaign->ID ) ) :
                            echo get_the_post_thumbnail( $campaign->ID, 'full' ); 
                        endif;
                    ?>
                    </div>

                    <div class="single-title">
                        <div class="inner clearfix">
                            <h3 class="title"><?php the_title() ?></h3>

                            <div class="campaign-donation">
                                <a class="dnt-button button" href="<?php echo charitable_get_permalink( 'campaign_donation_page', array( 'campaign_id' => $campaign->ID ) ) ?>" aria-label="<?php echo esc_attr( sprintf( _x( 'Make a donation to %s', 'make a donation to campaign', 'fundrize' ), get_the_title( $campaign->ID ) ) ) ?>"><span><span class="icon"><i class="inf-icon-heart"></i></span><?php echo esc_html( 'Donate Now', 'fundrize' ) ?></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="single-figure">
                        <div class="wprt-progress clearfix">
                            <div class="perc-wrap">
                                <div class="perc">
                                    <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span>
                                </div>
                            </div>
                            <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                <div class="progress-animate"></div>
                            </div>
                        </div>

                        <div class="figure clearfix">
                        <?php printf( _x( 'Raised: %s %s', 'Raised: amount goal', 'fundrize' ),
                            '<span class="amount">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span>',
                            '<span class="goal-amount">' . $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ) . '</span>'
                            );

                            printf('<span class="time-left">%1$s</span>', $campaign->get_time_left() );
                        ?>
                        </div>
                    </div>

                    <div class="single-content">
                        <?php printf('<div class="extend-desc">%1$s</div>', $campaign->post_content ); ?>
                    </div>
				<?php endwhile; ?>
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->
        
        <?php get_sidebar(); ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>