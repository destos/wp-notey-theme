<?php get_header(); ?>

		<div id="container">
			<section id="content">
			<?php// get_template_part( 'loop', 'index' );	?>
			
			<?php
			if(have_posts()){
				the_post();
				get_template_part( 'type-post', 'full' );
			}?>
			
			</section><!-- #content -->
		
			<div id="sub_container">
				<section id="past">
				<?php
				/*
	// sub items.
				query_posts( array(
					'offset' => 1,
					'posts_per_page' => 4,
				) );
	*/
				
				if(have_posts()){
					while(have_posts()){
						the_post();
						get_template_part( 'type-post', 'excerpt' );
					}
				}
				
				// TODO If we have more posts to show link to archive.
				?>
				<?php get_template_part('nav', 'bottom'); ?>
				</section>
			</div>
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>