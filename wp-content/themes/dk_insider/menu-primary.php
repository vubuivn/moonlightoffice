<?php
if ( has_nav_menu( 'primary' )) :
	// User has assigned menu to this location
	wp_nav_menu( array(
		'container' => '',
		'theme_location' => 'primary',
		'items_wrap' => '<ul>%3$s</ul>',
		'fallback_cb' => '' ) );
		
else:
	// Output all pages' links
	echo '<ul>';
	wp_list_pages( 'sort_column=menu_order&depth=0&title_li=&exclude=' );
	echo '</ul>';
	
endif;