<?php get_header(); ?>

<div class="index">

<!-- <h2><?php single_cat_title(); ?></h2> -->


<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article>

			<header>

				<?php the_category(); ?>

				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<p class="date"><?php the_time('m.d.Y'); ?></p>
			
					<?php spellerberg_the_author($post->ID, '<p class="author">By ','</p>'); ?>	

			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				</figure>
			<?php endif; ?>

		</article>
	<?php endwhile; ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>
