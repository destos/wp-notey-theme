<?php /* Start the Loop */ 

while ( have_posts() ) : the_post();

// get post type
get_template_part( 'type-'.get_post_type( get_the_ID() ), 'full' );

endwhile; ?>

<?php get_template_part('nav', 'bottom'); ?>