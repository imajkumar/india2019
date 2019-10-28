<?php
class WPRT_instagram extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Instagram Feed',
            'username'  => '', 
            'count'     => '9',
            'item_column' => '3',
            'gutter'    => '1'  
        );

        parent::__construct(
            'widget_instagram',
            esc_html__( 'Instagram Feed', 'fundrize' ),
            array(
                'classname'   => 'widget_instagram',
                'description' => esc_html__( 'Display images from Instagram.', 'fundrize' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );
        
        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

        $item_column = 'col'. $item_column;
        $gutter = 'g'. $gutter;

        if ( $username != '' ) {
            $media_array = $this->scrape_instagram( $username, $count );

            if ( is_wp_error( $media_array ) ) {
                echo esc_attr($media_array->get_error_message());
            } else {
                echo '<div class="instagram-wrap clearfix ' . $item_column .' '. $gutter .'">';
                foreach ( $media_array as $item ) {
                    echo '<div class="instagram_badge_image"><a href="'. esc_url( $item['link'] ) .'" target="_blank"><div class="item"><img src="'.esc_url( $item['thumbnail'] ).'"  alt="image" /></div></a></div>';
                }
                echo '</div>';
            }
        }

		echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['username']   = strip_tags( $new_instance['username'] );
        $instance['count']      = intval( $new_instance['count'] );
        $instance['item_column']      = $new_instance['item_column'];
        $instance['gutter']      = $new_instance['gutter'];
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'fundrize' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'fundrize' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['username'] ); ?>" />
        </p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'fundrize' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>"><?php esc_html_e( 'Number of column?', 'fundrize' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_column' ) ); ?>">
                <option value="2" <?php selected( '2', $instance['item_column'] ); ?>><?php esc_html_e( '2', 'fundrize' ) ?></option>
                <option value="3" <?php selected( '3', $instance['item_column'] ); ?>><?php esc_html_e( '3', 'fundrize' ) ?></option>
                <option value="4" <?php selected( '4', $instance['item_column'] ); ?>><?php esc_html_e( '4', 'fundrize' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'gutter' ) ); ?>"><?php esc_html_e( 'Gutter', 'fundrize' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'gutter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gutter' ) ); ?>">
                <option value="0" <?php selected( '0', $instance['gutter'] ); ?>><?php esc_html_e( '0', 'fundrize' ) ?></option>
                <option value="1" <?php selected( '1', $instance['gutter'] ); ?>><?php esc_html_e( '1', 'fundrize' ) ?></option>
                <option value="5" <?php selected( '5', $instance['gutter'] ); ?>><?php esc_html_e( '5', 'fundrize' ) ?></option>
                <option value="12" <?php selected( '12', $instance['gutter'] ); ?>><?php esc_html_e( '12', 'fundrize' ) ?></option>
                <option value="15" <?php selected( '15', $instance['gutter'] ); ?>><?php esc_html_e( '15', 'fundrize' ) ?></option>
            </select>
        </p>
    <?php
    }

    function scrape_instagram( $username, $slice = 12 ) {

        $username = strtolower( $username );

        if ( false === ( $instagram = get_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ) ) ) ) {

            $remote = wp_remote_get( 'http://instagram.com/' . trim( $username ) );

            if ( is_wp_error( $remote ) )
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'fundrize' ) );

            if ( 200 != wp_remote_retrieve_response_code( $remote ) )
                return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'fundrize' ) );

            $shards = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], TRUE );

            if ( ! $insta_array )
                return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'fundrize' ) );

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
            } else {
                return new WP_Error( 'bad_josn_2', esc_html__( 'Instagram has returned invalid data.', 'fundrize' ) );
            }

            if ( ! is_array( $images ) )
                return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'fundrize' ) );

            $instagram = array();
            
            foreach ( $images as $image ) {

                $image['thumbnail_src'] = preg_replace( "/^http:/i", "", $image['thumbnail_src'] );
                
                if ( ! isset( $image['caption'] ) )
                    $image['caption'] = array();
            
                if ( $image['is_video']  == true ) {
                    $type = 'video';
                } else {
                    $type = 'image';
                }

                $instagram[] = array(
                    'description'   => $image['caption'],
                    'link'          => '//instagram.com/p/' . $image['code'],
                    'time'          => $image['date'],
                    'comments'      => $image['comments']['count'],
                    'likes'         => $image['likes']['count'],
                    'thumbnail'     => $image['thumbnail_src'],
                    'type'          => $type
                );
            }

            // do not set an empty transient - should help catch private or empty accounts
            if ( ! empty( $instagram ) ) {
                $instagram = serialize( $instagram );
                set_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ), $instagram, 1 * HOUR_IN_SECONDS );
            }
        }

        if ( ! empty( $instagram ) ) {
            $instagram = unserialize( $instagram );
            return array_slice( $instagram, 0, $slice );

        } else {
            return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'fundrize' ) );
        }
    }
}
add_action( 'widgets_init', 'register_wprt_instagram' );

// Register widget
function register_wprt_instagram() {
    register_widget( 'WPRT_instagram' );
}


