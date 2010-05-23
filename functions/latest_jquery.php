<?php
/**
 * Register a later version of jQuery if it's later than the one currently in WordPress
 * from: http://binarybonsai.com/2010/02/14/how-to-load-the-latest-jquery-in-wordpress/
 * modded a little bit to load form google
 * V 0.1
 * @param {String} our_version The version of jQuery we want to upgrade to if needed.
 */
 
 //add_action( 'wp_head', upgrade_jquery( '1.4', true ) );
 
function upgrade_jquery( $our_version, $from_google = false, $enque = false ) {
	// We want to use the latest version of jQuery, but it may break something in
	// the admin, so we only load it on the actual site.
	global $wp_scripts;
	
	//TODO: first check that file exists?
	
	if ( ( version_compare( $our_version, $wp_scripts->registered['jquery']->ver ) == 1 ) && !is_admin() ):
		wp_deregister_script( 'jquery' );
		
		if(!$from_google):
			wp_register_script( 'jquery', get_bloginfo('template_directory') . '/js/jquery-'.$our_version.'.min.js', false, $our_version);
		else:
			wp_register_script( 'jquery', ( 'http://ajax.googleapis.com/ajax/libs/jquery/'.$our_version.'/jquery.min.js' ), false, $our_version, false );
		endif;
		
	endif;
	
	if($enque)
		wp_enqueue_script( 'jquery' );
}

