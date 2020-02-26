<?php get_header(); ?>

<section class="page-wrap">
  <div class="container">
    <h1><?php the_title(); ?></h1>

    <?php if(has_post_thumbnail()): ?>
      <img src="<?= the_post_thumbnail_url('blog-large') ?>" alt="<?= the_title() ?>" class="img-fluid mb-3 img-thumbnail">
    <?php endif; ?>

    <p>
        <?php get_template_part( 'includes/form', 'enquiry' ) ?>
    </p>

    <ul>
        <li>Color: <?= the_field( 'colour' ) ?></li>
        <li>Registration: <?= the_field( 'registration' ) ?></li>
    </ul>


    <?php wp_link_pages() ?>

  <p>
      <?php get_template_part( 'includes/section', 'cars' ) ?>
  </p>
  </div>
</section>
<?php get_footer( ); ?>