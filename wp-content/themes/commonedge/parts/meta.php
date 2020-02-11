<!-- parts/meta.php -->

<?php if ( have_posts() ): while(have_posts()): the_post(); endwhile; endif;?>

<meta name="author" content="<?php echo spellerberg_get_author_names($post->ID); ?>" />

<!--
	<meta property="fb:app_id" content="your_app_id" />
	<meta property="fb:admins" content="your_admin_id" /> -->
	<meta property="og:url" content="<?php the_permalink() ?>"/>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<?php if ( is_single() ) : ?>
	<meta property="og:title" content="<?php single_post_title(''); ?>" />
	<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'listing' )[0] ?>" />
<?php else : ?>
	<meta property="og:description" content="<?php bloginfo('description'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-180.png" />
<?php endif; ?>
