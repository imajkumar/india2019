<?php
class WPRT_Links extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title'                 => 'Short Navigation',
            'link_color'            => '',
            'column'                => 1,
            'item_count'            => 4,
            'arrow_style'           => 1,
            'bottom_margin'         => '',
            'icon_color' => '',
            'link_text1'            => 'Link item 1',
            'link_text2'            => 'Link item 2',
            'link_text3'            => 'Link item 3',
            'link_text4'            => 'Link item 4',
            'link_text5'            => 'Link item 5',
            'link_text6'            => 'Link item 6',
            'link_text7'            => 'Link item 7',
            'link_text8'            => 'Link item 8',
            'link_text9'            => 'Link item 9',
            'link_text10'           => 'Link item 10',
            'link_text11'           => 'Link item 11',
            'link_text12'           => 'Link item 12',
            'link_text13'           => 'Link item 13',
            'link_text14'           => 'Link item 14',
            'link_url1'             => 'http://your-link.com',
            'link_url2'             => 'http://your-link.com',
            'link_url3'             => 'http://your-link.com',
            'link_url4'             => 'http://your-link.com',
            'link_url5'             => 'http://your-link.com',
            'link_url6'             => 'http://your-link.com',
            'link_url7'             => 'http://your-link.com',
            'link_url8'             => 'http://your-link.com',
            'link_url9'             => 'http://your-link.com',
            'link_url10'            => 'http://your-link.com',
            'link_url11'            => 'http://your-link.com',
            'link_url12'            => 'http://your-link.com',
            'link_url13'            => 'http://your-link.com',
            'link_url14'            => 'http://your-link.com',
        );

        parent::__construct(
            'widget_links',
            esc_html__( 'Links', 'fundrize' ),
            array(
                'classname'   => 'widget_links',
                'description' => esc_html__( 'Display Links', 'fundrize' )
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

        if ( $link_color )
            $link_color = 'color:'. $link_color;

        $cls = ( $column == 2 ) ? 'col2' : '';
        $link_text = '';
        $link_url = '';
        $arrow = '';

        $bottom_margin = intval( $bottom_margin );

        $css = '';
          if ( ! empty( $bottom_margin ) )
            $css = 'margin-bottom:'. $bottom_margin .'px';
       
        $icon_css = '';
        if ( ! empty( $icon_color ) )
            $icon_css = 'color:'. $icon_color;

        switch ( $arrow_style ) {
            case 1: $arrow = 'angle-right'; break;
            case 2: $arrow = 'check'; break;
            case 3: $arrow = 'angle-double-right'; break;
            case 4: $arrow = 'arrow-circle-o-right'; break;
            case 5: $arrow = 'arrow-circle-right'; break;
            case 6: $arrow = 'chevron-circle-right'; break;
            case 7: $arrow = 'arrow-right'; break;
            case 8: $arrow = 'chevron-right'; break;
            case 9: $arrow = 'check-square'; break;
            case 10: $arrow = 'check-circle'; break;
            case 11: $arrow = 'check-circle-o'; break;
            case 12: $arrow = 'circle-o'; break;
            case 13: $arrow = 'circle-thin'; break;
            case 14: $arrow = 'check-square-o'; break;
            case 15: $arrow = 'caret-right'; break;
        }
        ?>
        <ul class="wprt-links clearfix <?php echo esc_attr( $cls ); ?>">
            <?php for ( $i = 1; $i <= $item_count; $i++ ) {
                switch ( $i ) {
                    case 1:
                        $link_text = $link_text1;
                        $link_url = $link_url1;
                        break;
                    case 2:
                        $link_text = $link_text2;
                        $link_url = $link_url2;
                        break;
                    case 3:
                        $link_text = $link_text3;
                        $link_url = $link_url3;
                        break;
                    case 4:
                        $link_text = $link_text4;
                        $link_url = $link_url4;
                        break;
                    case 5:
                        $link_text = $link_text5;
                        $link_url = $link_url5;
                        break;
                    case 6:
                        $link_text = $link_text6;
                        $link_url = $link_url6;
                        break;
                    case 7:
                        $link_text = $link_text7;
                        $link_url = $link_url7;
                        break;
                    case 8:
                        $link_text = $link_text8;
                        $link_url = $link_url8;
                        break;
                    case 9:
                        $link_text = $link_text9;
                        $link_url = $link_url9;
                        break;
                    case 10:
                        $link_text = $link_text10;
                        $link_url = $link_url10;
                        break;
                    case 11:
                        $link_text = $link_text11;
                        $link_url = $link_url11;
                        break;
                    case 12:
                        $link_text = $link_text12;
                        $link_url = $link_url12;
                        break;
                    case 13:
                        $link_text = $link_text13;
                        $link_url = $link_url13;
                        break;
                    case 14:
                        $link_text = $link_text14;
                        $link_url = $link_url14;
                        break;
                }

                if ( $link_url && $link_text ) 
                    printf( '
                        <li style="%5$s">
                            <a href="%1$s" style="%6$s">
                                <i class="fa fa-%3$s" style="%4$s"></i>
                                %2$s
                            </a>
                        </li>',
                        esc_url( $link_url ),
                        esc_html( $link_text ),
                        $arrow,
                        $icon_css,
                        $css,
                        $link_color
                    );
            } ?>
        </ul>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;

        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['link_color']         = strip_tags( $new_instance['link_color'] );
        $instance['column']             = $new_instance['column'];
        $instance['item_count']         = $new_instance['item_count'];
        $instance['icon_color']         = strip_tags( $new_instance['icon_color'] );
        $instance['arrow_style']        = $new_instance['arrow_style'];
        $instance['bottom_margin']      = strip_tags( $new_instance['bottom_margin'] );

        $instance['link_text1']         = strip_tags( $new_instance['link_text1'] );
        $instance['link_text2']         = strip_tags( $new_instance['link_text2'] );
        $instance['link_text3']         = strip_tags( $new_instance['link_text3'] );
        $instance['link_text4']         = strip_tags( $new_instance['link_text4'] );
        $instance['link_text5']         = strip_tags( $new_instance['link_text5'] );
        $instance['link_text6']         = strip_tags( $new_instance['link_text6'] );
        $instance['link_text7']         = strip_tags( $new_instance['link_text7'] );
        $instance['link_text8']         = strip_tags( $new_instance['link_text8'] );
        $instance['link_text9']         = strip_tags( $new_instance['link_text9'] );
        $instance['link_text10']        = strip_tags( $new_instance['link_text10'] );
        $instance['link_text11']        = strip_tags( $new_instance['link_text11'] );
        $instance['link_text12']        = strip_tags( $new_instance['link_text12'] );
        $instance['link_text13']        = strip_tags( $new_instance['link_text13'] );
        $instance['link_text14']        = strip_tags( $new_instance['link_text14'] );

        $instance['link_url1']         = strip_tags( $new_instance['link_url1'] );
        $instance['link_url2']         = strip_tags( $new_instance['link_url2'] );
        $instance['link_url3']         = strip_tags( $new_instance['link_url3'] );
        $instance['link_url4']         = strip_tags( $new_instance['link_url4'] );
        $instance['link_url5']         = strip_tags( $new_instance['link_url5'] );
        $instance['link_url6']         = strip_tags( $new_instance['link_url6'] );
        $instance['link_url7']         = strip_tags( $new_instance['link_url7'] );
        $instance['link_url8']         = strip_tags( $new_instance['link_url8'] );
        $instance['link_url9']         = strip_tags( $new_instance['link_url9'] );
        $instance['link_url10']        = strip_tags( $new_instance['link_url10'] );
        $instance['link_url11']        = strip_tags( $new_instance['link_url11'] );
        $instance['link_url12']        = strip_tags( $new_instance['link_url12'] );
        $instance['link_url13']        = strip_tags( $new_instance['link_url13'] );
        $instance['link_url14']        = strip_tags( $new_instance['link_url14'] );
        
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
            <label for="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>"><?php esc_html_e( 'Number of column', 'fundrize' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column' ) ); ?>">
                <option value="1" <?php selected( '1', $instance['column'] ); ?>><?php esc_html_e( '1', 'fundrize' ) ?></option>
                <option value="2" <?php selected( '2', $instance['column'] ); ?>><?php esc_html_e( '2', 'fundrize' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item_count' ) ); ?>"><?php esc_html_e( 'Number of links to show', 'fundrize' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'item_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_count' ) ); ?>">
                <option value="1" <?php selected( '1', $instance['item_count'] ); ?>><?php esc_html_e( '1', 'fundrize' ) ?></option>
                <option value="2" <?php selected( '2', $instance['item_count'] ); ?>><?php esc_html_e( '2', 'fundrize' ) ?></option>
                <option value="3" <?php selected( '3', $instance['item_count'] ); ?>><?php esc_html_e( '3', 'fundrize' ) ?></option>
                <option value="4" <?php selected( '4', $instance['item_count'] ); ?>><?php esc_html_e( '4', 'fundrize' ) ?></option>
                <option value="5" <?php selected( '5', $instance['item_count'] ); ?>><?php esc_html_e( '5', 'fundrize' ) ?></option>
                <option value="6" <?php selected( '6', $instance['item_count'] ); ?>><?php esc_html_e( '6', 'fundrize' ) ?></option>
                <option value="7" <?php selected( '7', $instance['item_count'] ); ?>><?php esc_html_e( '7', 'fundrize' ) ?></option>
                <option value="8" <?php selected( '8', $instance['item_count'] ); ?>><?php esc_html_e( '8', 'fundrize' ) ?></option>
                <option value="9" <?php selected( '9', $instance['item_count'] ); ?>><?php esc_html_e( '9', 'fundrize' ) ?></option>
                <option value="10" <?php selected( '10', $instance['item_count'] ); ?>><?php esc_html_e( '10', 'fundrize' ) ?></option>
                <option value="11" <?php selected( '11', $instance['item_count'] ); ?>><?php esc_html_e( '11', 'fundrize' ) ?></option>
                <option value="12" <?php selected( '12', $instance['item_count'] ); ?>><?php esc_html_e( '12', 'fundrize' ) ?></option>
                <option value="13" <?php selected( '13', $instance['item_count'] ); ?>><?php esc_html_e( '13', 'fundrize' ) ?></option>
                <option value="14" <?php selected( '14', $instance['item_count'] ); ?>><?php esc_html_e( '14', 'fundrize' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_color' ) ); ?>"><?php esc_html_e('Link Color (ex: #303030):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_color'] ); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php esc_html_e('Icon Color (ex: #303030):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>"><?php esc_html_e('Item Bottom Margin (ex: 5px):', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bottom_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['bottom_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'arrow_style' ) ); ?>"><?php esc_html_e( 'Arrow style', 'fundrize' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'arrow_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'arrow_style' ) ); ?>">
                <option value="1" <?php selected( '1', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 1', 'fundrize' ) ?></option>
                <option value="2" <?php selected( '2', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 2', 'fundrize' ) ?></option>
                <option value="3" <?php selected( '3', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 3', 'fundrize' ) ?></option>
                <option value="4" <?php selected( '4', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 4', 'fundrize' ) ?></option>
                <option value="5" <?php selected( '5', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 5', 'fundrize' ) ?></option>
                <option value="6" <?php selected( '6', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 6', 'fundrize' ) ?></option>
                <option value="7" <?php selected( '7', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 7', 'fundrize' ) ?></option>
                <option value="8" <?php selected( '8', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 8', 'fundrize' ) ?></option>
                <option value="9" <?php selected( '9', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 9', 'fundrize' ) ?></option>
                <option value="10" <?php selected( '10', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 10', 'fundrize' ) ?></option>
                <option value="11" <?php selected( '11', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 11', 'fundrize' ) ?></option>
                <option value="12" <?php selected( '12', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 12', 'fundrize' ) ?></option>
                <option value="13" <?php selected( '13', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 13', 'fundrize' ) ?></option>
                <option value="14" <?php selected( '14', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 14', 'fundrize' ) ?></option>
                <option value="15" <?php selected( '15', $instance['arrow_style'] ); ?>><?php esc_html_e( 'Style 15', 'fundrize' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text1' ) ); ?>"><?php esc_html_e('Link Text 1:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text1' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text1'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url1' ) ); ?>"><?php esc_html_e('Link URL 1:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url1' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url1'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text2' ) ); ?>"><?php esc_html_e('Link Text 2:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text2' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text2'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url2' ) ); ?>"><?php esc_html_e('Link URL 2:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url2' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url2'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text3' ) ); ?>"><?php esc_html_e('Link Text 3:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text3' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text3'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url3' ) ); ?>"><?php esc_html_e('Link URL 3:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url3' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url3'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text4' ) ); ?>"><?php esc_html_e('Link Text 4:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text4' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text4'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url4' ) ); ?>"><?php esc_html_e('Link URL 4:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url4' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url4' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url4'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text5' ) ); ?>"><?php esc_html_e('Link Text 5:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text5' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text5'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url5' ) ); ?>"><?php esc_html_e('Link URL 5:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url5' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url5' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url5'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text6' ) ); ?>"><?php esc_html_e('Link Text 6:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text6' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text6' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text6'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url6' ) ); ?>"><?php esc_html_e('Link URL 6:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url6' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url6' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url6'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text7' ) ); ?>"><?php esc_html_e('Link Text 7:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text7' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text7' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text7'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url7' ) ); ?>"><?php esc_html_e('Link URL 7:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url7' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url7' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url7'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text8' ) ); ?>"><?php esc_html_e('Link Text 8:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text8' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text8' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text8'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url8' ) ); ?>"><?php esc_html_e('Link URL 8:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url8' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url8' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url8'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text9' ) ); ?>"><?php esc_html_e('Link Text 9:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text9' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text9' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text9'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url9' ) ); ?>"><?php esc_html_e('Link URL 9:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url9' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url9' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url9'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text10' ) ); ?>"><?php esc_html_e('Link Text 10:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text10' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text10' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text10'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url10' ) ); ?>"><?php esc_html_e('Link URL 10:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url10' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url10' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url10'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text11' ) ); ?>"><?php esc_html_e('Link Text 11:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text11' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text11' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text11'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url11' ) ); ?>"><?php esc_html_e('Link URL 11:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url11' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url11' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url11'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text12' ) ); ?>"><?php esc_html_e('Link Text 12:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text12' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text12' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text12'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url12' ) ); ?>"><?php esc_html_e('Link URL 12:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url12' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url12' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url12'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text13' ) ); ?>"><?php esc_html_e('Link Text 13:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text13' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text13' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text13'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url13' ) ); ?>"><?php esc_html_e('Link URL 13:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url13' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url13' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url13'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_text14' ) ); ?>"><?php esc_html_e('Link Text 14:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text14' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text14' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_text14'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link_url14' ) ); ?>"><?php esc_html_e('Link URL 14:', 'fundrize') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url14' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url14' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['link_url14'] ); ?>">
        </p>
    <?php
    }
}
add_action( 'widgets_init', 'register_wprt_links' );

// Register widget
function register_wprt_links() {
    register_widget( 'WPRT_Links' );
}


