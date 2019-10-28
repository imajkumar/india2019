<?php
// Get layout position
$layout = wprt_layout_position();
if ( $layout == 'no-sidebar' )
	return;
?>

<div id="sidebar">
	<div id="inner-sidebar" class="inner-content-wrap">
		<?php
		$sidebar = 'sidebar-blog';

		if ( is_page() && wprt_metabox('page_sidebar') )
			$sidebar = wprt_metabox('page_sidebar');

		if ( wprt_is_woocommerce_page() )
			$sidebar = 'sidebar-shop';

		if ( is_active_sidebar( $sidebar ) )
			dynamic_sidebar( $sidebar );		
		?>
	</div><!-- /#inner-sidebar -->
</div><!-- /#sidebar -->
