<?php

// --------------------------------------------------------
// My Shortlink implimentation. As of now it isn't done supprise!
//


class shortlink{
	
	private $_shortlink_option = 'notey_shortlinks';
	private $_shortlinks	;
	
	function __construct(){
		
		// add filter for outputting shortlinks.
		add_filter( 'pre_get_shortlink',	array( &$this, 'get_shortlink' ) );
		
		// remove shortlink on post delete
		add_action( 'delete_post',				array( &$this, 'remove_sl') );
		
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
		}else{
			$post_id = $id;
		}
		
		if( $post_id === 0 )
			return false;		
		
		// handle different post types
		
		return $this->get_sl_byID( $post_id );
		
	}
	
	#TODO work on this.
	function set_sl( $post_id, $post_var = 'featured_chk' ){
		
		$old_shortlinks = ( is_array( get_option( $this->_shortlink_option ) ) ) ? get_option( $this->_shortlink_option ) : array();
		
		// are we adding to deleting this shortlink item?
		$set_shortlinks = (bool) $_POST[$post_var];
		
		// attempt to set it as featured,
		if( $set_shortlinks ){
			
			// if we are already featured ignore
			if( !self::has_shortlink($post_id)){
				$new_shortlinks = array_unique( array_merge( (array) $post_id, $old_shortlinks ) );
			}else{
				$new_shortlinks = $old_shortlinks;
			}
			
		// attempt to unset it if set
		}elseif( self::has_shortlink($post_id) and !$set_shortlinks ){
					
			$key = array_search( $post_id , $old_shortlinks );
			unset( $old_shortlinks[ $key ] );
			//$old_featured['debug'] = 'removing '.$post_id.' from featured';
			$new_shortlinks = $old_shortlinks;
			
		// if it doesn't exist just pass along the old featured list.
		}else{
			//$old_featured['debug'] = 'not updating or removing';
			$new_shortlinks = $old_shortlinks;
		}
		
		// update with new array of shortlinks
		update_option( $this->_shortlink_option, $new_shortlinks );
		
		return;
	
	}
	
	function has_shortlink( $post_id ){
		
		// load in shortlinks if not loaded yet.
		if(empty($this->_shortlinks))
			self::update_sl();
			
		// check for shortlink
		return (bool) $this->_shortlinks[$post_id];
		 
	}
	
	function update_sl(){
		
		$this->_shortlinks = get_option($this->_shortlink_option);
		
	}
	
	function get_sl_byID( $id ){
		
		$id = intval( $id );
		
		if( isset( $this->_shortlinks[$id] ) )
			return $this->_shortlinks[$id];
			
		return false;
		
	}
	
	function generate_sl(){
		
	}
	
	// clears out shortcodes that have had their posts removed
	function remove_sl(){
		
	}
	
}