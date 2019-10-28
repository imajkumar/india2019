<?php
   /*
   Plugin Name: NGO Profile
   Plugin URI: https://techbrise.com/
   description:A plugin to create NGO profiles and send it for verifications.
   Version: 1.0
   Author: TechBrise
   License: GPL2
   */
   // $adm_is = get_current_user_id();
 //  $current_user = wp_get_current_user();
//   print_r($current_user); die();
  // echo $current_user->ID;
  // echo get_current_user_id() ;die();
   if(isset($_POST['savedata'])){
	   global $wpdb;
	 echo $daaata =get_current_user_id() ;
	print_r($daaata);
	//echo '<pre>'; print_r($_POST);echo '</pre>';
		$j = sizeof($_POST['txtname']);
	//echo get_current_user_id();
	//die();
	 for($i=0; $i<$j;$i++){
		 $uid ='314';
		//echo '<pre>'; print_r($data);echo '</pre>';

		echo $name = $_POST['txtname'][$i];
	   $desig = $_POST['desig'][$i];
	   $tenure = $_POST['tenure'][$i];
	   $occup = $_POST['occup'][$i];
	   $relation = $_POST['relation'][$i];

	   $result = $wpdb->insert( 'wp_board_member',

         array(
              'id' => '',
              'user_id' => $uid,
			  'name' => $name,
			  'designation' => $desig,
			  'tenure' => $tenure,
			  'occupation' => $occup,
			  'relationship' => $relation
              ),
         array(
              '%d',
              '%d',
			  '%s',
			  '%s',
			  '%s',
			  '%s',
			  '%s',
      )

    );
	 }
	 //die();



   }

?>
<?php
// Disable to create single table for every Ngo websites.

$adm_is = get_current_user_id();
//if( $adm_is == 1 ) {
  require_once 'profile_table.php';
//}E

/*	$admin_email = get_option( 'admin_email' );
			$to = $admin_email;
		  //	$to = 'anurga@gmail.com';
			//$usercopy=$email;

			// $body = file_get_contents(plugin_dir_url( _FILE_ ) . 'css/email.php');
			// $body = str_replace('{{--shipFrom--}}', $shipF, $body);
			// $body = str_replace('{{--shipTo--}}', $shipT, $body);
			// $body = str_replace('{{--vehicleType--}}', $vType, $body);
            // $body = str_replace('{{--vehicleValue--}}', $vehi_val, $body);

			// $body = str_replace('{{--name--}}', $name, $body);
			// $body = str_replace('{{--phone--}}', $phone, $body);
			// $body = str_replace('{{--email--}}', $email, $body);

			// $body = str_replace('{{--frieght--}}', $f_rate, $body);
			// $body = str_replace('{{--insurance--}}', $insurace, $body);
			// $body = str_replace('{{--shipcost--}}', $ship_cost, $body);
			// $body = str_replace('{{--duty--}}', $duty, $body);
			// $body = str_replace('{{--gstv--}}', $gst, $body);
			// $body = str_replace('{{--c_symbol--}}', $c_symbol, $body);







		  $subject = 'Online Calculator Submission';
		 $body = 'Ship From';  // :'.$shipF."<br>";

		  $headers = array('Content-Type: text/html; charset=UTF-8');
		  // $multiple_recipients = array(
                // 'bhagyavm@gmail.com',
                // 'bhagyavm@gmail.com',
                // 'bhagyavm@gmail.com'
            // );
		  wp_mail( 'bhagyavm@gmail.com', $subject, $body, $headers );

} */
add_action('admin_menu', 'ngo_profile_menu');

function ngo_profile_menu(){
  $user_id = get_current_user_id();
  $user_meta= get_userdata($user_id);
  $user_roles= $user_meta->roles;
  //print_r(  $user_roles );
  if ( in_array("administrator", $user_roles) ){
    add_menu_page( 'NGO profile Page', 'List of NGOs', 'edit_posts', 'ngo_profile_form', 'tbs_ngo_profile_form','',10);
    add_submenu_page( 'ngo_profile_form', 'Form one details', 'Form one details', 'edit_posts','ngo_user_details', 'tbs_ngo_form_one_details');


	// add_submenu_page( 'ngo_profile_form', 'Form two details', 'Form two details', 'edit_posts','ngo_add_details', 'tbs_ngo_form_one_details1');
  } else {
    add_menu_page( 'NGO profile Page', 'NGO profile', 'edit_posts', 'ngo_profile_form', 'tbs_ngo_profile_form','',10);
    add_submenu_page( 'ngo_profile_form', 'Edit NGO profile', 'Edit NGO profile', 'edit_posts','edit-profile', 'tbs_edit_profiles');
	 add_submenu_page( 'ngo_profile_form', 'ADD Board Member', 'ADD Board Member', 'read','ngo_add_details', 'tbs_ngo_form_one_details12');

    $permission_grnt = "";
    global $wpdb;
    $table_name = "wp_ngo_profile";
    $charitable_cam_donation = "wp_charitable_campaign_donations";
    $result = $wpdb->get_results( " SELECT * FROM $table_name WHERE  nguser_id= '$user_id' ");
    $campign_id = $wpdb->get_results("SELECT campaign_id.$charitable_cam_donation FROM $table_name where nguser_id = '$user_id'" );
       foreach ($result as $print ) {
          $permission_grnt = $print->approval_status;
    if( $permission_grnt == "yes" ){
      add_menu_page( 'Projects Page', 'Projects Page', 'edit_posts', 'ngo_projects_page', 'ngo_projects_page_form','',10);
      add_submenu_page( 'ngo_projects_page', 'Add New Projects', 'Add New Projects','edit_posts','add_new_projects', 'ngo_projects_page_edit');

    }
  }

  }

}
/* Function to fetch the details for ngo registration form one.By using this function admin will send the mail to the ngo with second form links*/

function tbs_ngo_form_one_details12(){ ?>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<br/>
<br/>
<center><h2>Add Board Member</h2></center>
<div class="container">
<form method="post" action="">
<div class="field_wrapper"><?php
// get_currentuserinfo();

      //echo 'Username: ' . $current_user->user_login . "\n";


?>
<div class="col-md-2 col-sm-12"><input type="text" name="txtname[]" placeholder='Name' class="form-control" required></div>
<div class="col-md-2 col-sm-12"><input type="text" name="desig[]" placeholder='Designation' class="form-control" required></div>
<div class="col-md-2 col-sm-12"><input type="text" name="tenure[]" placeholder='Tenure' class="form-control" required></div>
<div class="col-md-2 col-sm-12"><input type="text" name="occup[]" placeholder='Occupation' class="form-control" required></div>
<div class="col-md-2 col-sm-12"><input type="text" name="relation[]" placeholder='Relationship with Board' class="form-control" required></div>
<a href="javascript:void(0);" class="add_button" title="Add field"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/add-icon.png"/> </a>

</div>
 </div><br/><br/>
 <center><input type="submit" name="savedata"></center>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="field_wrapper"><br/><div class="col-md-2 col-sm-12"><input type="text" name="txtname[]" placeholder="Name" class="form-control" required></div><div class="col-md-2 col-sm-12"><input type="text" name="desig[]" placeholder="Designation" class="form-control" required ></div><div class="col-md-2 col-sm-12"><input type="text" name="tenure[]" placeholder="Tenure" class="form-control" required></div><div class="col-md-2 col-sm-12"><input type="text" name="occup[]" placeholder="Occupation" class="form-control" required ></div><div class="col-md-2 col-sm-12"><input type="text" name="relation[]" placeholder="Relationship with the Board Member" class="form-control" required></div><a href="javascript:void(0);" class="remove_button" title="Remove field">  <img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/remove-icon.png"></a></div>';

    $(addButton).click(function(){
            $(wrapper).append(fieldHTML);
       });


    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
       e.preventDefault();
      $(this).parent('div').remove();

    });
});
</script>


<?php }

function tbs_ngo_form_one_details(){

  if( isset( $_GET['nunid'] ) ){
     $nid = $_GET['nunid'];
     $ngo_user_data = get_userdata( $nid );
     $user_ngo_login =  $ngo_user_data->user_login;
     $user_ngo_password = $ngo_user_data->user_pass;
     $user_ngo_email_id = $ngo_user_data->user_email;
     $user_ngo_web = $ngo_user_data->user_url;
     $user_ngo_name = $ngo_user_data->display_name;
     $ngo_user_meta = get_user_meta( $nid );
     //print_r($ngo_user_meta);
     $ngo_user_org_name = get_user_meta( $nid, 'org_name', true);
     $ngo_user_prefix_name = get_user_meta( $nid, 'user_prefix_name', true );
     $ngo_user_first_name = get_user_meta( $nid, 'user_first_name', true );
     $ngo_user_last_name = get_user_meta( $nid, 'user_last_name', true );
     $ngo_user_state = get_user_meta( $nid, 'user_state', true );
     $ngo_user_city = get_user_meta( $nid, 'user_city', true );
     $ngo_user_mobile_number = get_user_meta( $nid, 'user_phone', true );
     $ngo_user_desig = get_user_meta( $nid, 'user_designation', true );
     $ngo_user_reg_add = get_user_meta( $nid, 'user_reg_add', true );
     $ngo_user_reg_type = get_user_meta( $nid, 'user_ngo_type', true );
     $ngo_user_last_incom = get_user_meta( $nid, 'user_last_year_incom',true );
     $ngo_user_last_expd = get_user_meta( $nid, 'user_last_year_expd' ,true );
     $ngo_user_a_12_number = get_user_meta( $nid, 'user_a_12' ,true );
     $ngo_user_g_80_number = get_user_meta( $nid, 'user_g_80', true );
     $ngo_user_pan_number = get_user_meta( $nid, 'user_pan' ,true );
     $ngo_user_tan_number = get_user_meta( $nid, 'user_tan', true );
     $ngo_user_causes_for = get_user_meta( $nid, 'user_causes_for', true );
     $ngo_user_other_causes = get_user_meta( $nid, 'user_other_causes', true );
     $ngo_user_temp_pass = get_user_meta( $nid, 'vikkip', true );
   // echo" <center><h1> NGO Form- 1 details</h1></center>";

    ?>
    <div class="user-ngo-details-main-div">
    <center><h1> NGO Registration Details (Form-1)</h1></center>
      <div class="user-ngo-details-inner-first-div">
        <table class="tg">
          <tr>
            <td class="tg-0lax">Organsiation Name</td>
            <td class="tg-lqy6">:   <?php echo $ngo_user_org_name; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">State</td>
            <td class="tg-lqy6">:  <?php
            global $wpdb;
            $results_state = $wpdb->get_results( "SELECT * FROM wp_state_city WHERE id = $ngo_user_state;");
            foreach ($results_state as $key ) {?>
           <?php echo $key->name; }?></td>
          </tr>
          <tr>
            <td class="tg-0lax">Full Name</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_prefix_name." ". $ngo_user_first_name." ".$ngo_user_last_name ; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">Mobile Number</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_mobile_number; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">Registered Address</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_reg_add; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">Last Year's Income</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_last_incom; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">80G</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_g_80_number; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">PAN</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_pan_number; ?></td>
          </tr>

          <tr>
            <td class="tg-0lax">Causes support</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_causes_for; echo $ngo_user_other_causes; ?></td>
          </tr>

        </table>

      </div>
      <div class="user-ngo-details-inner-second-div">
        <table class="tg">
          <tr>
            <td class="tg-0lax">Websites</td>
            <td class="tg-lqy6">:  <?php echo $user_ngo_web; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">city</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_city; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">Designation</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_desig; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax ">Email</td>
            <td class="tg-lqy6">:  <?php echo $user_ngo_email_id; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">Registration type</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_reg_type; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">Last Year's Expenditure</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_last_expd; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">12A</td>
            <td class="tg-lqy6">:  <?php echo  $ngo_user_a_12_number; ?></td>
          </tr>
          <tr>
            <td class="tg-0lax">TAN</td>
            <td class="tg-lqy6">:  <?php echo $ngo_user_tan_number; ?></td>
          </tr>
          <tr style="background-color:transparent; border-bottom:transparent;">
            <td class="tg-0lax"></td>
            <td class="tg-lqy6"></td>
          </tr>
        </table>

      </div>
	  <div style="clear:both;"></div>
		 <center>
    <center><h1> Board Member</h1></center>
      <div class="">
        <table class="tg">
          <tr>
		  <th>S.No</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Tenure</th>
		  <th>Occupation</th>
		  <th>Relationship</th></tr>
	  <?php $s=1;
	  $results_state11 = $wpdb->get_results( "SELECT * FROM wp_board_member WHERE user_id = $nid");
            foreach ($results_state11 as $key ) { ?>

		  <tr>
            <td class="tg-0lax"><?php echo $s++ ?></td>
            <td class="tg-lqy6">  <?php echo $key->name; ?></td>
			<td class="tg-lqy6">  <?php echo $key->designation; ?></td>
			<td class="tg-lqy6">  <?php echo $key->tenure; ?></td>
			<td class="tg-lqy6">  <?php echo $key->occupation; ?></td>
			<td class="tg-lqy6"> <?php echo $key->relationship; ?></td>
          </tr>

			<?php } ?>

			 </table>

      </div>

	  </center>
	  <div style="clear:both;"></div>
        <?php
        if ( isset( $_POST["approve"] ) ) {
          $link = admin_url('/admin.php?page=ngo_profile_form');
          $message = "Mail Sent to NGO!";
          $arr_of_name = explode(' ', $ngo_user_full_name );
          $lastname = array_pop( $arr_of_name );
          $password_rset_link = home_url('/login/forgot-password/');
          $ngo_form_Second_link = admin_url('/admin.php?page=ngo_profile_form');
          $ngo_message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
              <meta name='viewport' content='width=device-width, initial-scale=1' />
              <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>

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
                  padding: 10px 10px 0px;
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
                  padding: 30px 10px;
                  width: 500px;
                }

                .mini-block {
                background-color: #ffffff;
                width: 498px;
                border: 0px solid #cccccc;
                border-radius: 5px;
                padding: 15px 15px;
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
                  padding: 10px 10px;
                  border: 1px solid #cccccc;
                  color: #4d4d4d;
                  font-weight: bold;
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
                padding: 10px 10px 0px;
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
                            <table cellpadding='0' cellspacing='0' width='800' class='w320'>
                              <tr>
                                <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                                  <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                                </td>
                                <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                                  <a style='color:#3C5A99;' href='#'><i class='fab fa-facebook-f fa-2x'></i></a>
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
                    <table cellspacing='0' cellpadding='0' width='800' class='w320'>
                      <tr>
                        <td class='free-text pull-left'>
                          Dear <strong> $ngo_user_prefix_name. $ngo_user_last_name </strong>

                          <p>Greetings from IndiaDonates!</p>

                          <p>Thank you for showing your interest. Your details have been verified. In order to proceed further, we would request you to fill in the online form. This needs activation of your account.</p>

                           <p>To activate your account, please click the link below:</p>
                          <a href='$ngo_form_Second_link'>$ngo_form_Second_link</a>
                        </td>
                      </tr>
                      <tr>
                        <td style='padding-bottom: 10px;'></td>

                      </tr>
                      <tr>
                        <td class='mini-block-container'>
                          <table cellspacing='0' cellpadding='0' width='100%'  style='border-collapse:separate !important;'>
                            <tr>
                              <td class='mini-block'>
                                <table cellpadding='5' cellspacing='5' width='100%'>
                                  <tr>
                                    <td class='code-block' style='text-align:center;'>
                                      <p>Username is your registered email id: <a href='mailto: $user_ngo_email_id'> $user_ngo_email_id </a></p>
                                      <p>Auto generated password is: <span style='color: #000'> $ngo_user_temp_pass </span></p>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style='padding: 10px 10px 0px; text-align: left;'>
                          <p>In case, you wish to change your password <a href='$password_rset_link'>click here</a></p>
                            <!--<p><a href='$password_rset_link'> $password_rset_link</strong></a></p>-->
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p class='bottom_regards'>For any questions and clarifications, do not hesitate to contact us at coordinator@indiadonates.in</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class='bottom_regards'>
                            <p>Regards,<br><strong>IndiaDonatesTeam</strong></p>

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

                            <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                              Sector 20, Noida<br>
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
          //$ngo_message = "Dear Mr./ Ms. {$ngo_user_full_name}. Invitation to create your next fundraiser profile, click on the link given below.\n URL: \n{$link}\n Username:{$user_ngo_login} \n Password:{$ngo_user_temp_pass} ";
          $ngo_headers = 'From: Indiadonates <no-reply@indiadonates.com>' . "\r\n";
          wp_mail( $user_ngo_email_id, "Welcome to IndiaDonates.in, Activate your account now!", $ngo_message , $ngo_headers);
          $user_nid = $_GET['nunid'];
          update_user_meta( $user_nid, 'first_form_mail', 'send' );

          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        ?>
        <form method="post">
          <div class="btn-ngo-approve-div">
            <?php
             $use_nid = $_GET['nunid'];
             $send_mail_status = get_user_meta( $use_nid, 'first_form_mail', true );
             $check_mail = get_user_meta( $use_nid );
            // print_r( $check_mail );
             if( $send_mail_status == "send" ){ ?>
              <button id="send_mail_form_1" class="btn_ngo_approve" name="approve" value="yes">Resend Mail</button><br> <?php
             }else{ ?>
               <button id="send_mail_form_1" class="btn_ngo_approve" name="approve" value="yes">Send Mail</button><br>
             <?php
             }
            ?>
            <em class="em-heading">Click here to send the form 2 link with username and Password.</em>
            </div>
        </form>

    </div>

    <?php

}else{
  global $wpdb;

  ?> <center><h2>List of NGOs Users</h2></center>
    <table class="user_table">
    <tr class="user_td user_th">
        <th class="th-ngoname">NGO Name</th>
        <th>Date of Registration</th>
        <th>Status</th>
        <th>Details</th>
    </tr>
      <?php
    $table_name = "wp_users";
       $result = $wpdb->get_results( " SELECT *  FROM $table_name
       JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id
       WHERE wp_usermeta.meta_key = 'wp_capabilities' and wp_usermeta.meta_value like '%ngo_charitable%' ORDER BY id DESC " );
       foreach( $result as $print ){
         //print_r( $print );
           $ngo_form_id = $print->ID;
         ?>
                <tr>
                  <td class="th-ngoname"><?php echo $print->display_name;?></td>
                  <td><?php echo date("jS F, Y", strtotime( $print->user_registered ) );?></td>
                  <td><?php
                   $ngo_status_btn = "";
                   //global $wpdb;
                   $table_name = "wp_ngo_profile";
                   $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$ngo_form_id'" );
                   if ( empty( $result ) ) {
                      echo $status = "Pending";
                    }else{
                    foreach ($result as $ngo ) {
                    $ngo_status_btn = $ngo->approval_status;
                    switch ( $ngo_status_btn ) {
                      case 'yes':
                        $status = 'Approved';
                        break;
                      case 'no':
                        $status = 'Rejected';
                        break;
                      default:
                        $status = 'Pending';
                        break;
                    }//end switch.
                  }
                    ?><?php echo $status;?></td><?php
                  }//end forech ?>
                   <td><a style="text-decoration: none;" href ="<?php echo get_admin_url();?>admin.php?page=ngo_user_details&nunid=<?php echo $print->ID; ?>">View Details</a></td>
                </tr>
         <?php

       }//end of foreach main.
       ?>
       </table>
       <?php
  }//end else condition.

}//end of function


//Function to Update the profiles the form.
function tbs_edit_profiles(){
  //echo "Ngo will edit the profies here.";
   global $wpdb;
   $user_id = get_current_user_id();
   $ng_id = "";
   $permission_grnt = "";
    $table_name = "wp_ngo_profile";
    $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$user_id'" );
       foreach ($result as $print ) {
          $permission_grnt = $print->approval_status;
            $ngo_done = $print->ngo_done;
          $ng_id = $print->nguser_id;
            $_narrative_msg = get_user_meta( get_current_user_id(), '_narrative_msg', true );
if($ngo_done==0){
  $ng_id = $print->nguser_id;
  $permission_grnt=='yes';
}


      if ( $ng_id!="" && $permission_grnt = "yes" ){

    global $wpdb;
    if ( isset( $_POST["prof_update"] ) ) {
    //$table = $wpdb->prefix."ngo_profile";
    $id = get_current_user_id();
    $table = "wp_ngo_profile";
    $org_name = strip_tags( $_POST["full_name"], "" );
    $designation = strip_tags( $_POST["user_desi"], "" );
    $email_id = strip_tags( $_POST["email"], "" );
    $mobile_number = strip_tags( $_POST["mobile_numb"], "" );
    $reserve_contact_name = strip_tags( $_POST["rc_name"], "" );
    $fr_contact_name = strip_tags( $_POST["frc_name"], "" );
    $acc_contact_name = strip_tags( $_POST["ac_name"], "" );
    $vision = $_POST["our_vis"];
    $mission = $_POST["our_mis"];
    $ngo_pan = strip_tags( $_POST["pan_numb"], "" );
    $ngo_pan_reg_no = strip_tags( $_POST["pan_reg"], "" );
    $ngo_pan_reg_date = strip_tags( $_POST["pan_dor"], "" );
    $ngo_tan = strip_tags( $_POST["tan_numb"], "" );
    $ngo_tan_reg_no = strip_tags( $_POST["tan_reg"], "" );
    $ngo_tan_reg_date = strip_tags( $_POST["tan_dor"], "" );
    $fcra = strip_tags( $_POST["fcra"], "" );
    $bank_name = strip_tags( $_POST["bank_name"], "" );
    $bank_branch = strip_tags( $_POST["bank_branch"], "" );
    $acc_number = strip_tags( $_POST["act_numb"], "" );
    $acc_name = strip_tags( $_POST["name_acct"], "" );
    $micr_number = strip_tags( $_POST["micr_nmb"], "" );
    $acc_type = strip_tags( $_POST["acc_type"], "" );
    $swift_code = strip_tags( $_POST["swift_code"], "" );
    $ifsc_code = strip_tags( $_POST["ifsc_code"], "" );
    $about_org = $_POST["abut_org"];
    $ng_site_id = strip_tags( $_POST["site_id"], "" );
    $ng_user_id = strip_tags( $_POST["site_user_id"], "" );

    //new feilds form one.
     $legal_name = strip_tags( $_POST["legal_name"], "" );
     $website = strip_tags( $_POST["web"], "" );
     $reg_add = strip_tags( $_POST["add_vari"], "" );
     $state = strip_tags( $_POST["state_name"], "" );
     $city = strip_tags( $_POST["city_name"], "" );
     $last_year_expd = strip_tags( $_POST["site_user_id"], "" );
     $last_year_income = strip_tags( $_POST["site_user_id"], "" );
     $last_yaer_trn = strip_tags( $_POST["site_user_id"], "" );
     $no_of_bnfs = strip_tags( $_POST["site_user_id"], "" );
     $a_12_num = strip_tags( $_POST["site_user_id"], "" );
     $g_80_num = strip_tags( $_POST["site_user_id"], "" );
     $causes_for = strip_tags( $_POST["site_user_id"], "" );

     //new feilds form second
     $acroym = strip_tags( $_POST["acronym"], "" );
     $pin_number = strip_tags( $_POST["pin_number"], "" );

     //contact type
     $contact_type = strip_tags( $_POST["ct_contact"], "" );
     $contact_type_desig = strip_tags( $_POST["ct_desig"], "" );
     $contact_type_eamil = strip_tags( $_POST["ct_email"], "" );
     $contct_type_landline = strip_tags( $_POST["ct_landline"], "" );
     $contact_type_mobile = strip_tags( $_POST["ct_mobile"], "" );

     // Reserve contact type
     $reserve_cont_desig = strip_tags( $_POST["rc_desig"], "" );
     $reserve_cont_eamil = strip_tags( $_POST["rc_email"], "" );
     $reserve_cont_landline = strip_tags( $_POST["rc_landline"], "" );
     $reserve_cont_mobile = strip_tags( $_POST["rc_mobile"], "" );


     // Fundrising contact type
     $fr_cont_desig = strip_tags( $_POST["frc_desig"], "" );
     $fr_cont_eamil = strip_tags( $_POST["frc_email"], "" );
     $fr_cont_landline = strip_tags( $_POST["frc_landline"], "" );
     $fr_cont_mobile = strip_tags( $_POST["frc_mobile"], "" );

     // Account contact type
     $acc_cont_desig = strip_tags( $_POST["ac_desig"], "" );
     $acc_cont_eamil = strip_tags( $_POST["ac_email"], "" );
     $acc_cont_landline = strip_tags( $_POST["ac_landline"], "" );
     $acc_cont_mobile = strip_tags( $_POST["ac_mobile"], "" );

     $trust = strip_tags( $_POST["trust_fvari"], "" );
     $socity_name = strip_tags( $_POST["so_name"], "" );
     $socity_reg_num = strip_tags( $_POST["so_regis"], "" );
     $socity_reg_date = strip_tags( $_POST["so_dor"], "" );

     //section 8
     $section_eig_name = strip_tags( $_POST["sec_name"], "" );
     $section_eig_re_num = strip_tags( $_POST["sec_regis"], "" );
     $section_eig_date_reg = strip_tags( $_POST["sec_dor"], "" );

    $ng_logo = strip_tags( $_POST["tbs_ngo_logo"], "" );
    //$blog_id = get_current_blog_id();
    //update_blog_details( $blog_id, array('blogname'=>$org_name) );

   $success = $wpdb->update(
        $table,
        array(
            'org_name' => $org_name,
            'designation' => $designation,
            'email_id' => $email_id,
            'mobile_n' => $mobile_number,
            'ngo_mission' => $vision,
            'ngo_vision' => $mission,
            'ngo_pan' => $ngo_pan,
            'ngo_pan_reg_no' => $ngo_pan_reg_no,
            'ngo_pan_reg_date' => $ngo_pan_reg_date,
            'ngo_tan' => $ngo_tan,
            'ngo_tan_reg_no' => $ngo_tan_reg_no,
            'ngo_tan_reg_date' => $ngo_tan_reg_date,
            'bank_name' => $bank_name,
            'bank_b_add' => $bank_branch,
            'acc_number' => $acc_number,
            'acc_name' => $acc_name,
            'micr_num' => $micr_number,
            'acc_type' => $acc_type,
            'swift_code' => $swift_code,
            'ifsc_code' => $ifsc_code,
            'about_org' => $about_org,
            'legal_name' => $legal_name,
            'website' =>$website,
            'reg_add' =>$reg_add,
            'state' => $state,
            'city' => $city,
            'cause_for' => $causes_for,
            'acroyn' => $acroym,
            'pin_number' => $pin_number,
            'trust' => $trust,
            'trust_dor'=>$trust,
            'socity_name' => $socity_name,
            'socity_reg_number' =>  $socity_reg_num,
            'socity_date_of_reg' =>  $socity_reg_date,
            'section_eig_name' => $section_eig_name,
            'secton_eig_reg_number'=>  $section_eig_re_num ,
            'section_eig_date_of_reg' => $section_eig_date_reg,
            'ngo_logo' => $ng_logo
        ),
        array(
            'nguser_id' => $id,
             )
    );
   if( $success ){
          $message = "Your Profile is Updated. please reload to see the changes";
              echo "<script type='text/javascript'>alert('$message');</script>";
      }else{
          $messagen = "Wrong!!Unable to update! Please conatct to Support!" ;
          echo "<script type='text/javascript'>alert('$messagen');</script>";
      }

}
  ?>
  <center><h2> Edit your Profile.</h2></center>
  <div class="edit-form-div">
  <form class="edit-form" method="post">
      <!-- form-2 fields-->
    <div class='field-edit'>
      <label>Full Name Of Organisation</label>
      <input name="full_name" type="text" value="<?php echo $print->org_name;?>">
    </div>
    <div class='field-edit'>
      <label>Legal Name</label>
      <input name="legal_name" type="text" value="<?php echo $print->legal_name;?>">
    </div>
    <div class='field-edit'>
      <label>Acronym(if any)</label>
      <input name="acronym" type="text" value="<?php echo $print->acroyn;?>">
    </div>
    <div class='field-edit'>
      <label>Address</label>
      <input name="add_vari" type="text" value="<?php echo $print->reg_add;;?>"></div>
    <div class='field-edit'>
      <label>PIN Code</label>
      <input name="pin_number" type="text" value="<?php echo $print->pin_number;?>"></div>
    <div class='field-edit'><label>Mobile Number</label><input name="mobile_numb" type="text" value="<?php echo $print->mobile_n;?>"></div>
    <div class='field-edit'><label>Email</label><input  name="email" type="email" value="<?php echo $print->email_id;?>"></div>
    <div class='field-edit'><label>Website</label><input name="web" type="text" value="<?php echo $print->email_id;?>"></div>
    <div class='field-edit'><label>Designation</label><input name="designation"  placeholder='Designation' value="<?php echo $print->email_id;?>"></div>

    <div class="field-edit">
      <label>Organisation Type</label>
        <select type="select" name="trust_fvari" id="editf-sel" >
          <option value="<?php echo $print->trust;?>"><?php echo $print->trust;?></option>
          <option>Trust</option>
           <option>Company</option>
          <option>Trust and company Both</option>
        </select>
      </div>
    <div class='field-edit'><label>PAN Number</label><input name="pan_numb" value="<?php echo $print->ngo_pan;?>"></div>
    <div class='field-edit'><label>PAN Registration</label><input name="pan_reg"  value="<?php echo $print->ngo_pan_reg_no;?>"></div>
    <div class='field-edit'><label>PAN Registration Date</label><input type="date" name="pan_dor"   value="<?php echo $print->ngo_pan_reg_date;?>"></div>
    <div class='field-edit'><label>TAN Number</label><input name="tan_numb" value="<?php echo $print->ngo_tan;?>"></div>
    <div class='field-edit'><label>TAN Registration</label><input name="tan_reg"  value="<?php echo $print->ngo_tan_reg_no;?>"></div>
    <div class='field-edit'><label>TAN Registration Date</label><input type="date" name="tan_dor" value="<?php echo $print->ngo_tan_reg_date;?>"></div>
    <div class='field-edit'><label>Society Name</label><input name="so_name"  placeholder='Society' value="<?php echo $print->socity_name;?>"></div>
    <div class='field-edit'><label>Society Registration</label><input name="so_regis"  placeholder='' value="<?php echo $print->socity_reg_number;?>"></div>
    <div class='field-edit'><label>Society Registration Date</label><input name="so_dor"  placeholder='Registration Date' value="<?php echo $print->socity_date_of_reg;?>"></div>
    <div class='field-edit'><label>Section 8</label><input name="sec_name" value="<?php echo $print->section_eig_name;?>"></div>
    <div class='field-edit'><label>Secton Registration</label><input name="sec_regis"  placeholder='' value="<?php echo $print->secton_eig_reg_number;?>"></div>
    <div class='field-edit'><label>Section Registration Date</label><input type="date" name="sec_dor"   value="<?php echo $print->section_eig_date_of_reg;?>"></div>

    <div class='field-edit' style="vertical-align: top;">
      <label>About Organisation</label>
      <textarea id="field-edit-textf" minlength="1" maxlength="400" name="abut_org" value="<?php echo $print->about_org;?>"><?php echo $print->about_org;?></textarea>
    </div>
    <div class='field-edit' style="vertical-align: top;">
      <label>Our Vision</label>
      <textarea id="field-edit-textf" minlength="1" maxlength="400" name="our_vis"><?php echo $print->ngo_vision;?></textarea>
    </div>
    <div class='field-edit' style="vertical-align: top;">
      <label>Our Mission</label>
      <textarea id="field-edit-textf" minlength="1" maxlength="400" name="our_mis" value="<?php echo $print->ngo_mission;?><"><?php echo $print->ngo_mission;?></textarea>
    </div>

    <div class='field-edit'><label>Bank Name</label><input name="bank_name"  value="<?php echo $print->bank_name;?>"></div>
    <div class='field-edit'><label>Bank Branch Name</label><input name="bank_branch" value="<?php echo $print->bank_b_add;?>"></div>
    <div class='field-edit'><label>Account Number</label><input name="act_numb"  value="<?php echo $print->acc_number;?>"></div>
    <div class='field-edit'><label>Account Name</label><input name="name_acct" value="<?php echo $print->acc_name;?>"></div>
    <div class='field-edit'><label>MIRC Number</label><input name="micr_nmb" value="<?php echo $print->micr_num;?>"></div>
    <div class="field-edit">
      <label>Account Type</label>
        <select type="select" name="acc_type" id="editf-sel" >
          <option value="<?php echo $print->acc_type;?>" ><?php echo $print->acc_type;?></option>
          <option>Current Account</option>
          <option>Saving Account</option>
        </select>
      </div>
    <div class='field-edit'><label>SWIFT Code</label><input name="swift_code"  placeholder='SWIFT Code' value="<?php echo $print->swift_code;?>"></div>
    <div class='field-edit' ><label>IFSE Code</label><input name="ifsc_code"  placeholder='IFSC CODE' value="<?php echo $print->ifsc_code;?>"></div>

     <div class='field-edit logo-A1' style="width: 100%">
      <input type="hidden" name="tbs_ngo_logo" class="tbs-website-logo-class" value="<?php echo $print->ngo_logo; ?>" />
        <img alt="NGOs Logo" src="<?php echo $print->ngo_logo; ?>" class="photo tbs-website-logo-class-display" style="width: 150px;height: 150px;">
        <p class="description"><button style="background-color: transparent;     border: 2px solid #616161; color: #616161; font-weight: bold; " type="button" class="button wp-generate-pw hide-if-no-js" name="logo-website" id="tbs_website_logo_id">Update NGO Logo</button></p>
      </div>

    <!-- form-2 fields End-->

    <div class='field-edit form-actions' style="text-align: center;">
      <button name="prof_update">Update</button>
      </div>
  </form>
  </div>

  <?php
    }else{
      ?>
      <center><h2>Your Profiles is not approved or rejected. If any question please contact support!!</h2></center>
      <?php
    }
  }
}

//check ajax for the validation for the user.
add_action('wp_ajax_validate_user_nice_name', 'validate_user_nice_name');
add_action('wp_ajax_nopriv_validate_user_nice_name', 'validate_user_nice_name');

function validate_user_nice_name(){ ?>

  <input type="hidden" id="nice_name_check" class="nicename" value="Hello" />
  <?php
  global $wpdb;
  $ngo_url = seoUrl( $_POST['ngo_urls'] );
  $ngo_nicename_test = $wpdb->get_results( "SELECT user_nicename FROM wp_users WHERE user_nicename = $ngo_url" );
  foreach( $ngo_nicename_test as $nice_name ) {
    //echo $nice_name;  ?>

  <?php }
}
if($_GET['enid']){
 echo "Hello Word this is the page for edit";
}else{
  //do nothings.
}

function tbs_ngo_profile_form( ){
  if( !current_user_can( 'edit_posts' ) ) {
      wp_die( __( 'you do not have sufficient permission to  access this page.' ) );
  }
  //Insert details in database
    global $wpdb;
    if ( isset( $_POST["submit_details"] ) ) {
    //$table = $wpdb->prefix."ngo_profile";
    $ngo_url = seoUrl( $_POST['ngo_urls'] );

	$wpdb->update($wpdb->users, array('user_login' => $ngo_url, 'user_nicename' => $ngo_url), array( 'ID' => get_current_user_id() ));
	//$wpdb->update($wpdb->users, array('user_login' => $ngo_url), array( 'ID' => get_current_user_id() ));
    //wp_update_user( array( 'ID' => get_current_user_id(), 'user_nicename' => $ngo_url ) );
    //wp_update_user( array ( 'ID' => get_current_user_id(), 'user_login' => $ngo_url ) ) ;
    //update_user_meta( get_current_user_id(), 'user_nicename', $ngo_url );
    //update_user_meta( get_current_user_id(), 'user_login', $ngo_url );

    $table = "wp_ngo_profile";
    $org_name = strip_tags( $_POST["full_name"], "" );
    $designation = strip_tags( $_POST["user_desi"], "" );
    $email_id = strip_tags( $_POST["email"], "" );
    $mobile_number = strip_tags( $_POST["mobile_numb"], "" );
    $reserve_contact_name = strip_tags( $_POST["rc_name"], "" );
    $fr_contact_name = strip_tags( $_POST["frc_name"], "" );
    $acc_contact_name = strip_tags( $_POST["ac_name"], "" );
    $vision = $_POST["our_vis"];
    $mission = $_POST["our_mis"];
   // $brif_introduction = strip_tags( $_POST["abut_org"], "" ); //change by mejjudin once again
   //PAN
    $ngo_pan = strip_tags( $_POST["pan_numb"], "" );
    $ngo_pan_reg_no = strip_tags( $_POST["pan_reg"], "" );
    $ngo_pan_reg_date = strip_tags( $_POST["pan_dor"], "" );
    $ngo_pan_doc = strip_tags( $_POST["upload_pan"], "" );

    //TAN
    $ngo_tan = strip_tags( $_POST["tan_numb"], "" );
    $ngo_tan_reg_no = strip_tags( $_POST["tan_reg"], "" );
    $ngo_tan_reg_date = strip_tags( $_POST["tan_dor"], "" );
    $ngo_tan_doc = strip_tags( $_POST["upload_tan"], "" );

    $fcra = strip_tags( $_POST["fcra"], "" );
    $bank_name = strip_tags( $_POST["fcra_name"], "" );
    $bank_branch = strip_tags( $_POST["fcra_branch"], "" );
    $acc_number = strip_tags( $_POST["fcra_numb"], "" );
    $acc_name = strip_tags( $_POST["fcra_acct"], "" );
    $micr_number = strip_tags( $_POST["fcra_nmb"], "" );
    $acc_type = strip_tags( $_POST["fcra_type"], "" );
    $swift_code = strip_tags( $_POST["fcra_swift"], "" );
    $ifsc_code = strip_tags( $_POST["ifsc_fcra"], "" );

    //non-fcra account details.
    $non_bank_name = strip_tags( $_POST["nfcra_name"], "" );
    $non_bank_branch = strip_tags( $_POST["nfcra_branch"], "" );
    $non_acc_number = strip_tags( $_POST["nfcra_numb"], "" );
    $non_acc_name = strip_tags( $_POST["nfcra_acct"], "" );
    $non_micr_number = strip_tags( $_POST["nfcra_nmb"], "" );
    $non_acc_type = strip_tags( $_POST["nfcra_type"], "" );
    $non_swift_code = strip_tags( $_POST["nfcra_swift"], "" );
    $non_ifsc_code = strip_tags( $_POST["ifsc_nfcra"], "" );

    $about_org =  $_POST["abut_org"];
    $ng_site_id = strip_tags( $_POST["site_id"], "" );
    $ng_user_id = strip_tags( $_POST["site_user_id"], "" );

    //new feilds form one.
     $legal_name = strip_tags( $_POST["legal_name"], "" );
     $website = strip_tags( $_POST["web"], "" );
     $reg_add = strip_tags( $_POST["add_vari"], "" );
     $state = strip_tags( $_POST["state_name"], "" );
     $city = strip_tags( $_POST["city_name"], "" );
     $last_year_expd = strip_tags( $_POST["site_user_id"], "" );
     $last_year_income = strip_tags( $_POST["site_user_id"], "" );
     $last_yaer_trn = strip_tags( $_POST["site_user_id"], "" );
     $no_of_bnfs = strip_tags( $_POST["site_user_id"], "" );
     $a_12_num = strip_tags( $_POST["site_user_id"], "" );
     $g_80_num = strip_tags( $_POST["site_user_id"], "" );
     $causes_for = strip_tags( $_POST["site_user_id"], "" );

     //new feilds form second
     $acroym = strip_tags( $_POST["acronym"], "" );
     $pin_number = strip_tags( $_POST["pin_number"], "" );

     $telephone = strip_tags( $_POST["ct_landline"], "" );
     //contact type
     $contact_type = strip_tags( $_POST["ct_contact"], "" );
     $contact_type_desig = strip_tags( $_POST["ct_desig"], "" );
     $contact_type_eamil = strip_tags( $_POST["ct_email"], "" );
     $contct_type_landline = strip_tags( $_POST["ct_landline"], "" );
     $contact_type_mobile = strip_tags( $_POST["ct_mobile"], "" );

     // Reserve contact type
     $reserve_cont_desig = strip_tags( $_POST["rc_desig"], "" );
     $reserve_cont_eamil = strip_tags( $_POST["rc_email"], "" );
     $reserve_cont_landline = strip_tags( $_POST["rc_landline"], "" );
     $reserve_cont_mobile = strip_tags( $_POST["rc_mobile"], "" );


     // Fundrising contact type
     $fr_cont_desig = strip_tags( $_POST["frc_desig"], "" );
     $fr_cont_eamil = strip_tags( $_POST["frc_email"], "" );
     $fr_cont_landline = strip_tags( $_POST["frc_landline"], "" );
     $fr_cont_mobile = strip_tags( $_POST["frc_mobile"], "" );

     // Account contact type
     $acc_cont_desig = strip_tags( $_POST["ac_desig"], "" );
     $acc_cont_eamil = strip_tags( $_POST["ac_email"], "" );
     $acc_cont_landline = strip_tags( $_POST["ac_landline"], "" );
     $acc_cont_mobile = strip_tags( $_POST["ac_mobile"], "" );

     //trust
     $trust = strip_tags( $_POST["trust_reg"], "" );
     $trust_dor = strip_tags( $_POST["trust_reg_dor"], "" );
     $trust_doc = strip_tags( $_POST["upload_trust"], "" );

     //socity name
     $socity_name = strip_tags( $_POST["so_name"], "" );
     $socity_reg_num = strip_tags( $_POST["so_regis"], "" );
     $socity_reg_date = strip_tags( $_POST["so_dor"], "" );
     $socity_doc = strip_tags( $_POST["upload_socity"], "" );

     //section 8
     $section_eig_name = strip_tags( $_POST["g_name"], "" );
     $section_eig_re_num = strip_tags( $_POST["sec_regis"], "" );
     $section_eig_date_reg = strip_tags( $_POST["sec_dor"], "" );
     $section_doc = strip_tags( $_POST["upload_section8"], "" );

     //section 80G
     $section_eighty_g_reg_number = strip_tags( $_POST["eighty_reg_num"], "" );
     $section_eighty_g_reg_dor = strip_tags( $_POST["eighty_reg_dor"], "" );
     $section_eighty_g_reg_validaty = strip_tags( $_POST["eighty_reg_exp"], "" );
     $section_eighty_g_reg_expire_reson = strip_tags( $_POST["eighty_reg_reson"], "" );
     $section_eighty_doc = strip_tags( $_POST["upload_80g"], "" );

     //section 12
     $section_tlv_name = strip_tags( $_POST["csec_name"], "" );
     $section_tlv_re_num = strip_tags( $_POST["csec_number"], "" );
     $section_tlv_date_reg = strip_tags( $_POST["csec_date"], "" );
     $section_tlv_date_exp = strip_tags( $_POST["csec_valid"], "" );
     $section_tlv_resn_exp = strip_tags( $_POST["csec_non"], "" );
     $section_tlv_doc = strip_tags( $_POST["upload_12a"], "" );

     //fcra
     $section_fcra_name = strip_tags( $_POST["frca_name"], "" );
     $section_fcra_re_num = strip_tags( $_POST["frca_desig"], "" );
     $section_fcra_date_reg = strip_tags( $_POST["frca_date"], "" );
     $section_fcra_date_exp = strip_tags( $_POST["frca_valid"], "" );
     $section_fcra_resn_exp = strip_tags( $_POST["frca_non"], "" );
     $section_fcra_doc = strip_tags( $_POST["upload_frca"], "" );

     $ng_logo = strip_tags( $_POST["tbs_ngo_logo"], "" );
     $ngo_annual_report = strip_tags( $_POST["tbs_ngo_report"], "" );
     $ngo_story = $_POST["our_story"];
     $borad_member_details = $_POST["borad_member_details"];
     $audited_finance_details = $_POST["audited_details"];
    //$blog_id = get_current_blog_id();
    //update_blog_details( $blog_id, array('blogname'=>$org_name) );

   $success = $wpdb->insert(
        $table,
        array(
            'org_name' => $org_name,
            'designation' => $designation,
            'email_id' => $email_id,
            'mobile_n' => $mobile_number,
            'reserve_cont' => $reserve_contact_name,
            'fr_cont' => $fr_contact_name,
            'acc_cont' => $acc_contact_name,
            'ngo_mission' => $vision,
            'ngo_vision' => $mission,
            'ngo_pan' => $ngo_pan,
            'ngo_pan_reg_no' => $ngo_pan_reg_no,
            'ngo_pan_reg_date' => $ngo_pan_reg_date,
            'ngo_tan' => $ngo_tan,
            'ngo_tan_reg_no' => $ngo_tan_reg_no,
            'ngo_tan_reg_date' => $ngo_tan_reg_date,
            'bank_name' => $bank_name,
            'bank_b_add' => $bank_branch,
            'acc_number' => $acc_number,
            'acc_name' => $acc_name,
            'micr_num' => $micr_number,
            'acc_type' => $acc_type,
            'swift_code' => $swift_code,
            'ifsc_code' => $ifsc_code,
            'nbank_name' => $non_bank_name,
            'nbank_b_add' => $non_bank_branch,
            'nacc_number' => $non_acc_number,
            'nacc_name' => $non_acc_name,
            'nmicr_num' => $non_micr_number,
            'nacc_type' => non_acc_type,
            'nswift_code' => $non_swift_code,
            'nifsc_code' => $non_ifsc_code,
            'about_org' => $about_org,
            'nguser_id' => $ng_user_id,
            'legal_name' => $legal_name,
            'website' =>$website,
            'reg_add' =>$reg_add,
            'state' => $state,
            'city' => $city,
            'acroyn' => $acroym,
            'pin_number' => $pin_number,
            'cp_landline' => $contct_type_landline,
            'cp_mobile' => $contact_type_mobile ,
            'contact_type' => $contact_type,
            'contact_design' => $contact_type_desig,
            'contact_eamil' => $contact_type_eamil,
            'contact_landline' => $contct_type_landline,
            'contact_mobile' => $contact_type_mobile,
            'reserve_design' => $reserve_cont_desig,
            'reserve_eamil' => $reserve_cont_eamil,
            'reserve_mobile' => $reserve_cont_mobile,
            'reserve_landline' => $reserve_cont_landline,
            'fr_design' => $fr_cont_desig,
            'fr_email' => $fr_cont_eamil,
            'fr_landline' => $fr_cont_landline,
            'fr_mobile' => $fr_cont_mobile,
            'acc_design' => $acc_cont_desig,
            'acc_eamil' => $acc_cont_eamil,
            'acc_landline' => $acc_cont_landline,
            'acc_mobile' => $acc_cont_mobile,
            'trust' => $trust,
            'trust_dor' => $trust_dor,
            'socity_name' => $socity_name,
            'socity_reg_number' =>  $socity_reg_num,
            'socity_date_of_reg' =>  $socity_reg_date,
            'secton_eig_reg_number'=>  $section_eig_re_num ,
            'section_eig_date_of_reg' => $section_eig_date_reg,
            'section_tlv_name'=> $section_tlv_name  ,
            'secton_tlv_reg_number' =>$section_tlv_re_num,
            'section_tlv_date_of_reg' => $section_tlv_date_reg,
            'section_tlv_date_of_exp' => $section_tlv_date_exp,
            'section_tlv_ren_of_exp'=>  $section_tlv_resn_exp ,
            'section_fcra_name'=> $section_fcra_name  ,
            'secton_fcra_reg_number' =>$section_fcra_re_num,
            'section_fcra_date_of_reg' => $section_fcra_date_reg,
            'section_fcra_date_of_exp' => $section_fcra_date_exp,
            'section_fcra_ren_of_exp'=>  $section_fcra_resn_exp ,
            'g_eighty_number'=> $section_eighty_g_reg_number,
            'g_eighty_dor' => $section_eighty_g_reg_dor,
            'g_eighty_doex' => $section_eighty_g_reg_validaty,
            'g_eighty_reson_of_expire' => $section_eighty_g_reg_expire_reson,
            'tel_number'=>$telephone,
            'ngo_annul_report'=>$ngo_annual_report,
            'section_fcra_doc'=> $section_fcra_doc,
            'section_tlv_doc'=>$section_tlv_doc,
            'section_eig_doc'=>$section_doc,
            'socity_doc'=>$socity_doc,
            'trust_doc'=>$trust_doc,
            'g_eighty_doc'=>$section_eighty_doc,
            'ngo_tan_doc'=>$ngo_tan_doc,
            'ngo_pan_doc'=>$ngo_pan_doc,
            'ngo_story'=>$ngo_story,
            'ngo_logo' => $ng_logo,
            'ngo_board_member' => $borad_member_details,
            'audited_finance_doc' => $audited_finance_details
        )
    );
   if( $success ){
    $url = get_admin_url();
    //$rurl = $url.'admin.php?page=ngo_profile_form&tid=thankyou';
    wp_redirect( $rurl );
    //mail NGO after sucessfull registration.
    $emails = get_option('admin_email'); //If you want to send to site administrator, use
    $title = get_home_url().'/ngo/'.$user_name;
    $url = get_home_url().'/ngo/'.$user_name;
    $arr_of_name = explode(' ', $user_full_name);
    $lastname = array_pop( $arr_of_name );
    $user_pre_name = get_user_meta( get_current_user_id(), 'user_prefix_name', true );
    $user_last_name = get_user_meta(  get_current_user_id(), 'user_last_name', true );
    $ngo_message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
              <meta name='viewport' content='width=device-width, initial-scale=1' />
              <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>

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
                  padding: 10px 10px 0px;
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
                  padding: 30px 10px;
                  width: 500px;
                }

                .mini-block {
                background-color: #ffffff;
                width: 498px;
                border: 0px solid #cccccc;
                border-radius: 5px;
                padding: 15px 15px;
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
                  padding: 10px 10px;
                  border: 1px solid #cccccc;
                  color: #4d4d4d;
                  font-weight: bold;
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
                padding: 10px 10px 0px;
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
                            <table cellpadding='0' cellspacing='0' width='800' class='w320'>
                              <tr>
                                <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                                  <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                                </td>
                                <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                                  <a style='color:#3C5A99;' href='#'><i class='fab fa-facebook-f fa-2x'></i></a>
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
                    <table cellspacing='0' cellpadding='0' width='800' class='w320'>
                      <tr>
                        <td class='free-text pull-left'>
                          Dear <strong> $user_pre_name. $user_last_name </strong>

                          <p>Thanks for filling all the details!</p>

                          <p>As part of the verification process, we would like to conduct a due diligence of your organisation. This will broadly cover the processes related to financial management system, legal compliances & related governance</p>

                           <p>Our Team will get in touch with you shortly.</p>

                           <p>For any questions and clarifications, do not hesitate to contact us at coordinator@indiadonates.in</p>

                           <p>Regards,<br><strong>IndiaDonatesTeam</strong></p>

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

                            <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                              Sector 20, Noida<br>
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
    wp_mail( $email_id, "Verification Process initiated!", $ngo_message , $ngo_headers);

    //send mail to admin.
    $admin_message = "We have a new NGO Registration details, Please go to the admin panel and check the details.\n NGO Email: \n{$user_email}\n NGO Name:{$org_name} ";
    wp_mail(  $emails, "New NGO Registration Request: {$org_name}", $admin_message , $admin_headers);
  }else{
    echo "Opps!! Something went wrong. Please fill the form again.";
  }

}
//Check for super admin where they can see the NGOs lsit and verify.
  $user_id = get_current_user_id();
  $user_meta= get_userdata($user_id);
  $user_roles= $user_meta->roles;
  //print_r(  $user_roles );

  if ( in_array("administrator", $user_roles) ){

    if( isset( $_GET['nid'] ) ){
        $nid = $_GET['nid'];
       // echo $nid;
        tbs_show_ngo_profiles();
        //die();
    }else{
  ?>
  <center><h1>List of NGO's</h1></center>
  <div class="updated vc_license-activation-notice" id="vc_license-activation-notice"><p>Hey Super Admin, to view the detail of NGO, please click on the name.</p></div>
      <div class="profrow">
    <?php
    global $wpdb;
    $table_name = "wp_ngo_profile";
    $result = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY id DESC" );
    ?><table id="grid-basic" class="table table-condensed table-hover table-striped" >
          <thead>
              <tr>
                  <th data-column-id="id" data-type="numeric" data-visible="true">ID</th>
                  <th data-column-id="organization_name" data-type="text">NGO Name</th>
                  <th data-column-id="sender" data-order="desc">Created Date</th>
                  <th data-column-id="received" data-order="desc">Status</th>
                  <th data-column-id="<?php echo get_admin_url();?>admin.php?page=ngo_profile_form&nid=<?php echo $print->nguser_id; ?>" data-formatter="link" data-sortable="false">View All Detail</th>
              </tr>
          </thead>
          <tbody>
              <?php
              foreach( $result as $print ){ ?>
                <tr>
                  <input type = "hidden" class="ngo-update-url" value="<?php echo get_admin_url();?>admin.php?page=ngo_profile_form&nid=<?php echo $print->nguser_id; ?>" />
                   <td><?php echo $print->nguser_id; ?></td>
                    <td><?php echo $print->org_name; ?></td>
                    <td><?php echo date("jS F, Y", strtotime(get_userdata($print->nguser_id)->user_registered)); ?></td>
                    <?php $ngo_status_btn = $print->approval_status;
                    switch ( $ngo_status_btn ) {
                      case 'yes':
                        $status = 'Approved';
                        break;
                      case 'no':
                        $status = 'Rejected';
                        break;
                      default:
                        $status = 'Pending';
                        break;
                    }
                    ?>
                    <td><?php echo $status; ?></td>
                    <td>View Detail</td>
                </tr>
              <?php } ?>

          </tbody>
      </table>
</div>
<script>

    jQuery("#grid-basic").bootgrid({
    selection: true,
    multiSelect: true,
    rowSelect: true,
    keepSelection: true,
    formatters: {
      "link": function(column, row)
      {
        return "<a href=\"" +column.id + row.id+ "\">View NGO Detail</a>";
      }
    }
  });
</script>
  <?php
}
}else{
    $id = get_current_user_id();
     //echo $id;
      $all_meta_for_user = get_user_meta( $id );

      /*echo "<pre>";
      print_r( $all_meta_for_user );*/
    // $table = "wp_ngo_profile";
   // echo $table;
    if( isset( $_GET['tid'] ) ){
        $tid = $_GET['tid'];
       // echo $nid;
        tbs_thankyou_page();
        //die();
    }
    global $wpdb;
   //$id = get_current_blog_id();
   $user_id = get_current_user_id();
    $table_name = "wp_ngo_profile";
    $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$user_id'" );
       foreach ($result as $key ) {
        $permission_grnt = $key->approval_status;
        $ng_id = $key->nguser_id;
      }
    if( $ng_id != "" && $permission_grnt == ""  ){
      tbs_thankyou_page();
    }else{

      if( $permission_grnt == "no" ){
          tbs_profiles_rejet();
          die();
      }else{
         if ( $permission_grnt == "yes" ){
        tbs_show_profile();
      }else{


  ?>
  <center><h1>NGO Verification Form</h1></center>
  <?php
  global $wpdb;
  global $current_user;

  $blog_id = $current_user->ID;

  //print_r($current_user);
  $current_ngo_eamil = $current_user->user_email;
  $current_ngo_nice_name = $current_user->user_nicename;
  $current_ngo_name = get_user_meta( $blog_id, 'org_name', true );
  $current_ngo_signup_meta_phone = get_user_meta( $blog_id, 'user_phone', true );
  //$current_ngo_signup_meta_email = $current_user->user_email;
  $current_ngo_signup_meta_reg_add = get_user_meta( $blog_id, 'user_reg_add', true );
  $current_ngo_signup_meta_state = get_user_meta( $blog_id, 'user_state', true );
  $current_ngo_signup_meta_city = get_user_meta( $blog_id, 'user_city', true );
  $current_ngo_signup_meta_reg_ngo = get_user_meta( $blog_id, 'user_ngo_type', true );
  $current_ngo_signup_meta_designation = get_user_meta( $blog_id, 'user_designation', true );
  $current_ngo_signup_meta_full_name = get_user_meta( $blog_id, 'user_full_name', true );
  $current_ngo_signup_meta_pan = get_user_meta( $blog_id, 'user_pan', true );
  $current_ngo_signup_meta_web = get_user_meta( $blog_id, 'user_website', true );
  $current_ngo_signup_meta_tan = get_user_meta( $blog_id, 'user_tan', true );
  $current_ngo_signup_meta_a_12 = get_user_meta( $blog_id, 'user_a_12', true );
  $current_ngo_signup_meta_g_80 = get_user_meta( $blog_id, 'user_g_80', true );

?>
     <form class="steps" action ="#" method ="post">
  <ul id="progressbar">
    <li class="active">NGO Details</li>
    <li>Legal Information</li>
    <li>Account Information</li>
    <li>Organisation Context</li>
  </ul>
  <fieldset>
    <!-- ----------- Full Name -------- -->
    <div >
          <label for=" "><strong>Full Name of Organisation</strong></label>
          <input id=" " name="full_name" required="required" type="text" value="<?php echo $current_ngo_name; ?>" placeholder="" data-rule-required="true" data-msg-required="Required" >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
           <input type="hidden" name="site_user_id" value="<?php echo $user_id; ?>">
        </div>
    <!-- ----------------------- End ----------- -->
        <!-- ----------- Legal Name -------- -->
        <div >
          <label for=" "><strong>Legal Name (if different from above)</strong></label>
          <input id="" name="legal_name" type="text" value="" placeholder="" data-rule-required="" data-msg-required="" >
        </div>
    <!-- ----------------------- End ----------- -->
    <!-- ----------- Acronym -------- -->
        <div >
          <label for=" "><strong>Acronym (if any)</strong></label>
          <input id="" name="acronym"  type="text" value="" placeholder="" >
          <!--<span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span> -->
        </div>
        <?php
            $get_user_lenght = get_user_meta(get_current_user_id(), 'string_lenght', true);
            if( $get_user_lenght == "yes"  ){?>
               <!-- ----------- Acronym -------- -->
                <div >
                  <label for=""><strong>URLs(Please select the url)</strong></label>
                  <input id="" name="ngo_urls"  type="text" class="url_check" value="<?php echo $current_ngo_nice_name; ?>" placeholder="" >
                  <em style="font-size: x-small;">URL lenght should not be more then 40 charecter</em>
                </div>

            <?php

            }else{
              ?>
              <div>
                  <label for=""><strong>URLs(Please select the url)</strong></label>
                  <input id="" name="ngo_urls"  type="hidden" class="url_check" value="<?php echo $current_ngo_nice_name; ?>" placeholder="" >
                  <em style="font-size: x-small;">URL lenght should not be more then 40 charecter</em>
                </div>

              <?php
            }
        ?>
    <!-- ----------------------- End ----------- -->
    <!-- ----------- Address -------- -->
    <h2 class="frm-two-head">Communication Address</h2>
        <div >
          <label for=" "><strong>Address</strong></label>
          <input id="" name="add_vari" type="text" value="<?php echo $current_ngo_signup_meta_reg_add; ?>" placeholder="" data-rule-required="true" data-msg-required="Required" >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- ------------ End ----------- -->

     <!-- ---------------------  State  ---------------------- -->
      <div >
        <?php
               global $wpdb;
                $results_state = $wpdb->get_results( "SELECT * FROM wp_state_city WHERE id = $current_ngo_signup_meta_state");
                foreach ($results_state as $key ) {
                ?><label><strong>State</strong></label>
                <input type="text" name="state_name" id="state_f2" class='state_veri' value="<?php  echo $key->name; ?>" style="width: 100%; height: 40px;">
                 <?php } ?>
      </div>
    <!-- --------------- End ------------------- -->
    <!-- ---------------------  City  ---------------------- -->
      <div>
                <label><strong>City</strong></label>
                <input type="text" name="city_name" id="city_f2" class='city_veri' style="width: 100%; height: 40px;" value="<?php echo $current_ngo_signup_meta_city; ?>">
      </div>
    <!-- --------------- End ------------------- -->
    <!-- ----------- PIN Number -------- -->
      <div >
        <label for=" "><strong>PIN Code</strong></label>
        <input id="" name="pin_number" required="required" type="number" style="height: 40px;" value="" placeholder="" data-rule-required="true" data-msg-required="Required" >
        <span class="error1" style="display: none;">
            <i class="error-log fa fa-exclamation-triangle"></i>
        </span>
      </div>
    <!-- ------------ End ----------- -->
    <!-- ----------- Telephone Number -------- -->
      <div >
        <label for=" "><strong>Telephone Number</strong></label>
        <input id="tel-id" name="mobile_numb" required="required" type="number" value="<?php echo $phone; ?>" placeholder="" data-rule-required="true" data-msg-required="Required" style="height: 40px;"  >
        <span class="error1" style="display: none;">
            <i class="error-log fa fa-exclamation-triangle"></i>
        </span>
      </div>
    <!-- ----------------------- End ----------- -->
    <!-- ----------- Mobile Number -------- -->
      <div >
        <label for=" "><strong>Mobile Number</strong></label>
        <input id="" name="mobile_numb" required="required" type="number" value="<?php echo $current_ngo_signup_meta_phone; ?>" placeholder="" data-rule-required="true" data-msg-required="Required" style="height: 40px;" >
        <span class="error1" style="display: none;">
            <i class="error-log fa fa-exclamation-triangle"></i>
        </span>
      </div>
    <!-- ----------------------- End ----------- -->
    <!-- --------------Email Field ------------ -->
        <div class="hs_email field hs-form-field">
          <label for=""><strong>Email ID</strong></label>
          <input id="" name="email" required="required" type="email" value="<?php echo $current_ngo_eamil; ?>" placeholder="" data-rule-required="true" data-msg-required="Required" >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------------- End ----------- -->
    <!-- ----------- Website -------- -->
         <div class="">
          <label for=""><strong>Website</strong></label>
          <input id="" name="web" type="text" value="<?php echo $current_ngo_signup_meta_web; ?>" placeholder="" data-rule-required="true" data-msg-required="Required">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- ------------ End ----------- -->
    <!-- --------------- Contact Tpye --------- -->
    <h2 class="frm-two-head">Please fill in the contact information for all the people mentioned in the table:</h2>
    <p class="frm-two-para">Please note: Alternate Contact Person- this person should be different from CEO contact.</p>
    <div class="form-tblfed">
        <div class="div-tblfed">
          <div class="divi-tblfed"><strong>Person</strong></div>
          <div class="divi-tblfed"><strong>Name</strong></div>
          <div class="divi-tblfed"><strong>Designation</strong></div>
          <div class="divi-tblfed"><strong>Email</strong></div>
          <div class="divi-tblfed"><strong>Landline No.</strong></div>
          <div class="divi-tblfed"><strong>Mobile No.</strong></div>
        </div>
        <div class="cat-tblfed">
          <div class="tblfed-rw">
            <div class="tblfed-rwTitle"><strong>Chief Functionary</strong></div>
              <div class="tblfed-val">
                <input id="" name="ct_contact" type="text" value="" style="border: transparent;" placeholder="" data-rule-required="true" data-msg-required="*">
                  <span class="error1" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
                  </span>
              </div>
            <div class="tblfed-val">
              <input id="" name="ct_desig" style="border: transparent;" type="text" value="" placeholder="" data-rule-required="true" data-msg-required="*">
                <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id="" name="ct_email" style="border: transparent;" type="email" value="" placeholder="" data-rule-required="true" data-msg-required="*">
                <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id="" name="ct_landline" style="border: transparent; height: 40px;" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="*" >
                <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id="" name="ct_mobile" style="border: transparent; height: 40px;" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="*" >
                <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
          </div>
          <div class="tblfed-rw">
            <div class="tblfed-rwTitle"><strong>Alternate Contact Person</strong></div>
              <div class="tblfed-val">
                <input id="" name="rc_name" style="border: transparent;" type="text" value="" placeholder=""  data-rule-required="" data-msg-required="">
                  <!--<span class="error1" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
                  </span> -->
              </div>
            <div class="tblfed-val">
              <input id="" name="rc_desig" style="border: transparent;" type="text" value="" placeholder="" data-rule-required="" data-msg-required="">
                <!--<span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>-->
            </div>
            <div class="tblfed-val">
              <input id="" name="rc_email" style="border: transparent;" type="email" value="" placeholder="" data-rule-required="" data-msg-required="">
                <!-- <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span> -->
            </div>
            <div class="tblfed-val">
              <input id="" name="rc_landline" style="border: transparent; height: 40px;" type="number" value="" placeholder="" data-rule-required="" data-msg-required="" >
                <!--<span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span> -->
            </div>
            <div class="tblfed-val">
              <input id="" name="rc_mobile" type="number" value="" placeholder="" data-rule-required="" data-msg-required="*" style="border: transparent; height: 40px;">
            </div>
          </div>
          <div class="tblfed-rw">
            <div class="tblfed-rwTitle"><strong>Fundraising Officer (if any)</strong></div>
              <div class="tblfed-val">
                <input id="" name="frc_name" type="text" value="" placeholder="" style="border: transparent;">
                  <span class="" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
                  </span>
              </div>
            <div class="tblfed-val">
              <input id=" " name="frc_desig" type="text" value="" placeholder="" style="border: transparent;">
                <span class="" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id="" name="frc_email" type="email" value="" placeholder="" style="border: transparent;">
                <span class="" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle" style="border: transparent;"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id=" " name="frc_landline" type="number" value="" placeholder="" style="border: transparent; height: 40px;">
                <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id=" " name="frc_mobile" type="number" value="" placeholder="" style="border: transparent; height: 40px;">
                <span class="" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
          </div>
          <div class="tblfed-rw">
            <div class="tblfed-rwTitle"><strong>Finance Manager</strong></div>
              <div class="tblfed-val">
                <input id=" " name="ac_name" type="text" value="" placeholder="" style="border: transparent;">
                  <span class="" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
                  </span>
              </div>
            <div class="tblfed-val">
              <input id=" " name="ac_desig" type="text" value="" placeholder="" style="border: transparent;">
                <span class="" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id="" name="ac_email" type="email" value="" placeholder="" style="border: transparent;">
                <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id="" name="ac_landline" type="number" value="" placeholder="" style="border: transparent; height: 40px;">
                <span class="" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="tblfed-val">
              <input id="" name="ac_mobile" type="number" value="" placeholder="" style="border: transparent; height: 40px;">
                <span class="" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
          </div>
        </div>
      </div>

    <input type="button" data-page="1" name="next" class="next action-button" value="Next" />
  </fieldset>


  <!-- -----------------------Step 2 Legal Information ---------------------- -->
  <fieldset>
      <h2 style=" margin: 20px 0px 10px;" class="frm-two-head">Registration Information:</h2>
      <div class="form-tblfed">
        <div class="div-tblfed">
          <div class="divi-tblfed"><strong>Type of Registration</strong></div>
          <div class="divi-tblfed"><strong>Registration number</strong></div>
          <div class="divi-tblfed"><strong>Date of Registration</strong></div>
          <div class="divi-tblfed"><strong>Upload Files</strong></div>
        </div>
        <?php
        /** Code to show the upload button on as per form one selection **/
        $ngo_id = get_current_user_id();
        $selected_ngo_reg_type = get_user_meta($ngo_id, 'user_ngo_type', true);
        //echo $selected_ngo_reg_type;
        if( $selected_ngo_reg_type == "Society" ){ ?>
        <div class="cat-tblfed">
          <div class="tblfed-rw">
            <div class="tblfed-rwTitle"><strong>Trust</strong></div>
            <div class="tblfed-val"><input id="" name="trust_reg" type="text" value="" placeholder="" style="border: transparent;">
              <span class="error1" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <div class="tblfed-val"><input type="date" name="trust_reg_dor" id="" style="border: transparent;">
              <span class="error1" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <div class="tblfed-val form-uplod">
              <div class="container-upload">
                  <div class="file-upload-wrapper-al" data-text="Select your file!">
                  <input type="hidden" name="upload_trust" class="tbs-upload_trust-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                  <a href="#" class="photo tbs-upload_trust-class-display"> <i class="" aria-hidden="true"></i></a>
                      <p  class="photo tbs-upload_trust-class-display" style=""></p>
                    <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_trust" id="tbs_upload_trust_id" disabled><strong>Upload Trust Doc</strong></button></p>
                  </div>
              </div>
            </div>
          </div>
          <div class="tblfed-rw">
            <div class="ttblfed-rwTitle"><strong>Society</strong></div>
              <div class="tblfed-val"><input id="" name="so_regis" type="text" value="" placeholder="" style="border: transparent;">
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span></div>
              <div class="tblfed-val"><input type="date" name="so_dor" id="" style="border: transparent;">
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span></div>
            <div class="tblfed-val form-uplod">
              <div class="container-upload">
                  <div class="file-upload-wrapper-al" data-text="Select your file!">
                  <input type="hidden" name="upload_socity" class="tbs-upload_socity-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                    <p class="photo tbs-upload_socity-class-display" style="">
                    <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_socity" id="tbs_upload_socity_id"><strong>Upload Society Doc</strong></button></p>
                  </div>
              </div>
            </div>
          </div>
        <?php } else{ ?>
          <div class="cat-tblfed">
          <div class="tblfed-rw">
            <div class="tblfed-rwTitle"><strong>Trust</strong></div>
            <div class="tblfed-val"><input id="" name="trust_reg" type="text" value="" placeholder="" style="border: transparent;">
              <span class="error1" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <div class="tblfed-val"><input type="date" name="trust_reg_dor" id="" style="border: transparent;">
              <span class="error1" style="display: none;">
                  <i class="error-log fa fa-exclamation-triangle"></i>
              </span>
            </div>
            <div class="tblfed-val form-uplod">
              <div class="container-upload">
                  <div class="file-upload-wrapper-al" data-text="Select your file!">
                    <input type="hidden" name="upload_trust" class="tbs-upload_trust-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                    <p class="photo tbs-upload_trust-class-display" style=""></p>
                    <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_trust" id="tbs_upload_trust_id" ><strong>Upload Trust Doc</strong></button></p>
                  </div>
              </div>
            </div>
          </div>
          <div class="tblfed-rw">
            <div class="tblfed-rwTitle"><strong>Society</strong></div>
              <div class="tblfed-val"><input id="" name="so_regis" type="text" value="" placeholder="" style="border: transparent;">
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span></div>
              <div class="tblfed-val"><input type="date" name="so_dor" id="" style="border: transparent;">
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span></div>
            <div class="tblfed-val form-uplod">
              <div class="container-upload">
                  <div class="file-upload-wrapper-al" data-text="Select your file!">
                    <input type="hidden" name="upload_socity" class="tbs-upload_socity-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                   <p class="photo tbs-upload_socity-class-display" style=""></p>
                    <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_socity" id="tbs_upload_socity_id" disabled><strong>Upload Society Doc</strong></button></p>
                  </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="tblfed-rw">
             <div class="tblfed-rwTitle"><strong>Section 8</strong></div>
             <div class="tblfed-val"><input id="" name="sec_regis" type="text" value="" placeholder="" style="border: transparent;"  >
          <span class="error1" style="display: none; ">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
             <div class="tblfed-val"><input type="date" name="sec_dor" id="" style="border: transparent;">
          <span class="error1" style="display: none; margin-right: 25px;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
          <div class="tblfed-val form-uplod">
            <div class="container-upload">
                <div class="file-upload-wrapper-al" data-text="Select your file!">
                  <input type="hidden" name="upload_section8" class="tbs-upload_section8-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                  <p class="photo tbs-upload_section8-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_section8" id="tbs_upload_section8_id"><strong>Upload Section 8</strong></button></p>
                </div>
              </div>
          </div>
          </div>
          <div class="tblfed-rw">
             <div class="tblfed-rwTitle"><strong>PAN Number</strong><!-- <input id="" name="pan_numb" value="<?php echo $current_ngo_signup_meta_pan; ?>" type="text" value="" style="border: transparent; text-align: center;" placeholder="PAN Number">
      <span class="error1" style="display: none;">
          <i class="error-log fa fa-exclamation-triangle"></i>
      </span> --></div>
             <div class="tblfed-val"><input id="" name="pan_reg" type="text" value="<?php echo $current_ngo_signup_meta_pan; ?>" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
             <div class="tblfed-val"><input type="date" name="pan_dor" id="" style="border: transparent;">
          <span class="error1" style="display: none; margin-right: 25px;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
          <div class="tblfed-val">
            <div class="container-upload form-uplod">
                <div class="file-upload-wrapper-al" data-text="Select your file!">
                  <input type="hidden" name="upload_pan" class="tbs-upload_pan-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                  <p class="photo tbs-upload_pan-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_pan" id="tbs_upload_pan_id"><strong>Upload PAN</strong></button></p>
                </div>
            </div>
          </div>
          </div>
          <div class="tblfed-rw">
             <div class="tblfed-rwTitle"><strong>TAN Number</strong><!-- <input id="" name="tan_numb" type="text" value="<?php echo $current_ngo_signup_meta_tan;?>" placeholder="TAN Number" style="border: transparent; text-align: center;">
      <span class="error1" style="display: none;">
          <i class="error-log fa fa-exclamation-triangle"></i>
      </span> --></div>
             <div class="tblfed-val">
              <input name="tan_reg" type="text" value="<?php echo $current_ngo_signup_meta_tan;?>" placeholder="" style="border: transparent;" >
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
             </div>
             <div class="tblfed-val"> <input type="date" name="tan_dor" id="" style="border: transparent;">
          <span class="error1" style="display: none; margin-right: 25px;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
          <div class="tblfed-val form-uplod">
            <div class="container-upload">
                <div class="file-upload-wrapper-al" data-text="Select your file!">
                  <input type="hidden" name="upload_tan" class="tbs-upload_tan-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                  <p class="photo tbs-upload_tan-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_tan" id="tbs_upload_tan_id"><strong>Upload TAN</strong></button></p>
                </div>
            </div>
          </div>
          </div>
        </div>
      </div>

    <!-- --------------- End ------------------- -->
    <h2 style=" margin: 20px 0px 10px;" class="frm-two-head">Certifications:</h2>
    <div class="form-tblfed">
  <div class="div-tblfed">
    <div class="divi-tblfed"><strong>Type</strong></div>
    <div class="divi-tblfed"><strong>Registration Number</strong></div>
    <div class="divi-tblfed"><strong>Registration Date</strong></div>
    <div class="divi-tblfed"><strong>Valid Until</strong></div>
    <div class="divi-tblfed"><strong>If expired, reason</strong></div>
    <div class="divi-tblfed"><strong>Upload File</strong></div>
  </div>
  <div class="cat-tblfed">
    <div class="tblfed-rw">
      <div class="tblfed-rwTitle"><strong>Section 12A</strong><!-- <input id="" name="csec_name" type="text" value="" placeholder="Section 12A" style="border: transparent; text-align: center;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span> --></div>
      <div class="tblfed-val">
        <input id="" name="csec_number" type="text" value="<?php echo $current_ngo_signup_meta_a_12; ?>" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
      </div>
      <div class="tblfed-val"><input id="" name="csec_date" type="date" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
      <div class="tblfed-val"><input id="" name="csec_valid" type="date" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
      <div class="tblfed-val"><input id="" name="csec_non" type="text" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
          <div class="tblfed-val form-uplod">
            <div class="container-upload">
              <div class="file-upload-wrapper-al" data-text="Select your file!">
                <input type="hidden" name="upload_12a" class="tbs-upload_12a-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                <p class="photo tbs-upload_12a-class-display" style=""></p>
                <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_12a" id="tbs_upload_12a_id"><strong>Upload 12A</strong></button></p>
              </div>
            </div>
          </div>
    </div>
    <div class="tblfed-rw">
       <div class="tblfed-rwTitle"><strong>FCRA</strong></div>
       <div class="tblfed-val"><input id="" name="frca_desig" type="text" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
        <div class="tblfed-val"><input id="" name="frca_date" type="date" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
       <div class="tblfed-val"><input id="" name="frca_valid" type="date" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
       <div class="tblfed-val"><input id="" name="frca_non" type="text" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
          <div class="tblfed-val form-uplod">
            <div class="container-upload">
              <div class="file-upload-wrapper-al" data-text="Select your file!">
                <input type="hidden" name="upload_frca" class="tbs-upload_frca-class" value="<?php echo get_option('tbs_upload_frca'); ?>" />
                  <p class="photo tbs-upload_frca-class-display" style=""></p>
                <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_frca" id="tbs_upload_frca_id"><strong>Upload FCRA</strong></button></p>
              </div>
            </div>
          </div>
    </div>
    <div class="tblfed-rw">
       <div class="tblfed-rwTitle"><strong>80G</strong><!-- <input id="" name="g_name" type="text" value="<?php echo $current_ngo_signup_meta_g_80; ?>" placeholder="80G" style="border: transparent; text-align: center;" >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span> --></div>
       <div class="tblfed-val"><input id="" name="eighty_reg_num" type="text" value=" <?php echo $current_ngo_signup_meta_g_80; ?> " placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
       <div class="tblfed-val"><input id="" name="eighty_reg_dor" type="date" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
       <div class="tblfed-val"><input id="" name="eighty_reg_exp" type="date" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
       <div class="tblfed-val"><input id="" name="eighty_reg_reson" type="text" value="" placeholder="" style="border: transparent;">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span></div>
          <div class="tblfed-val">
          <div class="container-upload">
            <div class="file-upload-wrapper-al" data-text="Select your file!">
              <input type="hidden" name="upload_80g" class="tbs-ngo-80g-class" value="<?php echo get_option('tbs_website_logo'); ?>" />
              <p class="photo tbs-ngo-80g-class-display" style=""></p>
              <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="upload_80g" id="tbs_upload_80g_id"><strong>Upload 80G</strong></button></p>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
  <!-- Borad Member Details -->
  <table>
    <tr>

    </tr>
  </table>

  <div class="form-uplod" style="margin-bottom: 20px; padding-top: 10px;">
        <div class="container-upload">
          <div class="file-upload-wrapper-al" data-text="Select your file!">
            <input type="hidden" name="borad_member_details" class="borad_member_details-class" value="<?php echo get_option('tbs_website_logo'); ?>" />
             <p class="borad_member_details-class-display"></p>
            <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="borad_member" id="borad_member_report_id"><strong>Upload Borad Member Details</strong></button></p>
          </div>
      </div>
  </div>

  <!-- Audited Finanace Details upload -->

  <div class="form-uplod" style="margin-bottom: 20px; padding-top: 10px;">
        <div class="container-upload">
          <div class="file-upload-wrapper-al" data-text="Select your file!">
            <input type="hidden" name="audited_details" class="audited_details-class" value="<?php echo get_option('tbs_website_logo'); ?>" />
             <p class="audited_details-class-display"></p>
            <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="audited_details" id="audited_details_id"><strong>Upload Latest Audited Financial Statement</strong></button></p>
          </div>
      </div>
  </div>

    <!-- Upload the Annual report -->

  <div class="form-uplod" style="margin-bottom: 20px;">
        <div class="container-upload">
          <div class="file-upload-wrapper-al" data-text="Select your file!">
            <input type="hidden" name="tbs_ngo_report" class="tbs-ngo-report-class" value="<?php echo get_option('tbs_website_logo'); ?>" />
            <p class="photo tbs-ngo-report-class-display" style=""></p>
            <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="ngo-report" id="tbs_ngo_report_id"><strong>Upload Latest NGO Annual Report</strong></button></p>
          </div>
      </div>
  </div>

    <!-- ----------------------- End ----------- -->
     <input type="button" data-page="2" name="previous" class="previous action-button" value="Previous" />
    <input type="button" data-page="2" name="next" class="next action-button" value="Next" />
  </fieldset>


  <!-- -------------- Step 3 Account Information --------------- -->
  <fieldset>
    <p class="frm-two-para">Bank Information required for disbursements</p>
    <h2 class="frm-two-head">Non FCRA Account:</h2>
        <!-- ---------------- Bank Name ------------------- -->
       <div >
          <label for=""><strong>Bank Name</strong></label>
          <input id="" name="nfcra_name" type="text" value="" placeholder=""  >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- -------------End ------------ -->
    <!-- ---------------- Bank Branch Address ------------------- -->
      <div >
          <label for=""><strong>Branch Name</strong></label>
          <input id="" name="nfcra_branch" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
      </div>
    <!-- -------------End ------------ -->
    <!-- -------------------Account Number---------------------- -->
        <div >
          <label for=" "><strong>Account Number</strong></label>
          <input id="" name="nfcra_numb" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- ----------------- Name of Account---------------- -->
        <div >
          <label for=" "><strong>Name of Account</strong></label>
          <input id="" name="nfcra_acct" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- ------------------MICR number--------------------- -->
        <div >
          <label for=" "><strong>9 digit MICR number</strong></label>
          <input id="" name="nfcra_nmb" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- ---------------------------Current/Savings account----------------------- -->
      <div style="display: inline-block; width: 100%">
        <label for="" ><strong>Account Current / Saving</strong></label>
        <select type="select" class="crt_sav" name="nfcra_type" style="width: 100%; height: 40px;">
          <option value="" disabled selected hidden >Select Account type</option>
          <option>Current Account</option>
          <option>Saving Account</option>
        </select>
      </div>
    <!-- --------------- End ------------------- -->
    <!-- ------------------SWIFT Code----------------------- -->
        <div >
          <label for=""><strong>SWIFT Code / Remittance Instructions</strong></label>
          <input id="" name="nfcra_swift" type="text" value="" placeholder="" >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- -----------------IFSC CODE-------------------- -->
        <div >
          <label for=""><strong>IFSC CODE (Ask your bank)</strong></label>
          <input id="" name="ifsc_nfcra" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <h2 class="frm-two-head">FCRA Account:</h2>
        <!-- ---------------- Bank Name ------------------- -->
       <div >
          <label for=" "><strong>Bank Name</strong></label>
          <input id="" name="fcra_name" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- -------------End ------------ -->
    <!-- ---------------- Bank Branch Address ------------------- -->
      <div >
          <label for=" "><strong>Branch Name</strong></label>
          <input id="" name="fcra_branch" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
      </div>
     <!-- -------------End ------------ -->
     <!-- -------------------Account Number---------------------- -->
        <div >
          <label for=" "><strong>Account Number</strong></label>
          <input id="" name="fcra_numb" type="text" value="" placeholder="" >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- -----------------Name of Account---------------- -->
        <div >
          <label for=" "><strong>Name of Account</strong></label>
          <input id="" name="fcra_acct" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- ------------------MICR number--------------------- -->
        <div >
          <label for=" "><strong>9 digit MICR number</strong></label>
          <input id="" name="fcra_nmb" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- ---------------------------Current/Savings account----------------------- -->
      <div style="display: inline-block; width: 100%">
        <label for="" ><strong>Account Current / Saving</strong></label>
        <select type="select" class="crt_sav" name="fcra_type" style="width: 100%; height: 40px;">
          <option value="" disabled selected hidden>Select Account type</option>
          <option>Current Account</option>
          <option>Saving Account</option>
        </select>
      </div>
    <!-- --------------- End ------------------- -->
    <!-- ------------------SWIFT Code----------------------- -->
        <div >
          <label for=""><strong>SWIFT Code / Remittance Instructions</strong></label>
          <input id="" name="fcra_swift" type="text" value="" placeholder="" >
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
    <!-- -----------------IFSC CODE-------------------- -->
        <div >
          <label for=""><strong>IFSC CODE (Ask your bank)</strong></label>
          <input id="" name="ifsc_fcra" type="text" value="" placeholder="">
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
     <input type="button" data-page="2" name="previous" class="previous action-button" value="Previous" />
    <input type="button" data-page="2" name="next" class="next action-button" value="Next" />
  </fieldset>
  <!-- --------------- End ------------------- -->
  <!-- --------------- Step 4 Organisation Context ------------------- -->
  <fieldset>
      <div >
          <label for=" "><strong>Brief information about the activities of the organisation.</strong></label>
          <textarea id="form2-text" name="abut_org" required="required" type="textarea" value="" placeholder="" data-rule-required="true" data-msg-required="Required" ></textarea>
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>

    <!-- ------------------ Our Vision ---------------------- -->
        <div >
          <label for=" "><strong>Our Vision</strong></label>
          <textarea id="form3-text" name="our_vis" required="required" type="textarea" value="" placeholder="" data-rule-required="true" data-msg-required="Required" ></textarea>
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
     <!-- ----------------- Our Mission ------------------------ -->
        <div >
          <label for=" "><strong>Our Mission</strong></label>
          <textarea id="form4-text" name="our_mis" required="required" type="textarea" value="" placeholder="" data-rule-required="true" data-msg-required="Required" ></textarea>
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
        <!-- ------------------ Success Stories ---------------------- -->
        <div >
          <label for=" "><strong>Success Stories</strong></label>
          <textarea id="form5-text" name="our_story" required="required" type="textarea" value="" placeholder="" data-rule-required="true" data-msg-required="Required" ></textarea>
          <span class="error1" style="display: none;">
              <i class="error-log fa fa-exclamation-triangle"></i>
          </span>
        </div>
    <!-- --------------- End ------------------- -->
        <div>
          <input type="hidden" name="tbs_ngo_logo" class="tbs-website-logo-class" value="<?php echo get_option('tbs_website_logo'); ?>" />
           <img alt="NGOs Logo" src="<?php echo get_option('tbs_website_logo'); ?>" class="photo tbs-website-logo-class-display" style="width: 150px;height: 150px;">
           <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="logo-website" id="tbs_website_logo_id"><strong>Upload NGO Logo</strong></button></p>
        </div>

      <!-- --------------- End ------------------- -->
      <!-- --------------- End ------------------- -->

    <input type="button" data-page="5" name="previous" class="previous action-button" value="Previous" />
    <input id="submit" name="submit_details" class="hs-button primary large action-button next" type="submit" value="Submit"/>
  </fieldset>
  <!-- --------------- End ------------------- -->
</form>
  <?php
  }
  }
  }
  }
}

//Function to get the ngo details.

  function tbs_show_ngo_profiles(){

    $npid = $_GET['nid'];
    global $wpdb;
    $table_name = "wp_ngo_profile";
    $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$npid'" );
    foreach( $result as $print ){
      //print_r($print);
      //echo $print->name;
       //$id = $print->ng_id;
       $uid = $print->nguser_id;
       //echo $uid;
       $user_meta = get_user_meta( $uid );
      // print_r($user_meta);
     //echo $id;
      ?>
      <div class="wrap">
        <h1 class="wp-heading-inline">NGO Profile</h1>
        <a href="<?php echo admin_url( 'admin.php?page=ngo_profile_form' ); ?>" class="page-title-action">Back (NGO Listings)</a>
      </div>
        <?php
          //update the form 2
            if( isset( $_POST['edit_details'] ) ){

              $check_massage = "Going it in the best way";
              //Getting the values
              $ngo_logo = $_POST['edit_logo'];
              $ngo_name = $_POST['edit_ngo_org_name'];
              $ngo_add = $_POST['edit_ngo_add'];
              //$ngo_city = $_POST['edit_ngo_city'];
              //$ngo_state = $_POST['edit_ngo_state'];
              $ngo_mobile = $_POST['edit_ngo_mobile'];
              $ngo_websites = $_POST['edit_ngo_websites'];
              $ngo_acrynm = $_POST['edit_ngo_org_acry'];
              $ngo_causes = $_POST['edit_ngo_org_causes'];
              $ngo_expd = $_POST['edit_ngo_org_expd'];
              $ngo_income = $_POST['edit_ngo_org_incom'];
              $ngo_legal_name = $_POST['edit_ngo_org_legal'];
              $ngo_tel = $_POST['edit_ngo_tel'];
              //$ngo_email = $_POST['edit_ngo_email'];
              $ngo_pin = $_POST['edit_ngo_pin'];

              $ngo_cf_desig = $_POST['edit_cf_desig'];
              $ngo_cf_name = $_POST['edit_cf_name'];
              $ngo_cf_eamil = $_POST['edit_cf_email'];
              $ngo_cf_mobile = $_POST['edit_cf_mobile'];
              $ngo_cf_landline = $_POST['edit_cf_landn'];

              $ngo_alt_name = $_POST['edit_alt_name'];
              $ngo_alt_email = $_POST['edit_alt_email'];
              $ngo_alt_mobile = $_POST['edit_alt_mobile'];
              $ngo_alt_desg = $_POST['edit_alt_desg'];
              $ngo_alt_landline = $_POST['edit_alt_landline'];

              $ngo_fr_name = $_POST['edit_fr_name'];
              $ngo_fr_email = $_POST['edit_fr_email'];
              $ngo_fr_mobile = $_POST['edit_fr_mobile'];
              $ngo_fr_desg = $_POST['edit_fr_desg'];
              $ngo_fr_landline = $_POST['edit_fr_landline'];

              $ngo_acc_name = $_POST['edit_acc_name'];
              $ngo_acc_email = $_POST['edit_acc_eamil'];
              $ngo_acc_mobile = $_POST['edit_acc_mobile'];
              $ngo_acc_desig = $_POST['edit_acc_desig'];
              $ngo_acc_line = $_POST['edit_acc_line'];


              $ngo_trust = $_POST['edit_trust'];
              $ngo_socity = $_POST['edit_socity'];
              $ngo_section = $_POST['edit_section_eig'];
              $ngo_pan = $_POST['edit_pan'];
              $ngo_tan = $_POST['edit_tan'];

              $ngo_trust_date = $_POST['edit_trust_date'];
              $ngo_socity_date = $_POST['edit_socity_date'];
              $ngo_section_eig_date = $_POST['edit_section_eight_date'];
              $ngo_pan_date = $_POST['edit_pan_date'];
              $ngo_tan_date = $_POST['edit_tan_date'];

              $ngo_tlv_eg_no = $_POST['edit_tlv_eg_no'];
              $ngo_tlv_vallid = $_POST['edit_tlv_valid'];
              $ngo_tlv_reg_date = $_POST['edit_tlv_reg_date'];
              $ngo_tlv_exp_date = $_POST['edit_tlv_exp_reson'];

              $ngo_80_reg_number = $_POST['edit_80g_reg_number'];
              $ngo_80g_valid = $_POST['edit_80g_valid'];
              $ngo_80g_reg_date = $_POST['edit_80g_reg_date'];
              $ngo_80g_exp_reson = $_POST['edit_80g_exp_reson'];

              $ngo_fcra_reg_number = $_POST['edit_fcra_reg_number'];
              $ngo_fcra_valid = $_POST['edit_fcra_vaild'];
              $ngo_fcra_reg_date = $_POST['edit_fcra_reg_date'];
              $ngo_fcra_exp_reson = $_POST['edit_fcra_reson_of_exp'];


              $ngo_bank_name = $_POST['edit_bank_name'];
              $ngo_bank_acc_number = $_POST['edit_acc_number'];
              $ngo_micr_number = $_POST['edit_micr_number'];
              $ngo_bank_branch_name = $_POST['edit_bank_branch_name'];
              $ngo_bank_acc_name = $_POST['edit_bank_acc_name'];
              $ngo_bank_acc_type = $_POST['edit_bank_acc_type'];
              $ngo_bank_swift_number = $_POST['edit_swift_number'];
              $ngo_bank_ifsc_number = $_POST[' edit_bank_ifsc'];

              $ngo_fcra_bank_name = $_POST['edit_fcra_bank_name'];
              $ngo_fcra_bank_micr_number = $_POST['edit_fcra_bank_micr_number'];
              $ngo_fcra_swift_number = $_POST['edit_fcra_bank_swift_code'];
              $ngo_fcra_bank_branch_name = $_POST['edit_fcra_bank_branch_name'];
              $ngo_fcra_bank_acc_name = $_POST['edit_fcra_bank_acc_name'];
              $ngo_fcra_bank_acc_type = $_POST['edit_fcra_bank_acc_type'];
              $ngo_fcra_bank_ifcs_number = $_POST['edit_fcra_bank_ifcs_code'];
              $ngo_fcra_bank_acc_number = $_POST['edit_fcra_bank_acc_number'];

              $ngo_about = $_POST['edit_ngo_about'];
              $ngo_vision = $_POST['edit_ngo_vision'];
              $ngo_mission = $_POST['edit_ngo_mission'];
              $ngo_success_story = $_POST['edit_ngo_success_story'];

              $ngo_annual_report = $_POST['edit_anual_doc'];
              $section_fcra_doc = $_POST['edit_fcra_doc'];
              $section_doc = $_POST['edit_sec_eight_doc'];
              $socity_doc = $_POST['edit_socity_doc'];
              $trust_doc = $_POST['edit_trust_doc'];
              $section_eighty_doc = $_POST[' edit_eighty_g_doc'];
              $ngo_tan_doc = $_POST['edit_tan_doc'];
              $ngo_pan_doc = $_POST['edit_pan_doc'];
              $borad_member_details = $_POST['edit_borad_member_doc'];
              $audited_finance_details = $_POST['edit_audti_fin_doc'];
              $section_tlv_doc = $_POST['edit_12a_doc'];

              //$cehck_post = $_POST;
              //echo "<script type='text/javascript'>alert($ngo_websites);</script>";

              //Update user meta
              $ng_id = $_GET['nid'];
              //update_user_meta( $ng_id, 'org_name', $org_name );
              //update_user_meta( $ng_id, 'user_state', $ngo_state );
              //update_user_meta( $ng_id, 'user_city', $ngo_city  );
              //update_user_meta( $ng_id, 'user_last_name', $user_last_name );
              //update_user_meta( $ng_id, 'user_first_name', $user_first_name );
              //update_user_meta( $ng_id, 'user_prefix_name',  $user_prefix_name );
              //update_user_meta( $ng_id, 'user_designation', $user_designation );
              update_user_meta( $ng_id, 'user_phone', $ngo_mobile );
              update_user_meta( $ng_id, 'user_website',  $ngo_websites );
              update_user_meta( $ng_id, 'user_reg_add', $ngo_add );
              //update_user_meta( $ng_id, 'user_ngo_type', $user_ngo_type );
              update_user_meta( $ng_id, 'user_last_year_incom', $ngo_income );
              update_user_meta( $ng_id, 'user_last_year_expd', $ngo_expd );
              update_user_meta( $ng_id, 'user_g_80', $ngo_80_reg_number );
              update_user_meta( $ng_id, 'user_a_12', $ngo_tlv_eg_no );
              update_user_meta( $ng_id, 'user_pan', $ngo_pan );
              update_user_meta( $ng_id, 'user_tan', $ngo_tan );
              //update_user_meta( $user_id, 'user_ltr', $user_ltr );
              //update_user_meta( $user_id, 'user_bnfs', $user_bnfs );
              update_user_meta( $ng_id, 'user_causes_for', $ngo_causes );
              //update_user_meta( $ng_id, 'user_other_causes', $user_causes_other );

              //update query
              $ng_id = $_GET['nid'];
              $table = "wp_ngo_profile";
              $success = $wpdb->update(
                    $table,
                    array(
                      //'org_name' => $ngo_name,
                      'mobile_n' => $ngo_mobile,
                      'reg_add' =>$ngo_add,
                      //'city' => $ngo_city,
                      //'designation' => $designation,
                      //'email_id' => $email_id,
                      //'mobile_n' => $mobile_number,
                     //'reserve_cont' => $reserve_contact_name,
                      //'fr_cont' => $fr_contact_name,
                      //'acc_cont' => $acc_contact_name,
                      'ngo_mission' =>  $ngo_vision,
                      'ngo_vision' => $ngo_mission,
                      //'ngo_pan' => $ngo_pan,
                      'ngo_pan_reg_no' => $ngo_pan,
                      'ngo_pan_reg_date' => $ngo_pan_date,
                      //'ngo_tan' => $ngo_tan,
                      'ngo_tan_reg_no' => $ngo_tan,
                      'ngo_tan_reg_date' => $ngo_tan_date,

                      'bank_name' => $ngo_fcra_bank_name,
                      'bank_b_add' => $ngo_fcra_bank_branch_name,
                      'acc_number' => $ngo_fcra_bank_acc_number,
                      'acc_name' => $ngo_fcra_bank_acc_name,
                      'micr_num' => $ngo_fcra_bank_micr_number ,
                      'acc_type' =>  $ngo_fcra_bank_acc_type,
                      'swift_code' => $ngo_fcra_swift_number,
                      'ifsc_code' => $ngo_fcra_bank_ifcs_number,

                      'nbank_name' => $ngo_bank_name,
                      'nbank_b_add' => $ngo_bank_branch_name,
                      'nacc_number' => $ngo_bank_acc_number,
                      'nacc_name' =>  $ngo_bank_acc_name,
                      'nmicr_num' =>$ngo_micr_number,
                      'nacc_type' => $ngo_bank_acc_type,
                      'nswift_code' => $ngo_bank_swift_number,
                      'nifsc_code' => $ngo_bank_ifsc_number,

                      'about_org' => $ngo_about,
                      //'nguser_id' => $ng_user_id,
                      'legal_name' => $ngo_legal_name,
                      'website' =>$ngo_websites,
                      'acroyn' => $ngo_acrynm,
                      'pin_number' => $ngo_pin,
                      /*'cp_landline' => $contct_type_landline,
                      'cp_mobile' => $contact_type_mobile ,
                      'contact_type' => $contact_type,
                      'contact_design' => $contact_type_desig,
                      'contact_eamil' => $contact_type_eamil,
                      'contact_landline' => $contct_type_landline,
                      'contact_mobile' => $contact_type_mobile,
                      'reserve_design' => $reserve_cont_desig,
                      'reserve_eamil' => $reserve_cont_eamil,
                      'reserve_mobile' => $reserve_cont_mobile,
                      'reserve_landline' => $reserve_cont_landline,
                      'fr_design' => $fr_cont_desig,
                      'fr_email' => $fr_cont_eamil,
                      'fr_landline' => $fr_cont_landline,
                      'fr_mobile' => $fr_cont_mobile,
                      'acc_design' => $acc_cont_desig,
                      'acc_eamil' => $acc_cont_eamil,
                      'acc_landline' => $acc_cont_landline,
                      'acc_mobile' => $acc_cont_mobile,*/
                      'trust' => $ngo_trust,
                      'trust_dor' => $ngo_trust_date,
                      //'socity_name' => $ngo_socity,
                      'socity_reg_number' =>  $ngo_socity,
                      'socity_date_of_reg' => $ngo_socity_date,
                      'secton_eig_reg_number'=>  $ngo_section ,
                      'section_eig_date_of_reg' => $ngo_section_eig_date,
                      //'section_tlv_name'=> $section_tlv_name,
                      'secton_tlv_reg_number' => $ngo_tlv_eg_no,
                      'section_tlv_date_of_reg' => $ngo_tlv_reg_date,
                      'section_tlv_date_of_exp' => $ngo_tlv_vallid,
                      'section_tlv_ren_of_exp'=>  $ngo_tlv_exp_date,
                      //'section_fcra_name'=> $section_fcra_name  ,
                      'secton_fcra_reg_number' =>$ngo_fcra_reg_number,
                      'section_fcra_date_of_reg' => $ngo_fcra_reg_date,
                      'section_fcra_date_of_exp' => $$ngo_fcra_valid,
                      'section_fcra_ren_of_exp'=>  $ngo_fcra_exp_reson,

                      'g_eighty_number'=> $ngo_80_reg_number,
                      'g_eighty_dor' => $ngo_80g_reg_date,
                      'g_eighty_doex' => $ngo_80g_valid,
                      'g_eighty_reson_of_expire' => $ngo_80g_exp_reson,

                      'tel_number'=>$ngo_tel,

                      'ngo_annul_report'=>$ngo_annual_report,
                      'section_fcra_doc'=> $section_fcra_doc,
                      'section_tlv_doc'=>$section_tlv_doc,
                      'section_eig_doc'=>$section_doc,
                      'socity_doc'=>$socity_doc,
                      'trust_doc'=>$trust_doc,
                      'g_eighty_doc'=>$section_eighty_doc,
                      'ngo_tan_doc'=>$ngo_tan_doc,
                      'ngo_pan_doc'=>$ngo_pan_doc,
                      'ngo_story'=>$ngo_success_story,
                      'ngo_logo' => $ngo_logo,
                      'ngo_board_member' => $borad_member_details,
                      'audited_finance_doc' => $audited_finance_details,
                    ),
                    array(
                      'nguser_id' => $ng_id,
                    )
                  );
                  if( $success ){
                    echo "<script type='text/javascript'>alert('Data Updated');</script>";
                    wp_redirect($_SERVER['HTTP_REFERER']);
                    exit;
                  }else{
                    echo "<script type='text/javascript'>alert('Error in data updating');</script>";
                  }
            }

          //End form editing.

        ?>
      <form action ="" method ="post">
      <div class="ngo_details">
          <div class="ngo_prof_details_l">
            <?php
            $ngo_logo = $print->ngo_logo;
             if( $ngo_logo == "" ){?>
                <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y" alt="Avatar" class="tbsavatar">
                <input type="hidden" name="edit_logo" class="tbs-edit_logo-class" value="<?php  echo $print->ngo_logo; ?>" />
                  <p class="photo tbs-edit_logo-class-display" style=""></p>
                  <p class="description edit_show"><button type="button" class="button wp-generate-pw hide-if-no-js " name="edit_logo" id="tbs_edit_logo_id"><strong> Upload Logo</strong></button></p>
             <?php }else{?>
                 <div class="edit_hide"><img src="<?php echo $ngo_logo; ?>" alt="Avatar" class="tbsavatar"></div>
                 <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_logo" class="tbs-edit_logo-class" value="<?php echo $print->ngo_logo; ?>" />
                  <p class="photo tbs-edit_logo-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_logo" id="tbs_edit_logo_id"><strong> Upload Logo</strong></button></p>
              </div>
             <?php } ?>

             <h2 class=""><?php echo get_user_meta( $uid, 'org_name', true); ?></h2>
             <address>
               Address: <b class=""><?php echo get_user_meta( $uid, 'user_reg_add', true); ?></b> <br>
               City:  <b class=""><?php echo get_user_meta( $uid, 'user_city', true); ?></b> <br>
              <?php
                global $wpdb;
                $state = get_user_meta( $uid, 'user_state', true);
                $results_state = $wpdb->get_results( "SELECT * FROM wp_state_city WHERE id = $state");
                foreach ($results_state as $key ) {?>
                  State:  <b class=""><?php echo $key->name;?></b>
                  <?php
                }?><br>
               Mobile:  <b class=""><?php echo get_user_meta( $uid, 'user_phone', true); ?></b><br>
               Website: <b class=""><?php echo get_user_meta( $uid, 'user_website', true) ; ?></b><br>
             </address>
             <?php
              $ngo_status_img = $print->approval_status;
              switch ( $ngo_status_img ) {
                case 'yes':?>
                      <img src="<?php echo plugins_url( 'ngo-profile' ).'/images/approve.png'?>" class="tbsavata" alt="Approve">
                <?php
                  break;
                case 'no':?>
                      <img src="<?php echo plugins_url( 'ngo-profile' ).'/images/reject.png'?>" class="tbsavata" alt="Approve">
                   <?php
                  break;

                default:
                  echo "In-Review";
                  break;
              }
             ?>

              <h3>Download Documents</h3>
              <!-- PAN -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_pan_doc" class="tbs-edit_pan-class" value="<?php echo $print->ngo_pan_doc; ?>" />
                  <p class="photo tbs-edit_pan-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_pan_doc" id="tbs_edit_pan_id"><strong>Upload PAN</strong></button></p>
              </div>

              <!-- TAN -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_tan_doc" class="tbs-edit_tan-class" value="<?php echo $print->ngo_tan_doc; ?>" />
                  <p class="photo tbs-edit_tan-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_tan_doc" id="tbs_edit_tan_id"><strong>Upload TAN</strong></button></p>
              </div>

              <!-- Socity -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_socity_doc" class="tbs-edit_soc-class" value="<?php echo $print->socity_doc; ?>" />
                  <p class="photo tbs-edit_soc-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_socity_doc" id="tbs_edit_soc_id"><strong>Socity Doc</strong></button></p>
              </div>
              <!-- FCRA -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_fcra_doc" class="tbs-edit_fcra-class" value="<?php echo $print->section_fcra_doc; ?>" />
                  <p class="photo tbs-edit_fcra-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_fcra_doc" id="tbs_edit_fcra_id"><strong>FRCA</strong></button></p>
              </div>

              <!-- Anuual Reports -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_anual_doc" class="tbs-edit_aunal-class" value="<?php echo $print->ngo_annul_report; ?>" />
                  <p class="photo tbs-edit_aunal-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_anual_doc" id="tbs_edit_anual_id"><strong>Anual Report</strong></button></p>
              </div>

              <!-- section 8 -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_sec_eight_doc" class="tbs-edit_sec_eight-class" value="<?php echo $print->section_eig_doc; ?>" />
                  <p class="photo tbs-edit_sec_eight-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_sec_eight_doc" id="tbs_edit_sec_eight_id"><strong>Section8</strong></button></p>
              </div>

              <!-- Trust -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_trust_doc" class="tbs-edit_trust-class" value="<?php echo $print->trust_doc; ?>" />
                  <p class="photo tbs-edit_trust-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_trust_doc" id="tbs_edit_trust_id"><strong>Trust</strong></button></p>
              </div>

              <!-- 80G -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_eighty_g_doc" class="tbs-edit_eighty_g-class" value="<?php echo $print->g_eighty_doc; ?>" />
                  <p class="photo tbs-edit_eighty_g-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_eighty_g_doc" id="tbs_edit_eighty_g_id"><strong>80G</strong></button></p>
              </div>

              <!-- edit 12 -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_12a_doc" class="tbs-edit_12a-class" value="<?php echo $print->section_tlv_doc; ?>" />
                  <p class="photo tbs-edit_12a-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_12a_doc" id="tbs_edit_12a_id"><strong>12A</strong></button></p>
              </div>

              <!-- Board Members -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_borad_member_doc" class="tbs-edit_board_members-class" value="<?php echo $print->ngo_board_member; ?>" />
                  <p class="photo tbs-edit_board_members-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_borad_member_doc" id="tbs_edit_borad_member_id"><strong>Board Members</strong></button></p>
              </div>

              <!-- Edit Audited Financial Statment -->
              <div class="file-upload-wrapper-al edit_show" data-text="Select your file!">
                  <input type="hidden" name="edit_audti_fin_doc" class="tbs-edit_audit_fin-class" value="<?php echo $print->audited_finance_doc; ?>" />
                  <p class="photo tbs-edit_audit_fin-class-display" style=""></p>
                  <p class="description"><button type="button" class="button wp-generate-pw hide-if-no-js" name="edit_audti_fin_doc" id="tbs_edit_audit_fin_id"><strong> Audited Financial Statment</strong></button></p>
              </div>

              <p class="edit_hide">
                <?php if( $print->ngo_pan_doc == "" ){ ?>
                    <a href="<?php echo $print->ngo_pan_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> PAN</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->ngo_pan_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> PAN</i></a>
                <?php } ?>
                <?php if( $print->ngo_tan_doc == "" ){ ?>
                    <a href="<?php echo $print->ngo_tan_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> TAN</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->ngo_tan_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> TAN</i></a>
                <?php } ?>

                <?php if( $print->socity_doc == "" ){ ?>
                    <a href="<?php echo $print->socity_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> Socity Doc</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->socity_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> Socity Doc</i></a>
                <?php } ?>
              </p>
              <p class="edit_hide">
              <?php if( $print->section_fcra_doc == "" ){ ?>
                    <a href="<?php echo $print->section_fcra_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> FRCA</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->section_fcra_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> FRCA</i></a>
                <?php } ?>

                <?php if( $print->ngo_annul_report == "" ){ ?>
                    <a href="<?php echo $print->ngo_annul_report; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> Audit</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->ngo_annul_report; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> Audit</i></a>
                <?php } ?>

                <?php if( $print->section_eig_doc == "" ){ ?>
                    <a href="<?php echo $print->section_eig_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> Section 8</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->section_eig_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> Section 8</i></a>
                <?php } ?>
              </p>
              <p class="edit_hide">
              <?php if( $print->trust_doc == "" ){ ?>
                    <a href="<?php echo $print->trust_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> Trust</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->trust_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> Trust</i></a>
              <?php } ?>

              <?php if( $print->g_eighty_doc == "" ){ ?>
                    <a href="<?php echo $print->g_eighty_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> 80G</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->g_eighty_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> 80G</i></a>
              <?php } ?>

              <?php if( $print->section_tlv_doc == "" ){ ?>
                    <a href="<?php echo $print->section_tlv_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> 12A</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->section_tlv_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> 12A</i></a>
              <?php } ?>
                </p>

              <p class="edit_hide">
              <?php if( $print->ngo_board_member == "" ){ ?>
                    <a href="<?php echo $print->ngo_board_member; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> Board Members</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->ngo_board_member; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> Board Members</i></a>
              <?php } ?></p>
              <p class="edit_hide">
              <?php if( $print->audited_finance_doc == "" ){ ?>
                    <a href="<?php echo $print->audited_finance_doc; ?>" target="_blank" style="pointer-events: none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa61;"> Audited Financial Statment</i></a>
                <?php } else{ ?>
                    <a href="<?php echo $print->audited_finance_doc; ?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:#0073aa;"> Audited Financial Statment</i></a>
              <?php } ?></p>


          </div>
          <div class="ngo_prof_details_r" id="DivIdToPrint">
           <center><h1>Details of NGOs Profile</h1></center>
            <i class="fa fa-edit edit_form_2_fafa" style="font-size:48px;color:red"></i>
            <!-- New table design -->
            <table style="padding-left: 40px; margin:0 auto;">
                <tbody>
                  <tr style="height: 23px;">
                    <td style="width: 344px; height: 23px;">
                      <p><h2>NGO Details: </h2></p>
                      <input type="hidden" name="txtUserID" id="txtUserID" value="<?=$uid?>">

                      <p class="">Organisation Name:  <?php echo get_user_meta( $uid, 'org_name', true); ?></p>
                      <!--<p class="edit_show">Organisation Name:  <input type="text" class="edit_show" name="edit_ngo_org_name" value="<?php //echo get_user_meta( $uid, 'org_name', true); ?>"></p>-->

                      <p class="edit_hide">Acronym (If any):  <?php echo $print->acroyn; ?></p>
                      <p class="edit_show">Acronym (If any):  <input type="text" class="edit_show" name="edit_ngo_org_acry" value="<?php echo $print->acroyn; ?>"></p>

                      <p class="edit_hide">Causes Support:  <?php echo get_user_meta( $uid, 'user_causes_for', true ); echo get_user_meta( $uid, 'user_other_causes', true ); ?></p>
                      <p class="edit_show">Causes Support:  <input type="text" class="edit_show" name="edit_ngo_org_causes" value="<?php echo get_user_meta( $uid, 'user_causes_for', true ); echo get_user_meta( $uid, 'user_other_causes', true ); ?>"></p>

                      <p class="edit_hide">Last Year Expenditure:  <?php echo get_user_meta( $uid, 'user_last_year_expd', true );?></p>
                      <p class="edit_show">Last Year Expenditure:  <input type="text" class="edit_show" name="edit_ngo_org_expd" value="<?php echo get_user_meta( $uid, 'user_last_year_expd', true ); ?>"></p>
                    </td>

                    <td style="width: 350px; height: 23px;">
                      <p class="edit_hide">Legal Name:  <?php echo $print->legal_name; ?></p>
                      <p class="edit_show">Legal Name: <input type="text" class="edit_show" name="edit_ngo_org_legal" value="<?php echo $print->legal_name; ?>"></p>

                      <p>NGO Id:  INDD<?php echo $print->id; ?></p>

                      <p class="edit_hide">Last Year Income:  <?php echo get_user_meta( $uid, 'user_last_year_incom', true ); ?></p>
                      <p class="edit_show">Last Year Income: <input type="text" class="edit_show" name="edit_ngo_org_incom" value="<?php echo get_user_meta( $uid, 'user_last_year_incom', true ); ?>"></p>
                    </td>
                  </tr>
                  <tr style="height: 23px;">
                    <td style="width: 344px; height: 23px;">
                      <p><h2>Communication Address:</h2></p>

                      <p class="edit_hide">Address:  <?php echo $print->reg_add; ?></p>
                      <p class="edit_show">Address: <input type="text" class="edit_show" name="edit_ngo_add" value="<?php echo $print->reg_add; ?>"></p>

                      <p class="">City:  <?php echo $print->city; ?></p>
                     <!--<p class="edit_show">City: <input type="text" class="edit_show" name="edit_ngo_city" value="<?php // echo $print->city; ?>"></p>-->

                      <p class="edit_hide">Telephone Number:  <?php echo $print->tel_number; ?></p>
                      <p class="edit_show">Telephone Number: <input type="text" class="edit_show" name="edit_ngo_tel" value="<?php echo $print->tel_number; ?>"></p>

                      <p>Email:  <span  class="ngoEmail"><?php echo $print->email_id; ?></span></p>

                    </td>

                    <td style="width: 350px; height: 23px;">
                      <p class="">State:  <?php echo $print->state; ?></p>
                      <!--<p class="edit_show">State: <input type="text" class="edit_show" name="edit_ngo_state" value="<?php //echo $key->name; ?>">-->

                      <p class="edit_hide">PIN Code:  <?php echo $print->pin_number; ?></p>
                      <p class="edit_show">PIN Code: <input type="text" class="edit_show" name="edit_ngo_pin" value="<?php echo $print->pin_number; ?>">

                      <p class="edit_hide">Mobile Number:  <?php echo $print->mobile_n; ?></p>
                      <p class="edit_show">Mobile Number: <input type="text" class="edit_show" name="edit_ngo_mobile" value="<?php echo $print->mobile_n; ?>">

                      <p class="edit_hide">Website:  <?php echo $print->website; ?></p>
                      <p class="edit_show">Website: <input type="text" class="edit_show" name="edit_ngo_websites" value="<?php echo $print->website; ?>">
                    </td>

                  </tr>
                  <tr style="height: 41px;">
                    <td style="width: 344px; height: 41px;">
                      <p><h2>Chief Functionary</h2></p>
                      <p class="edit_hide">Name:  <?php echo $print->contact_type; ?></p>
                      <p class="edit_show">Name: <input type="text" class="edit_show" name="edit_cf_name" value="<?php echo $print->contact_type;  ?>">

                      <p class="edit_hide">Email id:  <a href="mailto:<?php echo $print->contact_eamil; ?>"><?php echo $print->contact_eamil; ?></a></p>
                      <p class="edit_show">Email id:  <input type="text" class="edit_show" name="edit_cf_email" value="<?php echo $print->contact_eamil;  ?>">

                      <p class="edit_hide">Mobile Number:  <?php echo $print->contact_mobile; ?></p>
                      <p class="edit_show">Mobile Number:  <input type="text" class="edit_show" name="edit_cf_mobile" value="<?php echo $print->contact_mobile;  ?>">

                    </td>
                    <td style="width: 350px; height: 41px;">
                      <p></p>

                      <p class="edit_hide">Designation:  <?php echo $print->contact_design; ?></p>
                      <p class="edit_show">Designation:  <input type="text" class="edit_show" name="edit_cf_desg" value="<?php echo $print->contact_design;  ?>">

                      <p class="edit_hide">Landline number:  <?php echo $print->contact_landline; ?></p>
                      <p class="edit_show">Landline number:  <input type="text" class="edit_show" name="edit_cf_landn" value="<?php echo $print->contact_landline; ?>">
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Alternate Contact Person</h2></p>

                      <p class="edit_hide">Name:  <?php echo $print->reserve_cont; ?></p>
                      <p class="edit_show">Name:  <input type="text" class="edit_show" name="edit_alt_name" value="<?php echo $print->reserve_cont; ?>">

                      <p class="edit_hide">Email id: &nbsp;<a href="mailto:<?php echo $print->reserve_eamil; ?>"><?php echo $print->reserve_eamil; ?></a></p>
                      <p class="edit_show">Email id:  <input type="text" class="edit_show" name="edit_alt_email" value="<?php echo $print->reserve_eamil; ?>">

                      <p class="edit_hide">Mobile Number:  <?php echo $print->reserve_mobile; ?></p>
                      <p class="edit_show">Mobile Number:  <input type="text" class="edit_show" name="edit_alt_mobile" value="<?php echo $print->reserve_mobile; ?>">
                      &nbsp;</td>
                    <td style="width: 350px; height: 85px;">
                      <p></p>
                      <p class="edit_hide">Designation:  <?php echo $print->reserve_design; ?></p>
                      <p class="edit_show">Designation: <input type="text" class="edit_show" name="edit_alt_desg" value="<?php echo $print->reserve_design; ?>">

                      <p class="edit_hide">Landline number:  <?php echo $print->reserve_landline; ?></p>
                      <p class="edit_show">Landline number:  <input type="text" class="edit_show" name="edit_alt_landline" value="<?php echo $print->reserve_landline; ?>">

                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Fund Raising Contact</h2></p>

                      <p class="edit_hide">Name:  <?php echo $print->fr_cont; ?></p>
                      <p class="edit_show">Name:  <input type="text" class="edit_show" name="edit_fr_name" value="<?php echo $print->fr_cont; ?>">

                      <p class="edit_hide">Email id: &nbsp;<a href="mailto:<?php echo $print->fr_email; ?>"><?php echo $print->fr_email; ?></a></p>
                      <p class="edit_show">Email id:  <input type="text" class="edit_show" name="edit_fr_email" value="<?php echo $print->fr_email;  ?>">

                      <p class="edit_hide">Mobile Number:  <?php echo $print->fr_mobile; ?></p>
                      <p class="edit_show">Mobile Number:  <input type="text" class="edit_show" name="edit_fr_mobile" value="<?php echo $print->fr_mobile;  ?>">

                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p class="edit_hide">Designation:  <?php echo $print->fr_design; ?></p>
                      <p class="edit_show">Designation:  <input type="text" class="edit_show" name="edit_fr_desig" value="<?php echo $print->fr_design;   ?>">

                      <p class="edit_hide">Landline number:  <?php echo $print->fr_landline;?></p>
                      <p class="edit_show">Landline number:  <input type="text" class="edit_show" name="edit_fr_landline" value="<?php echo $print->fr_landline;   ?>">
                    </td>
                  </tr>

                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Account Contact</h2></p>

                      <p class="edit_hide">Name:  <?php echo $print->acc_cont; ?></p>
                      <p class="edit_show">Name:  <input type="text" class="edit_show" name="edit_acc_name" value="<?php echo $print->acc_cont; ?>">

                      <p class="edit_hide">Email id: &nbsp;<a href="mailto:<?php echo $print->acc_eamil; ?>"><?php echo $print->acc_eamil; ?></a></p>
                      <p class="edit_show">Email id:  <input type="text" class="edit_show" name="edit_acc_eamil" value="<?php echo $print->acc_eamil; ?>">

                      <p class="edit_hide">Mobile Number:  <?php echo $print->acc_mobile; ?></p>
                      <p class="edit_show">Mobile Number:  <input type="text" class="edit_show" name="edit_acc_mobile" value="<?php echo $print->acc_mobile; ?>">
                    </td>

                    <td style="width: 350px; height: 85px;">
                      <p class="edit_hide">Designation:  <?php echo $print->acc_design; ?></p>
                      <p class="edit_show">Designation:  <input type="text" class="edit_show" name="edit_acc_desig" value="<?php echo $print->acc_design; ?>">

                      <p class="edit_hide">Landline number:  <?php echo $print->acc_landline;?></p>
                      <p class="edit_show">Landline number:  <input type="text" class="edit_show" name="edit_acc_line" value="<?php echo $print->acc_landline; ?>">
                    </td>
                  </tr>

                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Legal Information</h2></p>
                      <p><strong>Registration Information: </strong></p>
                      <p class="edit_hide">Trust:  <?php echo $print->trust; ?></p>
                      <p class="edit_show">Trust:  <input type="text" class="edit_show" name="edit_trust" value="<?php echo $print->trust; ?>">

                      <p class="edit_hide">Society:  <?php echo $print->socity_reg_number; ?></p>
                      <p class="edit_show">Society:  <input type="text" class="edit_show" name="edit_socity" value="<?php echo $print->socity_reg_number; ?>">

                      <p class="edit_hide">Section 8:  <?php echo $print->secton_eig_reg_number; ?></p>
                      <p class="edit_show">Section 8:  <input type="text" class="edit_show" name="edit_section_eig" value="<?php echo $print->secton_eig_reg_number; ?>">

                      <p class="edit_hide">PAN Number:  <?php echo $print->ngo_pan_reg_no; ?></p>
                      <p class="edit_show">PAN Number:  <input type="text" class="edit_show" name="edit_pan" value="<?php echo $print->ngo_pan_reg_no; ?>">

                      <p class="edit_hide">TAN Number:  <?php echo $print->ngo_tan_reg_no; ?></p>
                      <p class="edit_show">TAN Number:  <input type="text" class="edit_show" name="edit_tan" value="<?php echo $print->ngo_tan_reg_no; ?>">
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p>&nbsp;</p>
                      <p><strong>Date of Registration: </strong></p>
                      <p class="edit_hide">Trust:   <?php
                       if ($print->trust_dor == ''){
                         echo 'Not Provided';
                       } else{
                        echo date('m-d-Y', strtotime( $print->trust_dor ));
                       } ?></p>

                      <p class="edit_show">Trust:   <?php
                       if ($print->trust_dor == ''){
                         //echo 'Not Provided';
                         ?> <input type="text" class="edit_show" name="edit_trust_date" value="<?php echo 'Not Provided';?>"> <?php
                       } else{
                        echo date('m-d-Y', strtotime( $print->trust_dor ));
                        ?> <input type="text" class="edit_show" name="edit_trust_date" value="<?php echo date('m-d-Y', strtotime( $print->trust_dor )); ?>"> <?php
                       } ?></p>

                      <p class="edit_show">Society:  <?php
                        if ( $print->socity_date_of_reg == '' ){
                          //echo 'Not Provided'; ?>
                          <input type="text" class="edit_show" name="edit_socity_date" value="<?php echo 'Not Provided';?>"> <?php
                        } else{
                          ?>
                          <input type="text" class="edit_show" name="edit_socity_date" value="<?php echo date('m-d-Y', strtotime( $print->socity_date_of_reg )); ?>">
                         <?php
                        } ?></p>

                      <p class="edit_hide">Society:  <?php
                        if ( $print->socity_date_of_reg == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime( $print->socity_date_of_reg ));
                        } ?></p>

                      <p class="edit_hide">Section 8:  <?php
                       if ( $print->section_eig_date_of_reg == '' ){
                        echo 'Not Provided';
                      } else{
                       echo date('m-d-Y', strtotime( $print->section_eig_date_of_reg ));
                      } ?></p>

                       <p class="edit_show">Section 8:  <?php
                       if ( $print->section_eig_date_of_reg == '' ){ ?>
                        <input type="text" class="edit_show" name="edit_section_eight_date" value="<?php echo 'Not Provided';?>"> <?php
                        //echo 'Not Provided';
                      } else{
                       ?>  <input type="text" class="edit_show" name="edit_section_eight_date" value="<?php echo date('m-d-Y', strtotime( $print->section_eig_date_of_reg )); ?>"> <?php
                      } ?></p>

                      <p class="edit_hide">PAN Registration date:  <?php
                       if ( $print->ngo_pan_reg_date == '' ){
                        echo 'Not Provided';
                      } else{
                       echo date('m-d-Y', strtotime( $print->ngo_pan_reg_date ));
                      } ?></p>

                      <p class="edit_show">PAN Registration date:  <?php
                       if ( $print->ngo_pan_reg_date == '' ){
                        //echo 'Not Provided';
                        ?>
                         <input type="text" class="edit_show" name="edit_pan_date" value="<?php echo 'Not Provided';?>"> <?php
                      } else{
                     ?>
                       <input type="text" class="edit_show" name="edit_pan_date" value="<?php  echo date('m-d-Y', strtotime( $print->ngo_pan_reg_date )); ?>"> <?php
                      } ?></p>

                      <p class="edit_hide">TAN Registration date:  <?php
                      if ( $print->ngo_tan_reg_date == '' ){
                        echo 'Not Provided';
                      } else{
                       echo date('m-d-Y', strtotime($print->ngo_tan_reg_date ));
                      } ?></p>

                      <p class="edit_show">TAN Registration date:  <?php
                      if ( $print->ngo_tan_reg_date == '' ){
                        //echo 'Not Provided';?>
                        <input type="text" class="edit_show" name="edit_tan_date" value="<?php echo 'Not Provided';?>"> <?php
                      } else{
                        ?>
                        <input type="text" class="edit_show" name="edit_tan_date" value="<?php echo date('m-d-Y', strtotime($print->ngo_tan_reg_date )); ?>"> <?php
                      } ?></p>
                    </td>
                  </tr>

                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Certification</h2><strong>Section 12A</strong></p>
                      <p class="edit_hide">Registration Number:  <?php echo $print->secton_tlv_reg_number; ?></p>
                      <p class="edit_show">Registration Number:  <input type="text" class="edit_show" name="edit_tlv_eg_no" value="<?php echo $print->secton_tlv_reg_number; ?>"></p>

                      <p class="edit_show"> Valid till:  <?php
                      if ( $print->section_tlv_date_of_exp == '' ){
                        //echo 'Not Provided';
                        ?>
                          <input type="text" class="edit_show" name="edit_tlv_valid" value="<?php echo 'Not Provided'; ?>">
                        <?php
                      } else{
                       //echo date('m-d-Y', strtotime( $print->section_tlv_date_of_exp ));
                       ?> <input type="text" class="edit_show" name="edit_tlv_valid" value="<?php echo date('m-d-Y', strtotime( $print->section_tlv_date_of_exp )); ?>"> <?php
                      } ?></p>

                     <p class="edit_hide">Valid till:  <?php
                      if ( $print->section_tlv_date_of_exp == '' ){
                        echo 'Not Provided';
                      } else{
                       echo date('m-d-Y', strtotime( $print->section_tlv_date_of_exp ));
                      } ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p></p>
                      <p></p></br>
                      <p>Registration Date:  <?php
                       if ( $print->section_tlv_date_of_reg == '' ){
                        ?> <input type="text" class="edit_show" name="edit_tlv_reg_date" value="<?php echo 'Not Provided'; ?>"> <?php
                      } else{

                       ?> <input type="text" class="edit_show" name="edit_tlv_reg_date" value="<?php echo date('m-d-Y', strtotime( $print->section_tlv_date_of_reg )); ?>"> <?php
                      } ?></p>

                      <p class="edit_hide">Reason if expire:  <?php echo $print->section_tlv_ren_of_exp;?></p>
                      <p class="edit_show">Reason if expire:  <input type="text" class="edit_show" name="edit_tlv_exp_reson" value="<?php echo $print->section_tlv_ren_of_exp; ?>"></p>

                    </td>
                  </tr>

                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><strong>Section 80G</strong></p>

                      <p class="edit_hide">Registration Number:  <?php echo $print->g_eighty_number; ?></p>
                      <p class="edit_show">Registration Number:  <input type="text" class="edit_show" name="edit_80g_reg_number" value="<?php echo $print->g_eighty_number; ?>"></p>

                      <p class="edit_hide">Valid till:  <?php
                      if ( $print->g_eighty_doex == '' ){
                        echo 'Not Provided';
                      } else{
                       echo date('m-d-Y', strtotime( $print->g_eighty_doex ));
                      } ?></p>

                    <p class="edit_show">Valid till:  <?php
                      if ( $print->g_eighty_doex == '' ){
                        //echo 'Not Provided';
                        ?>
                          <input type="text" class="edit_show" name="edit_80g_valid" value="<?php echo "Not Provided"; ?>">
                        <?php
                      } else{
                       ?> <input type="text" class="edit_show" name="edit_80g_valid" value="<?php  echo date('m-d-Y', strtotime( $print->g_eighty_doex )); ?>"> <?php
                      } ?></p>

                    </td>
                    <td style="width: 350px; height: 85px;">

                      <p>&nbsp;</p>
                      <p class="edit_hide">Registration Date:  <?php
                      if ( $print->g_eighty_dor == '' ){
                        echo 'Not Provided';
                      } else{
                       echo date('m-d-Y', strtotime( $print->g_eighty_dor ));
                      } ?></p>

                      <p class="edit_show">Registration Date:  <?php
                      if ( $print->g_eighty_dor == '' ){
                        ?><input type="text" class="edit_show" name="edit_80g_reg_date" value="<?php echo 'Not Provided'; ?>"> <?php
                      } else{

                       ?> <input type="text" class="edit_show" name="edit_80g_reg_date" value="<?php echo date('m-d-Y', strtotime( $print->g_eighty_dor )); ?>"> <?php
                      } ?></p>


                      <p class="edit_hide">Reason if expire:  <?php echo $print->g_eighty_reson_of_expire; ?></p>
                      <p class="edit_show">Reason if expire:  <input type="text" class="edit_show" name="edit_80g_exp_reson" value="<?php echo $print->g_eighty_reson_of_expire; ?>"></p>
                      &nbsp;</td>
                  </tr>

                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><strong>FCRA</strong></p>

                      <p class="edit_hide">Registration Number:  <?php echo $print->secton_fcra_reg_number; ?></p>
                      <p class="edit_show">Registration Number:  <input type="text" class="edit_show" name="edit_fcra_reg_number" value="<?php echo $print->secton_fcra_reg_number; ?>"></p>

                      <p class="edit_hide">Valid till:  <?php
                        if ( $print->section_fcra_date_of_exp == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime( $print->section_fcra_date_of_exp ));
                        }  ?></p>

                      <p class="edit_show">Valid till:  <?php
                        if ( $print->section_fcra_date_of_exp == '' ){
                          ?> <input type="text" class="edit_show" name="edit_fcra_vaild" value="<?php  echo 'Not Provided'; ?>"> <?php
                        } else{
                         ?> <input type="text" class="edit_show" name="edit_fcra_vaild" value="<?php  echo date('m-d-Y', strtotime( $print->section_fcra_date_of_exp )); ?>"> <?php
                        }  ?></p>

                      &nbsp;</td>
                    <td style="width: 350px; height: 85px;">

                      <p>&nbsp;</p>
                      <p class="edit_hide">Registration Date:  <?php
                         if ( $print->section_fcra_date_of_reg == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime( $print->section_fcra_date_of_reg ));
                        }  ?></p>

                        <p class="edit_show">Registration Date:  <?php
                         if ( $print->section_fcra_date_of_reg == '' ){
                          echo 'Not Provided';
                          ?> <input type="text" class="edit_show" name="edit_fcra_reg_date" value="<?php  echo 'Not Provided'; ?>"> <?php
                        } else{
                         ?> <input type="text" class="edit_show" name="edit_fcra_reg_date" value="<?php  echo date('m-d-Y', strtotime( $print->section_fcra_date_of_reg )); ?>"> <?php
                        }  ?></p>

                      <p class="edit_hide">Reason if expire:  <?php echo $print->section_fcra_ren_of_exp; ?></p>
                      <p class="edit_show">Reason if expire:  <input type="text" class="edit_show" name="edit_fcra_reson_of_exp" value="<?php echo $print->section_fcra_ren_of_exp; ?>"></p>

                      &nbsp;</td>
                  </tr>

                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Account Information</h2></p>
                      <p><strong>NON-FCRA</strong></p>

                      <p class="edit_hide">Bank Name:  <?php echo $print->nbank_name; ?></p>
                      <p class="edit_show">Bank Name:  <input type="text" class="edit_show" name="edit_bank_name" value="<?php echo $print->nbank_name; ?>"></p>

                      <p class="edit_hide">Account Number:  <?php echo $print->nacc_number; ?></p>
                      <p class="edit_show">Account Number:  <input type="text" class="edit_show" name="edit_acc_number" value="<?php echo $print->nacc_number; ?>"></p>

                      <p class="edit_hide">9 Digit MICR Number:  <?php echo $print->nmicr_num; ?></p>
                      <p class="edit_show">9 Digit MICR Number:  <input type="text" class="edit_show" name="edit_micr_number" value="<?php echo $print->nmicr_num; ?>"></p>

                      <p class="edit_hide">SWIFT Code:  <?php echo $print->nswift_code; ?></p>
                      <p class="edit_show">SWIFT Code:  <input type="text" class="edit_show" name="edit_swift_number" value="<?php echo $print->nswift_code; ?>"></p>

                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p></p>
                      <p class="edit_hide">Branch Name:  <?php echo $print->nbank_b_add; ?></p>
                      <p class="edit_show">Branch Name:  <input type="text" class="edit_show" name="edit_bank_branch_name" value="<?php echo $print->nbank_b_add; ?>"></p>

                      <p class="edit_hide">Name of the Acc:  <?php echo $print->nacc_name; ?></p>
                      <p class="edit_show">Name of the Acc:  <input type="text" class="edit_show" name="edit_bank_acc_name" value="<?php echo $print->nacc_name; ?>"></p>

                      <p class="edit_hide">Account Type:  <?php echo $print->nacc_type; ?></p>
                      <p class="edit_show">Account Type:  <input type="text" class="edit_show" name="edit_bank_acc_type" value="<?php echo $print->nacc_type; ?>"></p>

                      <p class="edit_hide">IFSC Code:  <?php echo $print->nifsc_code; ?></p>
                      <p class="edit_show">IFSC Code:  <input type="text" class="edit_show" name="edit_bank_ifsc" value="<?php echo $print->nifsc_code; ?>"></p>
                    </td>
                  </tr>

                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><strong>FCRA</strong></p>
                      <p class="edit_hide">Bank Name:  <?php echo $print->bank_name; ?></p>
                      <p class="edit_show">Bank Name:  <input type="text" class="edit_show" name="edit_fcra_bank_name" value="<?php echo $print->bank_name; ?>"></p>

                      <p class="edit_hide">Account Number:  <?php echo $print->acc_number; ?></p>
                      <p class="edit_show">Account Number:  <input type="text" class="edit_show" name="edit_fcra_bank_acc_number" value="<?php echo $print->acc_number; ?>"></p>

                      <p class="edit_hide">9 Digit MICR Number:  <?php echo $print->micr_num; ?></p>
                      <p class="edit_show">9 Digit MICR Number:  <input type="text" class="edit_show" name="edit_fcra_bank_micr_number" value="<?php echo $print->micr_num; ?>"></p>

                      <p class="edit_hide">SWIFT Code:  <?php echo $print->swift_code; ?></p>
                      <p class="edit_show">SWIFT Code:  <input type="text" class="edit_show" name="edit_fcra_bank_swift_code" value="<?php echo $print->swift_code; ?>"></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p class="edit_hide">Branch Name:  <?php echo $print->bank_b_add; ?></p>
                      <p class="edit_show">Branch Name:  <input type="text" class="edit_show" name="edit_fcra_bank_branch_name" value="<?php echo $print->bank_b_add; ?>"></p>

                      <p class="edit_hide">Name of Account:  <?php echo $print->acc_name; ?></p>
                      <p class="edit_show">Name of Account:  <input type="text" class="edit_show" name="edit_fcra_bank_acc_name" value="<?php echo $print->acc_name; ?>"></p>

                      <p class="edit_hide">Account Type:  <?php echo $print->acc_type; ?></p>
                      <p class="edit_show">Account Type:  <input type="text" class="edit_show" name="edit_fcra_bank_acc_type" value="<?php echo $print->acc_type; ?>"></p>

                      <p class="edit_hide">IFSC Code:  <?php echo $print->ifsc_code; ?></p>
                      <p class="edit_show">IFSC Code:  <input type="text" class="edit_show" name="edit_fcra_bank_ifcs_code" value="<?php echo $print->ifsc_code; ?>"></p>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="ngo-infor-about">
                <h2>About NGO</h2>
                <div class="edit_hide"><?php echo $print->about_org; ?></div>
                <textarea rows="10" cols="85" id="edit_ngo_abt" class="edit_show" name="edit_ngo_about"><?php echo $print->about_org; ?></textarea>
              </div>
              <div class="ngo-infor-about">
                <h2>Vision</h2>
                <div class="edit_hide"><?php echo $print->ngo_vision; ?></div>
                <textarea rows="10" cols="85" id="edit_ngo_vis" class="edit_show" name="edit_ngo_vision"><?php echo $print->ngo_vision; ?></textarea>
            </div>
            <div class="ngo-infor-about">
                <h2>Mission</h2>
                <div class="edit_hide"><?php echo $print->ngo_mission; ?></div>
                <textarea rows="10" cols="85" id="edit_ngo_miss" class="edit_show" name="edit_ngo_mission"><?php echo $print->ngo_mission; ?></textarea>
            </div>
            <div class="ngo-infor-about">
                <h2>Success Story</h2>
                <div class="edit_hide"><?php echo $print->ngo_story; ?></div>
                <textarea rows="10" cols="85" id="edit_ngo_succ" class="edit_show" name="edit_ngo_success_story"><?php echo $print->ngo_story; ?></textarea>
            </div>
            <input id="edit-submit" name="edit_details" class="hs-button primary large action-button ngo_form_2_update" type="submit" value="Update"/>
        </form>
            <!-- end -->

            <div>
            <?php
            global $wpdb;
            $ng_id = $_GET['nid'];
            if ( isset( $_POST["approve"] ) ) {
            $ng_id = $_GET['nid'];
            $table = "wp_ngo_profile";
            $app_status = $_POST["approve"];
            $success = $wpdb->update(
                    $table,
                    array(
                      'approval_status' => $app_status,
                    ),
                    array(
                      'nguser_id' => $ng_id,
                    )
                  );
            if( $success ){
              tbs_create_ngo_pages_on_success();
              $message = "Yes Approved";
              echo "<script type='text/javascript'>alert('$message');</script>";
              // Mail to admin for cross check.
              $ngo_emails = get_userdata( $uid );
              $title_name = get_user_meta( $uid, 'user_prefix_name', true);
              $last_name =  get_user_meta( $uid, 'user_last_name', true);
              $get_ngo_mail_is = $ngo_emails->user_email;
              $ngo_user_temp_pass = get_user_meta( $uid, 'vikkip', true );
              //$title = wp_strip_all_tags(get_the_title($post->ID));
              //$url = get_permalink($post->ID);
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
              <meta name='viewport' content='width=device-width, initial-scale=1' />
              <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>

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
                  padding: 10px 10px 0px;
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
                  padding: 30px 10px;
                  width: 500px;
                }

                .mini-block {
                background-color: #ffffff;
                width: 498px;
                border: 0px solid #cccccc;
                border-radius: 5px;
                padding: 15px 15px;
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
                  padding: 10px 10px;
                  border: 1px solid #cccccc;
                  color: #4d4d4d;
                  font-weight: bold;
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
                padding: 10px 10px 0px;
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
                            <table cellpadding='0' cellspacing='0' width='800' class='w320'>
                              <tr>
                                <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                                  <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                                </td>
                                <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                                  <a style='color:#3C5A99;' href='#'><i class='fab fa-facebook-f fa-2x'></i></a>
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
                    <table cellspacing='0' cellpadding='0' width='800' class='w320'>
                      <tr>
                        <td class='free-text pull-left'>
                          Dear <strong>$title_name, $last_name</strong>

                          <p>Greetings from IndiaDonates!</p>

                          <p>Congratulations! Based on the review process, we are happy to inform you, that your organisation has been selected to be part of the www.Indiadonates.in.</p>

                          <p>We welcome you to this credible group of NGO’s that have been chosen from across India to be part of this path breaking initiative.</p>

                          <p>We would encourage you now to create your own Projects. You are expected to create at least one project within next 15 days. Please remember to popularize it in your network, as we do our best to help raise funds for your project.</p>

                          <p>We are sharing with you a PPT which will help you to understand the step-by-step procedure of creating your projects.</p>

                          <p>Please read carefully & keep your Login details safe!</p>

                           <p>For your reference, your login detail is as follows:</p>
                        </td>
                      </tr>
                      <tr>
                        <td style='padding-bottom: 10px;'></td>

                      </tr>
                      <tr>
                        <td class='mini-block-container'>
                          <table cellspacing='0' cellpadding='0' width='100%'  style='border-collapse:separate !important;'>
                            <tr>
                              <td class='mini-block'>
                                <table cellpadding='5' cellspacing='5' width='100%'>
                                  <tr>
                                    <td class='code-block' style='text-align:center;'>
                                      <p>Username is your registered email id: <a href='mailto: $get_ngo_mail_is'> $get_ngo_mail_is </a></p>
                                      <p>Auto generated password is: <span style='color: #000'> $ngo_user_temp_pass </span></p>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style='padding: 10px 10px 0px; text-align: left;'>
                          <p>In case, you wish to change your password <a href='$password_rset_link'>click here</a></p>
                            <!--<p><a href='$password_rset_link'> $password_rset_link</strong></a></p>-->
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p class='bottom_regards'>For any questions and clarifications, do not hesitate to contact us at coordinator@indiadonates.in</p>
                          <p>Assuring you of our best service at all times.</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class='bottom_regards'>
                            <p>Regards,<br><strong>IndiaDonatesTeam</strong></p>

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

                            <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                              Sector 20, Noida<br>
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
              $headers = 'From: My Name <no-reply@indiadonates.in>' . "\r\n";

              wp_mail( $get_ngo_mail_is, "Congratulations! Your NGO is successfully enrolled. Login & start creating Projects!", $message , $headers);
              update_user_meta( $uid, 'final_ngo_approval', 'Approved' );

            }else{
               $messagen = "Wrong!! Already Approved!" ;
              echo "<script type='text/javascript'>alert('$messagen');</script>";
            }

            }
            if( isset( $_POST['reject'] ) ){
              //$table = $wpdb->prefix."ngo_profile";
              $table = "wp_ngo_profile";
              $app_status = $_POST["reject"];
              $success = $wpdb->update(
                    $table,
                    array(
                      'approval_status' => $app_status,
                    ),
                    array(
                      'nguser_id' => $ng_id,
                    )
                  );
            if( $success ){
              $message = "Are You sure!! Want to reject the NGOs Request";
              echo "<script type='text/javascript'>alert('$message');</script>";
              // Mail to admin for cross check.
                $ngo_emails = get_userdata( $uid );
                $get_ngo_mail_is = $ngo_emails->user_email;
                //$title = wp_strip_all_tags(get_the_title($post->ID));
                //$url = get_permalink($post->ID);
                $message = "NGO Rejected: \n{$url}";
                $headers = 'From: My Name <akshats@techbrise.com>' . "\r\n";

                wp_mail( $get_ngo_mail_is, "Your NGOs is Rejected. Please contact support for more deatils.: {$title}", $message , $headers);
              }else{
               $messagen = "Already Rejected!!" ;
              echo "<script type='text/javascript'>alert('$messagen');</script>";
            }

            }
            if( isset( $_POST['resend_approval_mail'] ) ){

              $ngo_emails = get_userdata( $uid );
              $title_name = get_user_meta( $uid, 'user_prefix_name', true);
              $last_name =  get_user_meta( $uid, 'user_last_name', true);
              $get_ngo_mail_is = $ngo_emails->user_email;
              $ngo_user_temp_pass = get_user_meta( $uid, 'vikkip', true );
              //$title = wp_strip_all_tags(get_the_title($post->ID));
              //$url = get_permalink($post->ID);
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
              <meta name='viewport' content='width=device-width, initial-scale=1' />
              <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>

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
                  padding: 10px 10px 0px;
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
                  padding: 30px 10px;
                  width: 500px;
                }

                .mini-block {
                background-color: #ffffff;
                width: 498px;
                border: 0px solid #cccccc;
                border-radius: 5px;
                padding: 15px 15px;
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
                  padding: 10px 10px;
                  border: 1px solid #cccccc;
                  color: #4d4d4d;
                  font-weight: bold;
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
                padding: 10px 10px 0px;
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
                            <table cellpadding='0' cellspacing='0' width='800' class='w320'>
                              <tr>
                                <td class='pull-left mobile-header-padding-left' style='vertical-align: middle;'>
                                  <a href=''><img width='137' height='47' src='http://indiadonates.in/indiadonates/wp-content/uploads/2018/12/india-donates-1024x344.png' alt='logo'></a>
                                </td>
                                <td class='pull-right mobile-header-padding-right' style='color: #4d4d4d;'>
                                  <a style='color:#3C5A99;' href='#'><i class='fab fa-facebook-f fa-2x'></i></a>
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
                    <table cellspacing='0' cellpadding='0' width='800' class='w320'>
                      <tr>
                        <td class='free-text pull-left'>
                          Dear <strong>$title_name, $last_name</strong>

                          <p>Greetings from IndiaDonates!</p>

                          <p>Congratulations! Based on the review process, we are happy to inform you, that your organisation has been selected to be part of the www.Indiadonates.in.</p>

                          <p>We welcome you to this credible group of NGO’s that have been chosen from across India to be part of this path breaking initiative.</p>

                          <p>We would encourage you now to create your own Projects. You are expected to create at least one project within next 15 days. Please remember to popularize it in your network, as we do our best to help raise funds for your project.</p>

                          <p>We are sharing with you a PPT which will help you to understand the step-by-step procedure of creating your projects.</p>

                          <p>Please read carefully & keep your Login details safe!</p>

                           <p>For your reference, your login detail is as follows:</p>
                        </td>
                      </tr>
                      <tr>
                        <td style='padding-bottom: 10px;'></td>

                      </tr>
                      <tr>
                        <td class='mini-block-container'>
                          <table cellspacing='0' cellpadding='0' width='100%'  style='border-collapse:separate !important;'>
                            <tr>
                              <td class='mini-block'>
                                <table cellpadding='5' cellspacing='5' width='100%'>
                                  <tr>
                                    <td class='code-block' style='text-align:center;'>
                                      <p>Username is your registered email id: <a href='mailto: $get_ngo_mail_is'> $get_ngo_mail_is </a></p>
                                      <p>Auto generated password is: <span style='color: #000'> $ngo_user_temp_pass </span></p>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style='padding: 10px 10px 0px; text-align: left;'>
                          <p>In case, you wish to change your password <a href='$password_rset_link'>click here</a></p>
                            <!--<p><a href='$password_rset_link'> $password_rset_link</strong></a></p>-->
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <p class='bottom_regards'>For any questions and clarifications, do not hesitate to contact us at coordinator@indiadonates.in</p>
                          <p>Assuring you of our best service at all times.</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class='bottom_regards'>
                            <p>Regards,<br><strong>IndiaDonatesTeam</strong></p>

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

                            <div class='textwidget'><p>A-5, Sector 26, Pocket C,
                              Sector 20, Noida<br>
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
              $headers = 'From: My Name <no-reply@indiadonates.in>' . "\r\n";

              wp_mail( $get_ngo_mail_is, "Congratulations! Your NGO is successfully enrolled. Login & start creating Projects!", $message , $headers);

              $gen_msg = "Mail Resend Successfuly!";
              echo "<script type='text/javascript'>alert('$gen_msg');</script>";
            }
            ?>
            <?php
                $final_approval_status = get_user_meta( $uid, 'final_ngo_approval', true );
                $ngo_status = $print->approval_status;
                if( $final_approval_status == "Approved" || $ngo_status =="yes"  ){ ?>
                <center>
                <form method="post">
                  <button class="btn_ngo_approve" name="resend_approval_mail" value="">Resend Mail</button> <button class="btn_ngo_reject" name="reject" value="no">Reject</button>
                  <input class="btn_ngo_approve" type='button' id='btn' value='Print' onclick='printDiv();' style="width: 15%;height: 45px;">


                  <!--<a href="<?php //echo get_admin_url();?>admin.php?page=ngo_profile_form&enid=<?php //echo $print->nguser_id; ?>" class="btn_ngo_approve">Edit</a>-->
                </form>
                </center>

                <?php
                }else{ ?>
                  <center>
                  <form method="post">
                    <button class="btn_ngo_approve" name="approve" value="yes">Approve</button> <button class="btn_ngo_reject" name="reject" value="no">Reject</button>
                    <input class="btn_ngo_approve" type='button' id='btn' value='Print' onclick='printDiv();' style="width: 15%;height: 45px;">
					 <button type="button" class="btn_ngo_approve" style="background:#16426B" data-toggle="modal" data-target="#myModal">Re-Submit</button>
					<!-- <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#btn_show"> Re-Submi11t</button>-->
                    <!--<a href="<?php //echo get_admin_url();?>admin.php?page=ngo_profile_form&enid=<?php //echo $print->nguser_id; ?>" class="btn_ngo_approve">Edit</a>-->
                  </center>
                  </form>
                <?php
                }
              ?>
             </p>
          </div>
        </div>
    </div>
      <?php
    }
  }

  ?>

  <?php
//NGOs Profiles show.
  function tbs_show_profile(){
    //$npid = get_current_blog_id();
    $usid = get_current_user_id();
    global $wpdb;
    $table_name = "wp_ngo_profile";
    $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$usid'" );
    foreach( $result as $print ){
      //print_r($print);
      //echo $print->name;
      ?>
      <div style="padding-top: 40px;">
          <div class="ngo_prof_details_l">
              <?php
            $ngo_logo = $print->ngo_logo;
             if( $ngo_logo == "" ){?>
                <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y" alt="Avatar" class="tbsavatar">
             <?php }else{?>
                 <img src="<?php echo $ngo_logo; ?>" alt="Avatar" class="tbsavatar">
             <?php } ?>
             <h2><?php echo $print->org_name; ?></h2>
             <address>
              Address: <?php echo $print->reg_add; ?> <br>
              City: <?php echo $print->city; ?> <br>
              State: <?php echo $print->state; ?><br>
              Mobile: <?php echo $print->mobile_n; ?><br>
              Eamil: <a href="mailto:<?php echo $print->email_id;?>"><?php echo $print->email_id;?></a>.<br>
              Website: <?php echo $print->website; ?><br>
             </address>
             <?php
              $ngo_status_img = $print->approval_status;
              switch ( $ngo_status_img ) {
                case 'yes':?>
                      <img src="<?php echo plugins_url( 'ngo-profile' ).'/images/approve.png'?>" class="tbsavata" alt="Approve">
                <?php
                  break;
                case 'no':?>
                      <img src="<?php echo plugins_url( 'ngo-profile' ).'/images/reject.png'?>" class="tbsavata" alt="Approve">
                   <?php
                  break;

                default:
                  echo "In-Review";
                  break;
              }
             ?>
          </div>
          <div class="ngo_prof_details_r">
            <center><h1>Your NGO Profile</h1></center>
            <table style="padding-left: 40px; margin:0 auto;">
                <tbody>
                  <tr style="height: 23px;">
                    <td style="width: 344px; height: 23px;">
                      <p><h2>NGO Details: </h2></p>
                      <p>Organisation Name:  <?php echo $print->org_name; ?></p>
                      <p>Acronym (If any):  <?php echo $print->acroyn; ?></p>
                      <p>Causes Support:  <?php echo get_user_meta( $usid, 'user_causes_for', true ); echo get_user_meta( $usid, 'user_other_causes', true ); ?></p>
                    </td>
                    <td style="width: 350px; height: 23px;">
                      <p>Legal Name:  <?php echo $print->legal_name; ?></p>
                      <p>NGO Id:  INDD<?php echo $print->id; ?></p>
                    </td>
                  </tr>
                  <tr style="height: 23px;">
                    <td style="width: 344px; height: 23px;">
                      <p><h2>Communication Address:</h2></p>
                      <p>Address:  <?php echo $print->reg_add; ?></p>
                      <p>City:  <?php echo $print->city; ?></p>
                      <p>Telephone Number:  <?php echo $print->tel_number; ?></p>
                      <p>Email:  <?php echo $print->email_id; ?></p>
                    </td>
                    <td style="width: 350px; height: 23px;">
                      <p>State:  <?php echo $print->state; ?></p>
                      <p>PIN Code:  <?php echo $print->pin_number; ?></p>
                      <p>Mobile Number:  <?php echo $print->mobile_n; ?></p>
                      <p>Website:  <?php echo $print->website; ?></p>
                    </td>
                  </tr>
                  <tr style="height: 41px;">
                    <td style="width: 344px; height: 41px;">
                      <p><h2>Chief Functionary</h2></p>
                      <p>Name:  <?php echo $print->contact_type; ?></p>
                      <p>Email id:  <a href="mailto:<?php echo $print->contact_eamil; ?>"><?php echo $print->contact_eamil; ?></a></p>
                      <p>Mobile Number:  <?php echo $print->contact_mobile; ?></p>
                    </td>
                    <td style="width: 350px; height: 41px;">
                      <p></p>
                      <p>Designation:  <?php echo $print->contact_design; ?></p>
                      <p>Landline number:  <?php echo $print->contact_landline; ?></p>
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Alternate Contact Person</h2></p>
                      <p>Name:  <?php echo $print->reserve_cont; ?></p>
                      <p>Email id: &nbsp;<a href="mailto:<?php echo $print->reserve_eamil; ?>"><?php echo $print->reserve_eamil; ?></a></p>
                      <p>Mobile Number:  <?php echo $print->reserve_mobile; ?></p>
                      &nbsp;</td>
                    <td style="width: 350px; height: 85px;">
                      <p></p>
                      <p>Designation:  <?php echo $print->reserve_design; ?></p>
                      <p>Landline number:  <?php echo $print->reserve_landline; ?></p>
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Fund Raising Contact</h2></p>
                      <p>Name:  <?php echo $print->fr_cont; ?></p>
                      <p>Email id: &nbsp;<a href="mailto:<?php echo $print->fr_email; ?>"><?php echo $print->fr_email; ?></a></p>
                      <p>Mobile Number:  <?php echo $print->fr_mobile; ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p>Designation:  <?php echo $print->fr_design; ?></p>
                      <p>Landline number:  <?php echo $print->fr_landline;?></p>
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Account Contact</h2></p>
                      <p>Name:  <?php echo $print->acc_cont; ?></p>
                      <p>Email id: &nbsp;<a href="mailto:<?php echo $print->acc_eamil; ?>"><?php echo $print->acc_eamil; ?></a></p>
                      <p>Mobile Number:  <?php echo $print->acc_mobile; ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p>Designation:  <?php echo $print->acc_design; ?></p>
                      <p>Landline number:  <?php echo $print->acc_landline;?></p>
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Legal Information</h2></p>
                      <p><strong>Registration Information: </strong></p>
                      <p>Trust:  <?php echo $print->trust; ?></p>
                      <p>Society:  <?php echo $print->socity_reg_number; ?></p>
                      <p>Section 8:  <?php echo $print->secton_eig_reg_number; ?></p>
                      <p>PAN Number:  <?php echo $print->ngo_pan_reg_no; ?></p>
                      <p>TAN Number:  <?php echo $print->ngo_tan_reg_no; ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p>&nbsp;</p>
                      <p><strong>Date of Registration: </strong></p>
                      <p>Trust:  <?php
                         if ( $print->trust_dor == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime( $print->trust_dor ));
                        } ?></p>
                      <p>Society:  <?php
                      if ( $print->socity_date_of_reg == '' ){
                        echo 'Not Provided';
                      } else{
                       echo date('m-d-Y', strtotime( $print->socity_date_of_reg ));
                      } ?></p>
                      <p>Section 8:  <?php
                        if (  $print->section_eig_date_of_reg == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->section_eig_date_of_reg ));
                        } ?></p>
                      <p>PAN Number:  <?php
                        if (  $print->ngo_pan_reg_date == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->ngo_pan_reg_date ));
                        } ?></p>
                      <p>TAN Number:  <?php
                        if ( $print->ngo_tan_reg_date == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->ngo_tan_reg_date ));
                        } ?></p>
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Certification</h2><strong>Section 12A</strong></p>
                      <p>Registration Number:  <?php echo $print->secton_tlv_reg_number; ?></p>
                      <p>Valid till:  <?php
                        if ( $print->section_tlv_date_of_exp == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->section_tlv_date_of_exp ));
                        } ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p></p>
                      <p></p></br>
                      <p>Registration Date:  <?php
                        if ( $print->section_tlv_date_of_reg == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->section_tlv_date_of_reg ));
                        } ?></p>
                      <p>Reason if expire:  <?php echo $print->section_tlv_ren_of_exp;?></p>
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><strong>Section 80G</strong></p>
                      <p>Registration Number:  <?php echo $print->g_eighty_number; ?></p>
                      <p>Valid till:  <?php
                        if ( $print->g_eighty_doex == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->g_eighty_doex ));
                        } ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p>&nbsp;</p>
                      <p>Registration Date:  <?php
                        if ( $print->g_eighty_dor == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->g_eighty_dor ));
                        } ?></p>
                      <p>Reason if expire:  <?php echo $print->g_eighty_reson_of_expire; ?></p>
                      &nbsp;</td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><strong>FCRA</strong></p>
                      <p>Registration Number:  <?php echo $print->secton_fcra_reg_number; ?></p>
                      <p>Valid till:  <?php
                        if ( $print->section_fcra_date_of_exp == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->section_fcra_date_of_exp ));
                        } ?></p>
                      &nbsp;</td>
                    <td style="width: 350px; height: 85px;">
                      <p>&nbsp;</p>
                      <p>Registration Date:  <?php
                        if ( $print->section_fcra_date_of_reg == '' ){
                          echo 'Not Provided';
                        } else{
                         echo date('m-d-Y', strtotime(  $print->section_fcra_date_of_reg ));
                        } ?></p>
                      <p>Reason if expire:  <?php echo $print->section_fcra_ren_of_exp; ?></p>
                      &nbsp;</td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><h2>Account Information</h2></p>
                      <p><strong>NON-FCRA</strong></p>
                      <p>Bank Name:  <?php echo $print->nbank_name; ?></p>
                      <p>Account Number:  <?php echo $print->nacc_number; ?></p>
                      <p>9 Digit MICR Number:  <?php echo $print->nmicr_num; ?></p>
                      <p>SWIFT Code:  <?php echo $print->nswift_code; ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p></p>
                      <p>Branch Name:  <?php echo $print->nbank_b_add; ?></p>
                      <p>Name of the Acc:  <?php echo $print->nacc_name; ?></p>
                      <p>Account Type:  <?php echo $print->nacc_type; ?></p>
                      <p>IFSC Code:  <?php echo $print->nifsc_code; ?></p>
                    </td>
                  </tr>
                  <tr style="height: 85px;">
                    <td style="width: 344px; height: 85px;">
                      <p><strong>FCRA</strong></p>
                      <p>Bank Name:  <?php echo $print->bank_name; ?></p>
                      <p>Account Number:  <?php echo $print->acc_number; ?></p>
                      <p>9 Digit MICR Number:  <?php echo $print->micr_num; ?></p>
                      <p>SWIFT Code:  <?php echo $print->swift_code; ?></p>
                    </td>
                    <td style="width: 350px; height: 85px;">
                      <p>Branch Name:  <?php echo $print->bank_b_add; ?></p>
                      <p>Name of Account:  <?php echo $print->acc_name; ?></p>
                      <p>Account Type:  <?php echo $print->acc_type; ?></p>
                      <p>IFSC Code:  <?php echo $print->ifsc_code; ?></p>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="ngo-infor-about">
                <h2>About NGO</h2>
                <?php echo $print->about_org; ?>
            </div>
              <div class="ngo-infor-about">
                <h2>About Vision</h2>
                <?php echo $print->ngo_vision; ?>
            </div>
            <div class="ngo-infor-about">
                <h2>About Mission</h2>
                <?php echo $print->ngo_mission ?>
            </div>
            <div class="ngo-infor-about">
                <h2>Success Story</h2>
                <?php echo $print->ngo_story; ?>
            </div>
        </div>
    </div>
      <?php
    }
  }



  // Thank you page call.
 function tbs_thankyou_page(){
    ?>
      <div id="th_wrapper" >
        <h1 class="th_h1">
          Thank you!
        </h1><br>
        <h3 class="th_subhead">
          <?php
             $_narrative_msg = get_user_meta( get_current_user_id(), '_narrative_msg', true );

             ?>
             <h2>Notice</h2>
             <p><?php echo $_narrative_msg;  ?></p>
             <?php
          ?>
        Our Team is in a process of reviewing your documents, If found appropriate, we will send you a confirmation mail.
        </h3>

      </div>
   <?php
   // Mail to admin for cross check.
     $emails = get_option('admin_email');
     $title = wp_strip_all_tags(get_the_title($post->ID));
     $url = get_permalink($post->ID);
     $message = "Link to post: \n{$url}";
     $headers = 'From: My Name <no-reply@indiadonates.in>' . "\r\n";

    wp_mail($emails, "Please check the ngo form second.: {$title}", $message , $headers);
  }
  //functin for ngos profiles rejections.
  function tbs_profiles_rejet(){
    ?>
    <div>
      <h1 class="stamp-text rej_head">Rejected</h1>
      <center><h1>Please contact to the admin for more informations</h1></center>
    </div>

    <?php

  }

  /*Added style and scripts here*/
add_action('admin_print_scripts', 'tbs_admin_common_scripts');
function tbs_admin_common_scripts() {

  //wp_deregister_script('jquery');
  //wp_enqueue_script( 'sfd-jquery','https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js' );
  wp_enqueue_media();
  wp_enqueue_script( 'tbs-custom-script',  plugins_url( 'ngo-profile' ).'/js/mu_form.js' );
  wp_enqueue_script( 'tbs-custom-script-upload',  plugins_url( 'ngo-profile' ).'/js/custom-admin.js' );

  wp_enqueue_script( 'tbs-mu-script','https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js' );
  //wp_enqueue_script('tbs-bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
  wp_enqueue_script( 'tbs-custom-mu-validation','https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js' );
  wp_enqueue_script('tiney-editor', 'https://cloud.tinymce.com/stable/tinymce.min.js');

  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if( admin_url('/admin.php?page=ngo_profile_form') == $actual_link ) {
    wp_enqueue_script('tbs-bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
    wp_enqueue_script('boot-grid', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.js');

  }
}

//Registera the stylesheet for a admin section.
add_action('admin_print_styles', 'tbs_common_admin_styles');

function tbs_common_admin_styles() {
  wp_register_style('tbs-theme-admin-styles', plugins_url( 'ngo-profile' ).'/css/custom-admin.css', array(), '1.0.0', 'all');
  wp_enqueue_style('tbs-theme-admin-styles');

  wp_register_style('tbs-theme-profile-styles','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
  wp_enqueue_style('tbs-theme-profile-styles');
  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if( admin_url('/admin.php?page=ngo_profile_form') == $actual_link ) {
      wp_enqueue_style('tbs-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
      wp_enqueue_style('front-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
      wp_enqueue_style('boot-gridstyles','https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.css');

  }

}

add_action("wp_ajax_ajdata","ajdata");
add_action( 'wp_ajax_nopriv_ajdata', 'ajdata' );

add_action("wp_ajax_select_cityf2","select_cityf2");
add_action( 'wp_ajax_nopriv_select_cityf2', 'select_cityf2' );

function ajdata(){

$admin_email = get_option( 'admin_email' );
$msg_data=$_POST['txtNarative'];
$ngoEmail=$_POST['ngoEmail'];
$txtUserID=$_POST['txtUserID'];
add_user_meta( $txtUserID, '_narrative_msg', $msg_data);
global $wpdb;
$wpdb->update(
	'wp_ngo_profile',
	array(
		'ngo_done' =>0	// string

	),
	array( 'nguser_id' => $txtUserID ),


);




$body = file_get_contents(plugin_dir_url( __FILE__ ) . 'email/email.php');
$body = str_replace('{{--msgData--}}', $msg_data, $body);
$subject = 'Form Re-submit Subject TESTing';

$headers = array('Content-Type: text/html; charset=UTF-8');
$multiple_recipients = array(
          $ngoEmail,

      );
   wp_mail( $multiple_recipients, $subject, $body, $headers );

exit(0);

  die;
}

function select_cityf2(){

    $state_id       = $_POST['state_id'];
    global $wpdb;
     $results_city_f2 = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}state_city WHERE parent_id = {$state_id}", OBJECT );

    $result = '<option>Select City</option>';
    foreach( $results_city_f2 as $city_f2) {
         $result .= '<option id="'.$city_f2->id.'" parent_id="'.$city_f2->parent_id.'">'.$city_f2->name.'</option>';

    }
    echo $result;
}
 function tbs_create_ngo_pages_on_success(){
  //Fetch the NGO data and print it to pages.
        $user_id = $_GET['nid'];
        global $wpdb;
        $table_name = "wp_ngo_profile";
        $result = $wpdb->get_results( " SELECT * FROM $table_name WHERE  nguser_id= '$user_id' ");
        foreach( $result as $print ){

          $about_ng = $print->about_org;
          $ngo_misson = $print->ngo_mission;
          $ngo_visio = $print->ngo_vision;
          $ngo_success = $print->ngo_story;

          $contact_add = $print->reg_add;
          $contact_email = $print->email_id;
          $contact_phone = $print->mobile_n;
          $contact_city = $print->city;
          $contact_state = $print->state;
          $contact_picode = $print->pin_number;
          $contact_landline = $print->cp_landline;
          $org_name = $print->org_name;


          $annual_report = $print->ngo_annul_report;
          $bord_member = $print->ngo_board_member;
          $audit_finacne_details = $print->audited_finance_doc;
          //legal
          $regis_trust_no = $print->trust;
          $regis_soci_no = $print->socity_reg_number;
          $dob_trust_res = date( 'd-m-Y', strtotime( $print->trust_dor ));
          if ( $print->trust_dor == '' ){
            $dob_trust_res_show =  'Not Provided';
          } else{
            $dob_trust_res_show =  date('m-d-Y', strtotime( $print->trust_dor));
          }

          //$dob_soc_res = date( 'd-m-Y', strtotime( $print->socity_date_of_reg ));
          if (  $print->socity_date_of_reg == '' ){
            $dob_soc_res_show = 'Not Provided';
          } else{
            $dob_soc_res_show =  date('m-d-Y', strtotime( $print->socity_date_of_reg));
          }


          $org_socity_doc = $print->socity_doc;
          $org_trust_doc = $print->trust_doc;
          if( $org_trust_doc == "" && $org_socity_doc == "" ){
            $doc_org_view = "<td data-label='Period'>Not Provided</td>";
            }else{
            $doc_org_view = "<td data-label='Period'><a href ='$org_trust_doc $org_socity_doc' target='_blank'>View</a></td>";
           }


          $section_eig_num = $print->secton_eig_reg_number;
          $section_dor = date( 'd-m-Y', strtotime( $print->section_eig_date_of_reg ));
          if ( $print->section_eig_date_of_reg == '' ){
            $section_dor_show =  'Not Provided';
          } else{
            $section_dor_show =  date('m-d-Y', strtotime( $print->section_eig_date_of_reg));
          }

          $section_doc = $print->section_eig_doc;
          if( $section_doc == "" ){
            $section_doc_view = "<td data-label='Period'>Not Provided</td>";
          }else{
            $section_doc_view = "<td data-label='Period'><a href ='$section_doc' target='_blank' >View</a></td>";
          }

          $pan_number = $print->ngo_pan_reg_no;
          $pan_dor = date( 'd-m-Y', strtotime( $print->ngo_pan_reg_date ));
          if ( $print->ngo_pan_reg_date == '' ){
            $pan_dor_show = 'Not Provided';
          } else{
            $pan_dor_show =  date('m-d-Y', strtotime( $print->ngo_pan_reg_date));
          }

          $pan_doc = $print->ngo_pan_doc;
          if( $pan_doc == "" ){
            $pan_doc_view = "<td data-label='Period'>Not Provided</td>";
          }else{
            $pan_doc_view = "<td data-label='Period'><a href ='$pan_doc' target='_blank'>View</a></td>";
          }

          $tan_number = $print->ngo_tan_reg_no;
          $tan_dor = date( 'd-m-Y', strtotime( $print->ngo_tan_reg_date ));
          if ( $print->ngo_tan_reg_date == '' ){
            $tan_dor_show = 'Not Provided';
          } else{
            $tan_dor_show =  date('m-d-Y', strtotime( $print->ngo_tan_reg_date ));
          }

          $tan_doc = $print->ngo_tan_doc;
          if( $tan_doc == "" ){
            $tan_doc_view = "<td data-label='Period'>Not Provided</td>";
          }else{
            $tan_doc_view = "<td data-label='Period'><a href ='$tan_doc' target='_blank'>View</a></td>";
          }

          //certificate
          $crt_twl_a = $print->secton_tlv_reg_number;
          $crt_twl_dor = date( 'd-m-Y', strtotime( $print->section_tlv_date_of_reg ));
          if ( $print->section_tlv_date_of_reg == '' ){
            $crt_twl_dor_show = 'Not Provided';
          } else{
            $crt_twl_dor_show =  date('m-d-Y', strtotime( $print->section_tlv_date_of_reg ));
          }

          $crt_twl_a_doc = $print->section_tlv_doc;
          if( $crt_twl_a_doc == "" ){
            $crt_twl_a_doc_view = "<td data-label='Period'>Not Provided</td>";
          }else{
            $crt_twl_a_doc_view = "<td data-label='Period'><a href ='$crt_twl_a_doc' target='_blank'>View</a></td>";
          }

          $ctr_80g = $print->g_eighty_number;
          $ctr_80g_dor = date( 'd-m-Y', strtotime( $print->g_eighty_dor ));
          if ( $print->g_eighty_dor == '' ){
            $$ctr_80g_dor_show = 'Not Provided';
          } else{
           $$ctr_80g_dor_show =  date('m-d-Y', strtotime( $print->g_eighty_dor ));
          }

          $ctr_80g_doc = $print->g_eighty_doc;
          if( $ctr_80g_doc == "" ){
            $ctr_80g_doc_view = "<td data-label='Period'>Not Provided</td>";
          }else{
            $ctr_80g_doc_view = "<td data-label='Period'><a href ='$ctr_80g_doc' target='_blank'>View</a></td>";
          }


          $ctr_fcra = $print->secton_fcra_reg_number;
          $ctr_fcra_dor = date( 'd-m-Y', strtotime( $print->section_fcra_date_of_reg ));
          if ( $print->section_fcra_date_of_reg == '' ){
            $ctr_fcra_dor_show = 'Not Provided';
                       } else{
                        $ctr_fcra_dor_show =  date('m-d-Y', strtotime( $print->section_fcra_date_of_reg ));
                       }
          $ctr_fcra_doc = $print->section_fcra_doc;
          if( $ctr_fcra_doc == "" ){
            $ctr_fcra_doc_view = "<td data-label='Period'>Not Provided</td>";
          }else{
            $ctr_fcra_doc_view = "<td data-label='Period'><a href ='$ctr_fcra_doc' target='_blank'>View</a></td>";
          }

   //Create posts on registartion.
      // Create a new post
            $user_id = $_GET['nid'];
            $contact_content = "<h1 class='h1_custom_temp'>About the Organization</h1><hr style='border: 2px solid #f58634;'>
            <div class='two_parts_temp'>
                <div class='part1_custom_temp'>
                    <div class='about_reg'>
                        <div class='fin_dls'>
                            <div class=''>
                                    $about_ng
                            </div>
                            <div class='fin_dls_inner'>
                                <h4>Vision</h4>
                                  $ngo_visio
                            </div>

                            <div class='fin_dls_inner'>
                                <h4>Mission</h4>
                                  $ngo_misson
                            </div>
                        </div>
                    </div>
                </div>
            </div>";

            //NGO Registration details contents
            $ngo_registration_details = "<h1 class='h1_custom_temp'>Registration Details</h1><hr style='border: 2px solid #f58634;'>
            <table>
              <caption><b>Legal Details</b></caption>
              <thead>
                <tr style='background-color: #f58735;color: white;'>
                  <th scope='col'>Name</th>
                  <th scope='col'>Registration Number</th>
                  <th scope='col'>Date of Registration</th>
                  <th scope='col'>View</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td data-label='Account'>Trust/Society</td>
                  <td data-label='Due Date'>$regis_trust_no / $regis_soci_no </td>
                  <td data-label='Amount'>$dob_trust_res_show / $dob_soc_res_show </td>
                  $doc_org_view
                </tr>
                <tr>
                  <td scope='row' data-label='Account'>Section 8</td>
                  <td data-label='Due Date'>$section_eig_num</td>
                  <td data-label='Amount'>$section_dor_show</td>
                  $section_doc_view
                </tr>
                <tr>
                  <td scope='row' data-label='Account'>PAN</td>
                  <td data-label='Due Date'>$pan_number</td>
                  <td data-label='Amount'>$pan_dor_show</td>
                  $pan_doc_view
                </tr>
                <tr>
                  <td scope='row' data-label='Acount'>TAN</td>
                  <td data-label='Due Date'>$tan_number</td>
                  <td data-label='Amount'>$tan_dor_show</td>
                  $tan_doc_view
                </tr>
              </tbody>
            </table>
            <table>
              <caption><b>Certificate Details</b></caption>
              <thead>
                <tr style='background-color: #f58735;color: white;'>
                  <th scope='col'>Name</th>
                  <th scope='col'>Registration Number</th>
                  <th scope='col'>Date of Registration</th>
                  <th scope='col'>View</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td data-label='Account'>12A</td>
                  <td data-label='Due Date'>$crt_twl_a</td>
                  <td data-label='Amount'>$crt_twl_dor_show</td>
                  $crt_twl_a_doc_view
                </tr>
                <tr>
                  <td scope='row' data-label='Account'>80G</td>
                  <td data-label='Due Date'>$ctr_80g</td>
                  <td data-label='Amount'>$ctr_80g_dor_show</td>
                  $ctr_80g_doc_view
                </tr>
                <tr>
                  <td scope='row' data-label='Account'>FCRA</td>
                  <td data-label='Due Date'>$ctr_fcra</td>
                  <td data-label='Amount'>$ctr_fcra_dor_show</td>
                  $ctr_fcra_doc_view
                </tr>
              </tbody>
            </table>";

            //Audit financial details contents
            $audit_financail_details = "<h1 class='h1_custom_temp'>Audited Financial Statement</h1><hr style='border: 2px solid #f58634;'>
                <div class='two_parts_temp'>
                    <div class='part1_custom_temp'>
                        <div class='about_reg'>
                            <div class='fin_dls'>
                                <div class='fin_dls_inner'>
                                    <h4>Click on the link below to access the Audited Financial Statement of the NGO</h4>
                                    <a href='$audit_finacne_details' download='newname' target='_blank' class='buttonDownload'>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";

                //Latest Annula Report content
                $annula_report = "<h1 class='h1_custom_temp'>Latest Annual Report</h1><hr style='border: 2px solid #f58634;'>
                <div class='two_parts_temp'>
                    <div class='part1_custom_temp'>
                        <div class='about_reg'>
                            <div class='fin_dls'>
                                <div class='fin_dls_inner'>
                                    <h4>Click on the link below to access the Latest Annual Report of the NGO</h4>
                                    <a href='$annual_report' download='newname' target='_blank' class='buttonDownload'>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";

                //Borad menber details
                $borad_member_details =  "<h1 class='h1_custom_temp'>Board Member Details</h1><hr style='border: 2px solid #f58634;'>
                <div class='two_parts_temp'>
                    <div class='part1_custom_temp'>
                        <div class='about_reg'>
                            <div class='fin_dls'>
                                <div class='fin_dls_inner'>
                                    <h4>Click on the link below to access the Board Member Details of the NGO</h4>
                                    <a href='$bord_member' download='newname' target='_blank' class='buttonDownload'>Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";

                //contact details contents
                $ngo_contact_details = "<h1 class='h1_custom_temp'>Contact</h1><hr style='border: 2px solid #f58634;'>
                <div class='contact_details_sec2'>
                <div class='ngo_add_details'>
                    <div class='address'>
                        <ul>
                        <span><strong><i class='fa fa-map-marker'></i></strong></span>
                              <li><strong>Address:</strong><br/>
                                $org_name<br>
                                $contact_add<br />
                                $contact_city<br />
                                $contact_state $contact_picode.
                            </li>
                        </ul>
                    </div>
                    <div class='contact_mob_em'>
                        <ul>
                          <span><strong><i class='fa fa-phone'></i></strong></span>
                           <li><strong>Contact No.:</strong> <br /><a href='tel:$contact_phone'>$contact_phone</a></li>
                           <li><strong>Landline No:</strong> <a href='tel:$contact_landline'>$contact_landline</a></li>
                        </ul>
                    </div>
                    <div class='contactngo_mail'>
                      <ul>
                        <span><strong><i class='fa fa-envelope-open'></i></strong></span>
                        <li><strong>Email Id:</strong> <br /><a href='mailto:$contact_email'>$contact_email</a></li>
                      </ul>
                    </div>
                </div>
            </div>";

            //NGO Success Story contents
            $ngo_success_story = "<div id='inner-content' class='inner-content-wrap'>
                                    <h1 class='h1_custom_temp' style='text-align: center;'>Success Story</h1><hr style='border: 2px solid #f58634;width: 230px;'>
                                    $ngo_success
                                  </div>";

            }

                $user_post = array(
                    'post_title'   => 'NGO Profile',
                    'post_content' => $contact_content,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post( $user_post );

                $user_post_about_ngo = array(
                    'post_title'   => 'About the Organization',
                    'post_content' => $contact_content,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post( $user_post_about_ngo );

                $user_post_reg_ngo = array(
                    'post_title'   => 'Registration Details',
                    'post_content' => $ngo_registration_details,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post( $user_post_reg_ngo );

                $user_post_success_ngo = array(
                    'post_title'   => 'Success Story',
                    'post_content' => $ngo_success_story,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post( $user_post_success_ngo );

                $user_post_contact_ngo = array(
                    'post_title'   => 'Contact',
                    'post_content' => $ngo_contact_details,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post( $user_post_contact_ngo );

                $user_post_finance_ngo = array(
                    'post_title'   => 'Audited Financial Statement',
                    'post_content' =>  $audit_financail_details,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                 $post_id = wp_insert_post( $user_post_finance_ngo );

                /*$user_post_governance_ngo = array(
                    'post_title'   => 'Governance',
                    'post_content' => '',
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post( $user_post_governance_ngo ); */

                $user_post_annual_ngo = array(
                    'post_title'   => 'Latest Annual Report',
                    'post_content' => $annula_report,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post(  $user_post_annual_ngo );

                $user_post_name_of_board_ngo = array(
                    'post_title'   => 'Board Member Details',
                    'post_content' =>  $borad_member_details,
                    'post_status'  => 'publish',
                    'post_author' => $user_id,
                    'post_type'    => 'ngospage',
                );
                // Insert the post into the database
                $post_id = wp_insert_post( $user_post_name_of_board_ngo );
        } if($_GET['nid']) { ?>


		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Narrative</h4>
        </div>
        <div class="modal-body">

	<textarea class="form-control" rows="5" id="txtNarative" name="msgdata" Placeholder="" required></textarea><br/>
	<input type="button" name="subb" id="btnSendMail" value="Submit"class="btn" >

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


  <?php } ?>
