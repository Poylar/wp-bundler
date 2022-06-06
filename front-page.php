<?php get_header(); ?>

<div id="root" class="page-wrapper page-sidebar container">
  <?php get_sidebar(); ?>
  <main class="main">
    <h1 class="main-title"> <?php the_field('title-h1');?></h1>
    <?php get_template_part('temp/front-slider') ?>
    <?php get_template_part('temp/car-grid') ?>
    <div class="page-content">
      <?php the_content(); ?>
    </div>
  </main>
</div>

<?php get_footer(); ?>