<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  !is_home() ) : ?>
				<nav class="post-nav">
					<div class="nav-previous"><?php previous_post_link( __( '%link <span class="meta-nav">&rarr;</span>', 'notey' ) ); ?></div>
					<div class="nav-next"><?php next_post_link( __( '<span class="meta-nav">&larr;</span> %link', 'notey' ) ); ?></div>
				</nav><!-- .post-nav -->
<?php endif; ?>