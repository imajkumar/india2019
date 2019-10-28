<?php
/**
 * Theme Plugins
 *
 * @package fundrize
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @link Thanks https://themes.trac.wordpress.org/browser/firmasite/1.1.13/functions/class-tgm-plugin-activation.php
 */
require get_template_directory() . '/framework/plugin-activation.php';


// Register action to declare required plugins
add_action( 'tgmpa_register', 'wprt_register_plugins' );

/**
 * Register third-party plugins
 */
function wprt_register_plugins() {
	$plugins = array(
		array(
			'name'     				=> esc_html__( 'Visual Composer', 'fundrize'), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/js_composer.zip', // The plugin source
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
		array(
			'name'     				=> esc_html__('Revolution Slider', 'fundrize'), // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'source'             	=> get_stylesheet_directory() . '/framework/plugins/revslider.zip', // The plugin source
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
		array(
			'name'     				=> esc_html__( 'Meta Box', 'fundrize'), // The plugin name
			'slug'     				=> 'meta-box', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'Contact Form 7', 'fundrize'), // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'MailChimp for WordPress', 'fundrize'), // The plugin name
			'slug'     				=> 'mailchimp-for-wp', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'Charitable', 'fundrize'), // The plugin name
			'slug'     				=> 'charitable', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'Woocommerce', 'fundrize'), // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'One Click Demo Import', 'fundrize'), // The plugin name
			'slug'     				=> 'one-click-demo-import', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'WPRT Custom Post Type', 'fundrize'), // The plugin name
			'slug'     				=> 'WPRT_Custom_Post_Type', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'source'             	=> esc_url('http://ninzio.com/fundrize/_plugins/WPRT_Custom_Post_Type.zip'),
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
		array(
			'name'     				=> esc_html__( 'WPRT Addons for Visual Composer', 'fundrize'),  // The plugin name
			'slug'     				=> 'WPRT_VC_Addons', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'source'             	=> esc_url('http://ninzio.com/fundrize/_plugins/WPRT_VC_Addons.zip'),
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'fundrize' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'fundrize' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'fundrize' ), // %s = plugin name.
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'fundrize' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'fundrize' ), // %1$s = plugin name(, 'fundrize's).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'fundrize' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'fundrize' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'fundrize' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'fundrize' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'fundrize' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );
}
