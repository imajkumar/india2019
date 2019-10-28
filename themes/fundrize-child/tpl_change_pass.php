<?php
get_header();
// Template Name: Change Password n
// if(!is_user_logged_in()){
          // wp_redirect(home_url());
// }

//echo $saltkey = get_user_meta('323', 'salltddata', true );

  //$check_mail = get_user_meta( '323' );
	 // echo '<pre>'; print_r($check_mail); echo '</pre>';
if(isset($_GET['daata'])){

	//echo $_GET['d1'];	
	 $saltkey = get_user_meta($_GET['d1'], 'salltddata', true );
	if($_GET['daata'] == $saltkey) { 

if(isset($_POST['current_password'])){
          $_POST = array_map('stripslashes_deep', $_POST);
          $current_password = sanitize_text_field($_POST['current_password']);
          $new_password = sanitize_text_field($_POST['new_password']);
          $confirm_new_password = sanitize_text_field($_POST['confirm_new_password']);
         // $user_id = get_current_user_id();
		 $user_id = $_POST['usriid'];
          $errors = array();
          $current_user = get_user_by('id', $user_id);
		  
if (empty($current_password) && empty($new_password) && empty($confirm_new_password) ) {
$errors[] = 'All fields are required';
}
if($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)){
//match
} else {
    $errors[] = 'Password is incorrect';
}
if($new_password != $confirm_new_password){
    $errors[] = 'Password does not match';
}
if(strlen($new_password) < 6){
    $errors[] = 'Password is too short, minimum of 6 characters';
}
	if(empty($errors)){
    wp_set_password( $new_password, $current_user->ID );
    echo '<h2>Password successfully changed!</h2>';
} else {
    // Echo Errors
    echo '<h3>Errors:</h3>';
    foreach($errors as $error){
        echo '<p>';
        echo "<strong>$error</strong>";
        echo '</p>';
    }
}	  
		  
		  
    }
?>

<div style="margin:0px auto;" class="mu_register wp-signup-container" >
 <form action="" method="post" id="msform"  class="charitable-form">
 <input type="hidden" name="usriid" value="<?php echo $_GET['d1']; ?>"> 
            <div class="marginb"><label for="current_password">Enter your current password:</label></div>
           <div class="marginb"> <input id="current_password" type="password" name="current_password" title="current_password" placeholder="" required></div>
            <div class="marginb"><label for="new_password">New password:</label></div>
           <div class="marginb"> <input id="new_password" type="password" name="new_password" title="new_password" placeholder="" required></div>
           <div class="marginb"> <label for="confirm_new_password">Confirm new password:</label></div>
            <div class="marginb"><input id="confirm_new_password" type="password" name="confirm_new_password" title="confirm_new_password" placeholder="" required></div>
           <input type="submit" value="Change Password" class="submit action-button" >
        </form>
		</div>
		
		<style>
		.marginb {
    margin-bottom: 8px;
    margin-left: 0px;
    width: 50% !important;
    text-align: left;
    padding-left: 20px;
}
#msform .action-button {
    width: 200px !important;
    background: #518c51;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 1px;
    cursor: pointer;
    padding: 10px 5px;
    ma
		</style>
		
		
	<?php 
	}else{
		
		echo '<h2 style="text-align:center;margin:00px auto;">Trying to acess wrong Page</h2>';
	}
	
	}else{
		
		
		echo '<h2  style="text-align:center;margin:00px auto;">Trying to acess wrong Page</h2>';
	}
		get_footer();
		?>