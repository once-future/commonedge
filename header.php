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

<header class="fixedheader">
	<div class="padding">
		<h1><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/commonedge-horizontal.svg" alt="Common Edge" /></a></h1>
	</div>
</header>

<?php if ( is_front_page() ) : ?>
<header class="homeheader">
	<h1><a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/commonedge-vertical.svg" alt="Common Edge" /></a></h1>
</header>
<?php else: ?>
	<div class="headerspacer"></div>
<?php endif; ?>


<div class="layout">