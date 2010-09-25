<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php tmpl::title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/img/ico/fav_icon.ico" type="image/x-icon"/>

<!--[if lte IE 8]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/ie6.css"/><![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head() ?>

</head>

<body <?php body_class() ?>>
	
	<header>
		<section>
			<div id="headwrap">
			<hgroup>
				<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
				<h4><?php bloginfo( 'description' ); ?></h4>
			</hgroup>
			<div id="archives">
			<?php top::archives(); ?>
			</div>
			<?php /*
wp_nav_menu( array(
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
*/?>
			</div>
		</section>
	</header>