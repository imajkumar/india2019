<?php
/**
 * Plugin Name: Default Site Structure
 * Description: Crates default pages and set them as front/blog index pages.
 * Network:     true
 * Plugin URL:  https://techbrise.com
 * License:     MIT
 * Version:     1.0.0
 */
namespace WPSE177819;

add_action( 'wp_loaded', __NAMESPACE__ . '\init' );

/**
 * @wp-hook wp_loaded
 */
function init() {

    add_action(
        'wpmu_new_blog',
        function( $blog_id, $user_id ) {

            $template_file_name = "front-page.php";
            $see_all_projects_page = "page-all-projects.php"; 

            switch_to_blog( $blog_id );

            $front_page_id = wp_insert_post( front_page_data( $user_id ) );
            $login_page_id = wp_insert_post( login_page_data( $user_id ) );
            $reg_page_id = wp_insert_post( reg_page_data( $user_id ) );
            $profile_page_id = wp_insert_post( profile_page_data( $user_id ) );
            $receipt_page_id = wp_insert_post( receipt_page_data( $user_id ) );
            $all_projetcs_page_id = wp_insert_post( all_projects_page_data( $user_id ) );
            $gallery_page_id = wp_insert_post( gallery_page_data( $user_id ) );
            //$index_page_id = wp_insert_post( index_page_data( $user_id ) );

            if ( ! is_wp_error( $front_page_id ) && 0 !== $front_page_id ) {
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $front_page_id );
                update_post_meta( $front_page_id, '_wp_page_template', $template_file_name );
            }
             update_post_meta( $all_projetcs_page_id, '_wp_page_template', $see_all_projects_page );
            /*if ( ! is_wp_error( $index_page_id ) && 0 !== $index_page_id ) {
                update_option( 'page_for_posts', $index_page_id );
            }*/


            update_option( 'date_format', date_format() );
            update_option( 'time_format', time_format() );

            restore_current_blog();
        },
        10,
        2
    );
}

/**
 * Returns the data of the blog index page
 *
 * @param int $post_author
 *
 * @return array
 */
function index_page_data( $post_author ) {

    return [
        'post_title'   => 'Home',
        'post_content' => '',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}

/**
 * Returns the data of the front page
 *
 * @param int $post_author
 *
 * @return array
 */
function front_page_data( $post_author ) {

    return [
        'post_title'   => 'Home',
        'post_content' => 'NGO Home Page',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}


/**
 * Returns the data of the Donation login page
 *
 * @param int $post_author
 *
 * @return array
 */
function login_page_data( $post_author ) {

    return [
        'post_title'   => 'Login',
        'post_content' => '[charitable_login]',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}

/**
 * Returns the data of the Registattion page
 *
 * @param int $post_author
 *
 * @return array
 */
function reg_page_data( $post_author ) {

    return [
        'post_title'   => 'Donation Registration',
        'post_content' => '[charitable_registration]',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}

/**
 * Returns the data of the Profile page
 *
 * @param int $post_author
 *
 * @return array
 */
function profile_page_data( $post_author ) {

    return [
        'post_title'   => 'Profiles',
        'post_content' => '[charitable_profile]',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}

/**
 * Returns the data of the Receipts page
 *
 * @param int $post_author
 *
 * @return array
 */
function receipt_page_data( $post_author ) {

    return [
        'post_title'   => 'Receipt page',
        'post_content' => '[donation_receipt]',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}
/**
 * Returns the data of the See all projetcs
 *
 * @param int $post_author
 *
 * @return array
 */
function all_projects_page_data( $post_author ) {

    return [
        'post_title'   => 'Projects',
        'post_content' => '',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}

/**
 * Returns the data of the See all projetcs
 *
 * @param int $post_author
 *
 * @return array
 */
function gallery_page_data( $post_author ) {

    return [
        'post_title'   => 'NGO gallery',
        'post_content' => '[vc_row full_width="stretch_row_content_no_spaces"][vc_column][spacing desktop_height="40" mobile_height="40" smobile_height="40"][headings subheading_width="600" subheading_font_size="16px" subheading_line_height="32px" heading_bottom_margin="7px" heading="OUR GALLERY" subheading="Your Support can make larger impact "][spacing desktop_height="45" mobile_height="30" smobile_height="30"][contentbox padding="0 10% 0 10%" padding_margin=""][alignbox][/alignbox][galleriesgrid image_crop="full" gapv="5" gaph="5" items="6" filter_button_all="SHOW ALL"][/contentbox][spacing desktop_height="70" mobile_height="40" smobile_height="40"][alignbox][buttons text="SEE FULL GALLERY" style="outline_light"][/alignbox][spacing desktop_height="90" mobile_height="50" smobile_height="50"][/vc_column][/vc_row]',
        'post_type'    => 'page',
        'post_author'  => $post_author,
        'post_status'  => 'publish'
    ];
}
/**
 * Returns the custom date format
 *
 * @return string
 */
function date_format() {

    return 'd,m,Y';
}

/**
 * Returns the custom time format
 *
 * @return string
 */
function time_format() {

    return 'H/i/s';
}