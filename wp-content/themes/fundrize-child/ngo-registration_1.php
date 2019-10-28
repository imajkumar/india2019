<?php 
/*
Template Name: NGO Registrations Page. 
*/
?>
<?php get_header(); ?>

<?php
if( isset( $_POST['ngo_submit'] ) ) {
    $org_name = $_POST['org_name'];
    $user_name = seoUrl($org_name);
    $user_email = $_POST['user_email'];
    $user_state = $_POST['state'];
    $user_city = $_POST['city'];
    $user_last_name = $_POST['last_name'];
    $user_first_name = $_POST['first_name'];
    $user_prefix_name = $_POST['name_prefix'];
    $user_designation = $_POST['designation'];
    $user_phone = $_POST['phone'];
    $user_website = $_POST['website'];
    $user_reg_add = $_POST['reg_add'];
    $user_ngo_type = $_POST['reg_ngo'];
    $user_last_year_incom = $_POST['incom'];
    $user_last_year_expd = $_POST['expd'];
    $user_g_80 = $_POST['g_80'];
    $user_a_12 = $_POST['a_12'];
    $user_pan = $_POST['pan'];
    $user_tan = $_POST['orgname']; //this is nothing but a tan number of an NGO.
    //$user_ltr = $_POST['ltr']; //last year turnover
    //$user_bnfs = $_POST['bnfs']; //number of benificiary
    //$user_causes_for = $_POST['causes_for']; //category
    $cuses_support_string = implode(', ', $_POST['causes_for']);
    $user_causes_other = $_POST['cat_other'];

    $user_id = username_exists( $user_name );
    if ( !$user_id and email_exists($user_email) == false ) {
        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        if ( strlen( $user_name ) > 40 ){
          $new_user = substr($user_name,0,40);
        }else{
          $new_user = seoUrl($org_name);
        }
         //$new_user;
        $userdata = array(
            'user_login' =>  $new_user,
            'user_pass' => $random_password,
            'user_email' => $user_email,
            'user_url' => $user_website,
            'display_name' => $org_name,
            'role' => 'ngo_charitable',
            'show_admin_bar_front' => false,
        );
        $user_id = wp_insert_user( $userdata );
        
        
        //On success
        if ( ! is_wp_error( $user_id ) ) {
            $string_count = strlen($user_name);
            if( $string_count > 40 ){
              update_user_meta( $user_id, 'string_lenght', "yes" );


            }
            update_user_meta( $user_id, 'org_name', $org_name );
            update_user_meta( $user_id, 'user_state', $user_state );
            update_user_meta( $user_id, 'user_city', $user_city );
            update_user_meta( $user_id, 'user_last_name', $user_last_name );
            update_user_meta( $user_id, 'user_first_name', $user_first_name );
            update_user_meta( $user_id, 'user_prefix_name',  $user_prefix_name );
            update_user_meta( $user_id, 'user_designation', $user_designation );
            update_user_meta( $user_id, 'user_phone', $user_phone );
            update_user_meta( $user_id, 'user_website', $user_website );
            update_user_meta( $user_id, 'user_reg_add', $user_reg_add );
            update_user_meta( $user_id, 'user_ngo_type', $user_ngo_type );
            update_user_meta( $user_id, 'user_last_year_incom', $user_last_year_incom );
            update_user_meta( $user_id, 'user_last_year_expd', $user_last_year_expd );
            update_user_meta( $user_id, 'user_g_80', $user_g_80 );
            update_user_meta( $user_id, 'user_a_12', $user_a_12 );
            update_user_meta( $user_id, 'user_pan', $user_pan );
            update_user_meta( $user_id, 'user_tan', $user_tan );
            //update_user_meta( $user_id, 'user_ltr', $user_ltr );
            //update_user_meta( $user_id, 'user_bnfs', $user_bnfs );
            update_user_meta( $user_id, 'user_causes_for', $cuses_support_string );
            update_user_meta( $user_id, 'user_other_causes', $user_causes_other );
            update_user_meta( $user_id, 'vikkip', $random_password );
            //print_r( $_POST );
            ?><div id="signup-content" class="widecolumn formone-registraion-thankyou">
              <h1 class="thankyou-heading-h1">Thank you for Registering with us!!</h1>
               <h5>We are verifying your details and will get back to you soon!!</h5>
            </div>

            <?php
            //mail NGO after sucessfull registration.
            $emails = get_option('admin_email'); //If you want to send to site administrator, use 
            $title = get_home_url().'/ngo/'.$user_name;
            $url = get_home_url().'/ngo/'.$user_name;
            $arr_of_name = explode(' ', $user_full_name);
            $lastname = array_pop( $arr_of_name );
            global $wpdb;
            $state = $wpdb->get_results( "SELECT * FROM wp_state_city WHERE id = $user_state;");
            foreach ($state as $key ){
                $fetched_state = $key->name; 
            }
            $ngo_message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
              <meta name='viewport' content='width=device-width, initial-scale=1' />           
              <title>India Donates</title>
              <style type='text/css'>
                /* Take care of image borders and formatting, client hacks */
                img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
                a img { border: none; }
                table { border-collapse: collapse !important;}
                #outlook a { padding:0; }
                .ReadMsgBody { width: 100%; }
                .ExternalClass { width: 100%; }
                .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
                table td { border-collapse: collapse; }
                .ExternalClass * { line-height: 115%; }
                .container-for-gmail-android { min-width: 600px; }
            
            
                /* General styling */
                * {
                  font-family: Helvetica, Arial, sans-serif;
                }
            
                body {
                  -webkit-font-smoothing: antialiased;
                  -webkit-text-size-adjust: none;
                  width: 100% !important;
                  margin: 0 !important;
                  height: 100%;
                  color: #676767;
                }
            
                td {
                  font-family: Helvetica, Arial, sans-serif;
                  font-size: 14px;
                  color: #777777;
                  text-align: center;
                  line-height: 21px;
                }
            
                a {
                  color: #676767;
                  text-decoration: none !important;
                  cursor: pointer;
                }
            
                .pull-left {
                  text-align: left;
                }
            
                .pull-right {
                  text-align: right;
                }
            
                .header-lg,
                .header-md,
                .header-sm {
                  font-size: 32px;
                  font-weight: 700;
                  line-height: normal;
                  padding: 35px 0 25px;
                  color: #4d4d4d;
                }
            
                .header-md {
                  font-size: 24px;
                }
            
                .header-sm {
                  padding: 5px 0;
                  font-size: 18px;
                  line-height: 1.3;
                }
            
                .content-padding {
                  padding: 20px 0 30px;
                }
            
                .mobile-header-padding-right {
                  width: 290px;
                  text-align: right;
                  padding-left: 10px;
                }
            
                .mobile-header-padding-left {
                  width: 290px;
                  text-align: left;
                  padding-left: 10px;
                }
            
                .free-text {
                  width: 100% !important;
                  padding: 10px 60px 0px;
                }
            
                .block-rounded {
                  border-radius: 5px;
                  border: 1px solid #e5e5e5;
                  vertical-align: top;
                }
            
                .button {
                  padding: 55px 0 0;
                }
            
                .info-block {
                  padding: 0 20px;
                  width: 260px;
                }
            
                .mini-block-container {
                  padding: 30px 50px;
                  width: 500px;
                }
            
                .mini-block {
                  background-color: #ffffff;
                  width: 498px;
                  border: 1px solid #cccccc;
                  border-radius: 5px;
                  padding: 60px 75px;
                }
            
                .block-rounded {
                  width: 260px;
                }
            
                .info-img {
                  width: 258px;
                  border-radius: 5px 5px 0 0;
                }
            
                .force-width-img {
                  width: 480px;
                  height: 1px !important;
                }
            
                .force-width-full {
                  width: 600px;
                  height: 1px !important;
                }
            
                .user-img img {
                  width: 82px;
                  border-radius: 5px;
                  border: 1px solid #cccccc;
                }
            
                .user-img {
                  width: 92px;
                  text-align: left;
                }
            
                .user-msg {
                  width: 236px;
                  font-size: 14px;
                  text-align: left;
                  font-style: italic;
                }
            
                .code-block {
                  padding: 10px 0;
                  border: 1px solid #cccccc;
                  color: #4d4d4d;
                  font-weight: bold;
                  font-size: 18px;
                  text-align: center;
                }
            
                .force-width-gmail {
                  min-width:600px;
                  height: 0px !important;
                  line-height: 1px !important;
                  font-size: 1px !important;
                }
            
                 .button-width {
                  width: 228px;
                }
                .fab {
                font-family: 'Font Awesome 5 Brands' !important;
                }
                .bottom_regards {
                text-align: left;
                padding: 10px 60px 0px;
                }
              </style>
            
              <style type='text/css' media='screen'>
                @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
              </style>
            
              <style type='text/css' media='screen'>
                @media screen {
                  /* Thanks Outlook 2013! */
                  * {
                    font-family: 'Oxygen', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                  }
                }
              </style>
            
              <style type='text/css' media='only screen and (max-width: 480px)'>
                /* Mobile styles */
                @media only screen and (max-width: 480px) {
            
                  table[class*='container-for-gmail-android'] {
                    min-width: 290px !important;
                    width: 100% !important;
                  }
            
                  table[class='w320'] {
                    width: 320px !important;
                  }
            
                  img[class='force-width-gmail'] {
                    display: none !important;
                    width: 0 !important;
                    height: 0 !important;
                  }
            
                  a[class='button-width'],
                  a[class='button-mobile'] {
                    width: 248px !important;
                  }
            
                  td[class*='mobile-header-padding-left'] {
                    width: 160px !important;
                    padding-left: 0 !important;
                  }
            
                  td[class*='mobile-header-padding-right'] {
                    width: 160px !important;
                    padding-right: 0 !important;
                  }
            
                  td[class='header-lg'] {
                    font-size: 24px !important;
                    padding-bottom: 5px !important;
                  }
            
                  td[class='header-md'] {
                    font-size: 18px !important;
                    padding-bottom: 5px !important;
                  }
            
                  td[class='content-padding'] {
                    padding: 5px 0 30px !important;
                  }
            
                   td[class='button'] {
                    padding: 15px 0 5px !important;
                  }
            
                  td[class*='free-text'] {
                    padding: 10px 18px 30px !important;
                  }
            
                  img[class='force-width-img'],
                  img[class='force-width-full'] {
                    display: none !important;
                  }
            
                  td[class='info-block'] {
                    display: block !important;
                    width: 280px !important;
                    padding-bottom: 40px !important;
                  }
            
                  td[class='info-img'],
                  img[class='info-img'] {
                    width: 278px !important;
                  }
            
                  td[class='mini-block-container'] {
                    padding: 8px 20px !important;
                    width: 280px !important;
                  }
            
                  td[class='mini-block'] {
                    padding: 20px !important;
                  }
            
                  td[class='user-img'] {
                    display: block !important;
                    text-align: center !important;
                    width: 100% !important;
                    padding-bottom: 10px;
                  }
            
                  td[class='user-msg'] {
                    display: block !important;
                    padding-bottom: 20px !important;
                  }
                }
              </style>
            </head>
            
            <body bgcolor='#f7f7f7'>
            <table align='center' cellpadding='0' cellspacing='0' class='container-for-gmail-android' width='100%'>
              <tr>
                <td align='left' valign='top' width='100%' style='background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;'>
                  <center>
                  <img src='http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png' class='force-width-gmail'>
                    <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#ffffff' background='http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' style='background-color:transparent'>
                      <tr>
                        <td width='100%' height='80' valign='top' style='text-align: center; vertical-align:middle;'>
                          <center>
                            <table cellpadding='0' cellspacing='0' class='w320'>
                              <tr>
                                <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                                  <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                                </td>
                              </tr>
                            </table>
                          </center>
                          <!--[if gte mso 9]>
                          </v:textbox>
                        </v:rect>
                        <![endif]-->
                        </td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
              <tr>
                <td align='center' valign='top' width='100%' style='background-color: #f7f7f7;' class='content-padding'>
                  <center>
                    <table cellspacing='0' cellpadding='0' width='600' class='w320'>
                      <tr>
                        <td class='free-text pull-left'>
                          Dear <strong> $user_prefix_name. $user_last_name </strong>
                          <br>
                          <p>Thank you for registering at <a href='http://www.indiadonates.in'><strong>www.indiadonates.in</strong></a>. We are in a process of reviewing your details, we will get back to you for the next step shortly.</p>

                          <p>The details of your application are listed below:</p>

<table style='width: 688px; height: 311px; border: solid 2px #666; padding-left:40px;text-align:left;'>
<tbody style='text-align:left;'>
<tr style='text-align:left;'>
<td style='width: 20%;text-align:left;'>Organisation Name</td>
<td style='width: 2%;'>:</td>
<td style='width: 30%;text-align:left;'>$org_name</td>
<td style='width: 25%;text-align:left;'>Website</td>
<td style='width: 2%;'>:</td>
<td style='width: 25%;text-align:left;'>$user_website</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>State</td>
<td>:</td>
<td style='text-align:left;'>$fetched_state</td>
<td style='text-align:left;'>City</td>
<td>:</td>
<td style='text-align:left;'>$user_city</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>Full Name</td>
<td>:</td>
<td style='text-align:left;'>$user_prefix_name $user_first_name $user_last_name</td>
<td style='text-align:left;'>Designation</td>
<td>:</td>
<td style='text-align:left;'>$user_designation</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>Mobile Number</td>
<td>:</td>
<td style='text-align:left;'>$user_phone</td>
<td style='text-align:left;'>Email</td>
<td>:</td>
<td style='text-align:left;'>$user_email</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>Registered Address</td>
<td>:</td>
<td style='text-align:left;'>$user_reg_add</td>
<td style='text-align:left;'>Registration of the NGO as</td>
<td>:</td>
<td style='text-align:left;'>$user_ngo_type</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>Last Year's Income</td>
<td>:</td>
<td style='text-align:left;'>$user_last_year_incom</td>
<td style='text-align:left;'>Last Year's Expenditure</td>
<td>:</td>
<td style='text-align:left;'>$user_last_year_expd</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>80G</td>
<td>:</td>
<td style='text-align:left;'>$user_g_80</td>
<td style='text-align:left;'>12A</td>
<td>:</td>
<td style='text-align:left;'>$user_a_12</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>PAN</td>
<td>:</td>
<td style='text-align:left;'>$user_pan</td>
<td style='text-align:left;'>TAN</td>
<td>:</td>
<td style='text-align:left;'>$user_tan</td>
</tr>
<tr style='text-align:left;'>
<td style='text-align:left;'>Causes Support</td>
<td>:</td>
<td style='width: 72.9064%;text-align:left;' colspan='4'>$cuses_support_string , $user_causes_other</td>
</tr>
</tbody>
</table>
                                                
                      </p>
            
                        </td>
                      </tr>
            
                      <tr>
                        <td>
                          <div class='bottom_regards'>
                            <p>Regards,<br><strong>IndiaDonates Team</strong></p>
                            
                          </div>
                        </td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
            
              <tr>
                <td align='center' valign='top' width='100%' style='background-color: #fff; height: 100px;'>
                  <center>
                    <table cellspacing='0' cellpadding='0' width='600' class='w320'>
                      <tr>
                        <td style='padding: 25px 0 25px'>
                          <a style='margin-bottom: 10px;' href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a><br />
            
                            <div class='textwidget'><p>A-5, Sector 26, Noida<br>
                              Uttar Pradesh 201301.<br>
                              <span class='text-white'>Phone:</span><a href='tel:+91-120-4773200'> +91-120-4773200</a><br>
                              <span class='text-white'>Email:</span><a href='mailto:coordinator@indiadonates.in'> coordinator@indiadonates.in</a></p>
                            </div>
                        </td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
            </table>
            </body>
            </html>";
            $ngo_headers = 'From: Indiadonates <no-reply@indiadonates.com>' . "\r\n";
            $admin_headers = 'From: Indiadonates <no-reply@indiadonates.com>' . "\r\n";
            wp_mail( $user_email, "Thank you for registering with us", $ngo_message , $ngo_headers);

            //send mail to admin.
            $admin_message = "We have a new NGO Registration details, Please go to the admin panel and check the details.\n NGO Email: \n{$user_email}\n NGO Name:{$org_name} ";
            wp_mail(  $emails, "New NGO Registration Request: {$org_name}", $admin_message , $admin_headers);

        }  
    } else {
         ?>

        <div id="signup-content" class="widecolumn ngo_registration_main ">
        <div class="mu_register wp-signup-container">
            <form id="msform" method="post" action="#" novalidate="novalidate">
                <h3 id="text-cntr">NGO Registration Form</h3>
                <input name="stage" value="validate-user-signup" type="hidden">
                <input name="signup_form_id" value="1279894771" type="hidden">
                <input id="_signup_form" name="_signup_form" value="e460127e45" type="hidden">		    
                <fieldset>
                    <h6 class="email_exist"><?php echo $random_password = __('Email Id already registered. Please use another Email Id.'); ?></h6>
                    <div class="reg-main">
                        <div class="reg-left reg-inner-div">  		
                            <input name="org_name" class="user_name" placeholder="Organisation Name" type="text" value="<?php echo $org_name; ?>">
                        </div>
                        <div class="reg-right reg-inner-div">
                        <input name="website" id="website" placeholder="Website" value="<?php echo $user_website; ?>" maxlength="30" type="text"> 
                        </div>
                    </div>

                    <div class="reg-main">
                        <div class="reg-left reg-inner-div">
                            <?php 
                                global $wpdb;
                                $results_state = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id = 0", OBJECT );
                                //print_r($results_state);
                                ?><select name="state" id="state" class='state'>
                                <option disabled selected hidden>State</option> <?php
                                foreach( $results_state as $state ) {
                                    echo '<option  value="'.$state->id.'">'.$state->name.'</option>';

                                }
                                ?></select><?php
                            ?>
                        </div>
                        <div class="reg-right reg-inner-div">
                                <?php 
                                global $wpdb;
                                $results_city = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id != 0", OBJECT );
                                //print_r($results_state);
                                ?><select name="city" id="city" class='state' disabled="disabled">
                                <option disabled selected hidden>City</option> <?php
                                foreach( $results_city as $city ) {
                                    echo '<option id="'.$city->id.'" parent_id="'.$city->parent_id.'">'.$city->name.'</option>';

                                }
                                ?></select><?php
                            ?>
                        </div>
                    </div>
                    <div class="reg-main">
                    <div class="reg-left reg-inner-div" style="display:inline-flex;">
                        <!-- FUll Name -->
                            <select name="name_prefix" id="name-prefix" class="prefix-name">
                                <option>Mr</option>
                                <option>Ms</option>
                                <option>Dr</option> 
                            </select>
                            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $user_first_name; ?>" class="rg-first_name">
                            <input name="last_name" id="full_name" placeholder="Last Name" value="<?php echo $user_last_name; ?>" maxlength="20" type="text" class="rg-last_name">
                    <!-- End -->    
                    </div>             
                            
                        <div class="reg-right reg-inner-div">
                            <!-- designation -->
                            <input name="designation" id="degi" placeholder="Designation" value="<?php echo $user_designation; ?>" maxlength="30" type="text">    
                            <!-- End -->    
                        </div>
                    </div>

                    <div class="reg-main">
                        <div class="reg-left reg-inner-div">
                            <!-- Mobile Number-->
                            <input name="phone" id="phone" placeholder=" Mobile Number" value="<?php echo $user_phone; ?>" maxlength="20" type="text">   
                            <!-- End -->        
                        </div>

                        <div class="reg-right reg-inner-div">
                            <!-- Website -->
                            <input name="user_email" class="user_email email_exist_already" placeholder="Email" type="email">
                                                
                            <!-- End -->           
                        </div>
                    </div>

                    <div class="reg-main">
                        <div class="reg-left reg-inner-div">
                            <!-- reg-address -->
                            
                            <input name="reg_add" id="reg_add" placeholder="Registered Address" value="<?php echo $user_reg_add; ?>" maxlength="100" type="text">
                        <!-- End -->         
                        </div>
                        <div class="reg-left reg-inner-div">
                            <select name="reg_ngo" class="state" id="causes_for">
                                <option disabled selected hidden>Registration of the NGO as</option>
                                <option>Society</option>
                                <option>Trust</option>
                                <option>Companies Act</option>
                                <option>Other</option>
                            </select> 
                        <!-- End --> 
                        </div>
                    </div>   

                    <div class="reg-main">
                        <div class="reg-left reg-inner-div">
                            <!-- incom -->
                            <input name="incom" id="incom" placeholder=" Last Year's Income" value="<?php echo $user_last_year_incom; ?>" maxlength="20" type="text">
                            <!-- End --> 
                        </div>
                        <div class="reg-left reg-inner-div">
                        <!-- expd -->
                            <input name="expd" id="expd" placeholder=" Last Year's Expenditure"  value="<?php echo $user_last_year_expd; ?>" maxlength="20" type="text">
                        <!-- End -->            
                        </div>
                    </div>

                    <div class="reg-main">
                        <div class="reg-left reg-inner-div">
                        <!-- 80g -->
                            <input name="g_80" id="g_80" placeholder="80G" maxlength="" type="text" value="<?php echo $user_g_80; ?>"> 
                        <!-- End -->             
                        </div>
                        <div class="reg-left reg-inner-div">
                            <!-- 12a -->
                                <input name="a_12" id="a_12" placeholder="12A" value="<?php echo $user_a_12; ?>" maxlength="" type="text">
                            <!-- End -->
                        </div>
                    </div>

                    <div class="reg-main">
                        <div class="reg-left reg-inner-div">            
                            <!-- pan -->
                            <input name="pan" id="pan" placeholder="PAN" value="<?php echo $user_pan; ?>" maxlength="20" type="text">
                            <!-- End -->        
                        </div>
                        <div class="reg-left reg-inner-div">
                            <input name="orgname" id="orgname" placeholder="TAN " value="<?php echo $user_tan; ?>" maxlength="20" type="text"> 
                            <!-- End -->
                        </div>
                    </div>    
                    <div class="reg-main">
                        <!-- causes for -->                
                        <select class="chosen-select" tabindex="8" name="causes_for[]" id="causes_f1"  style="width:89.5%; height: 40px;" data-placeholder="Causes support" multiple="multiple">
                            <option>Education</option>
                            <option>Health</option>
                            <option>Income Generation</option>
                            <option>Water &amp; Sanitation</option>
                            <option>Disaster preparedness and response</option>
                            <option>Environment</option>
                            <option>Disability</option>
                            <option>Others</option>
                        </select>
                    </div>

                    

                <!-- End -->
                        <input name="ngo_submit" class="submit action-button" value="Submit" type="submit">

                </fieldset>
                    
            </form>
        </div>
</div>
  <?php  }

} else {
    if( is_user_logged_in()  ){
        $current_user_id = get_current_user_id();

        ?>
        <div id="signup-content" class="widecolumn ngo_registration_main">
            <div class="mu_register wp-signup-container">
                <center><h1 class='heading-ngo-notverified'>You are already logged in. If you want to register a new NGO, then please click on the Log Out link below and register the NGO.</h1></center>
                <center><a href="<?php echo wp_logout_url(); ?>"><h3 style="color:#f79800;">Log Out</h3></a></center>
            </div>
        </div>
        <?php

    }else{
?>

<div id="signup-content" class="widecolumn ngo_registration_main">
    <div class="mu_register wp-signup-container">
	    <form id="msform" method="post" action="#" novalidate="novalidate">
		    <h3 id="text-cntr">NGO Registration Form</h3>
		    <input name="stage" value="validate-user-signup" type="hidden">
            <input name="signup_form_id" value="1279894771" type="hidden">
            <input id="_signup_form" name="_signup_form" value="e460127e45" type="hidden">		    <fieldset>
    	        <div class="reg-main">
        	        <div class="reg-left reg-inner-div">  		
                        <input name="org_name" class="user_name" placeholder="Organisation Name" type="text">
      		        </div>
		            <div class="reg-right reg-inner-div">
                    <input name="website" id="website" placeholder="Website" value="" maxlength="30" type="text"> 
                    </div>
                </div>

	            <div class="reg-main">
                    <div class="reg-left reg-inner-div">
                        <?php 
                            global $wpdb;
                            $results_state = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id = 0", OBJECT );
                            //print_r($results_state);
                            ?><select name="state" id="state" class='state' value="" >
                            <option disabled selected hidden>State</option> <?php
                            foreach( $results_state as $state ) {
                                echo '<option  value="'.$state->id.'">'.$state->name.'</option>';

                            }
                            ?></select><?php
                        ?>
                    </div>
                    <div class="reg-right reg-inner-div">
                            <?php 
                            global $wpdb;
                            $results_city = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id != 0", OBJECT );
                            //print_r($results_state);
                            ?><select name="city" id="city" class='state' value="" disabled="disabled">
                            <option disabled selected hidden>City</option> <?php
                            foreach( $results_city as $city ) {
                                echo '<option id="'.$city->id.'" parent_id="'.$city->parent_id.'">'.$city->name.'</option>';

                            }
                            ?></select><?php
                        ?>
                    </div>
                </div>
                <div class="reg-main">
                    <div class="reg-left reg-inner-div" style="display:inline-flex;">
                        <!-- FUll Name -->
                            <select name="name_prefix" id="name-prefix" class="prefix-name">
                                <option>Mr</option>
                                <option>Ms</option>
                                <option>Dr</option>
                            </select>
                            <input type="text" name="first_name" placeholder="First Name" class="rg-first_name">
                            <input name="last_name" id="full_name" placeholder="Last Name" value="" maxlength="20" type="text" class="rg-last_name">
                    <!-- End -->    
                    </div>             
                        
                    <div class="reg-right reg-inner-div">
                        <!-- designation -->
                        <input name="designation" id="degi" placeholder="Designation" value="" maxlength="30" type="text">    
                        <!-- End -->    
                    </div>
                </div>

                <div class="reg-main">
                    <div class="reg-left reg-inner-div">
                        <!-- Mobile Number-->
                         <input name="phone" id="phone" placeholder=" Mobile Number" value="" maxlength="20" type="text">   
                        <!-- End -->        
                    </div>

                    <div class="reg-right reg-inner-div">
                        <!-- Website -->
                        <input name="user_email" class="user_email" placeholder="Email" type="email">
                                            
                        <!-- End -->           
                    </div>
                </div>

                <div class="reg-main">
                    <div class="reg-left reg-inner-div">
                        <!-- reg-address -->
                        
                        <input name="reg_add" id="reg_add" placeholder="Registered Address" value="" maxlength="100" type="text">
                    <!-- End -->         
                    </div>
                    <div class="reg-left reg-inner-div">
                        <select name="reg_ngo" class="state" id="causes_for">
                            <option disabled selected hidden>Registration of the NGO as</option>
                            <option>Society</option>
                            <option>Trust</option>
                            <option>Companies Act</option>
                            <option>Other</option>
                        </select> 
                    <!-- End --> 
                    </div>
                </div>   

                <div class="reg-main">
                    <div class="reg-left reg-inner-div">
                        <!-- incom -->
                        <input name="incom" id="incom" placeholder=" Last Year's Income" value="" maxlength="20" type="text">
                        <!-- End --> 
                    </div>
                    <div class="reg-left reg-inner-div">
                    <!-- expd -->
                        <input name="expd" id="expd" placeholder=" Last Year's Expenditure" value="" maxlength="20" type="text">
                    <!-- End -->            
                    </div>
                </div>

                <div class="reg-main">
                    <div class="reg-left reg-inner-div">
                    <!-- 80g -->
                         <input name="g_80" id="g_80" placeholder="80G" maxlength="" type="text"> 
                    <!-- End -->             
                    </div>
                    <div class="reg-left reg-inner-div">
                        <!-- 12a -->
                            <input name="a_12" id="a_12" placeholder="12A" value="" maxlength="" type="text">
                        <!-- End -->
                    </div>
                </div>

                <div class="reg-main">
                    <div class="reg-left reg-inner-div">            
                        <!-- pan -->
                        <input name="pan" id="pan" placeholder="PAN" value="" maxlength="20" type="text">
                        <!-- End -->        
                    </div>
                    <div class="reg-left reg-inner-div">
                        <input name="orgname" id="orgname" placeholder="TAN " value="" maxlength="20" type="text"> 
                        <!-- End -->
                    </div>
                </div>    
                <div class="reg-main">
                    <!-- causes for -->                
                    <select class="chosen-select" tabindex="8" name="causes_for[]" id="causes_f1"  style="width:89.5%; height: 40px;" data-placeholder="Causes support" multiple="multiple">
                        <option>Education</option>
                        <option>Health</option>
                        <option>Income Generation</option>
                        <option>Water &amp; Sanitation</option>
                        <option>Disaster preparedness and response</option>
                        <option>Environment</option>
                        <option>Disability</option>
                        <option>Others</option>
                    </select>
                </div>

                <div class="reg-main" id="row_dim">
                    <input type="text" name="cat_other" class="other_cat" id="txtPassportNumber" placeholder="Others Name">
                </div> 
            <!-- End -->
                    <input name="ngo_submit" class="submit action-button" value="Submit" type="submit">

            </fieldset>
                
        </form>
    </div>
</div>
<?php   
    } 
}?>
<?php get_footer(); ?>