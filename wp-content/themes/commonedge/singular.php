<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php if ( is_page() ) echo 'class="page"'; ?>>

			<header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure>
						<?php spellerberg_the_thumbnail($post->ID,'hero'); ?>
					</figure>
				<?php endif; ?>

				<?php the_category(); ?>

				<h2><?php the_title(); ?></h2>

				<?php if ( is_single() ) : ?>

					<div class="articlemeta">

						<p class="date"><?php the_time('m.d.Y'); ?></p>

						<?php spellerberg_the_author($post->ID, '<p class="author">By ','</p>'); ?>

					</div>

				<?php endif; ?>

			</header>

			<main>
				<?php the_content(); ?>

				<?php get_template_part('parts/qanda'); ?>


			</main>

			<?php if ( is_single() ) : ?>
				<div class="articlefooters">

					<footer class="sharethis">
					<h4>Share this story</h4>

					<?php $url = get_permalink( $post->ID ); ?>
						<ul>
							<li class="facebook"><a href="http://www.facebook.com/share.php?u=<?php echo $url; ?>"><span>Facebook</span></a></li>
							<li class="twitter"><a href="http://twitter.com/?status=<?php echo $url; ?>"><span>Twitter</span></a></li>
							<li class="email"><a href="mailto:?subject=<?php the_title(); ?>&amp;body=Hi,%0d%0A%0d%0AI thought you might find this page interesting: %0d%0A%0d%0A<?php echo $url; ?>"><span>Email</span></a></li>
						</ul>
					</footer>

					<footer class="tags">
						<h4>Tags</h4>
						<?php the_tags( '<ul><li>', '</li><li>', '</li></ul>' ); ?>
					</footer>

					<footer class="authors">
						<h4>Author Bio</h4>
						<?php spellerberg_author_bio($post->ID); ?>
					</footer>

				</div>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>
<?php endif; ?>

<?php if (  is_page('climate-change') ) get_template_part('parts/climate'); ?>

<div class="getinvolved">
<div class="getinvolvedinner">

	<?php get_template_part('parts/newsletter'); ?>

	<?php get_template_part('parts/paypal'); ?>

</div>
</div>


<?php get_footer(); ?>
