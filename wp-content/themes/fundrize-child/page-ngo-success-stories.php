<?php /* Template Name: NGO Success Story */ ?>
<?php get_header(); 
	$specific_page_name =  basename($_SERVER['REQUEST_URI']);
	?>
    <div id="content-wrap" class="wprt-container <?php echo $specific_page_name;?>">
        <div id="site-content" class="site-content clearfix ">
        	<div id="inner-content" class="inner-content-wrap">
			<h1>NGO Success Story</h1>
			</div>
        </div><!-- /#site-content -->

        <?php //get_sidebar(); ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>
