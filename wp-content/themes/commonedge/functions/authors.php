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

function spellerberg_reorder_array(&$array, $new_order) {
  $inverted = array_flip($new_order);
  uksort($array, function($a, $b) use ($inverted) {
    return $inverted[$a] > $inverted[$b];
  });
}


function spellerberg_the_author($post_id, $before = '<h4>Author:</h4> <p>', $after = '</p>') {

  $thetaxonomy = 'author_categories';
	$authors = wp_get_post_terms( $post_id, $thetaxonomy );

  // Change author order in particular situation
  if ( $post_id == 3865 ) spellerberg_reorder_array($authors, array(1, 0, 2));

	$authorcount = count($authors);
	$i = 1;

	$output = '';

	foreach ( $authors as $author ) :

    $authorlink = get_term_link( $author->term_id, $thetaxonomy );

    $output .= '<a href="' . $authorlink . '">' . $author->name . '</a>';

		if ( $i < $authorcount) $output .= ', ';
		$i++;

	endforeach;

	echo $before . $output . $after;

}

function spellerberg_author_bio($post_id) {
	$thetaxonomy = 'author_categories';
	$authors = wp_get_post_terms( $post_id, $thetaxonomy );

  // Change author order in particular situation
  if ( $post_id == 3865 ) spellerberg_reorder_array($authors, array(1, 0, 2));

	$output = '';

	foreach ( $authors as $author ) :

		$authoroutput = '';

		$authorterm = $author->term_id;
		$authorname = $author->name;
		$authordescription = $author->description;

		$authorlink = get_term_link( $authorterm, $thetaxonomy );
		$authoroutput .= '<p><a href="' . $authorlink . '">' . $authorname . '</a> ' . $authordescription . '</p>';

		if ( $authoroutput != '' ) :

			$imageoutput = '';

			$tt_id = (int) $authorterm;
			$associations = taxonomy_image_plugin_get_associations();

			if ( isset( $associations[ $tt_id ] ) ) :
			    $attachment_id = (int) $associations[ $tt_id ];
			    $imagesrc = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
			endif;

			if ( $imagesrc != '' ) :
				$imageoutput = '<div class="authorimage"><a href="' . $authorlink . '"><img src="' . $imagesrc[0] . '" alt="' . $authorname . '" /></a></div>';
			endif;

			$output .= '<div class="authorbio">' . $imageoutput . $authoroutput . '</div>';

		endif;

	endforeach;

	echo $output;

}

function spellerberg_get_author_names($post_id) {
	$thetaxonomy = 'author_categories';
	$authors = wp_get_post_terms( $post_id, $thetaxonomy );

  // Change author order in particular situation
  if ( $post_id == 3865 ) spellerberg_reorder_array($authors, array(1, 0, 2));

	$authorcount = count($authors);
	$i = 1;

	$output = '';

	foreach ( $authors as $author ) :

		$authorname = $author->name;

		$output .= $authorname;

		if ( $i < $authorcount) $output .= ', ';
		$i++;

	endforeach;

	return $output;

}


?>
