<?php
class WPRT_Information extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'icon_style' => 'style-1',
            'title'                 => 'Contact',
            'address'            => '',
            'phone'            => '',
            'hour'            => '',
            'icon_color' => '',
            'icon_size' => '',
            'text_color' => '',
            'text_left_pad' => '',
            'bottom_margin' => '5px',
            'margin' => ''
        );

        parent::__construct(
            'widget_information',
            esc_html__( 'Information', 'fundrize' ),
            array(
                'classname'   => 'widget_information',
                'description' => esc_html__( 'Display Information', 'fundrize' )
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

        $icon = substr( $icon_style, -1 );

        $bottom_margin = intval( $bottom_margin );
        $text_left_pad = intval( $text_left_pad );
        
        $wrap_css = $css = $icon_css = $text_css = '';

        if ( ! empty( $margin ) ) $wrap_css .= 'margin:'. $margin .';';
        if ( ! empty( $bottom_margin ) ) $css .= 'margin-bottom:'. $bottom_margin .'px;';
        if ( ! empty( $icon_color ) ) $icon_css .= 'color:'. $icon_color .';';
        if ( ! empty( $icon_size ) ) $icon_css .= 'font-size:'. $icon_size .';';
        if ( ! empty( $text_color ) ) $text_css .= 'color:'. $text_color .';';
        if ( ! empty( $text_left_pad ) ) $text_css .= 'padding-left:'. $text_left_pad .'px;display:block;';
        ?>

        <ul class="clearfix <?php echo esc_attr( $icon_style ); ?>" style="<?php echo esc_attr( $wrap_css ); ?>">
            <?php
            if ( $address ) 
                printf( '<li class="address" style="%1$s"><i class="dd-%5$s-address" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $address ), $icon );

            if ( $phone ) 
                printf( '<li class="phone" style="%1$s"><i class="dd-%5$s-phone" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $phone ), $icon );

            if ( $hour ) 
                printf( '<li class="hour" style="%1$s"><i class="dd-%5$s-time" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $hour ), $icon );

            ?>
        </ul>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;

        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['address']         = strip_tags( $new_instance['address'] );
        $instance['phone']         = strip_tags( $new_instance['phone'] );
        $instance['hour']         = strip_tags( $new_instance['hour'] );
        $instance['icon_color']         = strip_tags( $new_instance['icon_color'] );
        $instance['icon_size']         = strip_tags( $new_instance['icon_size'] );       
        $instance['text_color']         = strip_tags( $new_instance['text_color'] );
        $instance['text_left_pad']         = strip_tags( $new_instance['text_left_pad'] );       
        $instance['bottom_margin']         = strip_tags( $new_instance['bottom_margin'] );
        $instance['margin']         = strip_tags( $new_instance['margin'] );
         $instance['icon_style']      = $new_instance['icon_style'];
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'fundrize' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_style' ) ); ?>"><?php esc_html_e( 'Icon Style', 'fundrize' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'icon_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_style' ) ); ?>">
                <option value="style-1" <?php selected( 'style-1', $instance['icon_style'] ); ?>><?php esc_html_e( 'Style 1', 'fundrize' ) ?></option>
                <option value="style-2" <?php selected( 'style-2', $instance['icon_style'] ); ?>><?php esc_html_e( 'Style 2', 'fundrize' ) ?></option>
                <option value="style-3" <?php selected( 'style-3', $instance['icon_style'] ); ?>><?php esc_html_e( 'Style 3', 'fundrize' ) ?></option>
                <option value="style-4" <?php selected( 'style-4', $instance['icon_style'] ); ?>><?php esc_html_e( 'Style 4', 'fundrize' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e('Address:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['address'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e('Phone:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['phone'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'hour' ) ); ?>"><?php esc_html_e('Hour:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hour' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hour' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['hour'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php esc_html_e('Icon Color (default: #ffb600):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>"><?php esc_html_e('Icon: Font Size (ex: 18px):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_size'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>"><?php esc_html_e('Text Color (ex: #e3e3e3):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['text_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_left_pad' ) ); ?>"><?php esc_html_e('Text: Left Padding (ex: 10px):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_left_pad' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_left_pad' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['text_left_pad'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>"><?php esc_html_e('Item Bottom Margin (ex: 15px):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bottom_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['bottom_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>"><?php esc_html_e('Wrap Margin: (ex: 0px 50px 0px 0px)', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['margin'] ); ?>">
        </p>
    <?php
    }
}
add_action( 'widgets_init', 'register_wprt_information' );

// Register widget
function register_wprt_information() {
    register_widget( 'WPRT_Information' );
}


