<?php /* Start the Loop */ 

while ( have_posts() ) : the_post();
tmpl::get_post_type_template('full');
endwhile; ?>

<?php get_template_part('nav', 'bottom'); ?>