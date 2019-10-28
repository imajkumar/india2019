<?php get_header(); 
	$specific_page_name =  basename($_SERVER['REQUEST_URI']);
	?>
    <div id="content-wrap" class="wprt-container <?php echo $specific_page_name;?>">
        <div id="site-content" class="site-content clearfix ">
        	<div id="inner-content" class="inner-content-wrap">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'page-content' ); ?>>
					<?php
					the_content();
					
					wp_link_pages( array(
						'before'      => '<p class="page-links">' . esc_html__( 'Pages:', 'fundrize' ),
						'after'       => '</p>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
					?>
				</article>
			<?php endwhile; ?>
			</div>
        </div><!-- /#site-content -->

        <?php //get_sidebar(); ?>
        <div id="sidebar" class="sidebar sticky">
            <div id="inner-sidebar" class="inner-content-wrap ngo-detail-sidebar-div">
                <div class="ngo-sidebar border-bold">      
                <div class="single-figure">
                    <?php
                    global $wpdb;
                    $postid = get_queried_object_id();
		            $auth = get_post($postid); // gets author from post
		            $author_id = $auth->post_author;
                    $table_name = "wp_ngo_profile";
                  
                   $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$author_id'" );
                    foreach ($result as $key ) {
                        //print_r($key);
                        $ng_logo = $key->ngo_logo;?>
                   
                    <a href="<?php echo get_author_posts_url( $author_id  );?>"><img style="width: 100%; height: 80px;" src="<?php echo $ng_logo; ?>"></a>
                    <a href="<?php echo get_author_posts_url( $author_id  );?>"><h2><?php echo $key->org_name; ?></h2></a>
                    <div>
                    <?php echo $key->email_id; ?>
                    <?php echo $key->reg_add; ?><br/>
                    <?php echo $key->city; ?><br/>
                    <?php echo $key->state; ?><br/>
                    Mobile Number:- <?php echo $key->mobile_n; ?><br/>
                    Landline No:- <?php echo $key->contact_landline; ?>
                    </div>
                    <?php

                    
                }
                    ?>     
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
<?php get_footer(); ?>