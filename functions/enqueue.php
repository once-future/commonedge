<?php

function enqueue_scripts_method() {

	$version = "a";

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

	// $flexsliderjs = get_template_directory_uri() . '/js/jquery.flexslider.js';
	// wp_register_script('flexsliderjs',$flexsliderjs, false, $version);


	// Define CSS

	$fontscss = get_stylesheet_directory_uri() . '/fonts/fonts.css';
	wp_register_style('fontscss',$fontscss, false, $version);

	$themecss = get_stylesheet_directory_uri() . '/style.css';
	wp_register_style('themecss',$themecss, false, $version);

	// Enqueue

//	wp_enqueue_script( 'flexsliderjs',array('jquery'));

	wp_enqueue_style( 'fontscss');
	wp_enqueue_style( 'themecss');

}

add_action('wp_enqueue_scripts', 'enqueue_scripts_method');

?>
