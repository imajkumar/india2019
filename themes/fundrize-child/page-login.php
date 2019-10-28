<?php get_header(); 
    $specific_page_name =  basename($_SERVER['REQUEST_URI']);
    get_template_part( 'content', 'login' );
	?>
    <div id="content-wrap" class="wprt-container <?php echo $specific_page_name;?>">
        <div id="site-content" class="site-content clearfix ">
        	<div id="inner-content" class="inner-content-wrap">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'page-content' ); ?>>
					<?php
                    the_content();
                    if ( is_user_logged_in() ) {
                        echo "<h2> You are already login. </h2>";
                    }else{?>
                    <div class="custom-login-class">                      
                        <div class="popup ngo-alk-c" >                            
                            <div class="container-c">
                                <h3 class="log-heading">Login</h3>
                                <div class="login_popup">
                                    <?php //echo do_shortcode('[login-with-ajax]');?>
                                    <?php //wp_login_form( array('redirect' => home_url()) );
                                   echo  do_shortcode('[charitable_login]'); ?>
                                    <!--<div class="forget-password-div"><a href="<?php echo home_url(); ?>/login/forgot-password/"> Forgot Password</a></div>-->
                                </div>
                                <div class="login_social">                                        
                                    <?php echo do_shortcode('[nextend_social_login provider="facebook"]');?>
                                    <h3 class="or">OR</h3>
                                    <?php echo do_shortcode('[nextend_social_login provider="google"]');?>
                                    <p class="popup-signup-text">If not registered, kindly</p>
                                    <a class="popup-donor-signup" href="<?php echo home_url().'/login/'?>">SIGN UP</a>
                                </div>                                        
                            </div>                            
                        </div>
                        
                    </div>
                        
                    <?php
                    }

					?>
				</article>
			<?php endwhile; ?>
			</div>
        </div><!-- /#site-content -->
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>
