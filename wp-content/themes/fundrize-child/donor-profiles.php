<?php /* Template Name: Doner Profile Page */ ?>

<?php get_header(); ?>
<?php

    if( !is_user_logged_in() ){?>
   <center> <h3>Please login to see your donor profile.</h3>
   <a href="../wp-login.php"><b>Login</b></a>
   </center>
    <?php
    }else{

    
    $user_id = get_current_user_id();
    $user_meta=get_userdata($user_id); 
    $user_roles=$user_meta->roles; 
    //print_r($user_roles);
    if( is_user_logged_in() && in_array("administrator", $user_roles )){?>
        <center><p class="profile-dashboard-link"><b>Goto the<a href="<?php echo admin_url(); ?>"> admindashboard</a></b></p></center>
    <?php
    }
    else{

        $user_id = get_current_user_id();
        $user_info = get_userdata( $user_id );
        $donor_mail = $user_info->user_email;
        $donor_info = get_user_meta( $user_id  );
       // print_r( $donor_info );
        $donor_title = get_user_meta( $user_id , 'user_title', true );
        $donor_first_name = get_user_meta( $user_id , 'first_name', true );
        $donor_last_name = get_user_meta( $user_id, 'last_name' , true );
        $donor_phone_number = get_user_meta ( $user_id, 'user_phone' , true );
        $donor_pin = get_user_meta( $user_id, 'user_pin', true );
        $donor_address = get_user_meta( $user_id, 'user_reg_add', true );
        $donor_country = get_user_meta( $user_id, 'user_country', true );
        $donor_dob = get_user_meta( $user_id , 'user_dob', true );
        $donor_about = get_user_meta( $user_id, 'user_about' ,true );
        $donor_desig = get_user_meta ( $user_id, 'user_desig', true );
        $donor_show_public = get_user_meta( $user_id, 'user_show', true );
        $donor_profile_img = get_user_meta( $user_id, 'user_profile_img', true); 
        $donor_full_name = $donor_title." " .$donor_first_name." " .$donor_last_name;
        //echo $donor_full_name;
        //Update for donor.
        if ( isset( $_POST['donor_update'] ) ){
            $get_donor_email = $_POST['donor_email'];
            $get_donor_phone = $_POST['donor_phone'];
            $get_donor_pin = $_POST['donor_pin'];
            $get_donor_address = $_POST['donor_add'];
            $get_donor_country = $_POST['donor_country'];
            $get_donr_dob = $_POST['donor_dob'];
            $get_donor_designation = $_POST['donor_desig'];
            $get_donor_about = $_POST['donor_about'];
            $get_donor_show_public = $_POST['show_public'];

            //update donor meta
            update_user_meta( $user_id, 'user_country', $get_donor_country );
            update_user_meta( $user_id, 'user_desig', $get_donor_designation );
            update_user_meta( $user_id, 'user_dob', $get_donr_dob );
            update_user_meta( $user_id, 'user_reg_add', $get_donor_address );
            update_user_meta( $user_id, 'user_pin', $get_donor_pin );
            update_user_meta( $user_id, 'user_phone', $get_donor_phone );
            update_user_meta( $user_id, 'user_about', $get_donor_about );
            update_user_meta( $user_id, 'user_show', $get_donor_show_public );
        }

        //User Profile image upload.
       // Check that the nonce is valid, and the user can edit this post.
            if ( isset( $_POST['my_image_upload_nonce'], $_POST['user_id'] ) 
                    && wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
                ) {
                    // The nonce was valid and the user has the capabilities, it is safe to continue.

                    // These files need to be included as dependencies when on the front end.
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    require_once( ABSPATH . 'wp-admin/includes/media.php' );
                    
                    // Let WordPress handle the upload.
                    // Remember, 'my_image_upload' is the name of our file input in our form above.
                    $attachment_id = media_handle_upload( 'my_image_upload', $_POST['user_id'] );
                    $user_profile_img = wp_get_attachment_thumb_url( $attachment_id );
                    $check_for_test = $_POST['profile_img'];
                    update_user_meta(  $user_id, 'user_profile_img', $user_profile_img );
                    
                    if ( is_wp_error( $attachment_id ) ) {
                        echo "There was an error uploading the image.";
                    } else {
                        //echo  "The image was uploaded successfully!";
                    }

                } else {

                    // The security check failed, maybe show the user an error.
                }               
                
        ?>

		
		<div class="donr-outer-div">
			<center><h2 class="donr-head"><?php echo $donor_full_name; ?></h2></center>
		<div class="donr-uprdiv"><hr style="border: 2px solid #518c51;"></div>
			<div class="donr-outer-ldiv">
				<div>
                <?php

                ?>
					<center>
                    <form id="featured_upload" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
                        <div class="">
                            <!-- User Profile Image -->
                            <?php
                            if ( $donor_profile_img == "" ){
                                ?>
                                <img class="donr-outer-proimg" src="http://indiadonates.in/indiadonates/wp-content/uploads/2019/01/dummy-profile-pic-300x300.jpg" alt="Oops">
                                <?php
                            }
                            ?>
                            <img class="profile-pic donr-outer-proimg" src="<?php echo $donor_profile_img; ?>">

                        <!-- Default Image -->
                        </div>
                        <div class="user-profile-image">
                            <i class="fa fa-camera upload-button"></i>
                            <input type="hidden" name="profile_img" value="<?php echo $user_profile_img; ?>"/>
                            <input class="user-file-upload" name="my_image_upload" id="my_image_upload" type="file"  multiple="false"/></br>  
                            <input type="hidden" name="user_id" id="user_id" value="<?php get_current_user_id(); ?>" />
                            <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?> 
                            <input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Save" style="display:none;" />
                        </div>
                
                    </form>
					<h6><?php echo $donor_mail ?> </h6>
					</center>
                </div>
                <div style="text-align:center;">
                    <h4 style="font-weight: bold;">Star Collected</h4>
                    <div class="rating-star">
                        <fieldset class="rating-star rating-star-fieldset" style="position: relative; left: 0;">
                            <input type="checkbox" id="star5" class="rating-star-checkbox" value="5">
                            <label class="full" for="star5" title="Great" style="color:#999;"></label>
                            <input type="checkbox" id="star4half" class="rating-star-checkbox" value="4.5">
                            <label class="half" for="star4half" title="Great - 4.5 stars" style="color:#999;"></label>
                            <input type="checkbox" id="star4" class="rating-star-checkbox" value="4">
                            <label class="full" for="star4" title="Good"></label>
                            <input type="checkbox" id="star3half" class="rating-star-checkbox" value="3.5">
                            <label class="half" for="star3half" title="Good - 3.5 stars"></label>
                            <input type="checkbox" id="star3" class="rating-star-checkbox" value="3">
                            <label class="full" for="star3" title="Average"></label>
                            <input type="checkbox" id="star2half" class="rating-star-checkbox" value="2.5">
                            <label class="half" for="star2half" title="Average - 2.5 stars"></label>
                            <input type="checkbox" id="star2" class="rating-star-checkbox" value="2">
                            <label class="full" for="star2" title="Not Good"></label>
                            <input type="checkbox" id="star1half" class="rating-star-checkbox" value="1.5">
                            <label class="half" for="star1half" title="Not Good - 1.5 stars"></label>
                            <input type="checkbox" id="star1" class="rating-star-checkbox" value="1">
                            <label class="full" for="star1" title="Poor"></label>
                            <input type="checkbox" id="starhalf" class="rating-star-checkbox" value="0.5">
                            <label class="half" for="starhalf" title="Poor - 0.5 stars"></label>
                        </fieldset>
                    </div>
                </div>
			</div>
			<div class="donr-outer-rdiv">
				<div class="tabset-lxa">
  <!-- Tab 1 -->
  <input type="radio" name="tabset-lxa" id="tab1" aria-controls="marzen-lx" checked style="display: none;">
  <label for="tab1" style="border-left: transparent;">My Profile</label>
  <!-- Tab 2 -->
  <input type="radio" name="tabset-lxa" id="tab2" aria-controls="Description" style="display: none;">
  <label for="tab2">My Giving Page</label>
  <!-- Tab 3 -->
  <input type="radio" name="tabset-lxa" id="tab3" aria-controls="dunkles" style="display: none;">
  <label for="tab3">Reminder Details</label>
  <!-- Tab 4 -->
  <input type="radio" name="tabset-lxa" id="tab4" aria-controls="donat" style="display: none;">
  <label for="tab4">Donation History</label>
  <!-- Tab 5 -->
  <input type="radio" name="tabset-lxa" class="donor-profile-tab" id="tab5" aria-controls="donate" style="display: none;">
  <label for="tab5" class="donor-profile-tab">Favourite Donation Options</label>
  
  <div class="tab-panellxslx">
    <section id="marzen-lx" class="tab-panellx">
    <center> <h5 class="donation-pages-list-heading">Your Profile Details</h5> </center> 
      <form class="form-donr-pro" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
      	<div class="form-donr-prodiv">
      		<input type="text" name="donor_name" class="" placeholder="Name" value="<?php echo $donor_full_name; ?>" readonly />
      		<input type="email" name="donor_mail" class="" placeholder="Email" value="<?php echo $donor_mail ?>" readonly />
      	</div>
      	<div class="form-donr-prodiv">
      		<input type="text" name="donor_phone" class="" placeholder="Phone Number" value="<?php echo $donor_phone_number; ?>"  />
      		<input type="text" name="donor_pin" class="" placeholder="PAN Number" value="<?php echo $donor_pin; ?>" />
      	</div>

      	<div class="form-donr-prodiv"><input type="text" name="donor_add" class="" placeholder="Address" value="<?php echo $donor_address; ?>"  />
      	<input type="text" name="donor_country" class="" placeholder="Country" value="<?php echo $donor_country; ?>" /></div>

      	<div class="form-donr-prodiv"><input type="text" name="donor_dob" class="" placeholder="Date of birth" value="<?php echo $donor_dob; ?>" />
      	<input type="text" name="donor_desig" class="" placeholder="Designation" value="<?php echo $donor_desig; ?>" />
      	</div>
      	<textarea minlength="2" maxlength="400" name="donor_about" value="donor_about" placeholder="About your-self" style="width: 90.5%;" value=""><?php echo $donor_about; ?></textarea><br>
      	<input type="checkbox" name="show_public" value="yes" <?php if( $donor_show_public == 'yes') echo 'checked="checked"';?>> Do you want to show your profile publically<br>
      	<center>
      	<button type="submit" id="btn-tab-donr" name="donor_update">Update</button></center>
      </form>
      
  </section>
    <section id="Description" class="tab-panellx">
    <?php
    $table_name_page = "wp_charitable_campaign_donations";
    $table_name_donor = "wp_charitable_donors";
    $donor_user_id = get_current_user_id();
    $donor_result = $wpdb->get_results( " SELECT * FROM  $table_name_donor where user_id = $donor_user_id ");
    foreach( $donor_result as $donor_number ){
       $donor_id = $donor_number->donor_id;
    } 
    $giving_page = $wpdb->get_results( " SELECT * FROM $table_name_page where donor_id = $donor_id " );
    //print_r( $giving_page );
    ?>
    <center> <h5 class="donation-pages-list-heading">Donation Giving pages </h5> </center>
    <table class="charitable-my-donations charitable-table">
		<thead>
			<tr>
                <th scope="col">Project ID</th>
				<th colspan="3" style="text-align:center;" scope="col">Project Name</th>
			</tr>
		</thead>
		<tbody>
     <?php
    foreach( $giving_page as $name_of_giving_page ){
        //print_r( $name_of_giving_page );
        $donor_page_name = $name_of_giving_page->campaign_name;
        $donor_page_id = $name_of_giving_page->campaign_id;
        ?>
         <tr>
            <td><?php echo $donor_page_id; ?></td>
            <td colspan="3"><?php echo $donor_page_name; ?></td>
         </tr>
        <?php
    }
    ?>
    </tbody>
	</table>
    <?php

    ?>
    </section>
    <section id="dunkles" class="tab-panellx">
    <center> <h5 class="donation-pages-list-heading">Your Reminder Details</h5> </center>
      
    </section>

    <section id="donat" class="tab-panellx">
    <center> <h5 class="donation-pages-list-heading">Your Donation History </h5> </center>
      <?php
      echo do_shortcode('[charitable_my_donations]');
      ?>
    </section>
  <section id="donate" class="tab-panellx">
  <center> <h5 class="donation-pages-list-heading">Your Favourite Donation Options </h5> </center>
  <?php
    $curnt_user = get_current_user_id();
    $is_fav_meta = get_user_meta( $curnt_user, 'is_favourite' );
    ?>
    <div class="fav-main-div">
    <?php
    foreach( $is_fav_meta as $fav_page  ){
          $page_title = $fav_page['page_title'];
          $img_url = $fav_page['image_url'];
          $page_link = $fav_page['page_url'];
         ?> 
         <div class="fav-card">
                <img src="<?php echo $img_url; ?>" alt="Feature Image" style="width:100%">
                <div class="fav-container">
                    <h4><b><a href="<?php echo $page_link ; ?>" class="fav-page-heading"><?php echo $page_title; ?></a></b></h4> 
                    <h4 class="fav-more-button"><a class="" href="<?php echo $page_link ; ?>">DONATE</a></h4>
                </div>
            </div>
         <?php
    }
  ?>
  </div>
</section>
  </div> 
</div>
				
		</div>

</div>
    <?php } 
    } ?>
<?php get_footer(); ?>