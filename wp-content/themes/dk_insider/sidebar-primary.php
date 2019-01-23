<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	
	<aside id="sidebar">
		<div class="widgets">		
			<?php dynamic_sidebar( 'sidebar' );  ?>
		</div>
	</aside>

<?php endif; ?>