<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract( shortcode_atts( array(
	'alignment' => 'text-center',
	'image_crop' => 'rectangle',
	'content_padding' => '',
	'content_background' => '#f6f6f6',
	'hide_meta' => '',
	'box_shadow' => '',
	'excerpt_lenght' => '15',
	'column'		=> '3c',
	'column2'		=> '2c',
	'column3'		=> '1c',
	'items'		=> '3',
	'gap'		=> '30',
	'auto_scroll' => 'false',
	'show_bullets' => '',
	'show_arrows' => '',
	'bullet_show' => 'bullet-square',
	'bullet_between' => '50',
    'arrow_offset' => 'center',
    'arrow_offset_v' => '0',
	'cat_slug' => '',
	'heading_font_family' => 'Default',
	'heading_font_weight' => 'Default',
	'heading_color' => '',
	'heading_font_size' => '',
	'heading_line_height' => '',
	'desc_font_family' => 'Default',
	'desc_font_weight' => 'Default',
	'desc_color' => '',
	'desc_font_size' => '',
	'desc_line_height' => '',
	'button_font_family' => 'Default',
	'button_font_weight' => 'Default',
	'button_font_size' => '',
	'button_line_height' => '',
	'button_style' => 'accent',
	'button_size' => 'small',
	'button_rounded' => '',
	'link_color' => '',
	'button_text' => 'READ MORE',
	'heading_top_margin' => '',
	'heading_bottom_margin' => '',
	'desc_top_margin' => '',
	'desc_bottom_margin' => '',
), $atts ) );
$content = wpb_js_remove_wpautop($content, true);

$items = intval( $items );
$gap = intval( $gap );
$column = intval( $column );
$column2 = intval( $column2 );
$column3 = intval( $column3 );

$excerpt_lenght = intval( $excerpt_lenght );
$heading_line_height = intval( $heading_line_height );
$desc_line_height = intval( $desc_line_height );
$button_line_height = intval( $button_line_height );
$button_rounded = intval( $button_rounded );

$heading_font_size = intval( $heading_font_size );
$desc_font_size = intval( $desc_font_size );
$button_font_size = intval( $button_font_size );

$heading_top_margin = intval( $heading_top_margin );
$heading_bottom_margin = intval( $heading_bottom_margin );
$desc_top_margin = intval( $desc_top_margin );
$desc_bottom_margin = intval( $desc_bottom_margin );

$item_css = $content_css = $heading_css = $desc_css = $button_css = '';

if ( empty( $items ) )
	return;

$cls = 'arrow-center '. $alignment .' '. $bullet_show .' ';
$cls .= 'offset'. $arrow_offset .' offset-v'. $arrow_offset_v;

if ( $box_shadow ) $cls .= ' has-shadow';

if ( $content_padding ) $content_css .= 'padding:'. $content_padding .';';
if ( $content_background ) $item_css .= 'background-color:'. $content_background .';';

if ( $show_bullets ) $cls .= ' has-bullets'; 
if ( $show_arrows ) $cls .= ' has-arrows';

if ( $bullet_between == '45' ) $cls .= ' bullet45';
if ( $bullet_between == '40' ) $cls .= ' bullet40';
if ( $bullet_between == '35' ) $cls .= ' bullet35';
if ( $bullet_between == '30' ) $cls .= ' bullet30';
if ( $bullet_between == '25' ) $cls .= ' bullet25';
if ( $bullet_between == '20' ) $cls .= ' bullet20';
if ( $bullet_between == '15' ) $cls .= ' bullet15';
if ( $bullet_between == '10' ) $cls .= ' bullet10';

if ( $heading_font_weight != 'Default' ) $heading_css .= 'font-weight:'. $heading_font_weight .';';
if ( $heading_color ) $heading_css .= 'color:'. $heading_color .';';
if ( $heading_font_size ) $heading_css .= 'font-size:'. $heading_font_size .'px;';
if ( $heading_line_height ) $heading_css .= 'line-height:'. $heading_line_height .'px;';
if ( $heading_top_margin ) $heading_css .= 'margin-top:'. $heading_top_margin .'px;';
if ( $heading_bottom_margin ) $heading_css .= 'margin-bottom:'. $heading_bottom_margin .'px;';
if ( $heading_font_family != 'Default' ) {
	wprt_enqueue_google_font( $heading_font_family );
	$heading_css .= 'font-family:'. $heading_font_family .';';
}

if ( $desc_font_weight != 'Default' ) $desc_css .= 'font-weight:'. $desc_font_weight .';';
if ( $desc_color ) $desc_css .= 'color:'. $desc_color .';';
if ( $desc_font_size ) $desc_css .= 'font-size:'. $desc_font_size .'px;';
if ( $desc_line_height ) $desc_css .= 'line-height:'. $desc_line_height .'px;';
if ( $desc_top_margin ) $desc_css .= 'margin-top:'. $desc_top_margin .'px;';
if ( $desc_bottom_margin ) $desc_css .= 'margin-bottom:'. $desc_bottom_margin .'px;';
if ( $desc_font_family != 'Default' ) {
	wprt_enqueue_google_font( $desc_font_family );
	$desc_css .= 'font-family:'. $desc_font_family .';';
}

if ( $button_font_weight != 'Default' ) $button_css .= 'font-weight:'. $button_font_weight .';';
if ( $link_color ) $button_css .= 'color:'. $link_color .';';
if ( $button_rounded ) $button_css .= 'border-radius:'. $button_rounded .'px;';
if ( $button_font_size ) $button_css .= 'font-size:'. $button_font_size .'px;';
if ( $button_line_height ) $button_css .= 'line-height:'. $button_line_height .'px;';
if ( $button_font_family != 'Default' ) {
	wprt_enqueue_google_font( $button_font_family );
	$button_css .= 'font-family:'. $button_font_family .';';
}

$button_cls = $button_size;
if ( $button_style == 'simple_link' ) $button_cls .= ' simple-link';
if ( $button_style == 'accent' ) $button_cls .= ' wprt-button accent small';
if ( $button_style == 'dark' ) $button_cls .= ' wprt-button small dark';
if ( $button_style == 'light' ) $button_cls .= ' wprt-button small light';
if ( $button_style == 'very-light' ) $button_cls .= ' wprt-button small very-light';
if ( $button_style == 'white' ) $button_cls .= ' wprt-button small white';
if ( $button_style == 'outline' ) $button_cls .= ' wprt-button small outline ol-accent';
if ( $button_style == 'outline_dark' ) $button_cls .= ' wprt-button small outline dark';
if ( $button_style == 'outline_light' ) $button_cls .= ' wprt-button small outline light';
if ( $button_style == 'outline_very-light' ) $button_cls .= ' wprt-button small outline very-light';
if ( $button_style == 'outline_white' ) $button_cls .= '  wprt-button small outline white';

$query_args = array(
    'post_type' => 'post',
    'posts_per_page' => $items
);

if ( ! empty( $cat_slug ) )
	$query_args['category_name'] = $cat_slug;

$query = new WP_Query( $query_args );
if ( ! $query->have_posts() ) { return; }
ob_start(); ?>

<div class="wprt-news <?php echo esc_attr( $cls ); ?>" data-auto="<?php echo esc_attr( $auto_scroll ); ?>" data-column="<?php echo esc_attr( $column ); ?>" data-column2="<?php echo esc_attr( $column2 ); ?>" data-column3="<?php echo esc_attr( $column3 ); ?>" data-gap="<?php echo esc_html( $gap ); ?>">
<?php if ( $query->have_posts() ) : ?>
	<?php wp_enqueue_script( 'wprt-owlcarousel' ); ?>

	<div class="owl-carousel owl-theme">
	    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    	<div class="news-item clearfix">
    		<div class="inner"  style="<?php echo esc_attr( $item_css ); ?>">
    			<?php
    			if ( has_post_thumbnail() ) {
			    	$img_size = 'wprt-rectangle';
					if ( $image_crop == 'square' ) $img_size = 'wprt-square';
					if ( $image_crop == 'rectangle2' ) $img_size = 'wprt-rectangle2';
					if ( $image_crop == 'bloggrid' ) $img_size = 'wprt-post-grid';

					echo get_the_post_thumbnail( get_the_ID(), $img_size );
    			} ?>

                <div class="text-wrap" style="<?php echo esc_attr( $content_css ); ?>">
					<?php
					if ( get_the_title() ) {
						echo '<h3 class="title" style="'. esc_attr( $heading_css ) .'"><a href="'. esc_url( get_the_permalink() ) .'">'. get_the_title() .'</a></h3>';
					}

					if ( empty( $hide_meta ) ) {
						echo '<div class="meta"><span class="post-date">'. get_the_date() .'</span></div>';
					}

					if ( $excerpt_lenght ) {
						echo '<p class="excerpt" style="'. esc_attr( $desc_css ) .'">'. wp_trim_words( get_the_content(), $excerpt_lenght, '&hellip;' ) .'</p>';
					}

					if ( $button_text ) {
						echo '<div class="post-btn"><a href="'. esc_url( get_permalink() ) .'" class="'. esc_attr( $button_cls ) .'" style="'. esc_attr( $button_css ) .'">'. esc_html( $button_text ) .'</a></div>';
					}
					?>
                </div><!-- /.text-wrap -->
            </div>
        </div><!-- /.news-item -->
		<?php endwhile; ?>
	</div><!-- /.owl-carousel -->

<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div><!-- /.wprt-news -->
<?php
$return = ob_get_clean();
echo $return;