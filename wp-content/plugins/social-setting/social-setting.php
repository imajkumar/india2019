<?php
/*
Plugin Name: Social Setting
Plugin URI: https://techbrise.com/
description: A plugin to set the social URLs for Indiadonates.
Version: 1.0
Author: TechBrise
License: GPL2
*/
add_action('admin_menu','custom_setting_menu');
function custom_setting_menu(){
    add_options_page('social setting','Social Setting','manage_options','social setting slug','custom_setting_function');
}


function custom_setting_function() {
    if( isset( $_POST['submit'] ) ){
        $fbkurl = $_POST['facebook'];
        $twrurl = $_POST['twitter'];
        $lkdnurl = $_POST['likedin'];
        $gmlurl = $_POST['gmail'];
        $instaurl = $_POST['instagram'];
        
            update_option('fcbk_url',$fbkurl);
            update_option('twtr_url',$twrurl);
            update_option('lkd_url',$lkdnurl);
            update_option('gml_url',$gmlurl);
            update_option('insta_url',$instaurl);

            $fbkurl =  get_option('fcbk_url');
       }   //  echo get_option('fcbk_url')."<br>".get_option('twtr_url')."<br>".get_option('lkd_url');
        ?>
        <form method="post" id="tbsform">
       <div class="margn">
            <h1> Indiadonates Social URLs Setting</h1> 
        <div>
        <div>
            <p>
                <label><strong>Facebook Url</strong></label>
                <br>
                <input  type="text" name="facebook" placeholder="FacebookUrl" value = "<?php echo get_option('fcbk_url')?>" >
                <br>
            </p>
            <p>
                <label><strong>Twitter Url</strong></label>
                <br>
                <input  type="text" name="twitter" placeholder="TwitterUrl" value = "<?php echo get_option('twtr_url')?>" >
                <br>
            </p>
            <p>
                <label><strong>Linkedin Url</strong></label>
                <br>
                <input  type="text" name="likedin" placeholder="linkedinUrl" value = "<?php echo get_option('lkd_url')?>" >
            </p>
            <p>
                <label><strong>Gmail Url</strong></label>
                <br>
                <input  type="text" name="gmail" placeholder="gmailUrl" value = "<?php echo get_option('gml_url')?>"  >
            </p>
            <p>
                <label><strong>Instagram Url</strong></label>
                <br>
                <input  type="text" name="instagram" placeholder="instagramUrl" value = "<?php echo get_option('insta_url')?>"  >
            </p>
        </div>
        <input class="tbs-btn-ind" name="submit"  value="Submit" type="submit">  
    </form>   
<?php
        }
function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', plugins_url('social-setting/css/custom-style.css'));
    //wp_enqueue_style('my-bootstrap',plugins_url('social-setting/css/bootstrap.min.css'));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
?>