	<article id="quote-<?php the_ID(); ?>" <?php post_class( 'excerpt' ); ?>>
		
<!--
		<header>
			<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'notey' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		</header>
-->
		
<?php //get_template_part('entry-utility'); ?>
				
		<section class="entry">
			<?php the_content(); ?>
		</section><!-- .entry -->
		<aside><cite><?php echo get_post_meta( get_the_ID(), 'quote_author', true ) ?></cite></aside>
<!--
<?php trackback_rdf(); ?>
-->
		
	</article><!-- #quote-<?php the_ID(); ?> -->