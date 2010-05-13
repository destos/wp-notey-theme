<?php
// --------------------------------------------------------------------
// Author: Patrick Forringer ( patrick@forringer.com )
// File info: custom wordpress theme function.php file, some functions custom others aquired through weasly means.
// Ver: 0.1
//

##
##	Main theme ini class
##

class Theme{
	
	var $theme_name = 'notey';
	
	// --------------------------------------------------------
	// Theme startup
	//
	
	function __construct(){
		//print_r ( pathinfo(__FILE__) );
			
		add_action( 'after_setup_theme',				array( &$this , 'theme_init' ) );
		add_action( 'init',											array( &$this , 'widget_sidebars' ) );
		add_action( 'widgets_init',							array( &$this , 'widgets_init' ) );
																						
		//
		// template helpers
		//																	
		add_filter( 'excerpt_more',							array( tmpl, 'excerpt_more' ) );
		add_filter( 'the_content_more_link',		array( tmpl, 'excerpt_more' ) );
		add_filter( 'excerpt_length',						array( tmpl, 'excerpt_length' ) );
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
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'nav-menus' );
		
		add_editor_style( 'css/editor-style.css');
		
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
			if( is_array( $bar ) )
				register_sidebar( array_merge( $bar, $defaults ) ); // TODO use wordpress's built in merge.
		}
		
	}
	
	//
	// Setup Custom Theme Widgets
	//
	function widgets_init(){ #action widgets_init
		// look up widgets directory and auto load files
		
	}
	
	
	// --------------------------------------------------------
	// 
	//
	
	
}


##
## Main template helper class
##
class tmpl{
	
	// --------------------------------------------------------
	// nice title
	//
	
	static function title(){

    if ( is_single() ) {
			single_post_title(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' ); self::get_page_number();
		} elseif ( is_page() ) {
			single_post_title( '' ); echo ' | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			printf( __( 'Search results for "%s"', 'theme' ), esc_html( $s ) ); self::get_page_number(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_404() ) {
			_e( 'Not Found', 'theme' ); echo ' | '; bloginfo( 'name' );
		} else {
			wp_title( '' ); echo ' | '; bloginfo( 'name' ); self::get_page_number();
		}
		
	}
	
	// Get the page number
	static function get_page_number() {
		if ( get_query_var( 'paged' ) )
			return ' | ' . __( 'Page ' , 'pat_theme' ) . get_query_var( 'paged' );
	}
	
	// Echo the page number
	static function the_page_number() {
		echo tmpl::get_page_number();
	}
	
	// Control excerpt length
	static function excerpt_length( $length ) {
		return 40;
	}	
	
	// Make a nice read more link on excerpts
	static function excerpt_more( $more ) {
		return '&hellip; <a href="'. get_permalink() . '">' . __('Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'theme') . '</a>';
	}
	
}

// start this sucker up!
new Theme;