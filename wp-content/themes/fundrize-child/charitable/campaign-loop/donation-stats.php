<?php
/**
 * Displays the campaign donation stats.
 *
 * @author  Studio 164a
 * @since   1.0.0
 * @version 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @var 	Charitable_Campaign
 */
$campaign = $view_args['campaign'];

?>
<div class="campaign-donation-stats">  
	<?php
	$currency_helper = charitable_get_currency_helper();

	printf( _x( 'Raised: %s %s', 'Raised: amount goal', 'fundrize' ),
	'<span class="amount">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span>',
	'<span class="goal-amount">' . $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ) . '</span>'
	);
	?>
</div>
