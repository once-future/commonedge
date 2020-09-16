<?php

function enqueue_scripts_method() {

	$version = "f";

	// Remove Unnecessary Code
	// http://www.themelab.com/2010/07/11/remove-code-wordpress-header/

	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link');

	if(!wp_script_is('jquery')) wp_enqueue_script("jquery");

	// Define JS

	$layoutjs = get_template_directory_uri() . '/js/layout.js';
	wp_register_script('layoutjs',$layoutjs, false, $version);

	$homepagejs = get_template_directory_uri() . '/js/homepage.js';
	wp_register_script('homepagejs',$homepagejs, false, $version);

	$interiorjs = get_template_directory_uri() . '/js/interior.js';
	wp_register_script('interiorjs',$interiorjs, false, $version);

	// Define CSS

	$fontscss = get_stylesheet_directory_uri() . '/fonts/fonts.css';
	wp_register_style('fontscss',$fontscss, false, $version);

	$themecss = get_stylesheet_directory_uri() . '/style.css';
	wp_register_style('themecss',$themecss, false, $version);

	// Enqueue

	wp_enqueue_style( 'fontscss');
	wp_enqueue_style( 'themecss');

	wp_enqueue_script( 'layoutjs',array('jquery'));

	if ( is_front_page() ) :
		wp_enqueue_script( 'homepagejs',array('jquery'));
	else:
		wp_enqueue_script( 'interiorjs',array('jquery'));
	endif;

}

add_action('wp_enqueue_scripts', 'enqueue_scripts_method');

?>
