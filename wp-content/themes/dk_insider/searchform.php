<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" id="searchbar">
	<fieldset>
		<input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr( 'Search', 'dk_insider' ); ?>" />
		<button type="button"><svg width="17" height="17" viewBox="0 0 17 17"><circle cx="7.7" cy="7.5" r="6.7" fill="none" stroke="#000" stroke-width="2"/><path d="M11.7 11.8a.9.9 0 0 1 1.3 0l3.7 3.7a.9.9 0 0 1 0 1.2.9.9 0 0 1-1.2 0L11.7 13a.9.9 0 0 1 0-1.2z" fill-rule="evenodd"/></svg></button>
	</fieldset>
</form>