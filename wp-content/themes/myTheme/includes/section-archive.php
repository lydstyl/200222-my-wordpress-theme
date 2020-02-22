<?php if(have_posts()): while(have_posts()): the_post(); ?>

  <div class="card mb-3">
    <div class="card-body">
      <?php if(has_post_thumbnail()): ?>
        <img src="<?= the_post_thumbnail_url('blog-small') ?>" alt="<?= the_title() ?>" class="img-fluid mb-3 img-thumbnail">
      <?php endif; ?>

      <h2><?php the_title(); ?></h2>
    
      <?php the_excerpt(); ?>
    
      <a class="btn btn-success" href="<?php the_permalink(); ?>">Read more</a>
    </div>
  </div>

<?php endwhile; else: endif; ?>