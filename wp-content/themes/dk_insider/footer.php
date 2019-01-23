		
		</div><!-- .wrapper -->
	</main>
	
	
	<!-- ====================
	       FOOTER 
	==================== -->
	<footer id="footer">
		<ul class="social-icons">
			<?php get_template_part('social_icons-list'); ?>
		</ul>
		
		<?php get_sidebar( 'footer' ); ?>
		
		<div class="bottom">
			<?php if ( get_theme_mod( 'insider_footer_text' ) ): ?> 
				<p><?php echo esc_attr( get_theme_mod( 'insider_footer_text' )); ?></p>
			<?php else: ?>
				<p><?php echo esc_attr( get_bloginfo( 'name' ) ); ?> &copy; <?php esc_html_e('Copyright','dk_insider'); ?> <?php echo date_i18n( 'Y' ); ?>. <?php esc_html_e('All rights reserved.','dk_insider'); ?></p>
			<?php endif; ?>
		</div>
	</footer>
</div><!-- #wrapperbox -->

<?php wp_footer(); ?>
</body>
</html>