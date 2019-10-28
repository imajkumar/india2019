<?php 
/*
Template Name: Donor Registrations Page. 
*/
?>
<?php get_header(); ?>

<?php
if( isset( $_POST['donor_submit'] ) ) {
    $user_email = $_POST['user_email'];
    $user_state = $_POST['state'];
    $user_city = $_POST['city'];
    $user_first_name = $_POST['first_name'];
    $user_last_name = $_POST['last_name'];
    $user_full_name = $_POST['first_name'].' '.$_POST['last_name'];
    $user_name_title = $_POST['name_title'];
    $user_reg_add = $_POST['reg_add'];
    $user_pin = $_POST['pin_code'];
    $user_phone = $_POST['user_phone'];

    $user_id = username_exists( $user_email );
    if ( !$user_id and email_exists($user_email) == false ) {
        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        
        $userdata = array(
            'user_login' => $user_email,
            'user_pass' => $random_password,
            'user_email' => $user_email,
            'display_name' => $user_full_name,
            'first_name' => $user_first_name,
            'last_name' => $user_last_name,
            'role' => 'donor',
            'show_admin_bar_front' => false,
        );
        $user_id = wp_insert_user( $userdata );
        
        //On success
        if ( ! is_wp_error( $user_id ) ) {
           
            update_user_meta( $user_id, 'user_state', $user_state );
            update_user_meta( $user_id, 'user_city', $user_city );
            update_user_meta( $user_id, 'user_title', $user_name_title );
            update_user_meta( $user_id, 'user_reg_add', $user_reg_add );
            update_user_meta( $user_id, 'user_pin', $user_pin );
            update_user_meta( $user_id, 'user_phone', $user_phone );
            ?>
            <div id="signup-content" class="widecolumn">
                <div class="mu_register wp-signup-container donor-tahnkyou-screen">
                    <h2 class="donor-thankyou-name">Dear <?php echo $user_name_title; ?>. <?php echo $user_last_name;?>! </h2> <h5>Thanks for registering with Indiadonates!!</h5>
                    Please check your Email for login details.
                </div>
            </div>
            <?php
            //mail to donor
            $emails = get_option('admin_email'); //If you want to send to site administrator, use 
            $title = wp_strip_all_tags(get_the_title($post->ID));
            $url = get_permalink($post->ID);
            //$mail_logo = ;
            $password_rset_link = home_url('/donner-login/forgot-password/');

            $donor_message ="<html>
                                <head><b>Dear $user_name_title. $user_last_name,</b></head>
                                    <p>
                                        Thank you! We wish you all the best for starting a joyous giving journey on Indiadonates platform,
                                        we believe that people like you will bring a large scale positive
                                        impact in the lives of the needy.</p>
                                        <p>
                                        For further Log In please use your email and 
                                        (computer generated) password attached in this mail.<p/>
                                        <p>Username: $user_email</p>
                                        <p>Password: $random_password</p>
                                        <p>
                                        You may change your password of your choice by clicking the link below.
                                       <p> $password_rset_link </p> 
                                        </p>  
                                         <b>Regards, <br>
                                         India Donates Team</b><br>
                                         <img src='https://master-7rqtwti-5yr2sxahiywhc.eu-2.platformsh.site/wp-content/uploads/2018/11/india-donates.png' alt='Smiley face' width='150px'>
                                    
                            <html>";

            $headers = 'From: My Name <akshats@techbrise.com>' . "\r\n";

            wp_mail( $user_email, "Congratulation! Your profile is registered. Please login and donate", $donor_message , $headers);

            //mail to admin on donor registration.
            $admin_message = "New donor Registration:{$user_full_name}";
            wp_mail( $emails, "New Donor Registration: $user_full_name", $admin_message , $headers);
        }  
    } else {
         ?>

                <div id="signup-content" class="widecolumn donor_reg_form">
                    <div class="mu_register wp-signup-container">
                        <form id="msform" method="post" action="#" novalidate="novalidate" style="margin-bottom: 40px;">
                            <h3 id="text-cntr">Welcome!</h3>
                            <h6>Join hands and make a difference</h6> 
                            <input name="stage" value="validate-user-signup" type="hidden">
                            <input name="signup_form_id" value="1279894771" type="hidden">
                            <input id="_signup_form" name="_signup_form" value="e460127e45" type="hidden">
                                <div class="reg-main">
                                            
                                </div>
                                <div class="reg-main">
                                    <div class="reg-left reg-inner-div">
                                    <h6 class="donor_email_exist"><?php echo $random_password = __('Email Id already registered. Please use another Email Id.'); ?></h6>
                                    <div class="marginb" style="display:inline-flex;">    
                                    <select class="form-control" name="name_title" id=""style="width:30%; width: 40%;padding-left: 0px;padding-right: 2px; height:40px; margin-right:5px;">
                                            <option selected="selected" value="Mr">Mr</option>
                                            <option value="Ms">Ms</option>
                                            <option value="Doctor">Dr.</option>
                                        </select>
                                        <div class="marginb" style="margin-right: 5px;"><input name="first_name" id="first_name" placeholder="First Name" value="<?php echo $user_first_name; ?>" maxlength="20" type="text"></div>
                                        <div class="marginb"><input name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $user_last_name; ?>" maxlength="20" type="text"></div>
                                    </div>
                                    <div class="marginb"><input name="user_email" class="user_email email_exist_already" placeholder="Email" type="email"></div>
                                    <div class="marginb"><input name="user_phone" class="user_phone" placeholder="Phone" type="text" value="<?php echo $user_phone; ?>"></div>
                                        <?php 
                                            global $wpdb;
                                            $results_state = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id = 0", OBJECT );
                                            //print_r($results_state);
                                            ?><select style="margin-bottom: 10px !important;" name="state" id="state" class='state' value="" >
                                            <option disabled selected hidden>State</option> <?php
                                            foreach( $results_state as $state ) {
                                                echo '<option  value="'.$state->id.'">'.$state->name.'</option>';

                                            }
                                            ?></select>
                                            <?php
                                            
                                            global $wpdb;
                                            $results_city = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id != 0", OBJECT );
                                            //print_r($results_state);
                                            ?><select style="margin-bottom: 10px !important;" name="city" id="city" class='state' value="" disabled="disabled">
                                            <option disabled selected hidden>City</option> <?php
                                            foreach( $results_city as $city ) {
                                                echo '<option id="'.$city->id.'" parent_id="'.$city->parent_id.'">'.$city->name.'</option>';

                                            }
                                            ?>
                                    </select>
                                        <div class="marginb"><input name="reg_add" id="reg_add" placeholder="Address" value="<?php echo $user_reg_add; ?>" maxlength="100" type="text"></div>
                                        <div class="marginb"><input name="pin_code" id="pan" placeholder="PIN Code" value="<?php echo $user_pin; ?>" maxlength="20" type="text"></div>
                                        </div>
                            

                                <div class="reg-right reg-inner-div">            
                                                
                                <div class="login_social" style= "width: 75%; padding-top: 20px;">
                                <!--<img src="../wp-content/uploads/2018/10/Social-img.png"/>-->
                                    
                                    <?php echo do_shortcode('[nextend_social_login provider="facebook"]');?>
                                    <h3 class="or">OR</h3>
                                    <?php echo do_shortcode('[nextend_social_login provider="google"]');?>
                                    <p class="popup-signup-text">If already registered, kindly</p>
                                    <a style="font-weight: bold;" class="popup-donor-signup" href="<?php echo home_url().'/login/'?>">Login</a>
                                    
                                </div>
                            </div>
                                
                        </div>  
                            <input name="donor_submit" class="submit action-button" value="Signup" type="submit">
                                

                            </fieldset>
                                
                        </form>   
                    </div>
                </div>

  <?php  }

} else {
    if( is_user_logged_in()  ){
        $current_user_id = get_current_user_id();

        ?>
        <div id="signup-content" class="widecolumn donor_reg_form">
            <div class="mu_register wp-signup-container">
                <center><h1 class='heading-ngo-notverified'>You are already logged in. If you want to register a new NGO, then please click on the Log Out link below and register the NGO.</h1></center>
                <center><a href="<?php echo wp_logout_url(); ?>"><h3 style="color:#f79800;">Log Out</h3></a></center>
            </div>
        </div>
        <?php

    }else{
?>
<div id="signup-content" class="widecolumn donor_reg_form">
    <div class="mu_register wp-signup-container">
	    <form id="msform" method="post" action="#" novalidate="novalidate" style="margin-bottom: 40px;">
            <h3 id="text-cntr">Welcome!</h3>
            <h6>Join hands and make a difference</h6> 
		    <input name="stage" value="validate-user-signup" type="hidden">
            <input name="signup_form_id" value="1279894771" type="hidden">
            <input id="_signup_form" name="_signup_form" value="e460127e45" type="hidden">
                <div class="reg-main">
                             
                </div>
                <div class="reg-main">
                    <div class="reg-left reg-inner-div">
                    <div class="marginb" style="display:inline-flex;">    
                     <select class="form-control" name="name_title" id=""style="width:30%; width: 40%;padding-left: 0px;padding-right: 2px; height:40px; margin-right:5px;">
                            <option selected="selected" value="Mr">Mr</option>
                            <option value="Ms">Ms</option>
                            <option value="Doctor">Dr</option>
                        </select>
                        <div class="marginb" style="margin-right: 5px;"><input name="first_name" id="first_name" placeholder="First Name" value="" maxlength="20" type="text"></div>
                        <div class="marginb"><input name="last_name" id="last_name" placeholder="Last Name" value="" maxlength="20" type="text"></div>
                    </div>
                    <div class="marginb"><input name="user_email" class="user_email" placeholder="Email" type="email"></div>
                    <div class="marginb"><input name="user_phone" class="user_phone" placeholder="Phone" type="text"></div>
                        <?php 
                            global $wpdb;
                            $results_state = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id = 0", OBJECT );
                            //print_r($results_state);
                            ?><select style="margin-bottom: 10px !important;" name="state" id="state" class='state' value="" >
                            <option disabled selected hidden>State</option> <?php
                            foreach( $results_state as $state ) {
                                echo '<option  value="'.$state->id.'">'.$state->name.'</option>';

                            }
                            ?></select>
                            <?php
                            
                            global $wpdb;
                            $results_city = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id != 0", OBJECT );
                            //print_r($results_state);
                            ?><select style="margin-bottom: 10px !important;" name="city" id="city" class='state' value="" disabled="disabled">
                            <option disabled selected hidden>City</option> <?php
                            foreach( $results_city as $city ) {
                                echo '<option id="'.$city->id.'" parent_id="'.$city->parent_id.'">'.$city->name.'</option>';

                            }
                            ?>
                    </select>
                        <div class="marginb"><input name="reg_add" id="reg_add" placeholder="Address" value="" maxlength="100" type="text"></div>
                        <div class="marginb"><input name="pin_code" id="pan" placeholder="PIN Code" value="" maxlength="20" type="text"></div>
                        </div>
               

                <div class="reg-right reg-inner-div">            
                                   
                <div class="login_social" style= "width: 75%; padding-top: 20px;">
                <!--<img src="../wp-content/uploads/2018/10/Social-img.png"/>-->
					
					<?php echo do_shortcode('[nextend_social_login provider="facebook"]');?>
					<h3 class="or">OR</h3>
					<?php echo do_shortcode('[nextend_social_login provider="google"]');?>
					<p class="popup-signup-text">If already registered, kindly</p>
                    <a style="font-weight: bold;" class="popup-donor-signup" href="<?php echo home_url().'/login/
                    '?>">Login</a>
					
				</div>
              </div>
                   
        </div>  
             <input name="donor_submit" class="submit action-button" value="Signup" type="submit">
                

            </fieldset>
                
        </form>   
    </div>
</div>
<?php   
    } 
}?>
<?php get_footer(); ?>