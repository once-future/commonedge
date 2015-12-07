<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article>

			<header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure>
						<?php the_post_thumbnail(); ?>
						<?php // echo spellerberg_featuredimage_caption($post->ID); ?>
					</figure>
				<?php endif; ?>

				<?php the_category(); ?>

				<h2><?php the_title(); ?></h2>
			
				<?php if ( is_single() ) : ?>
			
					<p class="date"><?php the_time('m.d.Y'); ?></p>
			
					<?php spellerberg_the_author($post->ID, '<p class="author">By ','</p>'); ?>	

				<?php endif; ?>

			</header>

			<main>
			<?php the_content(); ?>
			</main>

			<?php if ( is_single() ) : ?>

				<footer>
				<h4>Share this story</h4>

				<?php $url = get_permalink( $post->ID ); ?>
					<ul>
						<li><a class="facebook" href="http://www.facebook.com/share.php?u=<?php echo $url; ?>"><span>Facebook</span></a></li>
						<li><a class="twitter" href="http://twitter.com/?status=Interesting+link:+<?php echo $url; ?>"><span>Twitter</span></a></li>
						<li><a class="email" href="mailto:?subject=<?php the_title(); ?>&amp;body=Hi,%0d%0A%0d%0AI thought you might find this page interesting: %0d%0A%0d%0A<?php echo $url; ?>"><span>Email</span></a></li>
					</ul>
				</footer>

				<footer>
					<h4>Tags</h4>
					<?php the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?>
				</footer>

				<footer>
					<h4>Author Bio</h4>
					<?php spellerberg_author_bio($post->ID); ?>
				</footer>

			<?php endif; ?>

		</article>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
