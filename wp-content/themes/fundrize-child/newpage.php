<?php /* Template Name: Landing Page NGO */ ?>

<?php get_header(); ?>
 
<div id="signup-content" class="widecolumn">
                <div class="mu_register wp-signup-container">
                    <h2>Congratulation <?php echo $user_full_name;?>!!</h2>
                    <p>You have successfully signed up the NGO- 
                        <a href="<?php echo home_url().'/ngo/'.$user_name;?>"><?php echo $org_name;?></a>. <br/>Please find the below credentials and login to the system to fill the form 2 to activate the NGO. </p>
                    <p><b>Username:</b> <?php echo $user_name; ?><br/>
                    <b>Password:</b> <?php echo $random_password; ?></p>
                </div>
            </div>


<?php get_footer(); ?>