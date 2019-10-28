<?php

$whitelistData = array(
    '127.0.0.1',
    '::1'
);
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelistData)){
$user_ip = trim($_SERVER['REMOTE_ADDR']);
$access_url = "http://api.ipstack.com/";
$iptkey='cf38b009dd901b360ad6e720d197c082';
//$iptkey='352ca00b089f930914854aee9e9c97af';

$access_key = "?access_key=".$iptkey;
$ip_data = json_decode(file_get_contents($access_url . $user_ip . $access_key), true);
$userip=$ip_data['ip'];

$ipaddress = $ip_data['ip'];
$continent_name = $ip_data['continent_name'];
$country_name = $ip_data['country_name'];
$region_name = $ip_data['region_name'];
$city = $ip_data['city'];
$zip = $ip_data['zip'];
$latitude = $ip_data['latitude'];
$longitude = $ip_data['longitude'];
$country_flag = $ip_data['location']['country_flag'];
global $wpdb;

if ( ! is_admin() ) {
  if(isset($ipaddress)){

    $wpdb->insert(
    	'wp_user_ipdata',
    	array(
    		'ip_address' => $ipaddress,
    		'continent_name' => $continent_name,
    		'country_name' => $country_name,
    		'region_name' => $region_name,
    		'city' => $city,
    		'zip' => $zip,
    		'latitude' => $latitude,
    		'longitude' => $longitude,
    		'country_flag' => $country_flag,
    	)
    );
  }


}


}




function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'fundrize-style' for the Fundrize theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
   // wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style( 'bx_slider-style',get_stylesheet_directory_uri() . '/css/jquery.bxslider.css', array( $parent_style ),wp_get_theme()->get('Version'));

    //mulitpal section css for causes.
    wp_enqueue_style( 'choosen-css', 'https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css' );

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function wp_enqueue_custom_script() {
    /*
    wp_deregister_script( 'jquery' );
	  wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js');
    */
	//wp_enqueue_script( 'jQuery-owlcar', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array( 'jquery' ), '1.0', false );
      wp_enqueue_script( 'child-custom-validate-script', get_stylesheet_directory_uri() . '/js/reg-form-validate.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jQuery-owlcar', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js',null, null);
      wp_enqueue_script( 'child-custom-script', get_stylesheet_directory_uri() . '/js/registration.js', array( 'jquery' ), '1.0', true );
      wp_enqueue_script( 'child-ddtf-script', get_stylesheet_directory_uri() . '/js/ddtf.js', array( 'jquery' ), '1.0', true );
     // wp_register_script( 'jQuery-main', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', null, null, true );
    wp_enqueue_script( 'jQuery-multipage', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'jQuery-validation', 'https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js', array( 'jquery' ), null, true );
    //wp_enqueue_script( 'jQuery-owlcar', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array( 'jquery' ), null, true );
    wp_enqueue_script( 'bx_slider', get_stylesheet_directory_uri() . '/js/jquery.bxslider.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'jsmeter', get_stylesheet_directory_uri() . '/js/jqmeter.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'chosen-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js', array( 'jquery' ), null, true );
   // wp_enqueue_script( 'chosen-main-jquery', 'http://code.jquery.com/jquery-1.9.1.js', array( 'jquery' ), null, true );
     //wp_enqueue_script('validate');



}
add_action('wp_enqueue_scripts', 'wp_enqueue_custom_script');

//Code for custom registrations

//add_action( 'signup_extra_fields' , 'custom_signup_extra_fields' );

function custom_signup_extra_fields( $errors ) {

    $stage = isset( $_POST['stage'] ) ?  $_POST['stage'] : 'default';

     $full_name = $phone = $orgname = $city =$state = $reg_add = $reg_ngo = $pan = $a_12 = $g_80 =  $ltr = $bnfs = $incom = $expd = $causes_for = $web = $cdeg = '';

    if( $stage == 'validate-user-signup' ) {

        $result = validate_user_form();

        $full_name = $result['full_name'];
        $phone = $result['phone'];
        $orgname  = $result['orgname'];
        $city = $result['city'];
        $state = $result['state'];
        $reg_add = $result['reg_add'];
        $reg_ngo = $result['reg_ngo'];
        $pan = $result['pan'];
        $a_12 = $result['a_12'];
        $g_80 = $result['a_12'];
        $ltr = $result['ltr'];
        $incom = $result['incom'];
        $bnfs = $result['bnfs'];
        $expd= $result['expd'];
        $causes_for = $result['causes_for'];
        $web = $result['website'];
        $cdeg = $result['designation'];
    }

?>
 <!-- org name -->
    <?php if ( $errmsg = $errors->get_error_message( 'orgname' ) ) : ?>
        <p class="error"><?php echo $errmsg; ?></p>
    <?php endif; ?>
    <div class="reg-main">
        <div class="reg-left reg-inner-div">

             <input name="orgname" type="text" id="orgname" placeholder="Legal Name " value="<?php echo esc_attr( $orgname ); ?>" maxlength="20">
              <!-- FUll Name -->

            <?php if ( $errmsg = $errors->get_error_message( 'full_name' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
        <!-- End -->

        <div class="reg-right reg-inner-div">


            <input name="full_name" type="text" id="full_name" placeholder="Contact Person Name" value="<?php echo esc_attr( $full_name ); ?>" maxlength="20">
        <!-- End -->

        <!-- Website -->
            <?php if ( $errmsg = $errors->get_error_message( 'designation' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="reg-main">
        <div class="reg-left reg-inner-div">

            <input name="designation" type="text" id="degi" placeholder="Designation" value="<?php echo esc_attr(  $cdeg ); ?>" maxlength="30">

            <!-- End -->

            <!-- Website -->
                <?php if ( $errmsg = $errors->get_error_message( 'website' ) ) : ?>
                    <p class="error"><?php echo $errmsg; ?></p>
                <?php endif; ?>
        </div>

        <div class="reg-right reg-inner-div">

            <input name="website" type="text" id="website" placeholder="Website" value="<?php echo esc_attr( $web ); ?>" maxlength="30">

            <!-- End -->

            <!-- Mobile Number-->
                <?php if ( $errmsg = $errors->get_error_message( 'phone' ) ) : ?>
                    <p class="error"><?php echo $errmsg; ?></p>
                <?php endif; ?>
        </div>
    </div>

    <div class="reg-main">
        <div class="reg-left reg-inner-div">

            <input name="phone" type="text" id="phone" placeholder=" Mobile Number" value="<?php echo esc_attr( $phone ); ?>" maxlength="20">
            <?php //_e( '(Must be at least 10 characters, numbers only.)' ); ?>
        <!-- End -->

        <!-- reg-address -->

            <?php if ( $errmsg = $errors->get_error_message( 'reg_add' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
        <div class="reg-left reg-inner-div">

            <input name="reg_add" type="text" id="reg_add" placeholder="Registerd Address" value="<?php echo esc_attr( $reg_add ); ?>" maxlength="100">
        <!-- End -->

        <!-- state -->

            <?php if ( $errmsg = $errors->get_error_message( 'state' ) ) : ?>
            <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="reg-main">
        <div class="reg-left reg-inner-div">
            <?php
                global $wpdb;
                $results_state = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id = 0", OBJECT );
                //print_r($results_state);
                ?><select name="state" id="state" class='state' value="" >
                <option>Select State</option> <?php
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
                <option>Select City</option> <?php
                foreach( $results_city as $city ) {
                     echo '<option id="'.$city->id.'" parent_id="'.$city->parent_id.'">'.$city->name.'</option>';

                }
                ?></select><?php
            ?>
        </div>
    </div>

     <div class="reg-main">
        <div class="reg-left reg-inner-div">

            <select name="reg_ngo" class="state" id="causes_for" >
                <option>Trust</option>
                <option>Company</option>
                <option>Trust and company Both</option>
            </select>

        <!-- End -->

        <!-- pan -->

            <?php if ( $errmsg = $errors->get_error_message( 'pan' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
        <div class="reg-left reg-inner-div">

            <input name="pan" type="text" id="pan" placeholder="PAN" value="<?php echo esc_attr( $pan ); ?>" maxlength="20">

            <!-- End -->

            <!-- expd -->

            <?php if ( $errmsg = $errors->get_error_message( 'expd' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="reg-main">
        <div class="reg-left reg-inner-div">

            <input name="expd" type="text" id="expd" placeholder=" Last Year Expenditure" value="<?php echo esc_attr( $expd ); ?>" maxlength="20">

        <!-- End -->
        <!-- incom -->

            <?php if ( $errmsg = $errors->get_error_message( 'incom' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
        <div class="reg-left reg-inner-div">

            <input name="incom" type="text" id="incom" placeholder=" Last Year Incom" value="<?php echo esc_attr( $incom ); ?>" maxlength="20">

            <!-- End -->

            <!-- ltr -->

            <?php if ( $errmsg = $errors->get_error_message( 'ltr' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="reg-main">
        <div class="reg-left reg-inner-div">

            <input name="ltr" type="text" id="ltr" placeholder="Last year turnover" value="<?php echo esc_attr( $ltr ); ?>" maxlength="20">

        <!-- End -->

        <!-- no.of bnfs -->

            <?php if ( $errmsg = $errors->get_error_message( 'bnfs' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>
            <?php endif; ?>
        </div>
        <div class="reg-left reg-inner-div">

           <input name="bnfs" type="number" id="bnfs" placeholder="No. Of Banificeries" value="<?php echo esc_attr( $bnfs ); ?>" maxlength="200">

            <!-- End -->

        <!-- 12a -->
            <?php if ( $errmsg = $errors->get_error_message( 'a_12' ) ) : ?>
                <p class="error"><?php echo $errmsg; ?></p>

            <?php endif; ?>

        </div>
    </div>

    <div class="reg-main">
        <div class="reg-left reg-inner-div">


            <input name="a_12" type="text" id="a_12" placeholder="12A Number" value="<?php echo esc_attr( $a_12 ); ?>" maxlength="20">
            <!-- End -->


        </div>
        <div class="reg-left reg-inner-div">

           <input name="g_80" type="text" id="g_80" placeholder="80G Number"<?php echo esc_attr( $ltr ); ?>" maxlength="20">
<!-- 80g -->

                <?php if ( $errmsg = $errors->get_error_message( 'g_80' ) ) : ?>
                    <label class="error"><?php echo $errmsg; ?></label>
                <?php endif; ?>
            <!-- End -->



            <!-- causes for -->

                <?php if ( $errmsg = $errors->get_error_message( 'causes_for' ) ) : ?>
                    <p class="error"><?php echo $errmsg; ?></p>
                <?php endif; ?>

        </div>
    </div>
    <div class="reg-main">
        <select name="causes_for" id="#" style="width:89.5%; height: 40px;">
            <option>Projects</option>
            <option>Education</option>
            <option>Health</option>
            <option>Income Generation</option>
            <option>Water & Sanitation</option>
            <option>Disaster preparedness and response</option>
            <option>Environment</option>
            <option>Disability</option>
            <option>Women</option>
        </select>
    </div>

<!-- End -->
    	<input type="submit" name="submit" class="submit action-button" value="Submit" />

    </fieldset>

<?php

}

add_filter( 'wpmu_validate_user_signup' , 'custom_wpmu_validate_user_signup' );

function custom_wpmu_validate_user_signup( $result ) {

    $phone = '';

    if( !empty( $_POST['phone'] ) ) {

        $phone = sanitize_text_field( $_POST['phone'] );

    }

    //extra
    $orgname = '';

    if( !empty( $_POST['orgname'] ) ) {

        $orgname = sanitize_text_field( $_POST['orgname'] );

    }
     $full_name = '';

    if( !empty( $_POST['full_name'] ) ) {

        $full_name = sanitize_text_field( $_POST['full_name'] );

    }
        $city = '';

    if( !empty( $_POST['city'] ) ) {

        $city = sanitize_text_field( $_POST['city'] );

    }
        $state = '';

    if( !empty( $_POST['state'] ) ) {

        $state = sanitize_text_field( $_POST['state'] );

    }

    $reg_add = '';
    if( !empty( $_POST['reg_add'] ) ) {

        $reg_add = sanitize_text_field( $_POST['reg_add'] );

    }

    $reg_ngo = '';
    if( !empty( $_POST['reg_ngo'] ) ) {

        $reg_ngo = sanitize_text_field( $_POST['reg_ngo'] );

    }
    $pan = '';
    if( !empty( $_POST['pan'] ) ) {

        $pan = sanitize_text_field( $_POST['pan'] );

    }
    $a_12 = '';

    if( !empty( $_POST['a_12'] ) ) {

        $a_12 = sanitize_text_field( $_POST['a_12'] );

    }
    $g_80 = '';
    if( !empty( $_POST['g_80'] ) ) {

        $g_80 = sanitize_text_field( $_POST['g_80'] );

    }

    $ltr = '';
    if( !empty( $_POST['ltr'] ) ) {

        $ltr = sanitize_text_field( $_POST['ltr'] );

    }
     $bnfs = '';
    if( !empty( $_POST['bnfs'] ) ) {

        $bnfs = sanitize_text_field( $_POST['bnfs'] );

    }
    $incom = '';
    if( !empty( $_POST['incom'] ) ) {

        $incom = sanitize_text_field( $_POST['incom'] );

    }
    $expd = '';
    if( !empty( $_POST['expd'] ) ) {

        $expd = sanitize_text_field( $_POST['expd'] );

    }

    $causes_for = '';
    if( !empty( $_POST['causes_for'] ) ) {

        $causes_for = sanitize_text_field( $_POST['causes_for'] );

    }
    $web = '';
    if( !empty( $_POST['website'] ) ) {

        $web = sanitize_text_field( $_POST['website'] );

    }
    $cdeg = '';
    if( !empty( $_POST['designation'] ) ) {

        $cdeg  = sanitize_text_field( $_POST['designation'] );

    }


    //end


    if ( empty( $phone ) ) {

        $result['errors']->add( 'phone' , __( 'Please enter a Phone.' ) );

    } elseif( ! preg_match( '/^[0-9]*$/', $phone ) ) {

        $result['errors']->add( 'phone' , __( 'Sorry, Phone must be number only!' ) );

    } elseif( strlen( $phone ) < 10 ) {

        $result['errors']->add( 'phone' , __( 'Phone must be at least 10 characters.' ) );

    }
    //extra
     if ( empty( $orgname ) ) {

        $result['errors']->add( 'orgname' , __( 'Please enter the Organisation Name.' ) );

    }
     if ( empty( $full_name ) ) {

        $result['errors']->add( 'full_name' , __( 'Please enter Your Full Name.' ) );

    }

     if ( empty( $city ) ) {

        $result['errors']->add( 'city' , __( 'Please enter city name.' ) );

    }
     if ( empty( $state ) ) {

        $result['errors']->add( 'state' , __( 'Please enter state Name.' ) );

    }

    if ( empty( $reg_add ) ) {

        $result['errors']->add( 'reg_add' , __( 'Please enter registration address.' ) );

    }
    if ( empty( $reg_ngo ) ) {

        $result['errors']->add( 'reg_ngo' , __( 'Please fill the field.' ) );

    }
    if ( empty( $pan ) ) {

        $result['errors']->add( 'pan' , __( 'Please enter pan detail.' ) );

    }

    if ( empty( $a_12 ) ) {

        $result['errors']->add( 'a_12' , __( 'Please enter 12A number.' ) );

    }
     if ( empty( $g_80 ) ) {

        $result['errors']->add( 'g_80' , __( 'Please enter 80G number.' ) );

    }

    if ( empty( $ltr ) ) {

        $result['errors']->add( 'ltr' , __( 'Please enter last year transaction.' ) );

    }
    if ( empty( $incom ) ) {

        $result['errors']->add( 'incom' , __( 'Please enter incom.' ) );

    }

     if ( empty( $bnfs ) ) {

        $result['errors']->add( 'bnfs' , __( 'Please enter The Number of Banificeries.' ) );

    }
    if ( empty( $expd ) ) {

        $result['errors']->add( 'expd' , __( 'Please enter Expenditure.' ) );

    }

    if ( empty( $causes_for ) ) {

        $result['errors']->add( 'causes_for' , __( 'Please enter causes.' ) );

    }
      //end
      $result['full_name'] = $full_name;
      $result['phone'] = $phone;
      $result['orgname'] = $orgname;
      $result['city'] = $city;
      $result['state'] = $state;
      $result['reg_add'] = $reg_add;
      $result['reg_ngo'] = $reg_ngo;
      $result['pan'] = $pan;
      $result['a_12'] = $a_12;
      $result['g_80'] = $g_80;
      $result['ltr'] = $ltr;
      $result['incom'] = $incom;
      $result['bnfs'] = $bnfs;
      $result['expd'] = $expd;
      $result['causes_for'] = $causes_for;
      $result['website'] = $web;
      $result['designation'] = $cdeg;
	 return $result;

}

add_action( 'signup_blogform' , 'custom_signup_blogforms' );

function custom_signup_blogforms( $errors ) {

    $stage = isset( $_POST['stage'] ) ?  $_POST['stage'] : 'default';

    $result = validate_user_form();

   $full_name = $phone = $orgname = $city =$state = $reg_add = $reg_ngo = $pan = $a_12 = $g_80 =  $ltr = $incom = $bnfs = $expd = $causes_for =  $web = $cdeg = '';

    if( !empty( $result['phone'] ) ) {

        $phone = $result['phone'];

    }

    /* extra field*/

    if( !empty( $result['orgname'] ) ) {

        $orgname = $result['orgname'];

    }

     if( !empty( $result['full_name'] ) ) {

        $full_name = $result['full_name'];

    }


    if( !empty( $result['city'] ) ) {

        $city = $result['city'];

    }

    if( !empty( $result['state'] ) ) {

        $state = $result['state'];

    }

    if( !empty( $result['reg_add'] ) ) {

        $reg_add = $result['reg_add'];

    }

    if( !empty( $result['reg_ngo'] ) ) {

        $reg_ngo = $result['reg_ngo'];

    }
    if( !empty( $result['pan'] ) ) {

        $pan = $result['pan'];

    }

    if( !empty( $result['a_12'] ) ) {

        $a_12 = $result['a_12'];

    }
    if( !empty( $result['g_80'] ) ) {

        $g_80 = $result['g_80'];

    }

    if( !empty( $result['ltr'] ) ) {

        $ltr = $result['ltr'];

    }

    if( !empty( $result['incom'] ) ) {

        $incom = $result['incom'];

    }
       if( !empty( $result['bnfs'] ) ) {

        $bnfs = $result['bnfs'];

    }

    if( !empty( $result['expd'] ) ) {

        $expd = $result['expd'];

    }

    if( !empty( $result['causes_for'] ) ) {

        $causes_for = $result['causes_for'];

    }

     if( !empty( $result['website'] ) ) {

        $web = $result['website'];

    }
     if( !empty( $result['designation'] ) ) {

        $cdeg = $result['designation'];

    }


    /*end */
   // $blogdescription = $site_category = $site_text_option = '';
    //$site_checkbox_options = array();

    /*if( $stage == 'validate-blog-signup' ) {

        $result_blog = validate_blog_form();

        $blogdescription = $result_blog['blogdescription'];
        $site_category = $result_blog['site_category'];
        $site_text_option = $result_blog['site_text_option'];
        $site_checkbox_options = $result_blog['site_checkbox_options'];

    }*/

?>

    <input type="hidden" name="phone" value="<?php echo esc_attr( $phone ) ?>" />
    <!-- new field -->
    <input type="hidden" name="orgname" value="<?php echo esc_attr( $orgname ) ?>" />
    <input type="hidden" name="full_name" value="<?php echo esc_attr( $full_name ) ?>" />
    <input type="hidden" name="city" value="<?php echo esc_attr( $city ) ?>" />
    <input type="hidden" name="state" value="<?php echo esc_attr( $state ) ?>" />
    <input type="hidden" name="reg_add" value="<?php echo esc_attr( $reg_add ) ?>" />
    <input type="hidden" name="reg_ngo" value="<?php echo esc_attr( $reg_ngo ) ?>" />
    <input type="hidden" name="pan" value="<?php echo esc_attr( $pan ) ?>" />
    <input type="hidden" name="a_12" value="<?php echo esc_attr( $a_12 ) ?>" />
    <input type="hidden" name="g_80" value="<?php echo esc_attr( $g_80 ) ?>" />
    <input type="hidden" name="ltr" value="<?php echo esc_attr( $ltr ) ?>" />
    <input type="hidden" name="incom" value="<?php echo esc_attr( $incom ) ?>" />
    <input type="hidden" name="bnfs" value="<?php echo esc_attr( $bnfs ) ?>" />
    <input type="hidden" name="expd" value="<?php echo esc_attr( $expd ) ?>" />
    <input type="hidden" name="causes_for" value="<?php echo esc_attr( $causes_for ) ?>" />
    <input type="hidden" name="web" value="<?php echo esc_attr( $web ) ?>" />
    <input type="hidden" name="designation" value="<?php echo esc_attr( $cdeg ) ?>" />


    <!-- end -->

   <!--  <label for="blogdescription"></label>
    <input name="blogdescription" type="text" id="blogdescription" value=" " /><br /> -->


    <!-- <label for="site_category"><?php //_e( 'Site Category:' ) ?></label>

    <?php //if ( $errmsg = $errors->get_error_message( 'site_category' ) ) : ?>
        <p class="error"><?php //echo $errmsg; ?></p>
    <?php //endif; ?> -->

    <?php
    /*$categories = array(
        'business' => __( 'Business' ),
        'foods' => __( 'Foods' ),
        'health' => __( 'Health' ),
        'ourdoor' => __( 'Ourdoor' ),
        'other' => __( 'Other' ),
    );*/
    ?>
    <!-- <select name="site_category" id="site_category">
        <?php //foreach( $categories as $key => $category ) : ?>
            <option value="<?php //echo $key; ?>" <?php //selected( $site_category , $key ); ?>><?php //echo $category; ?></option>
        <?php //endforeach; ?>
    </select><br />
    <?php //_e( '(Must be choose.)' ); ?> -->


    <!-- <label for="site_text_option"><?php ///_e( 'Site Text Option:' ) ?></label>

    <?php //if ( $errmsg = $errors->get_error_message( 'site_text_option' ) ) : ?>
        <p class="error"><?php //echo $errmsg; ?></p>
    <?php //endif; ?>

    <input name="site_text_option" type="text" id="site_text_option" value="<?php //echo esc_attr( $site_text_option ); ?>" /><br />
    <?php //_e( '(Must be input.)' ); ?>


    <p style="text-transform: uppercase; font-size: 1.4rem; color: rgba(51, 51, 51, 0.7); font-weight: 700; margin: 2em 0 0;"><?php //_e( 'Site Checkbox Option:' ) ?></p>

    <?php //if ( $errmsg = $errors->get_error_message( 'site_checkbox_options' ) ) : ?>
        <p class="error"><?php //echo $errmsg; ?></p>
    <?php //endif; ?>

    <?php
   /* $checkboxes = array(
        'option1' => __( 'Option 1' ),
        'option2' => __( 'Option 2' ),
        'option3' => __( 'Option 3' ),
    );*/
    ?>
    <?php //foreach( $checkboxes as $key => $checkbox ) : ?>
        <!-- <label style="text-transform: none;"><input type="checkbox" name="site_checkbox_options[]" value="<?php //echo $key; ?>" <?php //checked( in_array( $key , $site_checkbox_options ) , 1 ); ?> /> <?php //echo $checkbox; ?></label> -->
    <?php //endforeach; ?>
    <br />
    <?php //_e( '(Must be choose and you can select multiple.)' ); ?>

<?php

}

//add_action( 'wpmu_validate_blog_signup' , 'custom_wpmu_validate_blog_signup' );

function custom_wpmu_validate_blog_signup( $result ) {

    $blogdescription = '';

    if( !empty( $_POST['blogdescription'] ) ) {

        $blogdescription = sanitize_text_field( $_POST['blogdescription'] );

    }

    $site_category = '';

    if( !empty( $_POST['site_category'] ) ) {

        $site_category = sanitize_text_field( $_POST['site_category'] );

    }

    $site_text_option = '';

    if( !empty( $_POST['site_text_option'] ) ) {

        $site_text_option = sanitize_text_field( $_POST['site_text_option'] );

    }

    $site_checkbox_options = array();

    if( !empty( $_POST['site_checkbox_options'] ) && is_array( $_POST['site_checkbox_options'] ) ) {

        foreach( $_POST['site_checkbox_options'] as $key => $val ) {

            if( ! is_string( $val ) ) {

                continue;

            }
            $key = sanitize_text_field( $key );
            $val = sanitize_text_field( $val );

            $site_checkbox_options[ $key ] = $val;

        }

    }

    if ( empty( $site_category ) ) {

        $result['errors']->add( 'site_category' , __( 'Please choose a Site Category.' ) );

    }

    if ( empty( $site_text_option ) ) {

        $result['errors']->add( 'site_text_option' , __( 'Please enter a Site Text Option.' ) );

    }

    if ( empty( $site_checkbox_options ) ) {

        $result['errors']->add( 'site_checkbox_options' , __( 'Please choose a Site Checkbox Options.' ) );

    }


    $result['blogdescription'] = $blogdescription;
    $result['site_category'] = $site_category;
    $result['site_text_option'] = $site_text_option;
    $result['site_checkbox_options'] = $site_checkbox_options;

    return $result;

}

add_filter( 'add_signup_meta' , 'custom_add_signup_meta' );

function custom_add_signup_meta( $meta ) {

    $result_user = validate_user_form();
    $result_blog = validate_blog_form();

    $user_meta = array(
        'phone' => $result_user['phone'],
        'orgname' => $result_user['orgname'],
        'full_name' => $result_user['full_name'],
        'city' => $result_user['city'],
        'state' => $result_user['state'],
        'reg_add' => $result_user['reg_add'],
        'reg_ngo' => $result_user['reg_ngo'],
        'pan' => $result_user['pan'],
        'a_12' => $result_user['a_12'],
        'g_80' => $result_user['g_80'],
        'ltr' => $result_user['ltr'],
        'incom' => $result_user['incom'],
        'bnfs' => $result_user['bnfs'],
        'expd' => $result_user['expd'],
        'causes_for' => $result_user['causes_for'],
        'web' => $result_user['web'],
        'designation' => $result_user['designation'],
    );

    $meta['user_meta'] = $user_meta;

    //$meta['blogdescription'] = $result_blog['blogdescription'];
    //$meta['site_category'] = $result_blog['site_category'];
    //$meta['site_text_option'] = $result_blog['blogdescription'];
    //$meta['site_checkbox_options'] = $result_blog['site_checkbox_options'];

    return $meta;

}

add_action( 'wpmu_activate_blog' , 'custom_wpmu_activate_blog' , 10 , 5 );

function custom_wpmu_activate_blog( $blog_id , $user_id , $password , $site_title , $meta ) {

    update_user_option( $user_id , 'phone' , $meta['user_meta']['phone'] , true );
    update_user_option( $user_id , 'orgname' , $meta['user_meta']['orgname'] , true );
    update_user_option( $user_id , 'full_name' , $meta['user_meta']['full_name'] , true );
    update_user_option( $user_id , 'city' , $meta['user_meta']['city'] , true );
    update_user_option( $user_id , 'state' , $meta['user_meta']['state'] , true );
    update_user_option( $user_id , 'reg_add' , $meta['user_meta']['reg_add'] , true );
    update_user_option( $user_id , 'reg_ngo' , $meta['user_meta']['reg_ngo'] , true );
    update_user_option( $user_id , 'pan' , $meta['user_meta']['pan'] , true );
    update_user_option( $user_id , 'a_12' , $meta['user_meta']['a_12'] , true );
    update_user_option( $user_id , 'g_80' , $meta['user_meta']['g_80'] , true );
    update_user_option( $user_id , 'ltr' , $meta['user_meta']['ltr'] , true );
    update_user_option( $user_id , 'incom' , $meta['user_meta']['incom'] , true );
    update_user_option( $user_id , 'bnfs' , $meta['user_meta']['bnfs'] , true );
    update_user_option( $user_id , 'expd' , $meta['user_meta']['expd'] , true );
    update_user_option( $user_id , 'causes_for' , $meta['user_meta']['causes_for'] , true );
    update_user_option( $user_id , 'web' , $meta['user_meta']['web'] , true );
    update_user_option( $user_id , 'designation' , $meta['user_meta']['designation'] , true );


    switch_to_blog( $blog_id );

    delete_option( 'user_meta' );

    restore_current_blog();

}

add_filter( 'user_contactmethods' , 'custom_user_contactmethods' , 10 , 2 );

function custom_user_contactmethods( $methods , $user ) {

    $methods['phone'] = __( 'Phone' );

    return $methods;

}

// Code to redirect the login and hide the assess for ngos

function your_function( $user_login, $user ) {

    if ( is_a( $user, 'WP_User' ) ) {

        if ( isset( $user->roles ) && is_array( $user->roles ) ) {
            //echo '<pre>';print_r($user);echo '</pre>'; die();
            if ( in_array('administrator', $user->roles ) ) {
                // redirect them to the default place
                wp_redirect( admin_url() );
                exit();
            } else if ( in_array( 'ngo_charitable', $user->roles ) ) {
                // redirect them to the default place
                wp_redirect( admin_url('/admin.php?page=ngo_profile_form') );
                exit();
            } else if ( in_array( 'donors', $user->roles ) ) {
                // redirect them to the default place
                wp_redirect( home_url('/profile/$user->user_login') );
                exit();
            } else {
                wp_redirect( home_url() );
                exit();
            }
        } else {
            wp_redirect( home_url() );
                exit();
        }
    } else {
        wp_redirect( home_url() );
        exit();
    }

}

//add_action('wp_login', 'your_function', 10, 2);

//add_filter('login_redirect', 'tbs_redirect_user_to_request', 10, 3);


//Redirecting the user on the same page after login.
/*$user_id = get_current_user_id();
$user_meta = get_userdata( $user_id );
$user_roles = $user_meta->roles;
if ( in_array("subscriber", $user_roles) || in_array("donor", $user_role ) ){
    function tbs_redirect_user_to_request( $redirect_to, $request, $user ){
        // instead of using $redirect_to we're redirecting back to $request
        return $request;
    }


}
add_filter('login_redirect', 'tbs_redirect_user_to_request', 10, 3);*/

function primary_login_redirect( $redirect_to, $request_redirect_to, $user ) {

   // $user_id = get_current_user_id();
    //$user_details =  get_userdata( $user_id );
    //echo '<pre>';print_r($user_details);echo '</pre>';
    //global $user;
    //echo $request_redirect_to;
    //echo '<pre>';print_r($user);echo '</pre>';
    if ( is_a( $user, 'WP_User' ) ) {
        //$redirect_to = home_url();

       // if ( isset( $user->caps ) && is_array( $user->caps ) ) {
           // print_r($user->caps['donor']); //die();
            if( $user->caps['administrator'] == 1 ) {
                return admin_url(); //echo "Administrator"; die();
            } else if( $user->caps['ngo_charitable'] == 1 ) {
                return admin_url('/admin.php?page=ngo_profile_form'); //echo "Ngo"; die();
            } else if ( $user->caps['donor'] == 1 || $user->caps['subscriber'] == 1 ) {
                return $request_redirect_to; //echo "donor"; die();
            } else {
                return home_url();
            }

            //echo '<pre>';print_r($user);echo '</pre>'; die();
           /* if ( in_array('administrator', $user->roles ) ) {
                // redirect them to the default place
                //$user->roles;

                return admin_url();
            } else if ( in_array( 'ngo_charitable', $user->roles ) ) {
                // redirect them to the default place
                return admin_url('/admin.php?page=ngo_profile_form');
            } else if ( in_array("subscriber", $user->roles) || in_array("donor", $user->roles ) ){
                // redirect them to the default place
                return $request_redirect_to;
            } else {
                return home_url();
            }*/
       /* } else {
            return $request_redirect_to;echo "2nd if else"; die();
        }*/
    } else {
        return $request_redirect_to;//echo "1st if else"; die();
    }
}
add_filter( 'login_redirect', 'primary_login_redirect', 1000, 3 );

add_action( 'wp_logout', 'auto_redirect_external_after_logout');
function auto_redirect_external_after_logout(){
  wp_redirect( home_url() );
  exit();
}


// Remove the menu iteam if user is not able to edit
/*function ngo_remove_menu_pages() {
    remove_menu_page( 'charitable' );    //charitable

}
function my_remove_menu_pages() {
    remove_menu_page( 'index.php' );                  //Dashboard
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_submenu_page( 'charitable', 'charitable-settings' );
};
function admin_css(){

    echo '<style>';
        echo '.updated{display:none}';
     echo '</style>';
      //Hide Featured title
     echo '<style>';
     echo '#featured-title { display: none; }';
     echo '</style>';

}
add_action('init', 'tbs_add_init_hook');
function tbs_add_init_hook() {
    if( ! is_super_admin() ){
        add_action( 'admin_menu', 'my_remove_menu_pages' );
        add_action('admin_head','admin_css');
    }
    global $wpdb;
    $cid =  get_current_user_id();
    $table_name = "wp_ngo_profile";
    $sta = "";
    $result = $wpdb->get_results( "SELECT * FROM $table_name where ng_id = '$cid'" );
    foreach ($result as $key ) {
        $sta = $key->approval_status;
    }
        print_r($sta);
     if( ! is_super_admin() && $sta == "no" || $sta == "" ){
        add_action( 'admin_menu', 'ngo_remove_menu_pages' );

     }
}*/

// Remove the menu iteam if user is not able to edit
add_action('init', 'remove_backend_pages', 1);
function  remove_backend_pages() {
    if(is_user_logged_in()) {
        $user_meta = get_userdata( get_current_user_id() );
        $user_roles = $user_meta->roles;
        //print_r ( $user_roles );
        if (in_array( "ngo_charitable", $user_roles) ) {

           add_action( 'admin_menu', 'my_remove_menu_pages');

            function my_remove_menu_pages() {
                remove_menu_page( 'index.php' );                  //Dashboard
                remove_menu_page( 'edit.php' );                   //Posts
                //remove_menu_page( 'upload.php' );                 //Media
                remove_menu_page( 'edit-comments.php' );          //Comments
                remove_menu_page( 'themes.php' );                 //Appearance
                remove_menu_page( 'users.php' );                  //Users
                remove_menu_page( 'tools.php' );                  //Tools
                remove_menu_page( 'options-general.php' );
                remove_menu_page( 'profile.php' );                //profiles page.
                remove_menu_page( 'plugins.php' );                //Plugins
                //remove_menu_page( 'edit.php?post_type=page' );    //Pages
                remove_menu_page( 'edit.php?post_type=member' ); //members
                remove_menu_page( 'edit.php?post_type=partner' ); //partner
                //remove_submenu_page( 'charitable', 'charitable-settings' );
                remove_menu_page( 'vc-general' );
                remove_menu_page( 'vc-welcome' );
                remove_menu_page( 'heateor-ss-general-options' );
                remove_submenu_page( 'charitable', 'edit-tags.php?taxonomy=campaign_category&post_type=campaign' );
                remove_submenu_page( 'galleries', 'edit-tags.php?taxonomy=gallery_category&post_type=gallery' );
                remove_submenu_page( 'charitable', 'charitable' );
                remove_menu_page( 'wpcf7' );  //Contact form 7.
                remove_menu_page( 'edit.php?post_type=gallery' );
            }

            add_action('admin_head','admin_css');
            function admin_css(){

                echo '<style>';
                echo '.updated{display:none}';
                echo '</style>';

                    //Hide admin baar

                //Hide Featured title
                    echo '<style>';
                    echo '#featured-title { display: none; }';
                    echo '</style>';
            }
            add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );

                function remove_wp_nodes() {
                    global $wp_admin_bar;
                    $wp_admin_bar->remove_node( 'new-post' );
                    $wp_admin_bar->remove_node( 'new-link' );
                    $wp_admin_bar->remove_node( 'new-media' );
                    $wp_admin_bar->remove_node( 'comments' );
                    $wp_admin_bar->remove_node( 'wp-logo' );
                    //$wp_adminbar->remove_node('customize');
                    $wp_admin_bar->remove_node( 'edit' );
                }
                function tbs_remove_new_content(){
                    global $wp_admin_bar;
                    $wp_admin_bar->remove_menu( 'new-content' );
                }
                add_action( 'wp_before_admin_bar_render', 'tbs_remove_new_content' );

                add_action( 'admin_bar_menu', 'remove_my_account', 999 );
                    function remove_my_account( $wp_admin_bar ) {
                        $wp_admin_bar->remove_node( 'my-account' );

                    }


                    add_action( 'admin_bar_menu', 'add_logout', 999 );
                    function add_logout( $wp_admin_bar ) {
                        $args = array(
                            'id'     => 'logout',           // id of the existing child node (New > Post)
                            'title'  => 'Logout',   // alter the title of existing node
                            'parent' => 'top-secondary',    // set parent
                        );
                        $wp_admin_bar->add_node( $args );
                    }

                    add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 999 );

                    //Added custom menu on admin dashbaord
                    function toolbar_link_to_mypage( $wp_admin_bar ) {
                        $user = wp_get_current_user();
                        $ngo_url = $user->user_login;
                        //print_r($user);
                        $home_link = get_home_url().'/ngo/'.$ngo_url;
                        $args = array(
                            'id'    => 'ngo_page',
                            'title' => 'NGO Home page',
                            'href'  => $home_link,
                            'meta'  => array( 'class' => 'my-toolbar-page' )
                        );
                        $wp_admin_bar->add_node( $args );
                    }



        }

        global $wpdb;
        $cid =  get_current_user_id();
        $table_name = "wp_ngo_profile";
        $sta = "";
        $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$cid'" );
        foreach ($result as $key ) {
            $sta = $key->approval_status;
        }
        //print_r($sta);
        $user_meta = get_userdata( $cid );
        $user_roles = $user_meta->roles;
        //print_r ( $user_roles );
        if ( in_array( "ngo_charitable", $user_roles ) ){

            if( $sta == "" || $sta == "no" ){

            add_action( 'admin_menu', 'ngo_remove_menu_pages' );
            function ngo_remove_menu_pages() {

                remove_menu_page( 'charitable' );    //charitable
                remove_menu_page( 'edit.php?post_type=page' );    //Pages
                remove_menu_page( 'upload.php' );                 //Media
                remove_menu_page( 'edit.php?post_type=gallery' );
                remove_menu_page( 'edit.php?post_type=ngospage' ); //cutom ngo pages.

                }
            }
        }
    }
}


add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar Footer 5', 'theme-slug' ),
        'id' => 'sidebar-footer-5',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<div id="widget_spacer-3" class="widget widget_spacer">
        <div class="spacer clearfix" data-desktop="14" data-mobi="0" style="height:14px">
        </div></div><div id="widget_links-4" class="widget widget_links">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'Sidebar Footer 6', 'theme-slug' ),
        'id' => 'sidebar-footer-6',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<div id="widget_spacer-3" class="widget widget_spacer">
        <div class="spacer clearfix" data-desktop="14" data-mobi="0" style="height:14px">
        </div></div><div id="widget_links-4" class="widget widget_links">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title"><span>',
        'after_title'   => '</span></h2>',
    ) );
}


/**
 * Generate sidebar for footer across all sites
 */
add_action( 'init', 'wds_footer_widgets_all_sites_footer_1' );
add_action( 'init', 'wds_footer_widgets_all_sites_footer_2' );
add_action( 'init', 'wds_footer_widgets_all_sites_footer_3' );
add_action( 'init', 'wds_footer_widgets_all_sites_footer_4' );
add_action( 'init', 'wds_footer_widgets_all_sites_footer_5' );
add_action( 'init', 'wds_footer_widgets_all_sites_footer_6' );

function wds_footer_widgets_all_sites_footer_1() {

    if ( ! is_main_site() )
        return;

    if ( ! ( $wds_footer_widgets = get_site_transient( 'wds_footer_widgets_footer_1' ) ) ) {
        // start output buffer
        ob_start();

        // Display our footer sidebars
        if ( ! dynamic_sidebar( 'sidebar-footer-1' ) ) :
                endif; // end sidebar widget area

        // grab the data from the output buffer and put it in our variable
        $wds_footer_widgets = ob_get_contents();
        ob_end_clean();

        // Put sidebar into a transient for 4 hours
        set_site_transient( 'wds_footer_widgets_footer_1', $wds_footer_widgets, 4*60*60 );
    }
}
function wds_footer_widgets_all_sites_footer_2() {

    if ( ! is_main_site() )
        return;

    if ( ! ( $wds_footer_widgets = get_site_transient( 'wds_footer_widgets_footer_2' ) ) ) {
        // start output buffer
        ob_start();

        if ( ! dynamic_sidebar( 'sidebar-footer-2' ) ) :
        endif; // end sidebar widget area

        // grab the data from the output buffer and put it in our variable
        $wds_footer_widgets = ob_get_contents();
        ob_end_clean();

        // Put sidebar into a transient for 4 hours
        set_site_transient( 'wds_footer_widgets_footer_2', $wds_footer_widgets, 4*60*60 );
    }
}

function wds_footer_widgets_all_sites_footer_3() {

    if ( ! is_main_site() )
        return;

    if ( ! ( $wds_footer_widgets = get_site_transient( 'wds_footer_widgets_footer_3' ) ) ) {
        // start output buffer
        ob_start();

        if ( ! dynamic_sidebar( 'sidebar-footer-3' ) ) :
        endif; // end sidebar widget area

        // grab the data from the output buffer and put it in our variable
        $wds_footer_widgets = ob_get_contents();
        ob_end_clean();

        // Put sidebar into a transient for 4 hours
        set_site_transient( 'wds_footer_widgets_footer_3', $wds_footer_widgets, 4*60*60 );
    }
}
function wds_footer_widgets_all_sites_footer_4() {

    if ( ! is_main_site() )
        return;

    if ( ! ( $wds_footer_widgets = get_site_transient( 'wds_footer_widgets_footer_4' ) ) ) {
        // start output buffer
        ob_start();

        if ( ! dynamic_sidebar( 'sidebar-footer-4' ) ) :
        endif; // end sidebar widget area

        // grab the data from the output buffer and put it in our variable
        $wds_footer_widgets = ob_get_contents();
        ob_end_clean();

        // Put sidebar into a transient for 4 hours
        set_site_transient( 'wds_footer_widgets_footer_4', $wds_footer_widgets, 4*60*60 );
    }
}

function wds_footer_widgets_all_sites_footer_5() {

    if ( ! is_main_site() )
        return;

    if ( ! ( $wds_footer_widgets = get_site_transient( 'wds_footer_widgets_footer_5' ) ) ) {
        // start output buffer
        ob_start();

        if ( ! dynamic_sidebar( 'sidebar-footer-5' ) ) :
        endif; // end sidebar widget area

        // grab the data from the output buffer and put it in our variable
        $wds_footer_widgets = ob_get_contents();
        ob_end_clean();

        // Put sidebar into a transient for 4 hours
        set_site_transient( 'wds_footer_widgets_footer_5', $wds_footer_widgets, 4*60*60 );
    }
}

function wds_footer_widgets_all_sites_footer_6() {

    if ( ! is_main_site() )
        return;

    if ( ! ( $wds_footer_widgets = get_site_transient( 'wds_footer_widgets_footer_6' ) ) ) {
        // start output buffer
        ob_start();

        if ( ! dynamic_sidebar( 'sidebar-footer-6' ) ) :
        endif; // end sidebar widget area

        // grab the data from the output buffer and put it in our variable
        $wds_footer_widgets = ob_get_contents();
        ob_end_clean();

        // Put sidebar into a transient for 4 hours
        set_site_transient( 'wds_footer_widgets_footer_6', $wds_footer_widgets, 4*60*60 );
    }
}

/**
 * Enqueue and localize our scripts
 */
add_action( 'admin_enqueue_scripts', 'wds_enqueue_ajax_scripts' );
function wds_enqueue_ajax_scripts() {
    global $current_screen;

    // Only register these scripts if we're on the widgets page
    if ( $current_screen->id == 'widgets' ) {
        wp_enqueue_script( 'wds_ajax_scripts', get_stylesheet_directory_uri() . '/js/admin-widgets.js', array( 'jquery' ), 1, true );
        wp_localize_script( 'wds_ajax_scripts', 'wds_AJAX', array( 'wds_widget_nonce' => wp_create_nonce( 'widget-update-nonce' ) ) );
    }
}

/**
 * Register our AJAX call
 */
add_action( 'wp_ajax_wds-reset-transient', 'wds_ajax_wds_reset_transient', 1 );

/**
 * AJAX Helper to delete our transient when a widget is saved
 */
function wds_ajax_wds_reset_transient() {

    // Delete our footer transient.  This runs when a widget is saved or updated.  Only do this if our nonce is passed.
    if ( ! empty( $_REQUEST['wds-widget-nonce'] ) ) {
        delete_site_transient( 'wds_footer_widgets_footer_1' );
        delete_site_transient( 'wds_footer_widgets_footer_2' );
        delete_site_transient( 'wds_footer_widgets_footer_3' );
        delete_site_transient( 'wds_footer_widgets_footer_4' );
        delete_site_transient( 'wds_footer_widgets_footer_5' );
        delete_site_transient( 'wds_footer_widgets_footer_6' );
    }
}
//Added defult category in cutom post type charitable.  Call the function when user is not a super admin. For subsites.
if(! is_super_admin() ){

    //add_action( 'init', 'tbs_insert_category_for_subsites' );
    add_action( 'init', 'tbs_insert_gallery_category_for_subsites' );
    add_action( 'admin_head', 'tbs_inline_css_for_defualt_cat', 0 );

function tbs_insert_category_for_subsites() {
    wp_insert_term(
        'Disability',
        '',
        array(
          'description' => 'This is default category for Disability type Projects.',
          'slug'        => 'disability'
        )
    );

     wp_insert_term(
        'Education',
        'campaign_category',
        array(
          'description' => 'This is default category for type Projects Education .',
          'slug'        => 'education'
        )
    );
     wp_insert_term(
        'Disaster and Response',
        'campaign_category',
        array(
          'description' => 'This is default category for Disaster and Response type Projects.',
          'slug'        => 'disaster-and-response'
        )
    );

     wp_insert_term(
        'Environment',
        'campaign_category',
        array(
          'description' => 'This is default category for Children type Projects Environment .',
          'slug'        => 'environment'
        )
    );
     wp_insert_term(
        'Health',
        'campaign_category',
        array(
          'description' => 'This is default category for  type Projects Health .',
          'slug'        => 'health'
        )
    );
     wp_insert_term(
        'Income Generation',
        'campaign_category',
        array(
          'description' => 'This is default category for type Projects Income Generation.',
          'slug'        => 'income-generation'
        )
    );

     wp_insert_term(
        'Water and Sanitation',
        'campaign_category',
        array(
          'description' => 'This is default category for type Projects Water and Sanitation.',
          'slug'        => 'water-nd-sanitation'
        )
    );
      wp_insert_term(
        'Women Empowerment',
        'campaign_category',
        array(
          'description' => 'This is default category for type Projects Women Empowerment.',
          'slug'        => 'women-empowerment'
        )
    );

}

// Default cateogry for the gallery
function tbs_insert_gallery_category_for_subsites() {
    wp_insert_term(
        'Disability',
        'gallery_category',
        array(
          'description' => 'This is default category for Disability type Projects.',
          'slug'        => 'disability'
        )
    );

     wp_insert_term(
        'Education',
        'gallery_category',
        array(
          'description' => 'This is default category for type Projects Education .',
          'slug'        => 'education'
        )
    );
     wp_insert_term(
        'Disaster and Response',
        'gallery_category',
        array(
          'description' => 'This is default category for Disaster and Response type Projects.',
          'slug'        => 'disaster-and-response'
        )
    );

     wp_insert_term(
        'Environment',
        'gallery_category',
        array(
          'description' => 'This is default category for Children type Projects Environment .',
          'slug'        => 'environment'
        )
    );
     wp_insert_term(
        'Health',
        'gallery_category',
        array(
          'description' => 'This is default category for  type Projects Health .',
          'slug'        => 'health'
        )
    );
     wp_insert_term(
        'Income Generation',
        'gallery_category',
        array(
          'description' => 'This is default category for type Projects Income Generation.',
          'slug'        => 'income-generation'
        )
    );

     wp_insert_term(
        'Water and Sanitation',
        'gallery_category',
        array(
          'description' => 'This is default category for type Projects Water and Sanitation.',
          'slug'        => 'water-nd-sanitation'
        )
    );
      wp_insert_term(
        'Women Empowerment',
        'gallery_category',
        array(
          'description' => 'This is default category for type Projects Women Empowerment.',
          'slug'        => 'women-empowerment'
        )
    );

}

//To remove the Add new category in charitable nav bar used inline css.
function tbs_inline_css_for_defualt_cat() {
  echo "<style>.taxonomy-add-new{display:none}</style>";
   echo "<style>.update-nag{display:none}</style>";
}
}

add_action("wp_ajax_select_city","select_city");
add_action( 'wp_ajax_nopriv_select_city', 'select_city' );
function select_city(){
    $state_id       = $_POST['state_id'];
    global $wpdb;
     $results_city = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id = {$state_id}", OBJECT );

    $result = '<option disabled selected hidden >City</option>';
    foreach( $results_city as $city ) {
         $result .= '<option id="'.$city->id.'" parent_id="'.$city->parent_id.'">'.$city->name.'</option>';

    }
    echo $result;
}
// Add specific CSS class by filter.

add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'header-style-3' ) );
} );

/**
 * Insert a widget in a sidebar.
 *
 * @param string $widget_id   ID of the widget (search, recent-posts, etc.)
 * @param array $widget_data  Widget settings.
 * @param string $sidebar     ID of the sidebar.
 */
function insert_widget_in_sidebar( $widget_ids = array(), $widget_data, $sidebar ) {
	// Retrieve sidebars, widgets and their instances
    $sidebars_widgets = get_option( 'sidebars_widgets', array() );
    //echo '<pre>';print_r($sidebars_widgets[$sidebar]);echo '</pre>';

    /*if ( !empty($sidebars_widgets[$sidebar]) ) {
        foreach($sidebars_widgets[$sidebar] as $sidebar_widget ) {
            $widgetid = explode('-', $sidebar_widget );
           echo $widgetid =  $widgetid[0];
            print_r($widget_ids);
            //echo $widgetid.' and ';
            if (in_array($widgetid[0], $widget_ids ) ) {
                $widget_ids = array_diff($widget_ids, [$widgetid[0]]);
            }
        }
    }*/
    //print_r($widget_ids);
    if ( empty($sidebars_widgets[$sidebar])) {
        if ( !empty($widget_ids)) {
            foreach( $widget_ids as $widget_id ) {
                $widget_data = array();
                if( $widget_id == 'charitable_donate_widget') {
                    $widget_data = array('title'=>'Donate Now');
                } else if( $widget_id == 'charitable_donors_widget') {
                    $widget_data = array('title'=>'Charitable Donors');
                } else if( $widget_id == 'charitable_donation_stats_widget') {
                    $widget_data = array('title'=>'Charitable Donation Stats');
                } else {
                    $widget_data = array('title'=>'Charitable Widget');
                }
                //echo $widget_id;
                $widget_instances = get_option( 'widget_' . $widget_id, array() );
                //print_r($widget_instances);
                // Retrieve the key of the next widget instance
                $numeric_keys = array_filter( array_keys( $widget_instances ), 'is_int' );
                $next_key = $numeric_keys ? max( $numeric_keys ) + 1 : 2;
                // Add this widget to the sidebar
                if ( ! isset( $sidebars_widgets[ $sidebar ] ) ) {
                    $sidebars_widgets[ $sidebar ] = array();
                }
                $sidebars_widgets[ $sidebar ][] = $widget_id . '-' . $next_key;
                // Add the new widget instance
                $widget_instances[ $next_key ] = $widget_data;
                // Store updated sidebars, widgets and their instances
                update_option( 'sidebars_widgets', $sidebars_widgets );
                update_option( 'widget_' . $widget_id, $widget_instances );
            }
        }
    }


}
add_action('init', 'tbs_add_default_sidebar');
    function tbs_add_default_sidebar() {
        $widget_id = array('charitable_donors_widget', 'charitable_donate_widget','charitable_donation_stats_widget');
        insert_widget_in_sidebar( $widget_id, array('title'=>'Charitable Widget'), 'sidebar-blog' );
}
/**
 * Get taxonomies terms links.
 *
 * @see get_object_taxonomies()
 */
function wpdocs_custom_taxonomies_terms_links() {
    // Get post by post ID.
    if ( ! $post = get_post() ) {
        return '';
    }

    // Get post type by post.
    $post_type = $post->post_type;

    // Get post type taxonomies.
    $taxonomies = get_object_taxonomies( $post_type, 'objects' );

    $out = array();

    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

        // Get the terms related to post.
        $terms = get_the_terms( $post->ID, $taxonomy_slug );

        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a class="cat-btn" href="%1$s">%2$s <hr style="
                    border:   none;
                    width: 2px;
                    height: 10px;
                    border-left: 2px solid #666;
                    display: inline;
                    margin-left: 5px;"> </a>',
                    esc_url( get_term_link( $term->slug, $taxonomy_slug ) ),
                    esc_html( $term->name )
                );
            }
            //$out[] = "";
        }
    }
    return implode( '&nbsp;', $out );
}
//code to add the extra files in the donation form.

function ed_charitable_register_new_donation_fields() {
    /**
     * Define a new text field.
     */
    $field = new Charitable_Donation_Field( 'phone_num', array(
        'label' => __( 'Phone Number', 'charitable' ),
        'data_type' => 'user',
        'donation_form' => array(
            'show_after' => 'phone',
            'required'   => true,
        ),
        'admin_form' => true,
        'show_in_meta' => true,
        'show_in_export' => true,
        'email_tag' => array(
            'description' => __( 'The new phome number field' , 'charitable' ),
        ),
    ) );
    /**
     * Register the text field.
     */
    charitable()->donation_fields()->register_field( $field );

    //select value for tax payer

        $options = array(
        'Indian' => __( 'Indian National', 'custom-namespace' ),
        'Foreign National'  => __( 'Foreign National', 'custom-namespace' ),
    );
    /**
     * Define a new select field.
     */
    $field = new Charitable_Donation_Field( 'tax_paying_status', array(
        'label' => __( 'Tax paying status', 'custom-namespace' ),
        'data_type' => 'user',
        'donation_form' => array(
            'type' => 'select',
            'id' => 'tax',
            'show_before' => 'phone',
            'required' => true,
            'options' => $options,
        ),
        'admin_form' => true,
        'show_in_meta' => true,
        'show_in_export' => true,
        'email_tag' => array(
            'description' => __( 'The new select field' , 'charitable' ),
        ),
    ) );
    /**
     * Register the select field.
     */
    charitable()->donation_fields()->register_field( $field );

    //country name for taxpayer
    $country_options = array(
        'Afghanistan' => __( 'Afghanistan', 'custom-namespace' ),
        'Albania'  => __( 'Albania', 'custom-namespace' ),
        'Algeria'  => __( 'Algeria', 'custom-namespace' ),
        'Andorra'  => __( 'Andorra', 'custom-namespace' ),
        'Angola'  => __( 'Angola', 'custom-namespace' ),
        'Antigua and Barbuda'  => __( 'Antigua and Barbuda', 'custom-namespace' ),
        'Argentina'  => __( 'Argentina', 'custom-namespace' ),
        'Armenia'  => __( 'Armenia', 'custom-namespace' ),
        'Australia'  => __( 'Australia', 'custom-namespace' ),
        'Austria'  => __( 'Austria', 'custom-namespace' ),
        'Azerbaijan'  => __( 'Azerbaijan', 'custom-namespace' ),
        'Bahamas'  => __( 'Bahamas', 'custom-namespace' ),
        'Bahrain'  => __( 'Bahrain', 'custom-namespace' ),
        'Bangladesh'  => __( 'Bangladesh', 'custom-namespace' ),
        'Barbados'  => __( 'Barbados', 'custom-namespace' ),
        'Belgium'  => __( 'Belgium', 'custom-namespace' ),
        'Belize'  => __( 'Belize', 'custom-namespace' ),
        'Benin'  => __( 'Benin', 'custom-namespace' ),
        'Bhutan'  => __( 'Bhutan', 'custom-namespace' ),
        'Bolivia'  => __( 'Bolivia', 'custom-namespace' ),
        'Bosnia and Herzegovina'  => __( 'Bosnia and Herzegovina', 'custom-namespace' ),
        'Botswana'  => __( 'Botswana', 'custom-namespace' ),
        'Brazil'  => __( 'Brazil', 'custom-namespace' ),
        'Brunei'  => __( 'Brunei', 'custom-namespace' ),
        'Bulgaria'  => __( 'Bulgaria', 'custom-namespace' ),
        'Burkina Faso'  => __( 'Burkina Faso', 'custom-namespace' ),
        'Burundi'  => __( 'Burundi', 'custom-namespace' ),
        'Cabo Verde'  => __( 'Cabo Verde', 'custom-namespace' ),
        'Cambodia'  => __( 'Cambodia', 'custom-namespace' ),
        'Cameroon'  => __( 'Cameroon', 'custom-namespace' ),
        'Canada'  => __( 'Canada', 'custom-namespace' ),
        'Central African Republic (CAR)'  => __( 'Central African Republic (CAR)', 'custom-namespace' ),
        'Chad'  => __( 'Chad', 'custom-namespace' ),
        'Chile'  => __( 'Chile', 'custom-namespace' ),
        'China'  => __( 'China', 'custom-namespace' ),
        'Colombia'  => __( 'Colombia', 'custom-namespace' ),
        'Comoros'  => __( 'Comoros', 'custom-namespace' ),
        'Democratic Republic of the Congo'  => __( 'Democratic Republic of the Congo', 'custom-namespace' ),
        'Republic of the Congo'  => __( 'Republic of the Congo', 'custom-namespace' ),
        'Costa Rica'  => __( 'Costa Rica', 'custom-namespace' ),
        'Cote d Ivoire'  => __( 'Cote dIvoire', 'custom-namespace' ),
        'Croatia'  => __( 'Croatia', 'custom-namespace' ),
        'Cuba'  => __( 'Cuba', 'custom-namespace' ),
        'Cyprus'  => __( 'Cyprus', 'custom-namespace' ),
        'Czech Republic'  => __( 'Czech Republic', 'custom-namespace' ),
        'Denmark'  => __( 'Denmark', 'custom-namespace' ),
        'Djibouti'  => __( 'Djibouti', 'custom-namespace' ),
        'Dominica'  => __( 'Dominica', 'custom-namespace' ),
        'Dominican Republic'  => __( 'Dominican Republic', 'custom-namespace' ),
        'Ecuador'  => __( 'Ecuador', 'custom-namespace' ),
        'Egypt'  => __( 'Egypt', 'custom-namespace' ),
        'El Salvador'  => __( 'El Salvador', 'custom-namespace' ),
        'Equatorial Guinea'  => __( 'Equatorial Guinea', 'custom-namespace' ),
        'Eritrea'  => __( 'Eritrea', 'custom-namespace' ),
        'Estonia'  => __( 'Estonia', 'custom-namespace' ),
        'Eswatini'  => __( 'Eswatini', 'custom-namespace' ),
        'Ethiopia'  => __( 'Ethiopia', 'custom-namespace' ),
        'Fiji'  => __( 'Fiji', 'custom-namespace' ),
        'Finland'  => __( 'Finland', 'custom-namespace' ),
        'France'  => __( 'France', 'custom-namespace' ),
        'Gabon'  => __( 'Gabon', 'custom-namespace' ),
        'Gambia'  => __( 'Gambia', 'custom-namespace' ),
        'Georgia'  => __( 'Georgia', 'custom-namespace' ),
        'Germany'  => __( 'Germany', 'custom-namespace' ),
        'Ghana'  => __( 'Ghana', 'custom-namespace' ),
        'Greece'  => __( 'Greece', 'custom-namespace' ),
        'Guatemala'  => __( 'Guatemala', 'custom-namespace' ),
        'Guinea'  => __( 'Guinea', 'custom-namespace' ),
        'Guinea-Bissau'  => __( 'Guinea-Bissau', 'custom-namespace' ),
        'Guyana'  => __( 'Guyana', 'custom-namespace' ),
        'Haiti'  => __( 'Haiti', 'custom-namespace' ),
        'Honduras'  => __( 'Honduras', 'custom-namespace' ),
        'Hungary'  => __( 'Hungary', 'custom-namespace' ),
        'Iceland'  => __( 'Iceland', 'custom-namespace' ),
        'India'  => __( 'India', 'custom-namespace' ),
        'Indonesia'  => __( 'Indonesia', 'custom-namespace' ),
        'Iran'  => __( 'Iran', 'custom-namespace' ),
        'Iraq'  => __( 'Iraq', 'custom-namespace' ),
        'Ireland'  => __( 'Ireland', 'custom-namespace' ),
        'Israel'  => __( 'Israel', 'custom-namespace' ),
        'Italy'  => __( 'Italy', 'custom-namespace' ),
        'Jamaica'  => __( 'Jamaica', 'custom-namespace' ),
        'Japan'  => __( 'Japan', 'custom-namespace' ),
        'Jordan'  => __( 'Jordan', 'custom-namespace' ),
        'Kazakhstan'  => __( 'Kazakhstan', 'custom-namespace' ),
        'Kenya'  => __( 'Kenya', 'custom-namespace' ),
        'Kiribati'  => __( 'Kiribati', 'custom-namespace' ),
        'Kosovo'  => __( 'Kosovo', 'custom-namespace' ),
        'Kuwait'  => __( 'Kuwait', 'custom-namespace' ),
        'Kyrgyzstan'  => __( 'Kyrgyzstan', 'custom-namespace' ),
        'Laos'  => __( 'Laos', 'custom-namespace' ),
        'Latvia'  => __( 'Latvia', 'custom-namespace' ),
        'Lebanon'  => __( 'Lebanon', 'custom-namespace' ),
        'Lesotho'  => __( 'Lesotho', 'custom-namespace' ),
        'Liberia'  => __( 'Liberia', 'custom-namespace' ),
        'Libya'  => __( 'Libya', 'custom-namespace' ),
        'Liechtenstein'  => __( 'Liechtenstein', 'custom-namespace' ),
        'Lithuania'  => __( 'Lithuania', 'custom-namespace' ),
        'Luxembourg'  => __( 'Luxembourg', 'custom-namespace' ),
        'Macedonia'  => __( 'Macedonia', 'custom-namespace' ),
        'Madagascar'  => __( 'Madagascar', 'custom-namespace' ),
        'Malawi'  => __( 'Malawi', 'custom-namespace' ),
        'Malaysia'  => __( 'Malaysia', 'custom-namespace' ),
        'Maldives'  => __( 'Maldives', 'custom-namespace' ),
        'Mali'  => __( 'Mali', 'custom-namespace' ),
        'Malta'  => __( 'Malta', 'custom-namespace' ),
        'Marshall Islands'  => __( 'Marshall Islands', 'custom-namespace' ),
        'Mauritania'  => __( 'Mauritania', 'custom-namespace' ),
        'Mauritius'  => __( 'Mauritius', 'custom-namespace' ),
        'Mexico'  => __( 'Mexico', 'custom-namespace' ),
        'Micronesia'  => __( 'Micronesia', 'custom-namespace' ),
        'Moldova'  => __( 'Moldova', 'custom-namespace' ),
        'Monaco'  => __( 'Monaco', 'custom-namespace' ),
        'Mongolia'  => __( 'Mongolia', 'custom-namespace' ),
        'Montenegro'  => __( 'Montenegro', 'custom-namespace' ),
        'Morocco'  => __( 'Morocco', 'custom-namespace' ),
        'Mozambique'  => __( 'Mozambique', 'custom-namespace' ),
        'Myanmar'  => __( 'Myanmar', 'custom-namespace' ),
        'Namibia'  => __( 'Namibia', 'custom-namespace' ),
        'Nauru'  => __( 'Nauru', 'custom-namespace' ),
        'Nepal'  => __( 'Nepal', 'custom-namespace' ),
        'Netherlands'  => __( 'Netherlands', 'custom-namespace' ),
        'New Zealand'  => __( 'New Zealand', 'custom-namespace' ),
        'Nicaragua'  => __( 'Nicaragua', 'custom-namespace' ),
        'Niger'  => __( 'Niger', 'custom-namespace' ),
        'Nigeria'  => __( 'Nigeria', 'custom-namespace' ),
        'North Korea'  => __( 'North Korea', 'custom-namespace' ),
        'Norway'  => __( 'Norway', 'custom-namespace' ),
        'Oman'  => __( 'Oman', 'custom-namespace' ),
        'Pakistan'  => __( 'Pakistan', 'custom-namespace' ),
        'Palau'  => __( 'Palau', 'custom-namespace' ),
        'Palestine'  => __( 'Palestine', 'custom-namespace' ),
        'Panama'  => __( 'Panama', 'custom-namespace' ),
        'Papua New Guinea'  => __( 'Papua New Guinea', 'custom-namespace' ),
        'Paraguay'  => __( 'Paraguay', 'custom-namespace' ),
        'Peru'  => __( 'Peru', 'custom-namespace' ),
        'Philippines'  => __( 'Philippines', 'custom-namespace' ),
        'Poland'  => __( 'Poland', 'custom-namespace' ),
        'Portugal'  => __( 'Portugal', 'custom-namespace' ),
        'Qatar'  => __( 'Qatar', 'custom-namespace' ),
        'Romania'  => __( 'Romania', 'custom-namespace' ),
        'Russia'  => __( 'Rwanda', 'custom-namespace' ),
        'Saint Kitts and Nevis'  => __( 'Saint Kitts and Nevis', 'custom-namespace' ),
        'Saint Lucia'  => __( 'Saint Lucia', 'custom-namespace' ),
        'Saint Vincent and the Grenadines'  => __( 'Saint Vincent and the Grenadines', 'custom-namespace' ),
        'Samoa'  => __( 'Samoa', 'custom-namespace' ),
        'San Marino'  => __( 'San Marino', 'custom-namespace' ),
        'Sao Tome and Principe'  => __( 'Sao Tome and Principe', 'custom-namespace' ),
        'Saudi Arabia'  => __( 'Saudi Arabia', 'custom-namespace' ),
        'Senegal'  => __( 'Senegal', 'custom-namespace' ),
        'Seychelles'  => __( 'Seychelles', 'custom-namespace' ),
        'Sierra Leone'  => __( 'Sierra Leone', 'custom-namespace' ),
        'Singapore'  => __( 'Singapore', 'custom-namespace' ),
        'Slovakia'  => __( 'Slovakia', 'custom-namespace' ),
        'Slovenia'  => __( 'Slovenia', 'custom-namespace' ),
        'Solomon Islands'  => __( 'Solomon Islands', 'custom-namespace' ),
        'Somalia'  => __( 'Somalia', 'custom-namespace' ),
        'South Africa'  => __( 'South Africa', 'custom-namespace' ),
        'South Korea'  => __( 'South Korea', 'custom-namespace' ),
        'South Sudan'  => __( 'South Sudan', 'custom-namespace' ),
        'Spain'  => __( 'Spain', 'custom-namespace' ),
        'Sri Lanka'  => __( 'Sri Lanka', 'custom-namespace' ),
        'Sudan'  => __( 'Sudan', 'custom-namespace' ),
        'Suriname'  => __( 'Suriname', 'custom-namespace' ),
        'Eswatini'  => __( 'Eswatini', 'custom-namespace' ),
        'Sweden'  => __( 'Sweden', 'custom-namespace' ),
        'Switzerland'  => __( 'Switzerland', 'custom-namespace' ),
        'Syria'  => __( 'Syria', 'custom-namespace' ),
        'Taiwan'  => __( 'Taiwan', 'custom-namespace' ),
        'Tajikistan'  => __( 'Tajikistan', 'custom-namespace' ),
        'Tanzania'  => __( 'Tanzania', 'custom-namespace' ),
        'Thailand'  => __( 'Thailand', 'custom-namespace' ),
        'Timor-Leste'  => __( 'Timor-Leste', 'custom-namespace' ),
        'Togo'  => __( 'Togo', 'custom-namespace' ),
        'Tonga'  => __( 'Tonga', 'custom-namespace' ),
        'Trinidad and Tobago'  => __( 'Trinidad and Tobago', 'custom-namespace' ),
        'Tunisia'  => __( 'Tunisia', 'custom-namespace' ),
        'Turkey'  => __( 'Turkey', 'custom-namespace' ),
        'Turkmenistan'  => __( 'Turkmenistan', 'custom-namespace' ),
        'Tuvalu'  => __( 'Tuvalu', 'custom-namespace' ),
        'Uganda'  => __( 'Uganda', 'custom-namespace' ),
        'Ukraine'  => __( 'Ukraine', 'custom-namespace' ),
        'United Arab Emirates'  => __( 'United Arab Emirates', 'custom-namespace' ),
        'United Kingdom'  => __( 'United Kingdom', 'custom-namespace' ),
        'United States of America'  => __( 'United States of America', 'custom-namespace' ),
        'Uruguay'  => __( 'Uruguay', 'custom-namespace' ),
        'Uzbekistan'  => __( 'Uzbekistan', 'custom-namespace' ),
        'Vanuatu'  => __( 'Vanuatu', 'custom-namespace' ),
        'Vatican City'  => __( 'Vatican City', 'custom-namespace' ),
        'Venezuela'  => __( 'Venezuela', 'custom-namespace' ),
        'Vietnam'  => __( 'Vietnam', 'custom-namespace' ),
        'Yemen'  => __( 'Yemen', 'custom-namespace' ),
        'Eswatini'  => __( 'Eswatini', 'custom-namespace' ),
        'Zambia'  => __( 'Zambia', 'custom-namespace' ),
        'Zimbabwe'  => __( 'Zimbabwe', 'custom-namespace' ),
    );

    $field = new Charitable_Donation_Field( 'country_name', array(
        'label' => __( 'Select your country name', 'charitable' ),
        'data_type' => 'user',
        'donation_form' => array(
            'type' => 'select',
            'id' => 'country_name',
            'show_before' => 'phone',
            'required'   => true,
            'options' =>  $country_options,
        ),
        'admin_form' => true,
        'show_in_meta' => true,
        'show_in_export' => true,
        'email_tag' => array(
            'description' => __( 'The new country name field' , 'charitable' ),
        ),
    ) );
    /**
     * Register the text field.
     */
    charitable()->donation_fields()->register_field( $field );

 }
 add_action( 'init', 'ed_charitable_register_new_donation_fields' );





function add_theme_caps() {
    //remove_role( 'ngo_user_new5', 'ngo_user_new4', 'ngo_user_new3', 'ngo_user_new2', 'ngo');
    add_role( 'ngo_charitable', __( 'Charitable NGO' ), array(
        'read'                   => true,
        'delete_posts'           => true,
        'edit_posts'             => true,
        'upload_files'           => true,
    ) );

    $role = get_role( 'ngo_charitable' );

    /* Add the main post type capabilities. */
    foreach ( tbs_get_core_caps() as $cap ) {
        $role->add_cap( $cap );
    }
}
add_action( 'admin_init', 'add_theme_caps');

function tbs_get_core_caps() {
    return array(
        /* Campaign post type */
        'edit_campaign',
        'read_campaign',
        'delete_campaign',
        'edit_campaigns',
       //'edit_others_campaigns',
        //'publish_campaigns',
        //'read_private_campaigns',
        'delete_campaigns',
        //'delete_private_campaigns',
        'delete_published_campaigns',
        //'delete_others_campaigns',
        //'edit_private_campaigns',
        //'edit_published_campaigns',
    );
}


function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

function disallowed_admin_pages() {
    global $pagenow;
    # Check current admin page.
    if( $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] == 'ngo_projects_page' ){

        wp_redirect( admin_url( '/edit.php?post_type=campaign' ), 301 );
        exit;

    }
    if( $pagenow == 'admin.php' && isset( $_GET['page'] ) && $_GET['page'] == 'add_new_projects' ){

        wp_redirect( admin_url( '/post-new.php?post_type=campaign' ), 301 );
        exit;

    }

}
add_action( 'admin_init', 'disallowed_admin_pages' );

function posts_for_current_author($query) {
    global $pagenow;

    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;

    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');


function fn_change_login_image() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".home_url()."/wp-content/uploads/2018/10/india-donates.png') no-repeat scroll center top / 150px auto;
        width: 170px;
        margin: 0 auto;
        height: 60px;
    }
	</style>
	";
}
add_action("login_enqueue_scripts", "fn_change_login_image");
/*
 * To change the link values so the logo links to your WordPress site.
*/
function fn_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'fn_login_logo_url' );
/*
 * To change the title of the login page logo url.
*/
function fn_login_logo_url_title() {
    return 'India Donates Websites.';
}
add_filter( 'login_headertitle', 'fn_login_logo_url_title' );

function get_user_role($id)
{
    $user = new WP_User($id);
    return array_shift($user->roles);
}


/*****
 * Meta for the package donations
 */
function tbs_charitable_get_meta_box( $meta_boxes ) {
	$prefix = 'tbs-';

	$meta_boxes[] = array(
		'id' => 'tbs-charitable-meta',
		'title' => esc_html__( 'Package Donation Setting', 'tbs-charitable-meta' ),
		'post_types' => array('campaign' ),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'tbs_charitable_rangebox',
				'name' => esc_html__( 'Click here to make you donation in packages', 'tbs-charitable-meta' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Please check the box here to make donation in packages.', 'tbs-charitable-meta' ),
			),
			array(
				'id' => $prefix . 'range_donation_amount',
				'type' => 'text',
				'name' => esc_html__( 'Enter Your Range Amount', 'tbs-charitable-meta' ),
				'desc' => esc_html__( 'Enter amount for  one packages', 'tbs-charitable-meta' ),
				'placeholder' => esc_html__( 'Amount', 'tbs-charitable-meta' ),
			),
			array(
				'id' => $prefix . 'package_name',
				'type' => 'text',
				'name' => esc_html__( 'Enter the Package name', 'tbs-charitable-meta' ),
				'desc' => esc_html__( 'Enter the package name like kid/kit/fee/student/etc.', 'tbs-charitable-meta' ),
				'placeholder' => esc_html__( 'Kid/kit/child/student/etc...', 'tbs-charitable-meta' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'tbs_charitable_get_meta_box' );

// Added meta feilds for campaign

function tbs_campagin_get_meta_box( $meta_boxes ) {
	$prefix = 'campg_desc-';
	$meta_boxes[] = array(
		'id' => 'project_dec',
		'title' => esc_html__( 'Project Descriptions', 'metabox-project-campaign' ),
		'post_types' => array('campaign' ),
		'context' => 'advanced',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			/*array(
				'id' => $prefix . 'campaign_textarea_1',
				'type' => 'textarea',
				'name' => esc_html__( 'A catchy well-placed descriptive project name - Keep it fairly short to help donors avoid getting bogged down in insistent text.', 'metabox-project-campaign' ),
				'placeholder' => esc_html__( '', 'metabox-project-campaign' ),
            ),*/
			array(
				'id' => $prefix . 'campaign_textarea_2',
				'type' => 'textarea',
				'name' => esc_html__( 'Explain your project, what and why it is important/relevant and who will benefit from it,make the issue personal by including stories and photos of the people who the donor will be helping.', 'metabox-project-campaign' ),
				'placeholder' => esc_html__( '', 'metabox-project-campaign' ),
			),
			array(
				'id' => $prefix . 'campaign_textarea_4',
				'type' => 'textarea',
				'name' => esc_html__( 'What you plan to do, what major issue you plan to address, and what\'s unique about the project, be specific where your project will take place.', 'metabox-project-campaign' ),
				'placeholder' => esc_html__( '', 'metabox-project-campaign' ),
			),
			array(
				'id' => $prefix . 'campaign_textarea_5',
				'type' => 'textarea',
				'name' => esc_html__( 'How do you plan to do it, explain the specific steps that will be taken to address it.', 'metabox-project-campaign' ),
				'placeholder' => esc_html__( '', 'metabox-project-campaign' ),
			),
			array(
				'id' => $prefix . 'campaign_textarea_6',
				'type' => 'textarea',
				'name' => esc_html__( 'Why should people support your project, explain who you are and why you\'re qualified to take on the project.(Give 2 or 3 good reasons and benefit from the project).', 'metabox-project-campaign' ),
				'placeholder' => esc_html__( '', 'metabox-project-campaign' ),
			),
			array(
				'id' => $prefix . 'campaign_textarea_7',
				'type' => 'textarea',
				'name' => esc_html__( 'What is your funding goal,how will funds be used and provide even a breakdown(budgeted plan) of where the money will be spend.', 'metabox-project-campaign' ),
				'placeholder' => esc_html__( '', 'metabox-project-campaign' ),
			),
			array(
				'id' => $prefix . 'image_advanced_8',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Images', 'metabox-project-campaign' ),
				'desc' => esc_html__( 'Images of the beneficiaries and if possible a video featuring the head of the NGO, this will allow the potential donors to get a sense of who you are,your passion,personality,etc.', 'metabox-project-campaign' ),
			),
			array(
				'id' => $prefix . 'campaign_video_9',
				'type' => 'video',
				'name' => esc_html__( 'Endorsements', 'metabox-project-campaign' ),
				'desc' => esc_html__( 'Endorsements- Securing the recommendation/support for noteworthy people from your project area will be a real plus. Their testimony and dedication to your cause/purpose will strengthen your message. Wherever possible upload a short video of the endorser reiterating and explaining why they believe your project is worthy of support.', 'metabox-project-campaign' ),
				'max_file_uploads' => 4,
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'tbs_campagin_get_meta_box' );



add_action( 'widgets_init', 'hstngr_register_widget' );

//Create a custom widgets for donor page.
function hstngr_register_widget() {
    register_widget( 'hstngr_widget' );
    }



    class hstngr_widget extends WP_Widget {

    function __construct() {
    parent::__construct(
    // widget ID
    'hstngr_widget',
    // widget name
    __('Campaign details', ' hstngr_widget_domain'),
    // widget description
    array( 'description' => __( 'Campaign deatils description.', 'hstngr_widget_domain' ), )
    );
    }

    public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    //echo $args['before_widget'];
    //if title is present
    if ( ! empty( $title ) )
    //echo $args['before_title'] . $title . $args['after_title'];
    //output
    ?>
    <div class="ngo-sidebar nice" style="position: relative;border-top: 5px solid #518c51; border-radius: 3px;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);">
            <?php
                 global $post;
                 $post_id = $post->ID;
                 $post_meta = get_post_meta( $post_id );
                 $range_check_box = get_post_meta( $post_id, 'tbs-tbs_charitable_rangebox', true );
                 $range_amount = get_post_meta( $post_id, 'tbs-range_donation_amount', true );
                 $range_package_name = get_post_meta( $post_id, 'tbs-package_name', true );
                if( $range_check_box == 1 ){?>
                    <div class="single-figure" style="height: auto; padding: 0px 0px 0px !important; min-height: fit-content;">
                <?php
                        $pid = get_the_ID();
                        $campain = get_post($pid );
                        $content = $campain->post_title;
                        $image =  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'large');
                        $ngo_name = get_the_author();

                    ?>
                    <img src="<?php echo $image; ?>">
                    <div style="padding: 5px 10px 5px 5px;">
                    <h5 class="card-title text-clamp-3 checkout-beneficiary" style="line-height: 3.375rem;border-bottom: 2px solid #ccc;">
                    <div>
                        <span class="darker-greyu"> Great! You are supporting</span>
                        <span class="info-beneficiary">1 <?php echo $range_package_name; ?></span>
                    </div>
                    </h5><br>
                    <div class="card-price" style= "text-align:left;">
                        <h6 class="price" style="font-weight: 400; font-size: 14px;">
                             <span class="darker-grey"><b>Donation Received</b></span>
                            <span class="checkout-text" style="font-weight: normal;"> <span><?php $campaign = charitable_get_current_campaign();
                            $currency_helper = charitable_get_currency_helper();
                            echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span>
                       </h6>
                    <h6 class="price checkout-program" style="font-weight: 400; font-size: 14px;text-align: left;">
                    <span class="darker-grey"><b>Program Name:</b> </span>
                        <span class="checkout-text" style="font-weight: normal;"><?php echo $content; ?></span>
                    </h6>
                    <h6 class="price checkout-program" style="font-weight: 400; font-size: 14px;text-align: left;">
                    <span class="darker-grey"><b>NGO Name:</b> </span>
                        <span class="checkout-text" style="font-weight: normal;"><?php echo $ngo_name; ?></span>
                    </h6>
                    <p style="font-size: smaller; font-style: oblique;"></p>
                    </div>
                    </div>

            </div>

                <?php } else{ ?>
            <div class="single-figure" style="height: auto; padding: 0px 0px 0px !important; min-height: fit-content;">
                <?php
                        $pid = get_the_ID();
                        $campain = get_post($pid );
                        $content = $campain->post_title;
                        $image =  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                        $ngo_name = get_the_author();

                    ?>
                    <img src="<?php echo $image; ?>">
                    <div style="padding: 5px 10px 5px 5px;">
                    <h5 class="card-title text-clamp-3 checkout-beneficiary" style="line-height: 3.375rem;">
                    <div>
                        <span class="darker-greyu"> Great! You are supporting</span>
                        <span class="info-beneficiary"></span>
                    </div>
                    </h5><br>
                    <div class="card-price" style= "text-align:left;">
                        <h6 class="price" style="font-weight: 400; font-size: 14px;">
                             <span class="darker-grey"><b>Donation Received:</b> </span>
                            <span class="checkout-text" style="font-weight: normal;"> <span><?php $campaign = charitable_get_current_campaign();
                            $currency_helper = charitable_get_currency_helper();
                            echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span>
                       </h6>
                    <h6 class="price checkout-program" style="font-weight: 400; font-size: 11px;text-align: left;">
                    <span class="darker-grey"><b>Program Name:</b> </span>
                        <span class="checkout-text" style="font-weight: normal;"><?php echo $content; ?></span>
                    </h6>
                    <h6 class="price checkout-program" style="font-weight: 400; font-size: 11px;text-align: left;">
                    <span class="darker-grey"><b>NGO Name:</b> </span>
                        <span class="checkout-text" style="font-weight: normal;"><?php echo $ngo_name; ?></span>
                    </h6>
                    <p style="font-size: smaller; font-style: oblique;"></p>
                    </div>
                    </div>

            </div>
                <?php } ?>


        </div>

    <?php
    echo $args['after_widget'];

    }

    public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) )
    $title = $instance[ 'title' ];
    else
    $title = __( 'Default Title', 'hstngr_widget_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
    }
    public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
    }

    }
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

    //Add popup for shopping on marketplace.
    function show_contact_us_button(){
       ?>
       <a class="btn open-popup" style= "background: #ff8313 !important; color: #fff; font-weight: bold; font-family: initial;" data-id="popup_12" data-animation="rotateCube" href="#popup_12"><span> Click to Buy</span> </a>
       <?php

    }
    add_action('woocommerce_after_shop_loop_item','show_contact_us_button');
    add_action('woocommerce_single_product_summary','show_contact_us_button');

    function limit_words($string, $word_limit) {

        // creates an array of words from $string (this will be our excerpt)
        // explode divides the excerpt up by using a space character

        $words = explode(' ', $string);

        // this next bit chops the $words array and sticks it back together
        // starting at the first word '0' and ending at the $word_limit
        // the $word_limit which is passed in the function will be the number
        // of words we want to use
        // implode glues the chopped up array back together using a space character

        return implode(' ', array_slice($words, 0, $word_limit));

    }

    function new_excerpt_more($more) {
        global $post;
        return '... <a href="'. get_permalink($post->ID) . '">continue reading</a>.';
    }
    add_filter('excerpt_more', 'new_excerpt_more');

//set mail type html
    function tbs_set_content_type(){
        return "text/html";
    }
    add_filter( 'wp_mail_content_type','tbs_set_content_type' );


// Register Custom Post Type NGOs page
// Post Type Key: ngospage
function tbs_create_ngospage_cpt() {

	$labels = array(
		'name' => __( 'Profile pages ', 'Post Type General Name', 'textdomain' ),
		'singular_name' => __( 'Profile page', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => __( 'Profile pages ', 'textdomain' ),
		'name_admin_bar' => __( 'Profile pages', 'textdomain' ),
		'archives' => __( 'Profile pages Archives', 'textdomain' ),
		'attributes' => __( 'Profile pages Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent NGOs page:', 'textdomain' ),
		'all_items' => __( 'All Profile pages ', 'textdomain' ),
		'add_new_item' => __( 'Add New Profile pages', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Profile page', 'textdomain' ),
		'edit_item' => __( 'Edit Profile page', 'textdomain' ),
		'update_item' => __( 'Update Profile page', 'textdomain' ),
		'view_item' => __( 'View Profile page', 'textdomain' ),
		'view_items' => __( 'View Profile pages ', 'textdomain' ),
		'search_items' => __( 'Search Profile page', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into NGOs page', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this NGOs page', 'textdomain' ),
		'items_list' => __( 'NGOs pages  list', 'textdomain' ),
		'items_list_navigation' => __( 'NGOs pages  list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter NGOs pages  list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'NGOs page', 'textdomain' ),
		'description' => __( 'Custom post type for NGOs menu pages ', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-admin-page',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'comments', 'trackbacks', 'page-attributes', 'post-formats', 'custom-fields', ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'ngospage', $args );

}
add_action( 'init', 'tbs_create_ngospage_cpt', 0 );

//Add more fucntion on doantion checkout page.
//add_action( 'charitable_donation_form_after_donation_amounts', 'tbs_add_more_button' );
function tbs_add_more_button(){?>
<div class="charitable-form-header">Choose the range you want to help</div>
<div class="range-slider">
    <div id="fix-amonut">Rs. <b>1500</b> per/kit.</div>
  <input class="range-slider__range" type="range" value="1" min="1" max="10">
  <span class="range-slider__value">1</span>
  <div class="result-value">You are supporting 1 kit of 1500</div>
  <input id="result-amount" name="donation_amount" type="hidden" value=""/>
</div>

<?php
}

/**
 * Automatically set the donation amount and recurring
 * period for donations.
 * Custom range of donation.
 *
 * @param   array $fields
 * @return  array
 */
function ed_charitable_set_donation_amount( $fields ) {
   //unset( $fields['donation_fields'] );
   global $post;
   $post_id = $post->ID;
   $post_meta = get_post_meta( $post_id );
   $range_check_box = get_post_meta( $post_id, 'tbs-tbs_charitable_rangebox', true );
   $range_amount = get_post_meta( $post_id, 'tbs-range_donation_amount', true );
   $range_package_name = get_post_meta( $post_id, 'tbs-package_name', true );
  if( $range_check_box == 1 ){
    unset( $fields['donation_fields'] );
    ?>
    <div class="charitable-form-header" style="padding-left: 40px;">Choose from the range you want to donate</div>
        <div class="range-slider">
        <div id="fix-amonut">Rs. <b><?php echo $range_amount; ?></b> per <em><?php echo $range_package_name; ?></em>.</div>
            <input class="range-slider__range" type="range" value="1" min="1" max="10">
            <span class="range-slider__value">1</span>
           <center><b class="or_bold">Or</b></center>
           <div class="extra-package-div"> Enter here for more than 10 <div style="padding-left: 21px;"> <input type="text" name="" class="extra-package" value="1"/></div></div>
        <div class="result-value">You are supporting 1 <?php echo $range_package_name; ?> of Rs. <?php echo $range_amount; ?></div>
        <input id="result-amount" name="donation_amount" type="hidden" value="<?php echo $range_amount; ?>"/>
    </div>
    <?php
  }
  return $fields;

}
add_filter( 'charitable_donation_form_fields', 'ed_charitable_set_donation_amount', 20 );

//add_action( 'edit_form_after_title', 'tbs_add_title_text', 20 );
function tbs_add_title_text(){
    echo "Write below the story about project or about content for profile pages.";
}

//function to remove the extra fields form project and profile pages section.
//ngo profiles pages.
function my_remove_meta_boxes() {
		remove_meta_box( 'linktargetdiv', 'ngospage', 'normal' );
		remove_meta_box( 'slugdiv', 'ngospage', 'normal' );
		remove_meta_box( 'linkadvanceddiv', 'ngospage', 'normal' );
		remove_meta_box( 'postexcerpt', 'ngospage', 'normal' );
		remove_meta_box( 'trackbacksdiv', 'ngospage', 'normal' );
		remove_meta_box( 'postcustom', 'ngospage', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'ngospage', 'normal' );
		remove_meta_box( 'commentsdiv', 'ngospage', 'normal' );
		remove_meta_box( 'revisionsdiv', 'ngospage', 'normal' );
		remove_meta_box( 'authordiv', 'ngospage', 'normal' );
        remove_meta_box( 'formatdiv', 'ngospage', 'normal' );
        remove_meta_box( 'pageparentdiv', 'ngospage', 'normal' );
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );

//remove for post type campaign.
function remove_custom_taxonomy() {
        remove_meta_box( 'linktargetdiv', 'campaign', 'normal' );
		remove_meta_box( 'slugdiv', 'campaign', 'normal' );
		remove_meta_box( 'linkadvanceddiv', 'campaign', 'normal' );
		remove_meta_box( 'postexcerpt', 'campaign', 'normal' );
		remove_meta_box( 'trackbacksdiv', 'campaign', 'normal' );
		remove_meta_box( 'postcustom', 'campaign', 'normal' );
		remove_meta_box( 'commentstatusdiv', 'campaign', 'normal' );
		remove_meta_box( 'commentsdiv', 'campaign', 'normal' );
		remove_meta_box( 'revisionsdiv', 'campaign', 'normal' );
		remove_meta_box( 'authordiv', 'campaign', 'normal' );
        remove_meta_box( 'formatdiv', 'campaign', 'normal' );
        remove_meta_box( 'pageparentdiv', 'campaign', 'normal' );
	    remove_meta_box( 'the_champ_meta', 'campaign', 'side' );
}
add_action( 'add_meta_boxes', 'remove_custom_taxonomy' );

/**
 * Remove Rev Slider Metabox
 */
    function remove_revolution_slider_meta_boxes() {
		remove_meta_box( 'mymetabox_revslider_0', 'ngospage', 'normal' );
		remove_meta_box( 'mymetabox_revslider_0', 'page', 'normal' );
        remove_meta_box( 'mymetabox_revslider_0', 'campaign', 'normal' );
        remove_meta_box( 'the_champ_meta', 'campaign', 'side' );
	}

    add_action( 'do_meta_boxes', 'remove_revolution_slider_meta_boxes' );

    //change the admin title
    add_filter('admin_title', 'my_admin_title', 10, 2);

    function my_admin_title($admin_title, $title){
        return get_bloginfo('Indiadonates').' &bull; '.$title;
    }

    //footer text changes
    function change_admin_footer(){
        echo '<span id="footer-note">All Rights Reserved <a href="#" target="_blank">Indiadonates.in</a>.</span>';
       }
   add_filter('admin_footer_text', 'change_admin_footer');

   //Add title for custom projects
   function wpb_change_title_text( $title ){
    $screen = get_current_screen();

        if  ( 'campaign' == $screen->post_type ) {
            $title = '<p style="font-size:15px; padding-top:15px;">A catchy well-placed descriptive project name - Keep it fairly short to help donors avoid getting bogged down in insistent text.</p>';
        }

        return $title;
    }

    add_filter( 'enter_title_here', 'wpb_change_title_text' );

    /*Remove WordPress menu from admin bar*/
        add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
        function remove_wp_logo( $wp_admin_bar ) {
            $wp_admin_bar->remove_node( 'wp-logo' );
        }

    /* Main redirection of the default login page */
        function redirect_login_page() {
            $login_page  = home_url('/login/');
            $page_viewed = basename($_SERVER['REQUEST_URI']);

            if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
                wp_redirect($login_page);
                exit;
            }
        }
        add_action('init','redirect_login_page');

        /* Where to go if a login failed */
        function custom_login_failed() {
            $login_page  = home_url('/login/');
            wp_redirect($login_page . '?login=failed');
            exit;
        }
        add_action('wp_login_failed', 'custom_login_failed');

        /* Where to go if any of the fields were empty */
        function verify_user_pass($user, $username, $password) {
            $login_page  = home_url('/login/');
            if($username == "" || $password == "") {
                wp_redirect($login_page . "?login=empty");
                exit;
            }
        }
        add_filter('authenticate', 'verify_user_pass', 1, 3);

        /* What to do on logout */
        function logout_redirect() {
            $login_page  = home_url('/login/');
            wp_redirect($login_page . "?login=false");
            exit;
        }
        add_action('wp_logout','logout_redirect');


// Recent Donor Widget

function recent_register_widget() {
    register_widget( 'recent_widget' );
    }

    add_action( 'widgets_init', 'recent_register_widget' );

    class recent_widget extends WP_Widget {

    function __construct() {
    parent::__construct(
    // widget ID
    'recent_widget',
    // widget name
    __('Recent Donor Widget', ' recent_widget_domain'),
    // widget description
    array( 'description' => __( 'Recent Widget Tutorial', 'recent_widget_domain' ), )
    );
    }
    public function widget( $args, $instance ) {
        global $wpdb;
        $camp_id = get_the_ID();
        $charitable_cam_donation = "wp_charitable_campaign_donations";
        $count_donor  = $wpdb->get_results("SELECT donor_id  FROM $charitable_cam_donation Where campaign_id = $camp_id");
        ?>
         <!-- <input type="checkbox" id="star5" class="rating-star-checkbox" value=<?php // echo $recent_donor_no; ?>> -->
            <label class="full" for="star5" title="Great"></label>
            <div class="contai">
                <h2 style="text-align: center;">Recent Donor</h2>
                <div class="rating-star">

        <?php
         foreach( $count_donor as $recent_donor ) {
             $recent_donor_no = $recent_donor->donor_id;
           // echo $recent_donor_no; ?>
            <fieldset class="rating-star rating-star-fieldset">
                <input type="checkbox" id="star5" class="rating-star-checkbox" value="5">
                <label class="full" for="star5" title="Great" style="color: coral;"></label>
            </fieldset>
        <?php  } ?>

    </div>
    <h3 class="star-h3-field" style=""><a href="" class="typewrite" data-period="2000" data-type="[ &quot;You Are Next ???&quot; ]"><span class="wrap-d">You Are</span></a></h3>
    </div>
    <?php
    $title = apply_filters( 'widget_title', $instance['title'] );
    echo $args['before_widget'];
    //if title is present
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
    //output

    echo $args['after_widget'];


    }
    public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) )
    $title = $instance[ 'title' ];
    else
    $title = __( 'Default Title', 'recent_widget_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
    }
    public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
    }

}

//code to check the validation on login using ajax
add_action('wp_ajax_tbs_check_login_validation', 'tbs_check_login_validation');
add_action('wp_ajax_nopriv_tbs_check_login_validation', 'tbs_check_login_validation');

function tbs_check_login_validation(){

    //print_r($_POST);


    $user_name = $_POST["loginname"];
    $password = $_POST["password"];
    $table_name = "wp_users";
    $user_id = email_exists( $user_name );
    $user = get_user_by('email', $user_name );
    $user_login = $user->user_login;
    if ( $user_login ) {
        if ( wp_check_password( $password, $user->data->user_pass, $user->ID) ) {
            $creds = array();
            $creds['user_login'] = $user_login;
            $creds['user_password'] = $password;
            $creds['remember'] = true;
            $user = wp_signon( $creds, false );
            if ( is_wp_error($user) ) {
                $msg = $user->get_error_message();
            } else {
		wp_set_current_user( $user->ID, $user_login );
		wp_set_auth_cookie( $user->ID, true, true );
	//	do_action( 'wp_login', $user_name );

                $role = ( array ) $user->roles;
                $user_role = $role[0];
                if( $user_role == "administrator") {
                    $url = admin_url();
                }
                elseif( $user_role == "ngo_charitable" ){
                    $url = admin_url().'admin.php?page=ngo_profile_form';
                }
                 else {
                    $url = "";
                }
				 $msg = '';
				 //sleep(2);
				  //header('Location: '.$_SERVER['REQUEST_URI']);
				// wp_redirect(home_url(), $interval = 20)
               // $msg = "success_and_".$url;
               $resp =array(
                 'status' => 1,
                 'msg' => 'Login successful',
                 'url' => $url
               );

            }
        } else {
          $resp =array(
            'status' => 0,
            'msg' => 'Invalid Credential',
            'url' => $url
          );
        }
    } else {
      //  $msg = "User doesn't exist. Please use valid user email id.";
        $resp =array(
          'status' => 0,
          'msg' => 'User does not exist',
          'url' => $url
        );
    }


    echo $msg;
    echo json_encode($resp);
	//wp_redirect( home_url() ); //exit;
    wp_die();

//print_r( $user );
}

//code to get the location on campaign by users.
function tbs_charitable_project_location_name( $meta_boxes ) {
	$prefix = 'tbs-';

	$meta_boxes[] = array(
		'id' => 'charitable-project-location',
		'title' => esc_html__( 'Project Location setting', 'tbs-charitable-project-location' ),
		'post_types' => array('campaign' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'location_select_1',
				'name' => esc_html__( 'Select  Project location', 'tbs-charitable-project-location' ),
				'type' => 'select',
				'desc' => esc_html__( 'Select your project location', 'tbs-charitable-project-location' ),
				'placeholder' => esc_html__( 'Select location of your project- State', 'tbs-charitable-project-location' ),
				'options' => array(
					'Andhra Pradesh' => 'Andhra Pradesh',
					'Arunachal Pradesh' => 'Arunachal Pradesh',
					'Assam' => 'Assam',
					'Bihar' => 'Bihar',
					'Chhattisgarh' => 'Chhattisgarh',
					'Goa' => 'Goa',
					'Gujarat' => 'Gujarat',
					'Haryana' => 'Haryana',
					'Himachal Pradesh' => 'Himachal Pradesh',
					'Jammu and Kashmir' => 'Jammu and Kashmir',
					'Jharkhand' => 'Jharkhand',
					'Karnataka' => 'Karnataka',
					'Kerala' => 'Kerala',
					'Madhya Pradesh' => 'Madhya Pradesh',
					'Maharashtra' => 'Maharashtra',
					'Manipur' => 'Manipur',
					'Meghalaya' => 'Meghalaya',
					'Mizoram' => 'Mizoram',
					'Nagaland' => 'Nagaland',
					'Odisha' => 'Odisha',
					'Punjab' => 'Punjab',
					'Rajasthan' => 'Rajasthan',
					'Sikkim' => 'Sikkim',
					'Tamil Nadu' => 'Tamil Nadu',
					'Telangana' => 'Telangana',
					'Tripura' => 'Tripura',
					'Uttar Pradesh' => 'Uttar Pradesh',
					'Uttarakhand' => 'Uttarakhand',
					'West Bengal' => 'West Bengal',
				),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'tbs_charitable_project_location_name' );

/* code for the categories custom slider on home page
Generating Shortcode.
*/
function tbs_custom_categories_slider(){
    $home_url = get_home_url();
    ?>
    <section id="cat_cards" class="composer_cards">
    <div class="inner_cards">
        <div class="container cards_container">
            <div class="row cards_row">
                <div class="cards_content">
                    <!-- Category 1-->
                    <div id="card_area" class="wprt-causes cat_grid_1">
			<?php
                            $query = new WP_Query( array(

                                'post_type' => 'campaign',
                                'posts_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'tax_query'=> array(
                                    array(
                                        'taxonomy'=>'campaign_category',
                                        'field'=>'slug',
                                        'terms'=>'disability'
                                        )
                                        )
                                 ));
                            $post_count = $query->post_count;
                            if( $post_count > 1 ) {
                                $slider_class = 'owl-theme_cat';
                            } else {
                                $slider_class = 'owl-theme_ca';
                            }
                        ?>
                        <div class="owl-carousel <?php echo $slider_class; ?>">
                            <?php

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();
                                //$post_author_id = get_post_field( 'post_author', $page_id );

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
																 <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 education"><a href="<?php echo $home_url; ?>/campaign_category/disability/ ">DISABILITY</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- End Of Category -->
                    <!-- Category 2-->
                    <div id="card_area" class="wprt-causes cat_grid_3">
			<?php
                            $query = new WP_Query( array(

                                'post_type' => 'campaign',
                                'posts_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'tax_query'=> array(
                                    array(
                                        'taxonomy'=>'campaign_category',
                                        'field'=>'slug',
                                        'terms'=>'disaster-response'
                                        )
                                        )
                                 ));

                                $post_count = $query->post_count;
                                if( $post_count > 1 ) {
                                    $slider_class = 'owl-theme_cat';
                                } else {
                                    $slider_class = 'owl-theme_ca';
                                }

                            ?>
                        <div class="owl-carousel <?php echo $slider_class; ?>">
                            <?php
                                // $query = new WP_Query( array(

                                  //  'post_type' => 'campaign',
                                   // 'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                      //  array(
                                        //    'taxonomy'=>'campaign_category',
                                          //  'field'=>'slug',
                                            //'terms'=>'disaster-response'
                                            //)
                                           // )
                                    // ));
                                     //print_r( $query );
                                //query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 health"><a href="<?php echo $home_url; ?>/campaign_category/disaster-response/ ">DISASTER RESPONSE</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- Category End-->
                    <!-- Category 3-->
                    <div id="card_area" class="wprt-causes cat_grid_4">
			<?php
                        $query = new WP_Query( array(

                            'post_type' => 'campaign',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'tax_query'=> array(
                                array(
                                    'taxonomy'=>'campaign_category',
                                    'field'=>'slug',
                                    'terms'=>'education'
                                    )
                                    )
                             ));
                             //print_r( $query );
                        //query_posts( $query );

                        $post_count = $query->post_count;
                        if( $post_count > 1 ) {
                            $slider_class = 'owl-theme_cat';
                        } else {
                            $slider_class = 'owl-theme_ca';
                        }

                        ?>
                        <div class="owl-carousel <?php echo $slider_class;  ?>">
                            <?php
                                 //$query = new WP_Query( array(

                                   // 'post_type' => 'campaign',
                                    //'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                       // array(
                                         //   'taxonomy'=>'campaign_category',
                                           // 'field'=>'slug',
                                            //'terms'=>'education'
                                            //)
                                           // )
                                     //));
                                     //print_r( $query );
                                //query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 income"><a href="<?php echo $home_url; ?>/campaign_category/education/ ">EDUCATION</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- Category End -->
                </div>
            </div>
            <!-- End First Row -->
            <!-- Second Row Start -->
            <div class="row cards_row">
                <div class="cards_content">
                    <!-- Category 4-->
                    <div id="card_area" class="wprt-causes cat_grid_5">
			<?php
                        $query = new WP_Query( array(

                            'post_type' => 'campaign',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'tax_query'=> array(
                                array(
                                    'taxonomy'=>'campaign_category',
                                    'field'=>'slug',
                                    'terms'=>'elderly-care'
                                    )
                                    )
                             ));
                             //print_r( $query );
                        //query_posts( $query );


                        $post_count = $query->post_count;
                        if( $post_count > 1 ) {
                            $slider_class = 'owl-theme_cat';
                        } else {
                            $slider_class = 'owl-theme_ca';
                        }
                        ?>
                        <div class="owl-carousel <?php echo $slider_class;  ?>">
                            <?php
                                 //$query = new WP_Query( array(

                                   // 'post_type' => 'campaign',
                                   // 'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                      //  array(
                                        //    'taxonomy'=>'campaign_category',
                                          //  'field'=>'slug',
                                            //'terms'=>'elderly-care'
                                           // )
                                            //)
                                     //));
                                     //print_r( $query );
                                //query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 water"><a href="<?php echo $home_url; ?>/campaign_category/elderly-care/ ">ELDERLY CARE</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- End Of Category -->
                    <!-- Category 5-->
                    <div id="card_area" class="wprt-causes cat_grid_6">
			<?php
                     $query = new WP_Query( array(

                        'post_type' => 'campaign',
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'tax_query'=> array(
                            array(
                                'taxonomy'=>'campaign_category',
                                'field'=>'slug',
                                'terms'=>'environment'
                                )
                                )
                         ));
                         //print_r( $query );
                    //query_posts( $query );

                    $post_count = $query->post_count;
                        if( $post_count > 1 ) {
                            $slider_class = 'owl-theme_cat';
                        } else {
                            $slider_class = 'owl-theme_ca';
                        }
                        ?>
                        <div class="owl-carousel <?php echo $slider_class;  ?>">
                            <?php
                                 //$query = new WP_Query( array(

                                   // 'post_type' => 'campaign',
                                    //'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                      //  array(
                                        //    'taxonomy'=>'campaign_category',
                                          //  'field'=>'slug',
                                            //'terms'=>'environment'
                                            //)
                                            //)
                                     //));
                                     //print_r( $query );
                                //query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 disaster"><a href="<?php echo $home_url; ?>/campaign_category/environment/ ">ENVIRONMENT</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- Category End-->
                    <!-- Category 6-->
                    <div id="card_area" class="wprt-causes cat_grid_7">
			<?php

                            $query = new WP_Query( array(

                                'post_type' => 'campaign',
                                'posts_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                                'tax_query'=> array(
                                    array(
                                        'taxonomy'=>'campaign_category',
                                        'field'=>'slug',
                                        'terms'=>'health'
                                        )
                                        )
                                ));
                                //print_r( $query );
                            query_posts( $query );
                             $post_count = $query->post_count;
                             if( $post_count > 1 ) {
                                 $slider_class = 'owl-theme_cat';
                             } else {
                                 $slider_class = 'owl-theme_ca';
                             }
                        ?>
                        <div class="owl-carousel <?php echo $slider_class;  ?>">
                            <?php
                                 //$query = new WP_Query( array(

                                   // 'post_type' => 'campaign',
                                    //'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                       // array(
                                           // 'taxonomy'=>'campaign_category',
                                            //'field'=>'slug',
                                            //'terms'=>'health'
                                            //)
                                            //)
                                     //));
                                     //print_r( $query );
                               // query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 environment"><a href="<?php echo $home_url; ?>/campaign_category/health/ ">HEALTH</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- Category End -->
                </div>
            </div>
            <!-- End Second Row -->
            <!-- Start Third Row -->
            <div class="row cards_row">
                <div class="cards_content">
                    <!-- Category 7-->
                    <div id="card_area" class="wprt-causes cat_grid_8">
			<?php
                        $query = new WP_Query( array(

                            'post_type' => 'campaign',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'tax_query'=> array(
                                array(
                                    'taxonomy'=>'campaign_category',
                                    'field'=>'slug',
                                    'terms'=>'income-generation'
                                    )
                                    )
                             ));
                             //print_r( $query );
                       // query_posts( $query );

                        //query_posts( $query );
                        $post_count = $query->post_count;
                        if( $post_count > 1 ) {
                            $slider_class = 'owl-theme_cat';
                        } else {
                            $slider_class = 'owl-theme_ca';
                        }
                        ?>
                        <div class="owl-carousel <?php echo $slider_class;?>">
                            <?php
                                 //$query = new WP_Query( array(

                                   // 'post_type' => 'campaign',
                                    //'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                       // array(
                                          //  'taxonomy'=>'campaign_category',
                                           // 'field'=>'slug',
                                            //'terms'=>'income-generation'
                                           // )
                                           // )
                                     //));
                                     //print_r( $query );
                                //query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 disability"><a href="<?php echo $home_url; ?>/campaign_category/income-generation/ ">INCOME GENERATION</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php  echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- End Of Category -->
                    <!-- Category 8-->
                    <div id="card_area" class="wprt-causes cat_grid_9">
			<?php
                        $query = new WP_Query( array(

                            'post_type' => 'campaign',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'tax_query'=> array(
                                array(
                                    'taxonomy'=>'campaign_category',
                                    'field'=>'slug',
                                    'terms'=>'water-sanitation'
                                    )
                                    )
                            ));
                            //print_r( $query );
                        //query_posts( $query );
                            $post_count = $query->post_count;
                            if( $post_count > 1 ) {
                                $slider_class = 'owl-theme_cat';
                            } else {
                                $slider_class = 'owl-theme_ca';
                            }
                        ?>
                        <div class="owl-carousel <?php echo $slider_class; ?>">
                            <?php
                                // $query = new WP_Query( array(

                                  //  'post_type' => 'campaign',
                                    //'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                       // array(
                                         //   'taxonomy'=>'campaign_category',
                                           // 'field'=>'slug',
                                            //'terms'=>'water-sanitation'
                                            //)
                                            //)
                                     //));
                                     //print_r( $query );
                                //query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();

                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 others"><a href="<?php echo $home_url; ?>/campaign_category/water-sanitation/ ">WATER AND SANITATION</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- Category End-->
                    <!-- Category 9-->
                    <div id="card_area" class="wprt-causes cat_grid_1">
			<?php
                        $query = new WP_Query( array(

                            'post_type' => 'campaign',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'tax_query'=> array(
                                array(
                                    'taxonomy'=>'campaign_category',
                                    'field'=>'slug',
                                    'terms'=>'others-category'
                                    )
                                    )
                             ));
                             //print_r( $query );
                        //query_posts( $query );
                            $post_count = $query->post_count;
                            if( $post_count > 1 ) {
                                $slider_class = 'owl-theme_cat';
                            } else {
                                $slider_class = 'owl-theme_ca';
                            }

                        ?>
                        <div class="owl-carousel <?php echo $slider_class; ?>">
                            <?php
                               //  $query = new WP_Query( array(

                                 //   'post_type' => 'campaign',
                                    //'posts_per_page' => -1,
                                    //'orderby' => 'title',
                                    //'order' => 'ASC',
                                    //'tax_query'=> array(
                                      //  array(
                                            //'taxonomy'=>'campaign_category',
                                            //'field'=>'slug',
                                            //'terms'=>'others-category'
                                            //)
                                            //)
                                     //));
                                     //print_r( $query );
                              //  query_posts( $query );

                                // The Loop
                                while ( $query->have_posts() ) : $query->the_post();
                                $page_id = get_the_ID();
                                $projet_meta = get_post_meta( $page_id );
                                $project_location = get_post_meta( $page_id, 'tbs-location_select_1', true );
                                $image_url = get_the_post_thumbnail_url();
                                $project_url = get_the_permalink();
                                $campaign = charitable_get_current_campaign();
                                $currency_helper = charitable_get_currency_helper();


                            ?>
                            <div class="item">
                                <div class="inner_owl_grid">
                                    <div class="grid_owl_content">
                                        <div class="catg_img">
                                        <div><a href="<?php echo  $project_url?>" class="grid_link_project" style="cursor:pointer">

                                                <img src="<?php echo $image_url; ?>"></a></div>
                                               <div> <a href="<?php echo $project_url; ?>/donate/"><span>Donate</span></a></div>
                                            </div>
                                            <div class="cate_name-location">
                                                <h4 class="cat_nameh4 elderly_care"><a href="<?php echo $home_url; ?>/campaign_category/others-category/ ">OTHERS</a></h4>
                                                <span class="location_cate"><i class="fa fa-map-marker" style="font-size:14px"></i><?php echo $project_location; ?></span>
                                            </div>
                                            <div class="Ngo_project_title">
                                                <h3 class="ngo_titleh3"><a href="<?php echo $project_url;?>"><?php echo wp_trim_words( get_the_title(), 6, '...' ); ?></a></h3><br/>
                                                <span>&nbsp;by&nbsp;<a href="#"><a href="<?php echo get_author_posts_url( get_post_field( 'post_author', $page_id )  ); ?>" style="color:red;"><?php echo wp_trim_words( get_the_author_meta('display_name') , 6, '...' ); ?></a></a></span>
                                            </div>
                                            <div class="wprt-progress clearfix"><div class="perc-wrap"><div class="perc">
                                                <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span></div></div>
                                                <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                                <div class="progress-animate"></div>
                                                </div>
                                            </div>
                                            <div class="campaign-donation-stats">
                                                Raised: <span class="amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ); ?></span> / <span class="goal-amount"><?php echo $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ); ?></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div><?php
                                 endwhile;

                            // Reset Query
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <!-- Category End -->
                </div>
            </div>
            <!-- End Third Row -->
        </div>
    </div>
</section><?php


}
add_shortcode( 'cat-slider', 'tbs_custom_categories_slider' );

/*
Code for the counter total NGO, Fund rises and donor.
1. Count Total NGOs.
2. Count Total FUND RAISED.
3. Count Total PROJECTS.
4. Count total BENEFICIARIES.
*/
function tbs_total_count_number(){
    global $wpdb;
    $ngo_table_name = "wp_ngo_profile";
    $donor_table_table = "wp_charitable_donors";
    $total_reased_fund = "wp_charitable_campaign_donations";
    $total_project_count = wp_count_posts( 'campaign' )->publish;

    //Count the NGO numbers.
    $ngo_count_query = $wpdb->get_results( "SELECT COUNT(id) as ngo_number FROM $ngo_table_name ");
    foreach($ngo_count_query as $ngo_count){
         $total_ngo = $ngo_count->ngo_number;
    }

    //Count the donors numbers.
    $donor_count_query = $wpdb->get_results( "SELECT COUNT(donor_id) as donors_number FROM $donor_table_table ");
    foreach( $donor_count_query as $donor_count ){
         $total_donor = $donor_count->donors_number;
    }

    //Count the total donation amount.
    $donation_sum_query = $wpdb->get_results( "SELECT SUM(amount) as donation_amount FROM $total_reased_fund ");
    foreach( $donation_sum_query as $donation_sum ){
         $total_donation = $donation_sum->donation_amount;
    }

    ?>
    <div>
		<div class="outerdiv-tbs">
			<div class="divinner-tbs">
				<div class="divinner1-tbs">
					<span class="divinner1a-tbs"><?php echo $total_ngo; ?></span>
					<hr class="divinner1b-tbs">
					<span class="divinner1c-tbs">NGOS</span>
				</div>
				<div class="divinner2-tbs">
					<span class="divinner1a-tbs"><?php echo $total_project_count; ?></span>
					<hr class="divinner1b-tbs">
					<span class="divinner1c-tbs">PROJECTS</span>
				</div>
				<div class="divinner3-tbs">
					<span class="divinner1a-tbs"><?php echo $total_donor; ?></span>
					<hr class="divinner1b-tbs">
					<span class="divinner1c-tbs">BENEFICIARIES</span>
				</div>
				<div class="divinner4-tbs">
					<span class="divinner1a-tbs"><?php  //echo  intval( $total_donation );
						$amonut_paid =  do_shortcode('[charitable_stat display=total]');
                   				$amonut_to_be_show = explode(".", $amonut_paid );
                    				echo  str_replace(',','',$amonut_to_be_show[1] );
					 ?></span>
					<hr class="divinner1b-tbs">
					<span class="divinner1c-tbs">FUND RAISED</span>
				</div>
			</div>
		</div>
	</div>

    <?php

}
add_shortcode('tbs-counter', 'tbs_total_count_number');

add_filter( 'ajax_query_attachments_args', 'wpb_show_current_user_attachments' );

function wpb_show_current_user_attachments( $query ) {
    $user_id = get_current_user_id();
    if ( $user_id && !current_user_can('activate_plugins') && !current_user_can('edit_others_posts
') ) {
        $query['author'] = $user_id;
    }
    return $query;
}


// hide update notifications
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //h

?>
