<?php get_template_part('post-nav', 'top'); ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'notey' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'notey' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'notey' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<div class="entry-meta">
			<?php// echo notey_posted_on(); ?>
		</div><!-- .entry-meta -->

<?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
		<div class="entry-summary">
			<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'notey' ) ); ?>
		</div><!-- .entry-summary -->
<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'notey' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'notey' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
<?php endif; ?>

		<div class="entry-utility">
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
		</div><!-- #entry-utility -->
	</div><!-- #post-<?php the_ID(); ?> -->

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

<?php get_template_part('post-nav', 'bottom'); ?>