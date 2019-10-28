<?php
/**
 * The template for displaying campaign content within loops.
 *
 * Override this template by copying it to yourtheme/charitable/campaign-loop/campaign.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Campaign
 * @since   1.0.0
 * @version 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

$campaign = charitable_get_current_campaign();

?>
<li id="campaign-<?php echo get_the_ID() ?>" <?php post_class() ?>>
<div class="inner">
	<?php
	/**
	 * @hook charitable_campaign_content_loop_before
	 */
	do_action( 'charitable_campaign_content_loop_before', $campaign, $view_args );

	?>
	<div class="thumb-wrap <?php if ( ! has_post_thumbnail( $campaign->ID ) ) echo esc_attr('no-thumb') ; ?>">
		<?php
			/**
			 * @hook charitable_campaign_content_loop_before_title
			 */
			do_action( 'charitable_campaign_content_loop_before_title', $campaign, $view_args );
		?>

		<?php
			/**
			 * @hook charitable_campaign_content_loop_after_title
			 */
			do_action( 'charitable_campaign_content_loop_after_title', $campaign, $view_args );
		?>
	
		<div class="campaign-donation">
			<a class="dnt-button button" href="<?php echo charitable_get_permalink( 'campaign_donation_page', array( 'campaign_id' => $campaign->ID ) ) ?>" aria-label="<?php echo esc_attr( sprintf( _x( 'Make a donation to %s', 'make a donation to campaign', 'fundrize' ), get_the_title( $campaign->ID ) ) ) ?>"><?php echo esc_html( 'Donate', 'fundrize' ) ?></a>
		</div>
	</div>

	<div class="text-wrap">
		<h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>

		<?php
			/**
			 * @hook charitable_campaign_content_loop_after
			 */
			do_action( 'charitable_campaign_content_loop_after', $campaign, $view_args );
		?>
	</div>
</div>
</li>
