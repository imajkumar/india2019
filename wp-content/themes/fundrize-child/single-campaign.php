
<?php get_header();
 global $wpdb;
 $donor_table_name = "wp_charitable_donors";
 $charitable_cam_donation = "wp_charitable_campaign_donations";
 $campaign = charitable_get_current_campaign();

//donation id count for suppoters
 $donation_id = $wpdb->get_results("SELECT donation_id  FROM $charitable_cam_donation Where campaign_id = $campaign->ID");
 $suppoter_count = 0;
     foreach( $donation_id as $dfh ){
         $donation_meta = get_post($dfh ->donation_id , 'post_status', true);
        if( $donation_meta ->post_status == "charitable-completed" ){
           $suppoter_count++;
        }
     }
//end

$campaign = charitable_get_current_campaign();
//print_r( $campaign );
$currency_helper = charitable_get_currency_helper();
if( is_user_logged_in() ){
    $logged_in_user_id = get_current_user_id();
    $meta = get_post_meta( get_the_ID()   );
    $camp_id = $campaign->ID;
    //print_r( $meta );
    $current_page_id = get_the_ID();
    $current_page_title = get_the_title();
    $current_page_url = get_the_permalink();
    $current_page_img_url = get_the_post_thumbnail_url();
    //echo "<script>alert('Thanks!');</script>";
    //fetch the donor id using user_id form wp_donors table.
    global $wpdb;
    $reminder_table = "wp_user_reminder";
    $donor_table_name = "wp_charitable_donors";
    $charitable_cam_donation = "wp_charitable_campaign_donations";
    $count_donor = $wpdb->get_results("SELECT COUNT(donor_id) as contributor FROM $charitable_cam_donation Where campaign_id = $camp_id");
    //print_r( $count_donor );

    $donor_id = $wpdb->get_results( "SELECT donor_id FROM $donor_table_name where user_id = $logged_in_user_id" );
    foreach( $donor_id as $donotion_id ){
        $get_donor_id = $donotion_id->donor_id;
    }

    $campign_id = $wpdb->get_results("SELECT campaign_id FROM $charitable_cam_donation WHERE donor_id =  $get_donor_id AND campaign_id = $camp_id ");
    foreach(  $campign_id as $get_camp_id ){
        $fetched_cam_id = $get_camp_id->campaign_id;
    }

    //stop dublicate entry fetch the data.
    $saved_campaign_id =  $wpdb->get_results("SELECT campaign_id FROM $reminder_table WHERE user_id =  $logged_in_user_id AND campaign_id = $camp_id ");
    foreach( $saved_campaign_id as $current_saved_campin_id ){
        $saved_camp_id =  $current_saved_campin_id->campaign_id;

    }
    if( $get_donor_id == "" && $saved_camp_id == "" ){
            $success = $wpdb->insert(
                $reminder_table,
                array(
                    'user_id' => $logged_in_user_id,
                    'campaign_id' => $camp_id ,
                    'campaign_name' => $current_page_title,
                    'campaign_img_url' => $current_page_img_url,
                    'campaign_url' => $current_page_url,
                )
            );
           // echo "<script>alert('Yes Saved with fresh inputs!');</script>";
            //insert details.

    }elseif( $get_donor_id != "" && $fetched_cam_id == "" && $saved_camp_id == "" ){
            $success = $wpdb->insert(
                $reminder_table,
                array(
                    'user_id' => $logged_in_user_id,
                    'campaign_id' => $camp_id ,
                    'campaign_name' => $current_page_title,
                    'campaign_img_url' => $current_page_img_url,
                    'campaign_url' => $current_page_url,
                )
            );
            //echo "<script>alert('Save for donor is register!');</script>";
        //insert details

    }else{
        //echo "<script>alert('Saves Nothing!');</script>";
        //do nothing.
    }



  }else{
      //do nothing.
  }
?>
    <div id="content-wrap" class="wprt-container project-detail-page">
        <div id="site-content" class="site-content clearfix project-detail-left">
            <div id="inner-content" class="inner-content-wrap">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="single-title">
                        <div class="inner clearfix">
                            <h3 class="title"><?php the_title() ?></h3>
                            <?php
                            $author_id = get_the_author_ID();
                            $author_id;
                            global $authordata;
                            $author_roles = $authordata->roles;
                            if ( in_array('administrator', $author_roles ) ) {
                                // redirect them to the default place
                                $ngo_org_name = '';
                                echo '<h4 style="font-size: 14px;"> <span class="author-org-name"><?php echo $ngo_org_name; ?></span>';
                            } else {
                                $ngo_org_name = get_user_meta( $author_id, 'org_name', true );
                                //$ngo_url = get_user_meta( $author_id, 'nickname', true );
				$new_ngo_url = get_userdata($author_id);
				$ngo_url = $new_ngo_url->user_login;
                                ?>
                                <a href="<?php echo home_url().'/ngo/'.$ngo_url;?>"><h4 style="font-size: 14px;"> By <span class="author-org-name"><?php echo $ngo_org_name; ?></span><hr style="border: none; width: 2px; height: 10px; border-left: 2px solid #666; display: inline;margin-left: 5px;"></a>
                                <?php
                            }

                            ?>

                            <?php echo wpdocs_custom_taxonomies_terms_links();  echo do_shortcode( '[TheChamp-Sharing]' );?></h4>
                        </div>


                    </div>
                    <div class="single-thumb">
                    <?php if ( has_post_thumbnail( $campaign->ID ) ) :
                            echo get_the_post_thumbnail( $campaign->ID, 'full' );
                        endif;
                    ?>
                    </div>

                    <div class="single-figure">
                        <?php
                        $current_browsing_user_id = get_current_user_id();
                        $page_title = $wp_query->post->post_title;
                        $page_link = get_permalink();
                        $img_url = get_the_post_thumbnail_url();
                        //echo $current_browsing_user_id;
                        if( isset( $_POST['my_fav'] ) ){
                            $is_fav = $_POST['my_fav'];
                            $page_title = $wp_query->post->post_title;
                            $page_link = get_permalink();
                            $img_url = get_the_post_thumbnail_url();
                            add_user_meta( $current_browsing_user_id, 'is_favourite', array(
                                'page_title'=> $page_title,
                                'page_url'=> $page_link,
                                'image_url'=>  $img_url,
                            ) );
                        }

                        $user_meta = get_user_meta( $current_browsing_user_id );
                        $is_fav_meta = get_user_meta( $current_browsing_user_id, 'is_favourite' );
                        if( isset( $_POST['remove_fav'] ) ){
                            delete_user_meta( $current_browsing_user_id, 'is_favourite', array(
                                'page_title'=> $page_title,
                                'page_url'=> $page_link,
                                'image_url'=>  $img_url,
                                ) );
                        }
                        foreach( $is_fav_meta as $title ){
                           // print_r($title);
                            $page_name = $title['page_title'];
                            if( $page_name == $page_title ){?>
                                <div class="campaign-favorite">
                                    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                        <span class="icon"><i class="inf-icon-heart dislike-remove" style="color:red;"></i></span><input type="submit" name="remove_fav" class="dnt-button button dis-button" id="like-button" data-id="fav" value="favourite">
                                    </form>
                                </div>
                            <?php
                            break;
                            }
                        }
                        foreach( $is_fav_meta as $non_save ) {
                        $page_name = $title['page_title'];
                        if( $page_name != $page_title ){
                        ?>
                        <div class="campaign-favorite">
                            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <span class="icon"><i class="inf-icon-heart"></i></span><input type="submit" name="my_fav" class="dnt-button button" id="like-button" data-id="fav" value="favourite">
                            </form>
                        </div>
                        <?php
                        break;
                        }
                       }
                       $is_fav_meta_check = get_user_meta( $current_browsing_user_id, 'is_favourite', true );
                       if( $is_fav_meta_check == "" ){?>
                       <div class="campaign-favorite">
                            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <span class="icon"><i class="inf-icon-heart"></i></span><input type="submit" name="my_fav" class="dnt-button button" id="like-button" data-id="fav" value="favourite">
                            </form>
                        </div>

                       <?php }
                          ?>
                        <div class="wprt-progress clearfix">
                            <div class="perc-wrap">
                                <div class="perc">
                                    <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span>
                                </div>
                            </div>
                            <div class="progress-bar" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                <div class="progress-animate"></div>
                            </div>
                        </div>

                        <div class="figure clearfix">
                        <?php printf( _x( 'Raised: %s %s', 'Raised: amount goal', 'fundrize' ),
                            '<span class="amount">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span>',
                            '<span class="goal-amount">' . $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ) . '</span>'
                            );

                            printf('<span class="time-left">%1$s</span>', $campaign->get_time_left() );
                        ?>
                        </div>
                        <div class="single-title project-donation-title-below-thumbnail">
                            <div class="inner clearfix">
                                <div class="campaign-donation">
                                    <?php
                                   // if( is_user_logged_in()){
                                        ?>
                                        <a class="dnt-button button" href="<?php echo charitable_get_permalink( 'campaign_donation_page', array( 'campaign_id' => $campaign->ID ) ) ?>" aria-label="<?php echo esc_attr( sprintf( _x( 'Make a donation to %s', 'make a donation to campaign', 'fundrize' ), get_the_title( $campaign->ID ) ) ) ?>"><span><span class="icon"><i class="inf-icon-heart"></i></span><?php echo esc_html( 'Donate Now', 'fundrize' ) ?></span></a>
                                        <?php
                                   // }else{
                                        ?>
                                         <!--<a class="dnt-button button open-popup" data-id="popup_11" href="#popup_11"><span><span class="icon"><i class="inf-icon-heart"></i></span><?php //echo esc_html( 'Donate', 'fundrize' ) ?></span></a>-->
                                        <?php

                                   // }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="single-content">
                            <div class="tabset-lxa">
                            <!-- Tab 1 -->
                            <!--<input type="radio" name="tabset-lxa" id="tab1" aria-controls="marzen-lx" checked style="display: none;">
                            <label for="tab1">Story</label>-->
                            <!-- Tab 2 -->
                            <input type="radio" name="tabset-lxa" id="tab2" aria-controls="Description" checked style="display: none;">
                            <label for="tab2">Description</label>

                            <!--budgets -->
                            <!-- Tab 5 -->
                            <input type="radio" name="tabset-lxa" id="tab6" aria-controls="budgets" style="display: none;">
                            <label for="tab6">Budget</label>

                            <!-- Tab 3 -->
                            <input type="radio" name="tabset-lxa" id="tab3" aria-controls="tab-vidlio" style="display: none;">
                            <label for="tab3">Video</label>
                            <!-- Tab 4 -->
                            <input type="radio" name="tabset-lxa" id="tab4" aria-controls="tab-imglio" style="display: none;">
                            <label for="tab4">Images</label>
                            <!-- Tab 5 -->
                            <input type="radio" name="tabset-lxa" id="tab5" aria-controls="dunkles" style="display: none;">
                            <label for="tab5">Updates</label>


                            <div class="tab-panellxslx">
                                <!--<section id="marzen-lx" class="tab-panellx">
                                <p><strong>Overall Impression:</strong> <?php //printf('<div class="extend-desc">%1$s</div>', $campaign->post_content ); ?>.</p>

                            </section>-->
                                <section id="Description" class="tab-panellx">
                                <p>
                                <?php
                                echo $narrative_value_1 = get_post_meta( get_the_ID(), 'campg_desc-campaign_textarea_1',true );
                                ?>
                                </p>
                                <p>
                                    <?php
                                    echo $narrative_value_2 = get_post_meta( get_the_ID(), 'campg_desc-campaign_textarea_2',true );
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo $narrative_value_3 = get_post_meta( get_the_ID(), 'campg_desc-campaign_textarea_3',true );
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo $narrative_value_4 = get_post_meta( get_the_ID(), 'campg_desc-campaign_textarea_4',true );
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo $narrative_value_5 = get_post_meta( get_the_ID(), 'campg_desc-campaign_textarea_5',true );
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo $narrative_value_6 = get_post_meta( get_the_ID(), 'campg_desc-campaign_textarea_6',true );
                                    ?>
                                </p>
                                </section>

                                <section id="budgets" class="tab-panellx">
                                <p><?php
                                    echo $narrative_value_7 = get_post_meta( get_the_ID(), 'campg_desc-campaign_textarea_7',true );
                                    ?> </p>

                                </section>
                                <section id="tab-vidlio" class="tab-panellx">
                                <p>
                                <?php
                                $key_1_value =  get_post_meta( get_the_ID(),'campg_desc-campaign_video_9' );
                                //print_r( $key_1_value );
                                foreach( $key_1_value as $video ){
                                    //echo $video;
                                     $vurl = wp_get_attachment_url($video);
                                     //echo $vurl;
                                     ?>
                                    <video width="320" height="240" controls>
                                        <source src="<?php echo $vurl; ?>" type="video/mp4">
                                    </video>
                                     <?php
                                }

                                ?>
                                </p>

                                </section>
                                <section id="tab-imglio" class="tab-panellx">
                                <p>
                                    <?php
                                    $key_1_value =  get_post_meta( get_the_ID(), 'campg_desc-image_advanced_8');
                                    //print_r( $key_1_value );
                                    foreach( $key_1_value as $img ){
                                        //echo $img;
                                        $url = wp_get_attachment_image($img);
                                        //print_r( $url );
                                        echo "<p style='display:inline;'>'$url'</p>";
                                        }

                                    ?>
                                </p>

                                </section>
                                <section id="dunkles" class="tab-panellx">
                                <p><strong>Overall Impression:</strong> Updated will be here.</p>

                                </section>
                            </div>

                            </div>
                    </div>
				<?php endwhile; ?>
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->

        <?php //get_sidebar(); ?>
        <div id="sidebar" class="sidebar sticky">
            <div id="inner-sidebar" class="inner-content-wrap ngo-detail-sidebar-div">
                <div class="ngo-sidebar">
                <div class="single-figure">
                    <?php
                    global $wpdb;
                    $table_name = "wp_ngo_profile";
                  // echo $user_url =  get_user_by( $author_id );
                  // $auth_url = get_user_meta( $author_id, 'nickname', true );
	            $new_ngo_url = get_userdata($author_id);
                    $auth_url = $new_ngo_url->user_login;
                    $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$author_id'" );
                    foreach ($result as $key ) {
                        //print_r($key);
                        $ng_logo = $key->ngo_logo;?>

                    <a href="<?php echo home_url().'/ngo/'.$auth_url;?>"><img style="width: 100%; height: 80px;" src="<?php echo $ng_logo; ?>"></a>
                    <a href="<?php echo home_url().'/ngo/'.$auth_url;?>"><h2><?php echo $key->org_name; ?></h2></a>
                    <?php


                }
                    ?>
                        <input type="hidden" class="get_donated_amount" value="<?php echo $campaign->get_donated_amount(); ?>">
                        <input type="hidden" class="get_donated_goal" value="<?php echo $campaign->get( 'goal' ); ?>">
                        <div class="figure clearfix">
                            <?php
                                echo '<span class="amount-project">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span><br/>';
                                echo '<span class="goal-amount-project">Raised Out of <span class="goal-amount-final">' . $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ) . '</span></span><br/>';
                               // printf('<span class="time-left">%1$s</span>', $campaign->get_time_left() );
                                echo '<span class="time-left">';
                                //echo $campaign->get_time_left();
                                echo '</span>';
                            ?>
                            <div class="o-article-status__section c-status">
                                <div class="c-status__column c-delay">
                                <span class="c-status__counter"><span class="leetchicon ic-hour c-status__icon"></span><?php printf( $campaign->get_time_left() ); ?></span>
                               <!-- <span class="c-status__label">Days</span> -->
                                </div>
                                <div class="c-status__column c-contribution has-border">
                                <span class="c-status__counter"><span class="leetchicon ic-user c-status__icon"></span><?php echo $suppoter_count; ?></span>
                                <span class="c-status__label">Supporters</span>
                            </div>
                        </div>

                        </div>
                        <div class="wprt-progress clearfix"style="padding-top: 15px;padding-bottom: 15px;">
                            <div class="perc-wrap">
                                <div class="perc">
                                    <span><?php echo round( $campaign->get_percent_donated_raw(), 0 ); ?>%</span>
                                </div>
                            </div>
                            <div class="progress-bar" style="width:100%;" data-percent="<?php echo esc_attr( $campaign->get_percent_donated_raw() ); ?>%" data-inviewport="yes">
                                <div class="progress-animate"></div>
                            </div>
                        </div>
                        <div class="single-title project-donation-title-below-thumbnail">
                            <div class="inner clearfix">
                                <div class="campaign-donation">
                                <?php
                                   // if( is_user_logged_in()){
                                        ?>
                                        <a class="dnt-button button" href="<?php echo charitable_get_permalink( 'campaign_donation_page', array( 'campaign_id' => $campaign->ID ) ) ?>" aria-label="<?php echo esc_attr( sprintf( _x( 'Make a donation to %s', 'make a donation to campaign', 'fundrize' ), get_the_title( $campaign->ID ) ) ) ?>"><span><span class="icon"><i class="inf-icon-heart"></i></span><?php echo esc_html( 'Donate Now', 'fundrize' ) ?></span></a>
                                        <?php
                                    //}else{
                                        ?>
                                        <!-- <a class="dnt-button button open-popup" data-id="popup_11" href="#popup_11"><span><span class="icon"><i class="inf-icon-heart"></i></span><?php //echo esc_html( 'Donate', 'fundrize' ) ?></span></a>-->
                                        <?php

                                   // }
                                    ?>
                                </div>
                                <div id="image-widget">
                                    <p style="margin: 0px;font-weight: bold;">Secure your payment with.</p>
                                    <img id="theImgi-widget" src="http://indiadonates.in/indiadonates/wp-content/uploads/2019/01/CreditCardLogos2.jpg">
                                </div>
                                <center><p style="margin: 0px; font-weight: bold;">Help us by sharing.</p><?php echo do_shortcode( '[TheChamp-Sharing]' );?></center>
                            </div>
                        </div>
                    </div>
                <?php
                $sidebar = 'sidebar-blog';

               /* if ( is_page() && wprt_metabox('page_sidebar') )
                    $sidebar = wprt_metabox('page_sidebar');

                if ( wprt_is_woocommerce_page() )
                    $sidebar = 'sidebar-shop';

                if ( is_active_sidebar( $sidebar ) )
                    dynamic_sidebar( $sidebar );	*/
                ?>
            </div><!-- /#inner-sidebar -->
        </div><!-- /#sidebar -->

    </div><!-- /#content-wrap -->
    <div class="clear"></div>
                                </div>
<?php get_footer(); ?>
