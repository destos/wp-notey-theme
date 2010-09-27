<?php get_header(); ?>

		<div id="container">
			<section id="content">
			<?php //get_template_part('nav', 'top'); ?>
			
			<?php /* If there are no posts to display, such as an empty archive page */ ?>
			<?php if ( ! have_posts() ) : ?>
				<article id="post-0" class="post error404 not-found">
					<header>
					<h1 class="entry-title"><?php _e( 'Not Found', 'notey' ); ?></h1>
					</header>
					<section class="entry">
						<p><?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'notey' ); ?></p>
						
						<?php get_template_part('search-page', 'index'); ?>
						
					</section><!-- .entry-content -->
				</article><!-- #post-0 -->
			<?php endif; ?>
			
			<?php /* Start the Loop */ 
			
			while ( have_posts() ) : the_post();
			
			// get post type
			get_template_part( 'type-'.get_post_type( get_the_ID() ), 'excerpt' );
			
			endwhile; ?>
			
			<?php get_template_part('nav', 'bottom'); ?>
			</section><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

