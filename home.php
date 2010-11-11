<?php get_header(); ?>

		<div id="container">
			<section id="content" class="container">
				<div class="row">
					<div class="eightcol">
					<?php// get_template_part( 'loop', 'index' );	?>
					
					<?php
					if(have_posts()){
						the_post();
						get_template_part( 'type-post', 'full' );
					}?>
					</div>
					<div class="fourcol last">
						<h3>This is a 5 col</h3>
					</div>
				</div>
			</section><!-- #content -->
		
			<div id="sub_container" class="container">
				<div class="row">
				<section id="past" class="eightcol">
				<?php
				
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
			</div>
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>