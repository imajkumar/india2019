<!DOCTYPE html>
<html <?php
language_attributes();
?> class="no-js">
<head>
    <meta charset="<?php
bloginfo('charset');
?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php
bloginfo('pingback_url');
?>">
    <link rel="stylesheet" type="text/css" href="#" title="colors">
    <?php
wp_head();
?>
</head>

<!--<body <?php //body_class('header-style-3');
?>>-->
<?php
$template_name = basename(get_page_template());
if ($template_name != "page.php") {
    echo '<body class=" header-fixed no-sidebar site-layout-full-width header-style-3 is-page no-padding-content menu-has-search menu-has-cart wpb-js-composer js-comp-ver-5.4.5 vc_responsive">';
} else {
    echo '<body class=" header-fixed right-sidebar site-layout-full-width header-style-3 is-page no-padding-content menu-has-search menu-has-cart wpb-js-composer js-comp-ver-5.4.5 vc_responsive">';
}
?>
<!--<body class=" header-fixed no-sidebar site-layout-full-width header-style-3 is-page no-padding-content menu-has-search menu-has-cart wpb-js-composer js-comp-ver-5.4.5 vc_responsive">-->
<div id="wrapper" style="<?php
echo wprt_background_css('wrapper_background_img');
?>">
    <div id="page" class="clearfix <?php
echo wprt_preloader_class();
?>">
        <div id="site-header-wrap">
            <input type="hidden" class="home_url" value="<?php
echo home_url();
?>" >
        <?php
global $blog_id;
$postid      = get_queried_object_id();
$auth        = get_post($postid); // gets author from post
$authid      = $auth->post_author;
$author_role = get_user_role($authid);
//print_r($author_role);

if (!is_author() && $author_role != 'ngo_charitable') {
?>

            <!-- Top Bar -->
            <?php
    get_template_part('templates/top');
?>

            <!-- Header -->
            <header id="site-header">
                <div id="site-header-inner" class="wprt-container">
                    <div class="wrap-inner">
                        <?php
    // Get Header logo
    get_template_part('templates/header-logo');

    // Get Header aside
    if (is_user_logged_in()) {

?><ul class="menu-profileAL ngo_page_loginbtn" style="float:right;">
                             <li>
                               <input id="check01" type="checkbox" name="menu"/>
                               <label for="check01">
                                   <?php
        $current_user = wp_get_current_user();
        $email_id     = $current_user->user_email;
        $display_name = $current_user->display_name;
        $user_profile = get_user_meta($current_user->ID, 'user_profile_img', true);
        if ($user_profile == "") {
            echo "<b style='color:#ff8313; font-family: initial;'>Welcome:</b><strong style='color:#518c51; font-family: initial; margin: 0px 15px 0px 10px;'> " . $display_name . "</strong>";
            echo get_avatar($email_id, 35);
        } else {
            echo "<b style='color:#ff8313; font-family: initial;'>Welcome:</b><strong style='color:#518c51; font-family: initial; margin: 0px 15px 0px 10px;'> " . $display_name . "</strong>";
?><img alt="" src="<?php
            echo $user_profile;
?>" srcset="" class="avatar avatar-35 photo" width="35" height="35" style="margin-left:10px;">
                                             <?php
        }
?>
                               </label>
                               <ul class="submen01">
                                 <li><a href="<?php
        echo home_url();
?>/donner-profile/">Your Profile</a></li>
                                 <li><a href="<?php
        echo wp_logout_url(home_url());
?>">Logout</a></li>
                               </ul>
                             </li>
                            </ul>

                            <?php
    } else {
        get_template_part('templates/header-aside');
    }
?>
                   </div>
                </div><!-- /#site-header-inner -->

                <?php
    // If Header is style-2,3
    get_template_part('templates/header-bottom');
?>

            </header><!-- /#site-header -->

        <?php //get_template_part( 'templates/featured-title');
?>
       <?php
} else {
?>
           <div id="top-bar" style="display:block;" class="header_2_btn_mobile">
                <div id="top-bar-inner" class="wprt-container">
                    <div class="top-bar-inner-wrap">
                        <div class="top-bar-content">
                            <a href="<?php
    echo network_site_url();
?>">
                            <img src="<?php
    echo get_stylesheet_directory_uri();
?>/images/india_donates.png"
                            width="291" height="56" alt="student charity"
                            data-retina="<?php
    echo get_stylesheet_directory_uri();
?>/images/india_donates.png" data-width="291" data-height="56" style="width: 110px; height:25px;"></a>
                        </div><!-- /.top-bar-content -->

                        <div class="mobile-button"><span></span></div>
                        <div class="top-bar-socials">
                                <?php
    if (is_user_logged_in()) {
?><ul class="menu-profileAL ngo_page_loginbtn">
                                         <li>
                                           <input id="check01" type="checkbox" name="menu"/>
                                           <label for="check01">
                                               <?php
        $current_user = wp_get_current_user();
        $email_id     = $current_user->user_email;
        $display_name = $current_user->display_name;
?>
                                              <?php
        echo get_avatar($email_id, 35);
?>
                                           </label>
                                            <!-- <svg class="jsx-165538222 dropdown-arrow-menuAL" style="right: 75px;"><path d="M0,10 20,10 10,0z" class="jsx-165538222" style="/ border-bottom: 1px solid; /fill: rgb(119, 119, 119);"></path><path d="M0,10 10,0 20,10" class="jsx-165538222" style="stroke: rgb(219, 219, 219);fill: transparent;"></path></svg> -->
                                           <ul class="submen01">
                                             <li class="sub-libor"><a href="<?php
        echo home_url();
?>/donner-profile/">Your Profile</a></li>
                                             <li><a href="<?php
        echo wp_logout_url(home_url());
?>">Logout</a></li>
                                           </ul>
                                         </li>
                                        </ul>

                                <?php
    } else {
?>
                                   <div class="ngo_page_login_btn">
                                        <a class="ngotemp_loginbtn open-popup" data-id="popup_11" data-animation="rotateCube" href="#popup_11">Log In</a>
                                    </div>
                                <?php
    }
?>
                           <div class="inner">

                                <span class="texts">Follow Us</span>
                                <span class="icons">
                                    <a href="<?php
    echo get_option('fcbk_url');
?>" title="Facebook">
                                        <span class="inf-icon-facebook" aria-hidden="true"></span>
                                        <span class="screen-reader-text">Facebook Profile</span>
                                    </a>
                                    <a href="<?php
    echo get_option('twtr_url');
?>" title="Twitter">
                                        <span class="inf-icon-twitter" aria-hidden="true"></span>
                                        <span class="screen-reader-text">Twitter Profile</span>
                                    </a>
                                    <a href="#" title="Vimeo">
                                        <span class="inf-icon-vimeo" aria-hidden="true"></span>
                                        <span class="screen-reader-text">Vimeo Profile</span>
                                    </a>
                                    <a href="<?php
    echo get_option('lkd_url');
?>" title="LinkedIn">
                                        <span class="inf-icon-linkedin" aria-hidden="true"></span>
                                        <span class="screen-reader-text">LinkedIn Profile</span>
                                    </a>
                                    <a href="#" title="Pinterest">
                                        <span class="inf-icon-pinterest" aria-hidden="true"></span>
                                        <span class="screen-reader-text">Pinterest Profile</span>
                                    </a>
                                </span>
                            </div>
                        </div><!-- /.top-bar-socials -->
                    </div>
                </div>
            </div>

            <?php
    global $wpdb;
    $postid = get_queried_object_id();
    $auth   = get_post($postid); // gets author from post
    $authid = $auth->post_author; // gets author id for the post

    /*print_r($authorid);die();*/
    $ngo    = get_user_by('slug', get_query_var('author_name'));
    //print_r ( $ngo );
    $ngo_id = $ngo->ID;
    if ($ngo_id == '') {
        $ngo_id = $authid;
    }
    //echo $ngo_id = $authid;
    $table_name = "wp_ngo_profile";
    $sta        = "";
    $ng_logo    = '';
    $result     = $wpdb->get_results("SELECT * FROM $table_name where nguser_id = '$ngo_id'");
    foreach ($result as $key) {
        //print_r($key);
        $sta     = $key->approval_status;
        $ng_logo = $key->ngo_logo;
        //echo $ng_logo;
    }
    if ($ng_logo == '') {
        $ng_logo = get_stylesheet_directory_uri() . '/images/india_donates.png';
    }
    //echo $ng_logo;
    if ($sta == "no" || $sta == "") {
?>
               <header id="site-header" class="ngo-home-nv">
                    <div class="row">
                        <div class="logo-row">
                            <a href="<?php
        echo home_url();
?>"><img src="<?php
        echo $ng_logo;
?> " alt="logo" class="logo" style="height: 70px;width: 172px;"></a>
                        </div>
                    </div>
                    <style>
                        .logo-row {
                            width: 250px;
                            margin: 0 auto;
                        }

                        .logo {
                            width: 100%;
                            height: auto;
                            text-align: center;
                        }
                        #site-header #site-header-inner {
                            left: 25%;
                            height: auto;
                        }
                    </style>
                    <div id="site-header-inner"  class="wprt-container">
                        <div class="wrap-inner">
                            <div id="header-aside" style="float: left;">
                                <div class="wprt-info" style="display:block; padding-left: 50px;">
                                    <div class="inner">
                                        <div class="info-one">
                                            <div class="info-wrap">
                                                <div class="info-i">
                                                    <span><i class="inf-icon-phone-call"></i></span>
                                                </div>
                                                <div class="info-c">
                                                    <span class="title">CALL NOW</span><br>
                                                    <span class="subtitle"><?php
        //$id = get_current_blog_id();
        //echo $id;
        $ngo_id = $ngo->ID;
        ;
        echo get_user_meta($ngo_id, 'user_phone', true);
?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-two">
                                            <div class="info-wrap">
                                                <div class="info-i">
                                                    <span><i class="inf-icon-envelope2"></i></span>
                                                </div>
                                                <div class="info-c">
                                                    <span class="title">EMAIL US</span><br>
                                                    <span class="subtitle"><?php
        echo $ngo->user_email;
        //echo get_the_author_meta( 'user_email',$ngo_id )
?> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 56px; display: none;"></div>
                </header> <?php
    } else {
?>
               <header id="site-header">
                    <div class="site-navigation-wrap">
                    <div class="wprt-container inner">

                    <nav id="main-nav" class="main-nav">
                        <ul id="menu-primary-menu" class="menu">
                            <li id="menu-item-1371" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1371">
                            <?php
        //ngo profiles.
        $profile_posttitle = 'NGO Profile';
        $profile_postid    = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $profile_posttitle . "' AND post_author = '" . $ngo_id . "'");
        //echo $profile_postid;
        $ngo_profile_link  = get_post_permalink($profile_postid);

        //About The NGO.
        $about_posttitle = 'About the Organization';
        $about_postid    = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $about_posttitle . "' AND post_author = '" . $ngo_id . "'");
        $ngo_about_link  = get_post_permalink($about_postid);

        //Registration Details.
        $regd_posttitle = 'Registration Details';
        $regd_postid    = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $regd_posttitle . "' AND post_author = '" . $ngo_id . "'");
        $ngo_regd_link  = get_post_permalink($regd_postid);



        //Contact Info .
        $contact_posttitle = 'Contact';
        $contact_postid    = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $contact_posttitle . "' AND post_author = '" . $ngo_id . "'");
        //echo $contact_postid;
        $ngo_contact_link  = get_post_permalink($contact_postid);

        //Success Story.
        $success_posttitle = 'Success Story';
        $success_postid    = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $success_posttitle . "' AND post_author = '" . $ngo_id . "'");
        //echo $success_postid;
        $ngo_success_link  = get_post_permalink($success_postid);

        //Financial Details.
        $finance_posttitle = 'Audited Financial Statement';
        $finance_postid    = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $finance_posttitle . "' AND post_author = '" . $ngo_id . "'");
        //echo $finance_postid;
        $ngo_finance_link  = get_post_permalink($finance_postid);

        //Governance.
        $governece_posttitle = 'Governance';
        $gov_postid          = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $governece_posttitle . "' AND post_author = '" . $ngo_id . "'");
        //echo $gov_postid;
        $ngo_gover_link      = get_post_permalink($gov_postid);

        //Annual Report.
        $annula_posttitle = 'Latest Annual Report';
        $annu_postid      = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $annula_posttitle . "' AND post_author = '" . $ngo_id . "'");
        //echo $annu_postid;
        $ngo_annu_link    = get_post_permalink($annu_postid);

        //Background of the board .
        $bob_posttitle = 'Board Member Details';
        $bob_postid    = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $bob_posttitle . "' AND post_author = '" . $ngo_id . "'");
        //echo $bob_postid;
        $ngo_bob_link  = get_post_permalink($bob_postid);
?>
                           <a href="<?php
        echo $ngo_profile_link;
?>">NGO Profile</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom "><a href="<?php
        echo $ngo_about_link;
?>">About the Organization</a></li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom "><a href="<?php
        echo $ngo_regd_link;
?>">Registration Details</a></li>
                                </ul>
                            </li>
                            <li id="menu-item-1371" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1371">
                                <a href="<?php
        echo $ngo_finance_link;
?>">Audited Financial Statement</a>
                            </li>
                            <li id="menu-item-1371" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1371">
                                <a href="#">Governance</a>
                                <ul class="sub-menu">
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom "><a href="<?php
        echo $ngo_annu_link;
?>">Latest Annual Report</a></li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom "><a href="<?php
        echo $ngo_bob_link;
?>">Board Member Details</a></li>
                                </ul>
                            </li>
                            <li id="menu-item-1371" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1371">
                                <a href="<?php
        echo $ngo_success_link;
?>">Success Story</a>
                            </li>
                            <li id="menu-item-1371" class="menu-item menu-item-type-post_type menu-item-1371">
                                <a href="<?php
        echo $ngo_contact_link;
?>">Contact</a>
                            </li>

                        </ul>
                    </nav>

                    <ul class="nav-extend active">
                        <li class="ext"><form role="search" method="get" action="<?php
        echo site_url();
?>" class="search-form">
                        <input type="search" class="search-field" placeholder="Search..." value="" name="s" title="Search for:">
                        <button type="submit" class="search-submit" title="Search">SEARCH</button>
                    </form>
                    </li>

                            <li class="ext"><a class="cart-info" href="<?php
        echo site_url();
?>" title="View your shopping cart">0 items <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">£</span>0.00</span></a></li>
                        </ul>
                            <div id="header-search" style="display: none;>
                            <a class="header-search-icon" href="#"><span class="inf-icon-magnifier9"></span></a>
                            <form role="search" method="get" class="header-search-form" action="<?php
        echo site_url();
?>">
                                <label class="screen-reader-text">Search for:</label>
                                <input type="text" value="" name="s" class="header-search-field" placeholder="Type and hit enter...">
                                <button type="submit" class="header-search-submit" title="Search">
                                    Search            </button>

                                <!-- <input type="hidden" name="post_type" value="product" /> -->
                                <input type="hidden" name="post_type" value="post">
                            </form>
                        </div><!-- /#header-search -->

                    </div>
                    </div><div style="height: 40px; display: none;"></div>
            </header>

            <?php
    }
?>


        <?php
}
?>
       </div><!-- /#site-header-wrap -->

    <div id="popup_10" class="popup-div pp-overly" style="display: none;">
    <div class="popup">
        <div class="popup-content rotateCubeIn">
            <a class="close-popup" data-id="popup_10" data-animation="rotateCube">×</a>
            <div class="container">
                <img class="login-img" src="<?php
echo get_stylesheet_directory_uri();
?>/images/india-donates.png" alt="oops">
                <h3 class="log-heading">Are You</h3>
                <?php
echo do_shortcode('[charitable_registration]');
?>
               <div class="login-footer">
                    <label class="f-cls login-head">Already have a Indian-Charty Account? Login now</label>
                   <a href="<?php
echo home_url();
?>/login" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="twitter" data-popupwidth="600" data-popupheight="600">
                    <img src="<?php
echo home_url();
?>/wp-content/uploads/2018/09/facebook_square-512.png" alt=""  style="height: 25px;width: 25px;"/>
                    </a>
                    <a href="<?php
echo home_url();
?>/login" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="twitter" data-popupwidth="600" data-popupheight="600">
                    <img src="<?php
echo home_url();
?>/wp-content/uploads/2018/09/G-Suit.png" alt="" style="height: 25px;width: 25px;" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup_11" class="popup-div pp-overly" style="display: none;">
    <div class="popup ngo-alk">
        <div class="popup-contents rotateCubeIn">
            <a class="close-popup" data-id="popup_11" data-animation="rotateCube">×</a>
            <div class="container" style="width: 750px; height: 420px;">
                <img class="login-img" src="<?php
echo get_stylesheet_directory_uri();
?>/images/india-donates.png" alt="oops">
                <h3 class="log-heading">Login</h3>
                <div class="login_popup">
                <div class="error"></div>
                    <?php //echo do_shortcode('[login-with-ajax]');
?>
                   <?php
wp_login_form();
?>
                   <div class="forget-password-div"><a href="<?php
echo home_url();
?>/donner-login/forgot-password/"> Forgot Password</a></div>
                </div>
                <div class="login_social">

                    <?php
echo do_shortcode('[nextend_social_login provider="facebook"]');
?>
                   <h3 class="or">OR</h3>
                    <?php
echo do_shortcode('[nextend_social_login provider="google"]');
?>
                   <p class="popup-signup-text">If not registered, kindly</p>
                    <a class="popup-donor-signup" href="<?php
echo home_url() . '/donor-signup';
?>">SIGN UP</a>

                </div>

            </div>
        </div>
    </div>
</div>
<!--Buy now popup code.-->
<div id="popup_12" class="popup-div pp-overly" style="display: none;">
    <div class="popup">
        <div class="popup-contents rotateCubeIn">
            <a class="close-popup" data-id="popup_12" data-animation="rotateCube">×</a>
            <div class="container" style="width: 750px; height: 420px;">
                <img class="login-img" src="<?php
echo get_stylesheet_directory_uri();
?>/images/india-donates.png" alt="oops">
                <h3 class="log-heading">We will Contact you Soon!!</h3>
                <div class="login_popup">
                    <?php
echo do_shortcode('[contact-form-7 id="2756" title="Buy now"]');
?>
               </div>
            </div>
        </div>
    </div>
</div>

    <?php
if ($blog_id != 1) {
?>
       <!-- Main Content -->
        <div id="main-content" class="site-main clearfix" style="padding-top: 0px; ">
    <?php
} else {
?>
       <div id="main-content" class="site-main clearfix">
    <?php
}
?>
<?php
$user_id     = get_current_user_id();
$user_phone  = get_user_meta($user_id, 'user_phone', true);
$donor_title = get_user_meta($user_id, 'user_title', true);
?>
<input class="donor-mobile-hidden" type="hidden" value="<?php
echo $user_phone;
?>">
<input class="donor-title-hidden" type="hidden" value="<?php
echo $donor_title;
?>">
<?php
?>
