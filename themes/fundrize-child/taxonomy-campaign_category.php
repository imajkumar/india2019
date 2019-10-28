<?php /* Template Name: Cateories Page */ ?>

<?php get_header(); ?>
<div class="camp-cat-div">
    <div>
        <h2 class="camp-cat-heading"><?php single_term_title(); ?></h2>
    </div>
        <hr class="camp-cat-hrU">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
    <div style="">	
        <div class="camp-cat-divA">
            <?php
                global $wpdb;
                $user_id = $post->post_author;
                $table_name = "wp_ngo_profile";
                $result = $wpdb->get_results( "SELECT * FROM $table_name where nguser_id = '$user_id'" );
                   foreach ($result as $print ) {
                      //print_r( $print );  
                      $ngo_id = $print->nguser_id;
                      $ngo_url =  get_author_posts_url( $ngo_id );
                      $ngo_name = $print->org_name; 
                      $ngo_logo = $print->ngo_logo;
                       ?>
                        
                        <center><a href="<?php echo $ngo_url; ?>" ><h3><?php echo $ngo_name;?></h3></a>
                        <a href="<?php echo $ngo_url; ?>" > <img src="<?php echo $print->ngo_logo;?>" alt="Oops"></a></center>
		
                <?php 
                } ?>
        </div>
        <?php if (has_post_thumbnail()): ?>
        <div class="camp-cat-divB">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="Indian Charity" data-width="172" data-height="32" >
                    <?php else: ?>
                    <div class="postlistfilling"></div>
                <?php endif; ?> 
        </div>     
		<div class="camp-cat-divC">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<p style="margin: 0 0 0px;"><?php echo limit_words(get_the_excerpt(), '30'); ?></p>
		</div>
		
		<div class="camp-cat-divD">
            <center>
                <div>
                    <h4 style="display: inline-block;">Be a Champion</h4> 
                </div>
                <div class="cat-post-link">
                    <a href="<?php the_permalink();?>">DONATE NOW</a>
                </div><!-- .post-link -->
                    <h4><a href="#" style="color: #f79800; font-weight: 600">Collect</a>
                    <fieldset class="rating-centr" >
                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full-rat" for="star5" title="Awesome - 5 stars" style="color: #518c51"></label>
                    </fieldset>
                    </h4>
            </center>
        </div>            
    
        <hr class="camp-cat-hrL">
    </div>        
	<?php endwhile; endif; ?>
    </div>
    </div>
<?php get_footer(); ?>