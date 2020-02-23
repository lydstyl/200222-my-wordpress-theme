<?php get_header(); ?>

<section class="page-wrap">
  <div class="container">
    <h1><?php the_title(); ?></h1>

    <?php get_template_part( 'includes/section', 'content' ) ?>

    <?= get_search_form() ?>


    <a href="https://www.youtube.com/watch?v=n3EcEYFgyrQ&list=PLgFB6lmeXFOpHnNmQ4fdIYA5X_9XhjJ9d">WordPress Theme Development From Scratch</a>
  </div>
</section>


<?php get_footer( ); ?>