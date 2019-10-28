<?php
//code to create a custom table in wordpress
global $wpdb;
$table = $wpdb->prefix . "user_reminder"; 
$charset_collate = $wpdb->get_charset_collate();
$sql = "CREATE TABLE IF NOT EXISTS $table (
    `id` mediumint(9) NOT NULL AUTO_INCREMENT,
    `user_id` mediumint(9) NOT NULL,
    `campaign_id` varchar(20) NOT NULL,
    `campaign_name` text NOT NULL,
    `campaign_img_url` text NOT NULL,
    `campaign_url` text NOT NULL,
UNIQUE (`id`)
) $charset_collate;";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
?>