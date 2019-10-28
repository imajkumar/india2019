<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'clean_url', 'rgmk_find_add_key', 99, 3 );

// Clean url.
function rgmk_find_add_key( $url, $original_url, $_context ) {
	$key = get_option( 'rgmk_google_map_api_key' );

	if ( ! $key )
		return $url;

	if ( strstr( $url, "maps.google.com/maps/api/js" ) !== false || strstr( $url, "maps.googleapis.com/maps/api/js" ) !== false ) {

		if ( strstr( $url, "key=" ) === false ) {
			$url = add_query_arg( 'key', $key, $url );
			$url = str_replace( "&#038;", "&amp;", $url );
		}

	}

	return $url;
}

add_action( 'admin_menu', 'rgmk_add_admin_menu' );

// Add the admin menu link.
function rgmk_add_admin_menu() {
	add_submenu_page(
		'options-general.php',
		'Google API KEY',
		'Google API KEY',
		'manage_options',
		'gmaps-api-key',
		'rgmk_add_admin_menu_html'
	);
}

/**
 * The html output for the settings page.
 *
 * @since   1.0.0
 * @since   1.1.0 Added button to generate API KEY from wp-admin.
 * @package GMAPIKEY
 */
function rgmk_add_admin_menu_html() {
	add_thickbox();
	$updated = false;
	if ( isset( $_POST['rgmk_google_map_api_key'] ) ) {
		$key     = esc_attr( $_POST['rgmk_google_map_api_key'] );
		$updated = update_option( 'rgmk_google_map_api_key', $key );
	}

	if ( $updated ) {
		echo '<div class="updated fade"><p><strong>' . __( 'Kay Updated!', 'gmaps-api-key' ) . '</strong></p></div>';

	}
	?>
	<div class="wrap">

		<h2><?php _e( 'Google Maps API KEY', 'gmaps-api-key' ); ?></h2>
		<p>

			<a href='https://console.developers.google.com/henhouse/?pb=["hh-1","maps_backend",null,[],"https://developers.google.com",null,["maps_backend","geocoding_backend","directions_backend","distance_matrix_backend","elevation_backend","places_backend"],null]&TB_iframe=true&width=600&height=400'
			   class="thickbox button-primary"
			   name="<?php _e( 'Generate API Key - ( MUST be logged in to your Google account )', 'gmaps-api-key' ); ?>">
				<?php _e( 'Generate API Key', 'gmaps-api-key' ); ?>
			</a>
			<?php echo sprintf( __( 'or %sclick here%s to Get a Google Maps API KEY', 'geodirectory' ), '<a target="_blank" href=\'https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true\'>', '</a>' ) ?>
		</p>

		<form method="post" action="options-general.php?page=gmaps-api-key">
			<label for="rgmk_google_map_api_key"><?php _e( 'Enter Google Maps API KEY', 'gmaps-api-key' ); ?></label>
			<input title="<?php _e( 'Add Google Maps API KEY', 'gmaps-api-key' ); ?>" type="text"
			       name="rgmk_google_map_api_key" id="rgmk_google_map_api_key"
			       placeholder="<?php _e( 'Enter your API KEY here', 'gmaps-api-key' ); ?>"
			       style="padding: 6px; width:50%; display: block;"
			       value="<?php echo esc_attr( get_option( 'rgmk_google_map_api_key' ) ); ?>"/>

			<?php

			submit_button();

			?>
		</form>

	</div><!-- /.wrap -->
	<?php
}