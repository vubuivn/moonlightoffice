</div>
<article>
	<div class="entry-content loop-error">
		
		<?php if( is_404() ): ?>	
		
		<h1><a class="mega404"><?php esc_html_e( '404', 'dk_insider' ); ?></a></h1>
		<h2><?php esc_html_e( 'Oops!... Something went wrong', 'dk_insider' ); ?></h2>
		<p><?php esc_html_e( 'This page cannot be found.', 'dk_insider' ); ?></p>
		<p><a href="#" onclick="window.history.go(-1)" class="button">&larr; <?php esc_html_e( 'Go to Previous Page', 'dk_insider' ); ?></a></p>
	
	
		<?php else: ?>

		<h2><?php esc_html_e( 'Nothing found', 'dk_insider' ); ?></h2>
		<p><?php esc_html_e( 'We are sorry. There are no pages with this search term on our site. Want to search for something else?', 'dk_insider' ); ?></p>
		<?php get_search_form(); ?>
		<p><a href="#" onclick="window.history.go(-1)" class="button">&larr;  <?php esc_html_e( 'Go to Previous Page', 'dk_insider' ); ?></a></p>
		
		<?php endif; ?>
	</div>
</article>