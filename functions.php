<?php

require_once( 'functions/authors.php' );
require_once( 'functions/enqueue.php' );
require_once( 'functions/images.php' );


function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );
