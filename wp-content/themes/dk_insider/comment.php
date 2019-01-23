<li <?php hybrid_attr( 'comment' ); ?>>

	<article>
		<?php echo get_avatar( $comment ); ?>
		
		<header class="comment-meta">
			<?php hybrid_comment_reply_link(); ?>
			<cite <?php hybrid_attr( 'comment-author' ); ?>><strong><?php comment_author_link(); ?></strong></cite> &nbsp; &bull; &nbsp; <time <?php hybrid_attr( 'comment-published' ); ?>><?php printf( esc_html__( '%s ago', 'dk_insider' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
		</header>
		
		<div <?php hybrid_attr( 'comment-content' ); ?>>
			<?php comment_text(); ?>
			<?php edit_comment_link(); ?>
		</div>
		
	</article>

<?php // No closing </li> is needed.  WordPress will know where to add it. ?>	