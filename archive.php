<?php get_header(); ?>

		<div id="container">
			<section id="content">
<?php
	if ( have_posts() )
the_post();
?>

			<h1 class="page-title">
<?php if ( is_day() ) :
	 printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() );
elseif ( is_month() ) :
	printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date('F Y') );
elseif ( is_year() ) :
	printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date('Y') );
elseif ( is_tag() ) :
	printf( __( 'Tag Archives: %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' );
elseif ( is_category() ):
	printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
else :
	_e( 'Blog Archives', 'twentyten' );
endif; ?>
			</h1>
			
<?php

if( is_tag() || is_category() ){
	$description = term_description();
	if ( ! empty( $description ) )
		echo '<div class="archive-meta">' . $description . '</div>';
}

// TDOD archive Feed link

rewind_posts();
			?>
			<?php //get_template_part('nav', 'top'); ?>
			<?php			
			while ( have_posts() ) : the_post();
			
			// get post type
			get_template_part( 'type-'.get_post_type( get_the_ID() ), 'excerpt' );
			
			endwhile; ?>
			
			<?php get_template_part('nav', 'bottom'); ?>
			</section><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

