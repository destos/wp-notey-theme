<?php get_header(); ?>

		<div id="container">
		
			<section id="content" class="container">
				<div class="row">
				
					<div class="eightcol">					
					<?php
					if(have_posts()){
						the_post();
						tmpl::get_post_type_template('full');
					}?>
					</div><!-- end .eightcol -->
					
					<aside id="top-sidebar" class="fourcol last">
						<?php get_sidebar('top'); ?>
					</aside><!-- end .fourcol -->
					
				</div><!-- end .row -->
			</section><!-- end #content -->
		
			<div id="sub_container" class="container">
				<div class="row">
				
					<section id="past" class="eightcol">
					<?php
					
					if(have_posts()){
						while(have_posts()){
							the_post();
							tmpl::get_post_type_template('excerpt');
						}
					}
					
					?>
					<?php get_template_part('nav', 'bottom'); ?>
					</section>
					
					<aside id="bottom-sidebar" class="fourcol last">
						<?php get_sidebar('bottom'); ?>
					</aside><!-- end .fourcol -->
					
				</div><!-- end eightcol -->
				
			</div><!-- end .row -->
		</div><!-- end #container -->
		

<?php get_footer(); ?>