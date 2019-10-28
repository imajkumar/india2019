<?php
/**
 * Displays the campaign progress bar.
 *
 * Override this template by copying it to yourtheme/charitable/campaign/progress-bar.php
 *
 * @author  Studio 164a
 * @since   1.0.0
 * @version 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @var Charitable_Campaign
 */
$campaign = $view_args['campaign'];

if ( ! $campaign->has_goal() ) :
	return;
endif;

?>
<div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc"><span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
    <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
        <div class="progress-animate"></div>
    </div>
</div>