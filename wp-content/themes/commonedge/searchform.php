<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="searchfield" class="search-field" placeholder="Search here&hellip;" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit" value="Search" /><img src="<?php echo get_stylesheet_directory_uri() ?>/images/search.svg" alt="Search"></button>
</form>
