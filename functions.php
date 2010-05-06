<?php
// --------------------------------------------------------------------
// Author: Patrick Forringer ( patrick@forringer.com )
// File info: custom wordpress theme function.php file, some functions custom others aquired through weasly means.
// Ver: 0.1
//

class Theme{
	
	var $theme_name = 'notey';
	
	// --------------------------------------------------------
	// Theme startup
	//
	
	function __construct(){
		//print_r ( pathinfo(__FILE__) );
			
		add_action( 'after_setup_theme',		array( &$this , 'theme_init' ) );
		add_action( 'init',									array( &$this , 'widget_sidebars' ) );
		add_action( 'widgets_init',					array( &$this , 'widgets_init' ) );
	
	}
	
	
	// --------------------------------------------------------
	// Initialize everything
	//
	
	function theme_init(){ #action after_setup_theme
	
		//
		// Include theme functions
		//
		#require_once('functions/func.php');
		
		
		//
		// Theme Supports
		//
		add_theme_support(
			'post-thumbnails',
			'automatic-feed-links',
			'nav-menus'
		);
		
		add_editor_style();
		
		
		//
		// Set thumbnail sizes
		//
		add_image_size( 'single-post-thumbnail', 150, 150 );
		add_image_size( 'post-header', 500, 400, true );
		
		
		//
		// Setup Language support
		//
		load_theme_textdomain( $this->theme_name , TEMPLATEPATH . '/languages' );
		
		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
			
	}
	
	
	// --------------------------------------------------------
	// Widgets
	//
	
	//
	// Setup locations
	//
	function widget_sidebars(){ #action init
	
		$defaults = array(
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => "</li>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		);
		
		$sidebars = array(
			array(
				'name' => __( 'Primary Widget Area', $this->theme_name ),
				'id' => 'primary-widget-area',
			),
		);
		
		// loop through all the sidebars
		foreach( $sidebars as $bar ){
			if( is_array($bar) )
				register_sidebar( array_merge( $bar, $defaults ) );
		}
		
	}
	
	//
	// Setup Custom Theme Widgets
	//
	function widgets_init(){ #action widgets_init
		// look up widgets directory and auto load files
		
	}
	
}

// start this sucker up!
new Theme;