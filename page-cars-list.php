<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme
 */

get_header();
?>


<div id="root" class="page-wrapper page-sidebar container">
  <?php get_sidebar(); ?>
  <main class="main">
    <div class="breadcrumbs">
      <?php bcn_display() ?>
    </div>
    <div class="single-content">
      <h1 class="single-title">
        <?php the_title(); ?>
      </h1>
      <div class="single-description">
        <?php the_content(); ?>
      </div>
    </div>
    <?php
    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $args = array(
      'posts_per_page' => 9,
      'post_type' => 'cars',
      'paged' => $paged,


    );

    $query = new WP_Query($args);

    ?>

    <?php if ($query->have_posts()) : ?>

      <div class="car car-paginate">

        <?php while ($query->have_posts()) : $query->the_post(); ?>
          <?php get_template_part('temp/car__item') ?>
        <?php endwhile; ?>
      </div>

    <?php endif; ?>

    <?php wp_reset_query(); ?>
    <div class="pagination">
      <?php
      $big = 999999999;

      echo paginate_links(array(
        'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'current' => max(1, get_query_var('paged')),
        'total'   => $query->max_num_pages,
        'prev_text'    => __(''),
        'next_text'    => __(''),
      ));
      ?>
    </div>
    <div class="page-content">
      <?php the_field('add-content');?>
    </div>
  </main>
</div>
<?php

get_footer();
