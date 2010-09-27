	<article id="post-<?php the_ID(); ?>" <?php post_class( 'full' ); ?>>
		
		<header>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'notey' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
		
<?php get_template_part('entry-utility'); ?>
		
		<section class="entry">
			<?php the_content(); ?>
		</section><!-- .entry -->
		
		<?php if(is_single()){ ?>
		<?php get_template_part('nav', 'post'); ?>	
		<section class="comments">
			<?php comments_template( '', true ); ?>
		</section>
		<?php } ?>
		
<!--
<?php trackback_rdf(); ?>
-->
		
	</article><!-- #post-<?php the_ID(); ?> -->