<?php

// --------------------------------------------------------
// My Shortlink implimentation. As of now it isn't done supprise!
//


class shortlink{
	
	function __construct(){
		
		// add filter for outputting shortlinks.
		add_filter( 'pre_get_shortlink', array( &$this, 'get_shortlink' ) );
		
		// load shortcodes
		$this->update_sl();
		
		// TODO: add meta menus to posts
		
		// TODO: add cron to run remove_sl
		// or only run on post delete hook?
	}
	
	function get_shortlink( $id, $context, $allow_slugs ){
	
		global $wp_query;
		$post_id = 0;
		if ( 'query' == $context && is_single() ) {
			$post_id = $wp_query->get_queried_object_id();
		} elseif ( 'post' == $context ) {
			$post = get_post($id);
			$post_id = $post->ID; 
		}
		
		// 
		if( $post_id === 0 )
			return false;		
		
		return $this->get_sl_byID( $post_id );
		
	}
	
	#TODO work on this.
	function set_sl( $post_id, $post_var = 'featured_chk'){
	
		$kind = 'featured_works';
		
		$old_special = ( is_array( get_option( $kind ) ) ) ? get_option( $kind ) : array();
		
		// are we adding to deleting this featured item?
		$set_special = (bool) $_POST[$post_var];
		
		// attempt to set it as featured,
		if( $set_special ){
			
			// if we are already featured ignore
			if(!is_special_work($post_id, $kind)){
				//$old_featured['debug'] = 'updating featured.';
				$new_special = array_unique( array_merge( (array) $post_id, $old_special ) );
			}else{
				//$old_featured['debug'] = 'featured set but not removing';
				$new_special = $old_special;
			}
			
		// attempt to unset it if set
		}elseif( is_special_work($post_id, $kind) and !$set_special ){
					
			$key = array_search( $post_id , $old_special );
			unset( $old_special[ $key ] );
			//$old_featured['debug'] = 'removing '.$post_id.' from featured';
			$new_special = $old_special;
			
		// if it doesn't exist just pass along the old featured list.
		}else{
			//$old_featured['debug'] = 'not updating or removing';
			$new_special = $old_special;
		}
		
		// update with new array of featured
		update_option( $kind, $new_special );
		
		return;
	
	}
	
	function update_sl(){
	
		$this->shortlinks = get_option('shortlinks');
		
	}
	
	function get_sl_byID( $id ){
		
		$id = intval( $id );
		
		if( isset( $this->shortlinks[$id] ) )
			return $this->shortlinks[$id];
			
		return false;
		
	}
	
	function generate_sl(  ){
		
	}
	
	// clears out shortcodes that have had their posts removed
	function remove_sl(){
		
	}
	
}