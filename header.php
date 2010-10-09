<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- www.phpied.com/conditional-comments-block-downloads/ -->
	<!--[if IE]><![endif]-->
	
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
	       Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php tmpl::title(); ?></title>
	
	<!--  Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	
	<!-- CSS : implied media="all" -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" >
	<!-- For the less-enabled mobile browsers like Opera Mini -->
	<link rel="stylesheet" media="handheld" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/handheld.css">
	
	<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/img/icons/favicon.ico" >
	<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/img/icons/apple-touch-icon.png">
		
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
	
	<?php wp_head() ?>

</head>

<body <?php body_class() ?>>
	
	<header>
		<section>
			<div id="headwrap" class="wrap">
			<hgroup>
				<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a><span>blog</span></h1>
				<h4><?php bloginfo( 'description' ); ?></h4>
			</hgroup>
			<?php 
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'slug' => 'main',
				'sort_column' => 'menu_order',
				'menu' => 'Top',
				'container' => 'nav',
				'container_class' => 'menu-header',
				'menu_class' => '',
				'echo' => true,
				'fallback_cb' => 'wp_page_menu',
				'before' => '',
				'after' => '',
				'link_before' => '', //<span></span>
				'link_after' => '',
				'depth' => 0,
				'walker' => '',
				'context' => 'frontend'
			) ); 
		?>
			<a href="http://feeds.feedburner.com/patrick-forringer-blog<?php //bloginfo('rss2_url'); ?>" class="feed" data-tip="Subscribe to the Site RSS Feed" data-tip-grav="ne">Site Feed</a>
			</div>
		</section>
	</header>