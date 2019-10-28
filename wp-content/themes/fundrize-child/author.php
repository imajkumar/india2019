<?php
get_header(); ?>

   <!--Fetch all the post-->
   <?php

    $ngo = get_user_by( 'slug', get_query_var( 'author_name' ) );
    $ngo_id = $ngo->ID;
    //echo  $ngo_id;
            $ngo_id = $ngo->ID;
            $table_name = "wp_ngo_profile";
            $sta = "";
            $ng_logo = '';
            $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$ngo_id'" );
            foreach ($result as $key ) {
                //print_r($key);
                $sta = $key->approval_status;
            }

            if( $sta == "no" || $sta == ""  ){
                //echo $sta;
                echo "<center><h1 class='heading-ngo-notverified'>NGO not verified. If you are Admin, please login and upload the documents.</h1></center>";?>
                <center><a href="<?php echo site_url().'/wp-admin/'?>"><h3 style="color:#f79800;">Login Here</h3></a></center>
                <?php
            }else{

    $args = array( 'post_type' => 'campaign', 'posts_per_page' => 4,'author' => $ngo_id, );
    $the_query = new WP_Query( $args );
    ?>
    <?php if ( $the_query->have_posts() ) { ?>
        <div class="bxslider">
            <?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
            <div><?php $slider_img = get_the_post_thumbnail_url();
            if ( $slider_img == "" ){?>
                <img src="<?php echo home_url();?>/wp-content/uploads/2018/09/no-image-available-banner.jpg" title="<?php the_title(); ?>" id="slider_imgid">
            <?php }else{?>


                <img src="<?php echo get_the_post_thumbnail_url(); ?>" title="<?php the_title(); ?>" id="slider_imgid">
                <?php

            }

                ?>
                <div class="wrap">
                    <a class="btn-6" href="<?php the_permalink(); ?>">Donate<span></span></a>
                </div>
            </div>
            <?php wp_reset_postdata(); }?>
        </div>
    <?php } ?>
    <div id="content-wrap" class="wprt-container">
        <div id="site-content" class="site-content clearfix">

            <div data-vc-full-width="true" data-vc-full-width-init="true" id="rec_cau" class="vc_row wpb_row vc_row-fluid vc_custom_1507951665065 vc_row-has-fill" style="background-color: #fff;">
                 <?php //global $wpdb;
            //$cid =  get_current_blog_id();
            $table_name = "wp_ngo_profile";
            $ng_logo = '';
            $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$ngo_id'" );
            foreach ($result as $key ) {
                //print_r($key);
                $ngo_edit_id = $print->nguser_id;
                $ngo_url =  get_author_posts_url( $ngo_id );
                $ng_logo = $key->ngo_logo;
                //echo $ng_logo;
            }

                if ( $ng_logo == '') {
                    $ng_logo = get_stylesheet_directory_uri().'/images/india_donates.png';
                }?>
                <div id="site-logo" class="ngo-detail-logo" class="clearfix">
                    <div id="site-logo-inner">
                            <a href="<?php echo  $ngo_url;?>" title="Indian Charity" rel="home" class="main-logo">
                            <img src="<?php echo $ng_logo; ?>" width="172" height="70" alt="Indian Charity" data-width="172" data-height="70" style="width: 172px;"></a>
                    </div>
                    <!--div class="mail_ngo_logo"><?php
                     //foreach ($result as $key ) {
                       // print_r($key);
                       // $ng_mail = $key->email_id;
                        //echo $ng_logo;
                    //}
                    ?>
                    </div>-->
                </div><!-- #site-logo -->
                <div class="wpb_column vc_column_container vc_col-sm-12 detail_border" style="width: 85%">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="wprt-tabs clearfix style-1" id="styl_1">
                            <?php
                            foreach ($result as $key ) {
                       // print_r($key);
                        $ng_name = $key->org_name;
                        //echo $ng_logo;
                        ?><h3 style="color: #292929; margin-top: 15px; text-align: center; font-family: Verdana, Geneva, sans-serif;"><?php echo $ng_name; ?></h3><?php
                            }
                            ?>
                             <button class="tablink" onclick="openCity('ngo-profile', this, '#555')" id="defaultOpen">Profile</button>
                                <button class="tablink" onclick="openCity('ngo-support-option', this, '#f79800')">Support Option</button>
                                <button class="tablink" onclick="openCity('ngo-financial-details', this, '#f79800')">Financial</button>
                                <button class="tablink" onclick="openCity('ngo-governance', this, '#f79800')">Governance</button>
                                <button class="tablink" onclick="openCity('ngo-reg-details', this, '#f79800')">Registration</button>
                                <div id="ngo-profile" class="tabcontent">

                                        <div class="tab-profile">
                                            <button class="tablinks-profile" onclick="openCity_profile(event, 'abous-us-ngo')" id="defaultOpen-profile">About Us</button>
                                            <button class="tablinks-profile" onclick="openCity_profile(event, 'vission-ngo')">Vision</button>
                                            <button class="tablinks-profile" onclick="openCity_profile(event, 'mission-ngo')">Mission</button>
                                        </div>

                                        <div id="abous-us-ngo" class="tabcontent-profile">
                                           <h3>About Us</h3>
                                            <p style="text-align:left;"><?php
                                                foreach ($result as $key ) {
                                                    //print_r($key);
                                                    echo $ng_logo = $key->about_org;
                                                    //echo $ng_logo;
                                                }
                                            ?>

                                            </p>
                                        </div>

                                        <div id="vission-ngo" class="tabcontent-profile">
                                        <h3>Vision</h3>
                                            <p style="text-align:left;">

                                            <?php
                                                foreach ($result as $key ) {
                                                    //print_r($key);
                                                   echo $ng_logo = $key->ngo_vision;;
                                                    //echo $ng_logo;
                                                }
                                            ?>
                                            </p>
                                        </div>

                                        <div id="mission-ngo" class="tabcontent-profile">
                                        <h3>Mission</h3>
                                            <p style="text-align:left;">
                                            <?php
                                                foreach ($result as $key ) {
                                                    //print_r($key);
                                                   echo  $ng_logo = $key->ngo_mission;
                                                    //echo $ng_logo;
                                                }
                                            ?>

                                            </p>
                                        </div>

                                        <script>
                                            function openCity_profile(evt, cityNameP) {
                                                var i_p, tabcontent_p, tablinks_p;
                                                tabcontent_p = document.getElementsByClassName("tabcontent-profile");
                                                for (i_p = 0; i_p < tabcontent_p.length; i_p++) {
                                                    tabcontent_p[i_p].style.display = "none";
                                                }
                                                tablinks_p = document.getElementsByClassName("tablinks-profile");
                                                for (i_p = 0; i_p < tablinks_p.length; i_p++) {
                                                    tablinks_p[i_p].className = tablinks_p[i_p].className.replace(" active-p", "");
                                                }
                                                document.getElementById(cityNameP).style.display = "block";
                                                evt.currentTarget.className += " active-p";
                                            }

                                            // Get the element with id="defaultOpen" and click on it
                                            document.getElementById("defaultOpen-profile").click();
                                        </script>
                                </div>

                                <div id="ngo-support-option" class="tabcontent">
                                    <h3>Support Option</h3>
                                    <p>We have several option to support NGO.</p>
                                </div>

                                <div id="ngo-financial-details" class="tabcontent">
                                    <h3>Financial Details</h3>
                                    <p>We believe in transparacy. Please find the Financial details.</p>
                                </div>

                                <div id="ngo-governance" class="tabcontent">
                                    <h3>Governance</h3>
                                    <p>NGO governance by following people.</p>
                                </div>
                                <div id="ngo-reg-details" class="tabcontent">
                                    <h3>NGO Registration Details</h3>
                                    <p>Registration details.</p>
                                </div>
                                <!-- <button class="tablink" onclick="openCity('ngo-profile', this, '#f79800')" id="defaultOpen">Profile</button>
                                <button class="tablink" onclick="openCity('ngo-support-option', this, '#f79800')">Support Option</button>
                                <button class="tablink" onclick="openCity('ngo-financial-details', this, '#f79800')">Financial Details</button>
                                <button class="tablink" onclick="openCity('ngo-governance', this, '#f79800')">Governance</button>
                                <button class="tablink" onclick="openCity('ngo-reg-details', this, '#f79800')">Registration Details</button> -->

                                <script>
                                function openCity(cityName,elmnt,color) {
                                    var i, tabcontent, tablinks;
                                    tabcontent = document.getElementsByClassName("tabcontent");
                                    for (i = 0; i < tabcontent.length; i++) {
                                        tabcontent[i].style.display = "none";
                                    }
                                    tablinks = document.getElementsByClassName("tablink");
                                    for (i = 0; i < tablinks.length; i++) {
                                        tablinks[i].style.backgroundColor = "";
                                    }
                                    document.getElementById(cityName).style.display = "block";
                                    elmnt.style.backgroundColor = color;

                                }
                                // Get the element with id="defaultOpen" and click on it
                                document.getElementById("defaultOpen").click();
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<div class="vc_row-full-width vc_clearfix"></div>

<div data-vc-full-width="true" data-vc-full-width-init="true" id="rec_cau" class="vc_row wpb_row vc_row-fluid vc_custom_1507951665065 vc_row-has-fill">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper ngo-recent-projects">
                <div class="wprt-spacer clearfix" id="cler_fix3" data-desktop="35" data-mobi="60" data-smobi="60">
                </div>
                <div class="wprt-headings clearfix text-center" style="">
                    <h2 class="heading clearfix" id="clr_fix">RECENT PROJECTS</h2>
                    </div>
               <!-- <div class="wprt-spacer clearfix" id="wprt-space" data-desktop="65" data-mobi="40" data-smobi="40"></div> -->
              <!-- Custom coursel -->

<div class="Container1">

  <!-- Carousel Container -->
  <div class="SlickCarousel project_block">
    <?php
    $args = array( 'post_type' => 'campaign', 'posts_per_page' => 8,'author' => $ngo_id, );
    $the_query = new WP_Query( $args );
    ?>
    <?php if ( $the_query->have_posts() ) { ?>
    <?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
    <!-- Item -->
    <div class="ProductBlock">
      <div class="inner">
        <div class="thumb-wrap item_l">
              <?php $img = get_the_post_thumbnail_url();
            if( $img == "" ){?>
                 <img width="366" height="150" src="<?php echo home_url();?>/wp-content/uploads/2018/09/no-image-available-banner.jpg">
            <?php
            }else{?>
                <img width="366" height="150" src="<?php echo get_the_post_thumbnail_url(); ?> ">
            <?php

            } ?>
            <!-- <img width="365" height="150" src="http://localhost/indian-charity/wp-content/uploads/2018/09/cause1-300x177.jpg" sizes="(max-width: 300px) 100vw, 300px"> -->
            <div class="campaign-donation">
                <a class="dnt-button button" href="<?php echo $post->guid;?>" aria-label="Make a donation to Poor Children Donation">Donate</a>
            </div>
        </div>
        <div class="text-wrap">
            <h3 class="new-title-for-ng0-landing">
                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 10 );?></a>
            </h3>
            <div class="campaign-description" style="display:block;">
                <?php //echo get_the_excerpt();
               echo wp_trim_words( get_the_excerpt(), 60 );
               /* $string = get_the_excerpt();
                if (strlen($string) > 400 ) {
                $trimstring = substr($string, 0, 400). " <a href='$ngo_url'>readmore...</a>";
                } else {
                $trimstring = $string;
                }
                echo $trimstring;*/

                ?>
            </div>
           <!-- <div class="wprt-progress clearfix"><div class="perc-wrap">
                <div class="perc show" id="showperc" style="width: 0%;">
                    <span>0%</span>
                </div>
                </div>
                <div class="progress-bar" data-percent="0%" data-inviewport="yes">
                    <div class="progress-animate" style="width: 0%;"></div>
                </div>
            </div> -->
            <!-- <div class="campaign-donation-stats">Raised:
                <span class="amount">$0.00</span>
                <span class="goal-amount">Rs <?php echo get_post_meta( $post->ID, '_campaign_goal', true ); ?></span>
            </div> -->
           <center> <a class="view-more-btn" href="<?php the_permalink(); ?>">View More</a> </center>
        </div>
    </div>
    </div>
    <?php wp_reset_postdata(); }?>
    <?php } else{?>
        <center>Sorry, Currently we don't have any project!!</center>
    <?php }?>
  </div>
  <!-- Carousel Container -->
</div>
              <!-- end-->
                <div class="wprt-spacer clearfix" id="cler_fix4" data-desktop="15" data-mobi="30" data-smobi="30"></div>
                <!--<div class="wprt-align-box text-center">
                    <div class="button-wrap icon-right" style="">
                        <a href="./projects" target="_blank" class="wprt-button  solid outline_light outline light" style="">
                            <span style="">SEE ALL Projects </span>
                        </a>
                    </div>
                </div>-->
                <div class="wprt-spacer id="wprt_sp" clearfix" data-desktop="40" data-mobi="60" data-smobi="60"></div>
            </div>
        </div>
    </div>
</div>
<div class="vc_row-full-width vc_clearfix"></div>

<div class="vc_row-full-width vc_clearfix"></div>
<?php
    }
?>
</article>
</div>
</div>
<!-- /#site-content -->
</div>


<?php get_footer();
?>
