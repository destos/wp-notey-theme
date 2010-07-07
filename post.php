	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'notey' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div><?php tmpl::posted_on() ?></div>
		</header>
		<section class="entry">
			<?php the_content(); // __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'notey' ) ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'notey' ), 'after' => '</div>' ) ); ?>
		</section><!-- .entry -->
		
		<section class="entry-utility">
			<span class="cat-links">
				<span class="entry-utility-prep entry-utility-prep-cat-links">
				<?php
					printf( __('Posted in %s', 'notey' ), '</span> '.get_the_category_list( ', ' ) );
				?>					
			</span>
			<span class="meta-sep">|</span>
			<?php
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ):
			?>
				<span class="tag-links">
					<span class="entry-utility-prep entry-utility-prep-tag-links"><?php printf( __('Tagged %s', 'notey'), '</span> ' . $tags_list ); ?>
				</span>
				<span class="meta-sep">|</span>
			<?php endif; ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'notey' ), __( '1 Comment', 'notey' ), __( '% Comments', 'notey' ) ); ?></span>
			<?php edit_post_link( __( 'Edit', 'notey' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</section><!-- .entry-utility -->
		
		<section class="comments">
			<?php comments_template( '', true ); ?>
		</section>
		
	</article><!-- #post-<?php the_ID(); ?> -->