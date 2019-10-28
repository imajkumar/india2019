<?php

// Framework functions
require_once( get_template_directory() . '/framework/get_mods.php' );
require_once( get_template_directory() . '/framework/framework-functions.php' );
require_once( get_template_directory() . '/framework/sanitize-data.php' );
require_once( get_template_directory() . '/framework/fonts.php' );
require_once( get_template_directory() . '/framework/accent-color.php' );
require_once( get_template_directory() . '/framework/typography.php' );
require_once( get_template_directory() . '/framework/customizer/customizer.php' );
require_once( get_template_directory() . '/framework/metabox-options.php' );
require_once( get_template_directory() . '/framework/widgets/widgets.php' );
require_once( get_template_directory() . '/framework/widget-areas.php' );
require_once( get_template_directory() . '/framework/breadcrumbs.php' );
require_once( get_template_directory() . '/framework/plugins.php' );
require_once( get_template_directory() . '/framework/theme-woocommerce.php' );
require_once( get_template_directory() . '/framework/demo-install.php' );

// Visual Composer
if ( class_exists( 'Vc_Manager' ) ) {
	require_once( get_template_directory() . '/framework/visual-composer-config.php' );
}

// Sets up theme defaults and registers support for various WordPress features.
add_action( 'after_setup_theme', 'wprt_theme_setup' );
function wprt_theme_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'fundrize', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable woocommerce support
	add_theme_support( 'woocommerce' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'wprt-post-standard', 877, 470, true );
	add_image_size( 'wprt-post-grid', 600, 440, true );
	add_image_size( 'wprt-post-widget', 160, 160, true );
	add_image_size( 'wprt-post-related', 300, 236, true );

	// Register menus
	register_nav_menu( 'top', esc_html__( 'Top Menu', 'fundrize' ) );
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'fundrize' ) );
	register_nav_menu( 'about', esc_html__( 'About Menu', 'fundrize' ) );
	register_nav_menu( 'service', esc_html__( 'Service Menu', 'fundrize' ) );
	register_nav_menu( 'bottom', esc_html__( 'Bottom Menu', 'fundrize' ) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video'
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}

// Enqueues scripts and styles.
add_action( 'wp_enqueue_scripts', 'wprt_theme_scripts' );
function wprt_theme_scripts() {
	// Third Party Styles
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.2' );
	wp_enqueue_style( 'animsition', get_template_directory_uri() . '/assets/css/animsition.css', array(), '4.0.1' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), '4.7.0' );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.6.0' );
	wp_enqueue_style( 'wprt-themecore-icons', get_template_directory_uri() . '/assets/css/themecore-icons.css', array(), '1.0.0' );
	wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), '1.0.0' );
	wp_enqueue_style( 'charitable', get_template_directory_uri() . '/assets/css/charitable.css', array(), '1.0.0' );

	// Theme Style
	wp_enqueue_style( 'wprt-theme-style', get_stylesheet_uri(), array(), '1.0.0' );

	// Third Party Scripts
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/assets/js/html5shiv.js', array('jquery'), '3.7.3', true );
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/assets/js/respond.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'matchmedia', get_template_directory_uri() . '/assets/js/matchmedia.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/easing.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array('jquery'), '1.1.0', true );
	wp_enqueue_script( 'animsition', get_template_directory_uri() . '/assets/js/animsition.js', array('jquery'), '4.0.1', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.6.0', true );

	// Theme Script
	wp_enqueue_script( 'wprt-theme-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );

	// Comment JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

// Registers a widget area.
add_action( 'after_setup_theme', 'wprt_widgets_init' );
function wprt_widgets_init() {
	// Sidebar for Blog
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Blog', 'fundrize' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here to appear in Sidebar Blog.', 'fundrize' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>'
	) );

	// Sidebar for Pages
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Page', 'fundrize' ),
		'id'			=> 'sidebar-page',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Page', 'fundrize' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Portfolio
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Portfolio', 'fundrize' ),
		'id'			=> 'sidebar-portfolio',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Portfolio', 'fundrize' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Shop
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Shop', 'fundrize' ),
		'id'			=> 'sidebar-shop',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Shop', 'fundrize' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// 4 Sidebars for Footer
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 1', 'fundrize' ),
		'id'			=> 'sidebar-footer-1',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 1', 'fundrize' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 2', 'fundrize' ),
		'id'			=> 'sidebar-footer-2',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 2', 'fundrize' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 3', 'fundrize' ),
		'id'			=> 'sidebar-footer-3',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 3', 'fundrize' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 4', 'fundrize' ),
		'id'			=> 'sidebar-footer-4',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 4', 'fundrize' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
}



//ajcode
function ajaxConversion1(){

	 echo 'bhagya';
	 die();

    if ( !empty( $_POST['user_email'] ) ) {


        $email = $_POST['user_email'];

   // do check
   if ( email_exists($email) ) {
      echo 'exit';
   }
   else {
      echo 'not exit';
   }

   // echo( json_encode( $response));
   wp_die();
    }
}
add_action('wp_ajax_ajaxConversion1', 'ajaxConversion1' );
add_action('wp_ajax_nopriv_ajaxConversion1', 'ajaxConversion1');


//ajcode
