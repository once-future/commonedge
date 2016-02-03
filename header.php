<!doctype html>
<html>
<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta name="author" content="http://once-future.com, http://martyspellerberg.com" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php get_template_part('parts/favicons'); ?>
<?php wp_head(); ?>

</head>
<body <?php if ( is_front_page() ) echo 'class="homepage"'; ?>>

<div class="layout">

<header class="fixedheader">
	<div class="margin">
		<a class="hamburger"><span>Menu</span><a/>
		<h1><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/commonedge-horizontal.svg" alt="Common Edge" /></a></h1>
		<nav class="sitenav"><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?></nav>
	</div>
</header>

<div class="headerspacer"></div>

<?php if ( is_front_page() ) : ?>
<header class="homeheader">
	<h1><img src="<?php echo get_stylesheet_directory_uri() ?>/images/commonedge-vertical.svg" alt="Common Edge" /></h1>

	<nav class="sitenav">
			<div class="navpadding"><?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?></div>
	</nav>

</header>
<?php endif; ?>