<?php
     /* Template Name: NOG Listing Page */
?>

<?php get_header(); 
?>
<!-- new template-->


<div id="content-wrap" class="wprt-container">
        <div id="site-content" class="site-content clearfix">
                <div id="inner-content" class="inner-content-wrap">
                    <article class="page-content page type-page status-publish hentry">
                        <div class="wprt-container">
                            <div class="nogs_listing">
                                <div class="ngo_head">
                                    <h2>Accredited NGOs</h2>
                                </div>
                                <?php
                                global $wpdb;
                                $table_name = "wp_ngo_profile";
                                $result = $wpdb->get_results( "SELECT * FROM `wp_ngo_profile` WHERE `approval_status` = 'yes' ORDER BY id DESC ");
                                //print_r($result);
                                
                                foreach( $result as $print ){
                                    $ngo_id = $print->nguser_id;
                                    $ngo_url =  get_author_posts_url( $ngo_id );
                                    $ngo_data = get_userdata($ngo_id);
                                    $current_ngo_name = get_user_meta( $ngo_id, 'org_name', true );
                                    ?>
                                <div class="ngo_grid">
                                    <div class="ngo_avatar">
                                        <a href="<?php echo  $ngo_url; ?> "> <img width="366" height="150" src="<?php echo $print->ngo_logo; ?>"></a>

                                    </div>
                                    <div class="ngo_details">
                                        <div class="ngo_title">
                                            <h3><?php echo $current_ngo_name; ?></h3>
                                        </div>
                                        <div class="ngo_desc">
                                            <span>
                                            <?php 
                                            //echo $print->about_org;
                                           $ngo_url =  get_author_posts_url( $ngo_id );
                                            $string = wp_strip_all_tags($print->about_org);
                                            if (strlen($string) > 400 ) {
                                            $trimstring = substr($string, 0, 400). " <a href='$ngo_url'>read more...</a>";
                                            } else {
                                            $trimstring = $string;
                                            }
                                            echo $trimstring;
                                            //Output : Lorem Ipsum is simply dum [readmore...][1]*/
                                            ?>


                                            </span>
                                        </div>
                                        <div class="desc_more">
                                             <a class="view_more" href="<?php echo get_author_posts_url( $ngo_id );?>">View More</a>
                                        </div>
                                    </div>
                                </div>
                                <hr style="height: 5px;margin: 12px;">
                                <?php } ?>
                            </div>

                        </div>
                    </article>

                </div>
    </div><!-- /#site-content -->

</div>

<?php get_footer(); ?>
