<?php
     /* Template Name: All Projects page */
?>

<?php get_header(); 
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">  

<!-- new template-->
<!-- Check sorting for tables -->
<div id="content-wrap" class="wprt-container">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <article class="page-content post-1114 page type-page status-publish hentry">
                    <?php
                        //$campaign = charitable_get_campaign();
                        //echo "Hello";
                        global $wpdb;
                        $post_table_name = "wp_posts";
                        $campaign_post = $wpdb->get_results("SELECT * FROM $post_table_name Where post_type = 'campaign' AND post_status = 'publish'");
                        ?>
                        <div id="jquery-script-menu">
                        <div class="jquery-script-center">
                        <div class="jquery-script-ads">
                        </div>
                        <div class="jquery-script-clear"></div>
                        </div>
                        </div>
                        <div id="allproject_conatiner" class="container" style="margin-top:20px;">
                        <h1 style="color: #518c51; font-weight: bold; font-size:24px;"><center>List of all Projects by Indiadonates</center></h1>
                        <div class="hrtype_5"></div>
                        <table id="table_format" class="table table-bordered">
                            <tbody class="tbody_allprojects">
                                <tr id="tr_allprojects" class="tr_th_allprojects">
                                    <th id="th_projhead" class="">NGO Name</th>
                                    <th id="th_projhead" class="">Project Name</th>                                    
                                    <!--<td id="th_projhead" class="">Amount to be raised</td>-->
                                    <!-- <td id="th_projhead" class="">Amount raised so far</td> -->
                                    <th id="th_projhead" class="">Project Budget</th>
                                    <th id="th_projhead" class="th_causes">Causes</th>
                                    <th id="th_projhead" class="th_location">Location</th>
                                </tr>
                                <?php
                                    foreach( $campaign_post as $get_campaign ){
                                        $campaign = charitable_get_campaign($get_campaign->ID); 
                                        //print_r($campaign);
                                ?>
                                <tr id="tr_allprojects" class="tr_td_allprojects">
                                    <td id="td_project" class=""><?php echo get_the_author_meta('display_name', $get_campaign->post_author); ?></td>                                    
                                    <td id="td_project" class=""><?php echo $get_campaign->post_title; ?></td>
                                    <td id="td_project"> 
                                        <div style="margin-bottom: 5px;">
                                        Goal: <b><?php $cam_meta = get_post_meta($get_campaign->ID, '_campaign_goal', true); echo $goal=$cam_meta;?> </b>/ Raised: <b><?php  echo $received=number_format ($campaign->donated_amount); ?></b>
                                    </div>
                                        <div class="progress" style="margin-bottom:0px;">
                                            <?php $received=str_replace(",", "", $received); $goal=str_replace(",", "", $goal); $percen=round($received/$goal * 100,2);?>
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $percen;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percen;?>%"><?php echo $percen;?>%</div>
                                        </div>
                                    </td>
                                    <td id="td_project" class="td_projectcat">
                                        <?php
                                        $camp_cat = get_the_terms( $get_campaign->ID, 'campaign_category');
                                            foreach( $camp_cat as $camp_name ){
                                                echo $camp_name->name;
                                            }
                                            $test = get_post_meta($get_campaign->ID);
                                        ?>
                                    </td>
                                    <td id="td_project" class="td_location"><?php  echo $cam_meta = get_post_meta($get_campaign->ID,'tbs-location_select_1', true); ?></td>                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        </div>
                        <!--End the code -->
                    
                </article>

             </div>
        </div><!-- /#site-content -->

            </div>
<?php get_footer(); ?>
