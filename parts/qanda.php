<?php 

$is_qa = get_field('is_qa');
if ( $is_qa == "yes") : ?>

	<div class="qanda">
		<?php 
			$participants = get_field('participants'); 
			$participant_count = count($participants); 
		?>
		<?php if( have_rows('participants') ): ?>
			<?php $i = 1; ?>
			<p>
			<?php while ( have_rows('participants') ) : the_row(); ?>
				<?php 
					$initials = get_sub_field('initials'); 
					$full_name = get_sub_field('full_name'); 
				?>
				<span class="speaker"><?php echo $initials; ?>: </span><?php echo $full_name; ?><?php if ( $i < $participant_count ) echo '<br />'; ?>
				<?php $i++; ?>
			<?php endwhile; ?>
			<p>
		<?php endif; ?>

		<?php if( have_rows('blocks') ): ?>
			<?php while ( have_rows('blocks') ) : the_row(); ?>
				<?php if ( get_row_layout() == 'text_block' ) : ?>

					<?php 
						$type = get_sub_field('type'); 
						$speaker = get_sub_field('speaker'); 
						$text = get_sub_field('text'); 
					?>
					<div class="textblock <?php echo $type; ?>">
						<span class="speaker"><?php echo $speaker; ?>: </span>
						<?php echo $text; ?>
					</div>

				<?php elseif ( get_row_layout() == 'image_block' ) :  ?>
					<figure>
					<?php 
						$image = get_sub_field('image'); 
						spellerberg_the_image($image,'standard'); 
						echo spellerberg_image_caption($image);
					?>
					</figure>
				<?php elseif ( get_row_layout() == 'embed_block' ) :  ?>
					<figure>
					<div class="embed-container"><?php echo get_sub_field('embed'); ?></div>
					</figure>
				<?php endif; ?>

			<?php endwhile; ?>
		<?php endif; ?>

	</div>

<?php endif; ?>