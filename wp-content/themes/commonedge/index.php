<?php get_header(); ?>

<div class="index">

<?php if ( !is_front_page() ) : ?>
<header class="indexheader">
 <h2><?php single_cat_title(); ?></h2>
</header>
<?php endif; ?>


<?php if (have_posts()) : ?>
	<?php if ( is_front_page() ) $firstPost = true; ?>

	<?php while (have_posts()) : the_post(); ?>

		<article <?php if ( $firstPost == true ) echo 'class="firstpost"'; ?>>

			<?php if ( $firstPost == true ) : ?>

				<div class="biglogo">

					<div class="underlay">
						<img src="<?php echo get_stylesheet_directory_uri() ?>/images/commonedge-vertical.svg" alt="Common Edge" />
					</div>

					<header class="firstheader">

						<?php the_category(); ?>

						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

							<p class="date"><?php the_time('m.d.Y'); ?></p>

							<?php spellerberg_the_author($post->ID, '<p class="author">By ','</p>'); ?>

					</header>

				</div>

			<?php else : ?>

				<header>

					<?php the_category(); ?>

					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<p class="date"><?php the_time('m.d.Y'); ?></p>

						<?php spellerberg_the_author($post->ID, '<p class="author">By ','</p>'); ?>

				</header>

			<?php endif; ?>

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

		<?php if ( $firstPost == true ) $firstPost = false; ?>

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

<div class="getinvolved">
<div class="getinvolvedinner">

	<?php get_template_part('parts/newsletter'); ?>

	<?php get_template_part('parts/paypal'); ?>

</div>
</div>

</div>

<?php get_footer(); ?>
