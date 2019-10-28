<?php /* Template Name: NGO Financial Details */ ?>
<?php get_header(); 
	$specific_page_name =  basename($_SERVER['REQUEST_URI']);
	?>
    <div id="content-wrap" class="wprt-container <?php echo $specific_page_name;?>">
        <div id="site-content" class="site-content clearfix ">
        	<div id="inner-content" class="inner-content-wrap">
			<h1 class="h1_custom_temp">NGO Financial Details</h1>
                <div class="two_parts_temp">
                    <div class="part1_custom_temp">
                        <div class="about_reg">
                            <div class="ngo_img_det_reg">
                               <img class="temp_img_ngo_logo" src="https://master-7rqtwti-5yr2sxahiywhc.eu-2.platformsh.site/wp-content/uploads/2018/11/signa-logo-1.png"/>
                            </div>
                            <div class="fin_dls">
                                <h2>NGO Name</h2>
                                <div class="fin_dls_inner">
                                    <h4>Download Pdf to get financial details of the NGO</h4>
                                    <a href="/files/download-file.pdf" download="newname" target="_blank" class="buttonDownload">Download PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="part2_custom_temp">
                        <div class="ngo_img_det_reg">
                           <img class="temp_img_ngo_logo_sidebar" src="https://master-7rqtwti-5yr2sxahiywhc.eu-2.platformsh.site/wp-content/uploads/2018/11/signa-logo-1.png"/>
                           <h4>NGO Name</h4>
                           <p class="ngo_sidebar_dls">
                               Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                           </p>
                        </div>
                        
                    </div>
                </div>
			</div>
        </div><!-- /#site-content -->

        <?php //get_sidebar(); ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>
