<?php

$args = array(
  'posts_per_page' => 18,
  'post_type' => 'cars',

);

$query = new WP_Query($args);

?>

<?php if ($query->have_posts()) : ?>
  <h3 class="car__title">
    <?php the_field('car-title'); ?>
  </h3>
  <div class="car">

    <?php while ($query->have_posts()) : $query->the_post(); ?>

      <?php get_template_part('temp/car__item') ?>
      <?php if ($query->current_post == 8) : ?>
  </div>
  <div class="car__form">
    <h3 class="car__form-title">
    <?php the_field('form-title');?>
    </h3>
    <?php echo do_shortcode('[fluentform id="4"]'); ?>
  </div>
  <h3 class="car__title">
    <?php the_field('car-title'); ?>
  </h3>
  <div class="car">

  <?php endif; ?>

<?php endwhile; ?>
  </div>

<?php endif; ?>

<?php wp_reset_query(); ?>