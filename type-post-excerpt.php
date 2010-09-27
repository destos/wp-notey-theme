	<article id="post-<?php the_ID(); ?>" <?php post_class( 'excerpt' ); ?>>
		
		<header>
			<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'notey' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		</header>
		
<?php get_template_part('entry-utility'); ?>
				
		<section class="entry">
			<?php the_excerpt(); ?>
		</section><!-- .entry -->

<!--
<?php trackback_rdf(); ?>
-->
		
	</article><!-- #post-<?php the_ID(); ?> -->