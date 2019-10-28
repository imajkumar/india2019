<?php
/**
 * Breadcrumbs
 *
 * @package fundrize
 * @version 3.6.8
 */

function wprt_breadcrumbs() {

    global $post;

    $home_text     = esc_html__('Home','fundrize');
    $category_text = esc_html__('Archive by Category "%s"','fundrize');
    $tax_text      = esc_html__('Archive by "%s"','fundrize');
    $tag_text      = esc_html__('Posts Tagged "%s"','fundrize');
    $author_text   = esc_html__('Articles Posted by %s','fundrize');
    $error_text    = esc_html__('Error 404','fundrize');
    $search_text   = esc_html__('Search Results for "%s" Query','fundrize');

    $blog_text   = esc_html__('Blog','fundrize');
	$gallery_text = esc_html__('Galleries','fundrize');
	$product_text = esc_html__('Products','fundrize');

    $home_link = esc_url(home_url('/'));
    $blog_link = get_post_type_archive_link( 'post' );

    if ( is_home() && is_front_page() ) {
        // Post is frontpage
        echo '<span>' . $blog_text . '</span>';
    } elseif ( is_home() && !is_front_page() ) {
        // Post is separate page
        echo '<a href="'. $home_link .'">'. $home_text .'</a>';
        echo '<span>'. $blog_text . '</span>';
    } elseif ( is_front_page() && !is_home() ) {
        // Front page and not post page
        echo '<span>' . $home_text .'</span>';
    } else {

        /*  Page
        -------------------*/
            if ( is_page() ) {
                echo '<a href="'. $home_link .'">'. $home_text .'</a>';

                if ( $post->post_parent ) {
                    $this_parents = get_post_ancestors($post->ID);

                    foreach ( array_reverse( $this_parents ) as $parent_ID ) {
                        echo '<a href="'. get_page_link( $parent_ID, false, false ) .'">'. get_the_title( $parent_ID ) .'</a>';
                    }

                    echo '<span>'. get_the_title() .'</span>';
                } else {
                    echo '<span>'. get_the_title() .'</span>';
                }

            }

        /*  Single post
        -------------------*/
            if ( is_singular( 'post' ) ) {

                $this_cats         = get_the_category();
                $first_cat         = $this_cats[0];
                $first_cat_link    = get_category_link( $first_cat->cat_ID );
            
                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                echo '<a href="'. $blog_link .'">'. $blog_text .'</a>';

                if ( $first_cat->parent )
                    echo get_category_parents( $first_cat->parent, true, '' );

                echo '<a href="'. $first_cat_link .'">'. $first_cat->name .'</a>';
                echo '<span>'. get_the_title() .'</span>';
                
            }

        /*  Category / Tag / Taxonomy
        -------------------*/
            if ( is_category() ) {

                $this_cat = get_category( get_query_var('cat'), false );

                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                echo '<a href="'. $blog_link .'">'. $blog_text .'</a>';

                if ( $this_cat->parent != 0 ) {
                    echo get_category_parents( $this_cat->parent, true, '' );
                    echo '<span>'. sprintf( $category_text, single_cat_title('', false) ) .'</span>';
                } else {
                    echo '<span>'. sprintf( $category_text, single_cat_title('', false) ) .'</span>';
                }
            }

            if ( is_tag() ) {
                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                echo '<a href="'. $blog_link .'">'. $blog_text .'</a>';
                echo '<span>'. sprintf( $tag_text, single_tag_title('', false) ) .'</span>';
            }

        /*  Date
        -------------------*/
            if ( is_day() ) {
                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                echo '<a href="'. get_year_link( get_the_time('Y'),get_the_time('Y') ) .'">'. get_the_time('Y') .'</a>';
                echo '<a href="'. get_month_link( get_the_time('Y'),get_the_time('m') ) .'">'. get_the_time('F') .'</a>';
                echo '<span>'. get_the_time('d') .'</span>';
            }

            if ( is_month() ) {
                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                echo '<a href="'. get_year_link( get_the_time('Y'),get_the_time('Y') ) .'">'. get_the_time('Y') .'</a>';
                echo '<span>'. get_the_time('F') .'</span>';
            }

            if ( is_year() ) {
                echo '<a href="'. $home_link . '">'. $home_text .'</a>';
                echo '<span>'. get_the_time('Y') .'</span>';
            }

        /*  Misc
        -------------------*/
            if ( is_search() ) {
                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                echo '<span>'. sprintf( $search_text, get_search_query() ) .'</span>';
            }

            if ( is_author() ) {
                global $author;
                $userdata = get_userdata( $author );
                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                echo '<span>'. sprintf( $author_text, $userdata->display_name ) .'</span>';
            }

            if ( is_404() ) {
                echo '<a href="'. $home_link . '">'. $home_text .'</a>';
                echo '<span>'. $error_text .'</span>';
            }

        /*  CPT
        -------------------*/
            $cpt_list = get_post_types( array(
                'public' => true,
                'publicly_queryable' => true,
                '_builtin' => false,
            ), 'objects', 'and' );

            if ( is_array( $cpt_list ) ) {
                foreach ( $cpt_list as $cpt ) {

                    $cpt_title = $cpt->labels->name;

                    switch ( $cpt->name ) {
                        case 'gallery':
                            $cpt_title = $gallery_text;
                            break;
                        case 'product':
                            $cpt_title = $product_text;
                            break;
                    }

                    /*  Archive
                    -------------------*/
                        if ( is_post_type_archive( $cpt->name ) ) {
                            echo '<a href="'. $home_link . '">'. $home_text .'</a>';
                            echo '<span>'. $cpt_title .'</span>';
                        }

                    /*  Taxonomy
                    -------------------*/
                        $cpt_taxonomies = get_object_taxonomies( $cpt->name );
                        if ( is_array( $cpt_taxonomies ) ) {
                            foreach ( $cpt_taxonomies as $cpt_tax ) {
                                if ( is_tax( $cpt_tax ) ) {

                                    $this_tax    = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
                                    $this_parents = get_ancestors( $this_tax->term_id, get_query_var('taxonomy') );

                                    echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                                    echo '<a href="'. get_post_type_archive_link($cpt->name) .'">'. $cpt_title .'</a>';

                                    if ( is_array( $this_parents ) ) {
                                        foreach ( array_reverse( $this_parents ) as $this_parent_ID ) {
                                            $this_parent = get_term( $this_parent_ID, get_query_var('taxonomy') );
                                            echo '<a href="'. get_term_link( $this_parent->slug, get_query_var('taxonomy') ) .'">'. $this_parent->name .'</a>';
                                        }
                                        echo '<span>'. sprintf( $tax_text, single_cat_title('', false) ) .'</span>';
                                    } else {
                                        echo '<span>'. sprintf( $tax_text, single_cat_title('', false) ) .'</span>';
                                    }
                                }
                            }
                        } else {
                            if ( is_tax() ) {
                                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                                echo '<span>'. sprintf( $tax_text, single_cat_title('', false) ) .'</span>';
                            }
                        }

                    /*  Single post
                    -------------------*/
                        if ( $cpt->name == 'gallery' ) {
                            if ( is_singular( 'gallery' ) ) {

                                $this_terms = get_the_terms( $post->ID, 'gallery_category' );

                                $first_term         = $this_terms[0];
                                $first_term_link    = get_term_link( $first_term->term_id,'gallery_category' );
                                $first_term_parents = get_ancestors( $first_term->term_id,'gallery_category' );

                                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                                echo '<a href="'. get_post_type_archive_link( $cpt->name ) .'">'. $cpt_title .'</a>';

                                if ( is_array( $first_term_parents ) ) {
                                    foreach ( array_reverse( $first_term_parents ) as $this_parent_ID ) {
                                        $this_parent = get_term( $this_parent_ID, 'gallery_category' );
                                        echo '<a href="'. get_term_link( $this_parent->slug, 'gallery_category' ) .'">'. $this_parent->name .'</a>';
                                    }
                                }

                                echo '<a href="'. $first_term_link .'">'. $first_term->name .'</a>';
                                //echo '<span>'. get_the_title() .'</span>';
                            }
                        } elseif ( $cpt->name == 'campaign' ) {
                            if ( is_singular( 'campaign' ) ) {
                                $this_terms = get_the_terms( $post->ID, 'campaign_category' );
                                $first_term = $this_terms[0];

                                echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                                echo '<a href="#">'. $first_term->name .'</a>';
                                echo '<span>'. get_the_title() .'</span>';
                            }
                        } elseif ( $cpt->name == 'product' ) {

                            if ( is_singular( 'product' ) ) {

                                    $shop_page_url = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
                                    $this_terms    = get_the_terms( $post->ID, 'product_cat' );

                                    $first_term         = $this_terms[0];
                                    $first_term_link    = get_term_link( $first_term->term_id,'product_cat' );
                                    $first_term_parents = get_ancestors( $first_term->term_id,'product_cat' );

                                    echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                                    echo '<a href="'. $shop_page_url .'">'. $product_text .'</a>';

                                    if ( is_array( $first_term_parents ) ) {
                                        foreach ( array_reverse( $first_term_parents ) as $this_parent_ID ) {
                                            $this_parent = get_term( $this_parent_ID, 'product_cat' );
                                            echo '<a href="'. get_term_link( $this_parent->slug, 'product_cat' ) .'">'. $this_parent->name .'</a>';
                                        }
                                    }

                                    echo '<a href="'. $first_term_link .'">'. $first_term->name .'</a>';
                                    echo '<span>'. get_the_title() .'</span>';
                            }
                        }

                }
            } else {
                if ( is_tax() ) {
                    echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                    echo '<span>'. sprintf( $tax_text, single_cat_title('', false) ) .'</span>';
                }
            }
        
    }

    if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { echo ' ('; }

        echo '<span>'. esc_html__( 'Page','fundrize' ) .' '. get_query_var('paged') .'</span>';

        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) { echo ')'; }
    }
} // End wprt_breadcrumbs()