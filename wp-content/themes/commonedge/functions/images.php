<?php

// Image linking in content is lame
update_option('image_default_link_type','none');

// Featured Images
add_theme_support( 'html5', array( 'gallery', 'caption' ) );
add_theme_support( 'post-thumbnails' );

// Sets of sizes appropriate for srcset
add_image_size( 'hero', 1000, 430, array( 'center', 'center' ) );
add_image_size( 'hero_big', 1500, 644, array( 'center', 'center' )  );
add_image_size( 'hero_bigger', 2000, 858, array( 'center', 'center' )  );
add_image_size( 'hero_biggest', 2500, 1073, array( 'center', 'center' )  );

add_image_size( 'listing', 1000, 625, array( 'center', 'center' ) );
add_image_size( 'listing_big', 1500, 938, array( 'center', 'center' )  );
add_image_size( 'listing_bigger', 2000, 1250, array( 'center', 'center' )  );
add_image_size( 'listing_biggest', 2500, 1563, array( 'center', 'center' )  );

add_image_size( 'standard', 1000 );
add_image_size( 'standard_big', 1500 );
add_image_size( 'standard_bigger', 2000 );
add_image_size( 'standard_biggest', 2500 );


function spellerberg_this_sites_sizesets() {

	$sets = Array();

	// WordPress Default Sizes
	$sets[] = Array('thumbnail','medium','large','full');

	// Custom sizes as defined via add_image_size, 
	// grouped into sets appropriate for srcset,
	// ordered from smallest to largest.
	$sets[] = Array('hero','hero_big','hero_bigger','hero_biggest');
	$sets[] = Array('listing','listing_big','listing_bigger','listing_biggest');
	$sets[] = Array('standard','standard_big','standard_bigger','standard_biggest');	

	return $sets;
}



function spellerberg_image_caption($image) {

	$attachment = get_posts(array(
		'include' => $image,
		'post_type' => 'attachment',
	));

	$post_title = $attachment[0]->post_title; // title, unused
	$post_content = $attachment[0]->post_content; // caption.
	$post_excerpt = $attachment[0]->post_excerpt; // description

	$output = '';

	if ($post_content) $output .= wpautop($post_content);
	if ($post_excerpt) $output .= wpautop($post_excerpt);

	if ($output != '' ) :
		return '<figcaption>' . $output . '</figcaption>';
	endif;

}

function spellerberg_featuredimage_caption($post_id) {

	$thumbnail_id = get_post_thumbnail_id($post_id);
	$images = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	if ( count($images) > 0 ) :
		foreach ($images as $attachment_id => $image) :

			$img_caption = $image->post_excerpt; // caption.
	//		$img_description = $image->post_content; // description, unused

			if ($img_caption) : 
				$output .= '<figcaption>' . wpautop($img_caption) . '</figcaption>';
			endif; 

		endforeach;
	endif;

	return $output;

}


/* Responsive Images: Remove Inline Widths */

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
add_filter( 'category_description', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {

	if (preg_match_all('/<img[^>]+>/ims', $html, $matches)) {
		foreach ($matches as $match) {
			$clean = preg_replace('/(width|height)=["\'\d%\s]+/ims', "", $match); // Replace all occurences of width/height
			$html = str_replace($match, $clean, $html); // Replace with result within html
		}
	}

	return $html;
}


add_filter('img_caption_shortcode','fix_img_caption_shortcode_inline_style',10,3);

function fix_img_caption_shortcode_inline_style($output,$attr,$content) {
	$atts = shortcode_atts( array(
		'id'	  => '',
		'align'	  => 'alignnone',
		'width'	  => '',
		'caption' => '',
		'class'   => '',
	), $attr, 'caption' );

	$atts['width'] = (int) $atts['width'];
	if ( $atts['width'] < 1 || empty( $atts['caption'] ) )
		return $content;

	if ( ! empty( $atts['id'] ) )
		$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	if ( current_theme_supports( 'html5', 'caption' ) ) {
		return '<figure ' . $atts['id'] . ' class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
	}

	$caption_width = 10 + $atts['width'];

	$caption_width = apply_filters( 'img_caption_shortcode_width', $caption_width, $atts, $content );

	$style = '';

	return '<div ' . $atts['id'] . $style . 'class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<p class="wp-caption-text">' . $atts['caption'] . '</p></div>';
}