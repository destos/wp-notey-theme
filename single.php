<?php get_header(); ?>

		<div id="container">
			<section id="content">
			<?php
			if ( have_posts() ) : the_post();

			// get post type
			get_template_part( 'type-'.get_post_type( get_the_ID() ), 'full' );
			
			endif; ?>
			</section><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>