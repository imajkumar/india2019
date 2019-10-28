<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'fundrize' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'fundrize' ); ?>" />
	<button type="submit" class="search-submit" title="<?php esc_html_e('Search', 'fundrize'); ?>"><?php esc_html_e('SEARCH', 'fundrize'); ?></button>
</form>
