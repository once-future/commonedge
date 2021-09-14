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
