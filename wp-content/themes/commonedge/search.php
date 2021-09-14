<?php get_header(); ?>

<div class="index searchpage">

<header class="indexheader">
 <h2>Search</h2>

 <?php echo get_search_form(); ?>

 <?php if ( get_search_query() != '' && !have_posts() ) : ?>
	 <p>We could not find any results for your search.</p>
 <?php endif; ?>

</header>

<?php if ( get_search_query() != '' ) : ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<article>

				<header>

					<?php the_category(); ?>

					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<p class="date"><?php the_time('m.d.Y'); ?></p>

						<?php spellerberg_the_author($post->ID, '<p class="author">By ','</p>'); ?>

				</header>

			<div class="excerpt excerpta">
				<?php the_excerpt(); ?>
				<p class="morelink"><a href="<?php the_permalink(); ?>">More</a></p>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure>
					<a href="<?php the_permalink(); ?>"><?php
						$sizeguidance = '(min-width: 1223px) 970px, (min-width:768px) 894px, (min-width: 480px) 440px, (min-width: 320px) 739px, 970px';
						spellerberg_the_thumbnail($post->ID,'listing',$sizeguidance);
					?></a>
				</figure>
			<?php endif; ?>

			<div class="excerpt excerptb">
				<?php the_excerpt(); ?>
				<p class="morelink"><a href="<?php the_permalink(); ?>">More</a></p>
			</div>

		</article>

	<?php endwhile; ?>

	<div class="pagination">

	<?php

		$args = array(
			'show_all'           => true,
			'prev_next'          => true,
			'prev_text'          => __('&larr;'),
			'next_text'          => __('&rarr;'),
			'type'               => 'list'
		);

		echo paginate_links( $args );

	?>

	</div>

<?php endif; ?>

<?php endif; ?>

</div>

<?php get_footer(); ?>
