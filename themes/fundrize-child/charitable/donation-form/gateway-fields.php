<?php
/**
 * The template used to display the gateway fields.
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Donation Form
 * @since   1.0.0
 * @version 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! isset( $view_args['form'] ) || ! isset( $view_args['field'] ) ) {
	return;
}

$form     = $view_args['form'];
$field    = $view_args['field'];
$classes  = $view_args['classes'];
$gateways = $field['gateways'];
$default  = isset( $field['default'] ) && isset( $gateways[ $field['default'] ] ) ? $field['default'] : key( $gateways );

?>
<fieldset id="charitable-gateway-fields" class="charitable-fieldset">
	<?php
	if ( isset( $field['legend'] ) ) : ?>

		<div class="charitable-form-header"><?php echo $field['legend'] ?></div>

	<?php
	endif;

	if ( count( $gateways ) > 1 ) :
	?>
		<fieldset class="charitable-fieldset-field-wrapper">
			<div class="charitable-fieldset-field-header" id="charitable-gateway-selector-header"><?php _e( 'Choose Your Payment Method', 'charitable' ) ?></div>
			<div class="payment-selection-tab-div">
				<div class="tabset-lxa">
				<!-- Tab 1 -->
				<input type="radio" name="tabset-lxa" class="offline-donation" id="tab1" aria-controls="Description-ma" checked style="display: none;">
				<label for="tab1">Online</label>
				<!-- Tab 2 -->
				<input type="radio" name="tabset-lxa" class="online-donation" id="tab2" aria-controls="marzen-lx-ma" style="display: none;">
				<label for="tab2">Offline</label>
				<!-- Tab 3 -->
				<input type="radio" name="tabset-lxa" class="other-donation" id="tab3" aria-controls="tab-vidlio-ma" style="display: none;">
				<label for="tab3">others</label>
				
				<div class="tab-panellxslx">
					<section id="marzen-lx-ma" class="tab-panellx"> 
						
					<div class="form-container">
						<div class="field-container">
							<label for="name">Name on your card</label>
							<input id="name" maxlength="20" type="text">
						</div>
						<div class="field-container">
							<label for="cardnumber">Card Number</label>
							<input id="cardnumber" type="text" pattern="[0-9]*" inputmode="numeric">
							<svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink">
							</svg>
						</div>
						<div class="field-container">
							<label for="expirationdate">Year of expiry(DD/mm/YY)</label>
							<input id="expirationdate" type="text" pattern="^((0[1-9])|(1[0-2]))\/((2009)|(20[1-2][0-9]))$" inputmode="numeric">
						</div>
						<div class="field-container">
							<label for="securitycode">CCV Number</label>
							<input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric">
						</div>
					</div>
					<?php
					
					?>
					</section>
					<section id="Description-ma" class="tab-panellx">
					<p>Pay Using Check and DD.</p>                  
					<p><input type="text" name="gateway" placeholder="Enter the cheque/DD number" class="" style="width: 340px;"></p>
					<input type="text" name="gateway" placeholder="Enter date of Expiry" class="" style="width: 340px;">
					</section>
					<section id="tab-vidlio-ma" class="tab-panellx">
					<p>Others<br>
					<ul style="list-style: none;">
									<li><input type="radio" id="gateway-paypal" name="gateway" value="paypal" aria-describedby="charitable-gateway-selector-header">
										<label for="gateway-paypal">PayPal</label>
									</li>
									<li><input type="radio" id="gateway-payu_money" name="gateway" value="payu_money" aria-describedby="charitable-gateway-selector-header">
										<label for="gateway-payu_money">PayUMoney</label>
									</li>
								</ul>
					<img src="https://master-7rqtwti-5yr2sxahiywhc.eu-2.platformsh.site/wp-content/uploads/2018/11/paypal-logo-png.png" style="width:15%; height:65px;">
					<img src="https://master-7rqtwti-5yr2sxahiywhc.eu-2.platformsh.site/wp-content/uploads/2018/11/payu.png" style="width:15%; height:65px;">
					</p>
					</section>
				</div>
				
				</div>
			</div>
			<ul id="charitable-gateway-selector" class="charitable-radio-list charitable-form-field" style="display:none;">
				<?php foreach ( $gateways as $gateway_id => $details ) : ?>
					<li><input type="radio" 
							id="gateway-<?php echo esc_attr( $gateway_id ) ?>"
							name="gateway"
							value="<?php echo esc_attr( $gateway_id ) ?>"
							aria-describedby="charitable-gateway-selector-header"
							<?php checked( $default, $gateway_id ) ?> />
						<label for="gateway-<?php echo esc_attr( $gateway_id ) ?>"><?php echo $details['label'] ?></label>
					</li>
				<?php endforeach ?>
			</ul>
		</fieldset>
	<?php
	endif;

	foreach ( $gateways as $gateway_id => $details ) :

		if ( ! isset( $details['fields'] ) || empty( $details['fields'] ) ) :
			continue;
		endif;

		?>
		<div id="charitable-gateway-fields-<?php echo $gateway_id ?>" class="charitable-gateway-fields charitable-form-fields cf" data-gateway="<?php echo $gateway_id ?>">
			<?php $form->view()->render_fields( $details['fields'] ) ?>
		</div><!-- #charitable-gateway-fields-<?php echo $gateway_id ?> -->	
	<?php endforeach ?>
</fieldset><!-- .charitable-fieldset -->
