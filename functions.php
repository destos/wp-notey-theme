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
	
		add_action( 'after_setup_theme',				array( &$this , 'theme_init' ) );
		//widget stuff
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
		//require_once('functions/shortlink.php');
		//new shortlink;
		
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
		set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
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
	// General Template
	//
	
	// nice title
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
			return ' | ' . __( 'Page ' , 'notey' ) . get_query_var( 'paged' );
	}
	
	// Echo the page number
	static function the_page_number() {
		echo self::get_page_number();
	}
	
	// Control excerpt length
	static function excerpt_length( $length ) {
		return 40; #TODO make dynamic
	}	
	
	// Make a nice read more link on excerpts
	static function excerpt_more( $more ) {
		return '&hellip; <a href="'. get_permalink() . '">' . __('Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'notey') . '</a>';
	}
	
	static function posted_on( $args = array() ) {
		
		$defaults = array(
			'show_author' => false,
			'show_modified_date' => true
		);
		
		extract( wp_parse_args( $args, $defaults ) );
		
		if( $show_author ){
			printf( __( '<span %1$s>Posted on</span> %2$s by %3$s', 'notey' ),
				'class=""', // TODO do something with the class
				self::get_post_time(),
				self::get_author()
			);
		}else{
			printf( __( '<span %1$s>Posted on</span> %2$s', 'notey' ),
				'class=""',
				self::get_post_time()
			);
		}
		//echo get_the_time();
		
		if( (bool) $show_modified_date and get_the_modified_date() != get_the_date() ){
			printf( __( ' <span %1$s>Updated on</span> %2$s', 'notey' ),
				'class="updated_time"',
				get_the_modified_date()
			);
		}
		
	}
	
	static function get_post_time(){
		return sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			);
	}
	
	static function get_author(){
		return sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>', 
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'notey' ), get_the_author() ),
				get_the_author()
			);
	}
	
	// --------------------------------------------------------
	// Commenting
	//
	
	// Delete comment
	static function delete_comment_link($id) {
	  if (current_user_can('edit_post')) {
	    echo '<a href="'.admin_url("comment.php?action=cdc&c=$id").'">'.__('Delete', 'theme').'</a> ';
	    echo '<a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">'.__('Spam', 'theme').'</a>';
	  }
	}
	
	// custom comment html
	static function comment_html( $comment, $args, $depth ) {
		$GLOBALS ['comment'] = $comment; ?>
		<?php if ( '' == $comment->comment_type ) : ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'notey' ), get_comment_author_link() ); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'notey' ); ?></em>
				<br />
			<?php endif; ?>
	
			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s at %2$s', 'notey' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'notey' ),'  ','' ); ?></div>
	
			<div class="comment-body"><?php comment_text(); ?></div>
	
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</div>
	
		<?php else : ?>
		<li class="post pingback">
			<p><?php _e( 'Pingback: ', 'theme' ); ?><?php comment_author_link(); ?><?php edit_comment_link ( __('edit', 'theme'), '&nbsp;&nbsp;', '' ); self::delete_comment_link( $comment->comment_ID ) ?></p>
		<?php endif;
	}
	
}

// start this sucker up!
new Theme;