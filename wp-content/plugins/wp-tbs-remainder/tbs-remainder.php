<?php
/**
 * Plugin Name: WP Remainder
 * Description: Plugins for sending the remainder to user about activity that left.
 * Network:     true
 * Plugin URL:  https://techbrise.com
 * License:     MIT
 * Version:     1.0.0
 * Author:      TechBrise Solutions 
 */
require_once('tbs-remainder-table.php');

//Add setting option for sechulde the reminder details. 
add_action( 'admin_menu', 'tbs_add_schedule_setting_page' );

/** This function will add the submenu for user role menu */
function tbs_add_schedule_setting_page() {
    add_options_page( 'Schedule Reminder', 'Schedule Reminder', 'manage_options', 'plugin', 'tbs_send_reminder_mail' );
}

// Set the cron job for sending the remider to the user.
register_activation_hook(__FILE__, 'tbs_reminder_schedule_cron');
add_action('wp', 'tbs_reminder_schedule_cron');
function tbs_reminder_schedule_cron() {
  if ( !wp_next_scheduled( 'reminder_corn' ) )
    wp_schedule_event( time(), 'customTime', 'reminder_corn' );
}

// CUSTOM TIME INTERVAL
add_filter('cron_schedules', 'myplugin_cron_add_intervals');
function myplugin_cron_add_intervals( $schedules ) {
  $schedules['customTime'] = array(
    'interval' => 30,
    'display' => __('Every 30sec')
  );
  return $schedules;
}

add_action('reminder_corn', 'tbs_send_reminder_mail');
function test_corn(){
    wp_mail('akmashish15@gmail.com','Cron Worked', date('r'));
}

//Cron function
function tbs_send_reminder_mail(){
    //Define the local varibales.
    global $wpdb;
    $reminder_table = "wp_user_reminder";
    $donor_table_name = "wp_charitable_donors";
    $charitable_cam_donation = "wp_charitable_campaign_donations";

    //Fetch the campaign details form wp_user_reminder table.
    $saved_campaign_details =  $wpdb->get_results( "SELECT * FROM $reminder_table" );
    foreach( $saved_campaign_details as $current_saved_campin_details ){

        $saved_campaign_user_id = $current_saved_campin_details->user_id;
        $saved_camp_id =  $current_saved_campin_details->campaign_id;
        $saved_camp_name = $current_saved_campin_details->campaign_name;
        $saved_camp_img_url = $current_saved_campin_details->campaign_img_url;
        $saved_Camp_url = $current_saved_campin_details->campaign_url;

        //Fetch the donor details using user id form donor tabel.
        $get_donor_id =  $wpdb->get_results( "SELECT donor_id FROM $donor_table_name WHERE user_id = $saved_campaign_user_id" );
        if( empty( $get_donor_id ) ){
           //send mail to the used with all details.
           $donor_info = get_userdata( $saved_campaign_user_id );
           $userloginname = $donor_info->user_login;
           $nicename = $donor_info->user_nicename;
           $email = $donor_info->user_email;
           $email_test = "ashishk@techbrise.com";
           $donor_message ="<html>
                               <head>
                                   <b>Dear Donor</b>
                               </head>
                                   <p> Please click here and complete your donoation to make people Happy.</p>
                                   <div>
                                       <h2>$saved_camp_name</h2>
                                       <img src= '$saved_camp_img_url'  width='200px' height='200px'>
                                       <a href='$saved_Camp_url'></a>
                                   </div>
                                   <b>Regards,<br>
                                   India Donates Team
                                   </b><br>
                                   <img src='https://master-7rqtwti-5yr2sxahiywhc.eu-2.platformsh.site/wp-content/uploads/2018/10/india-donates.png' alt='Indiadonates logo' width='150px'>
                           <html>";
           $headers = 'From: Indiadonates Reminder <no-reply@indiadonates.com>' . "\r\n";
           wp_mail( $email, "Please complete your donoation: {$saved_camp_name}", $donor_message , $headers);
        }else{
        foreach( $get_donor_id as $get_donner ){
               $fetched_donner_id = $get_donner->donor_id;
    
        } //end of donor id loop.
        
        // Fetch the Campaign id using donor ID. 
        $get_campaign_id = $wpdb->get_results( "SELECT campaign_id FROM $charitable_cam_donation WHERE donor_id =  $fetched_donner_id AND campaign_id = $saved_camp_id" );
            if( empty( $get_campaign_id ) ){
                echo "Hello World";
                //send mail to the used with all details.
                $donor_info = get_userdata( $saved_campaign_user_id );
                $userloginname = $donor_info->user_login;
                $nicename = $donor_info->user_nicename;
                $email = $donor_info->user_email;
                $email_test = "ashishk@techbrise.com";
                //$email_id = get_option('admin_email'); //If you want to send to site administrator, use 
                $donor_message ="<html>
                                    <head>
                                        <b>Dear Donor</b>
                                    </head>
                                        <p> Please click here and complete your donoation to make people Happy.</p>
                                        <div>
                                            <h2>$saved_camp_name</h2>
                                            <img src= '$saved_camp_img_url'  width='200px' height='200px'>
                                            <a href='$saved_Camp_url'></a>
                                        </div>
                                        <b>Regards,<br>
                                        India Donates Team
                                        </b><br>
                                        <img src='https://master-7rqtwti-5yr2sxahiywhc.eu-2.platformsh.site/wp-content/uploads/2018/10/india-donates.png' alt='Indiadonates logo' width='150px'>
                                <html>";
                $headers = 'From: Indiadonates Reminder <no-reply@indiadonates.com>' . "\r\n";
                wp_mail( $email, "Please complete your donoation: {$saved_camp_name}", $donor_message , $headers);

            }else{
                //Delete the Campaign details with user id.
                $wpdb->delete( $reminder_table, array( 'user_id' => $saved_campaign_user_id,
                                                       'campaign_id' => $saved_camp_id,                                    
                                                     ) );
            }

       // } //End of Campaign ID Loop
    } //else for empty array donor


    }//main foreach loop close.
}//function close.