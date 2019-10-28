<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       imajkumar.github.io
 * @since      1.0.0
 *
 * @package    Ayra
 * @subpackage Ayra/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ayra
 * @subpackage Ayra/admin
 * @author     Ajay Kumar <ajayit2020@gmail.com>
 */
class Ayra_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		function _ayra_donate_top_menu(){
   		add_menu_page('India Donate', 'India Donate', 'manage_options','ayra_page', 'ayra_donate', null,4);
			 add_submenu_page('ayra_page', 'User List', 'User List', 'manage_options','/ayracustom', '_ayra_donate');
			 add_submenu_page('ayra_page', 'User List1', 'User List1', 'manage_options','/ayracustom2', '_ayra_donate1');

 		}
 		 add_action('admin_menu','_ayra_donate_top_menu');
		 function ayra_donate(){
				include 'admin_dashboard.php';

		}
		function _ayra_donate(){
			 include 'admin_dashboard.php';

	 }
	 function _ayra_donate1(){
			include 'admin_dashboard.php';

	}



	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ayra_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ayra_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ayra-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ayra_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ayra_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ayra-admin.js', array( 'jquery' ), $this->version, false );

	}

}
