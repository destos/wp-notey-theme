<?php get_header(); ?>

		<div id="container">
			<section id="content">
			<?php if( have_posts() ){
				the_post(); ?>
				<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<header>
						<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'notey' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</header>
					
					<section class="entry">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'notey' ), 'after' => '</div>' ) ); ?>
						<div id="archives">
							<?php top::archives(); ?>
						</div>
					</section><!-- .entry -->
										
			<!--
			<?php trackback_rdf(); ?>
			-->
					
				</article><!-- #page-<?php the_ID(); ?> -->
			<?php } ?>
			</section><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
