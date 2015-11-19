<?php

add_action( 'init', 'create_author_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function create_author_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Authors', 'taxonomy general name' ),
    'singular_name' => _x( 'Author', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Authors' ),
    'all_items' => __( 'All Authors' ),
    'parent_item' => __( 'Parent Author' ),
    'parent_item_colon' => __( 'Parent Author:' ),
    'edit_item' => __( 'Edit Author' ), 
    'update_item' => __( 'Update Author' ),
    'add_new_item' => __( 'Add New Author' ),
    'new_item_name' => __( 'New Author' ),
    'menu_name' => __( 'Authors' ),
  ); 	

  register_taxonomy('author_categories',array('post'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'authors' ),
  ));
}


/* Front End */

function spellerberg_the_author($post_id, $before = '<h4>Author:</h4> <p>', $after = '</p>') {
	echo get_the_term_list( $post_id, 'author_categories', $before, ', ', $after ); 
}

function spellerberg_author_bio($post_id) {
	$my_taxonomy = 'author_categories';
	$terms = wp_get_post_terms( $post_id, $my_taxonomy );
	echo '<div class="authorbio">' .term_description($terms[0]->term_id, $my_taxonomy) . '</div>'; 
}

?>