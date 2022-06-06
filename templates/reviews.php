<?php /* Template Name: Отзывы */ ?>
<?php get_header() ?>
<div class="page-wrapper page-sidebar container" id="root">
<?php get_sidebar(); ?>
  <main class="main">
    <section class="container">
      <div class="breadcrumbs">
        <?php bcn_display() ?>
      </div>
      <h1 class="single-title">
        <?php the_title() ?>
      </h1>
      <div class="reviews col">
        <?php
        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $args = array(
          'posts_per_page' => 9,
          'post_type' => 'reviews',
          'paged' => $paged,

        );

        $query = new WP_Query($args);

        ?>

        <?php if ($query->have_posts()) : ?>

          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="reviews__item col">
              <div class="row align-center reviews__info">
                <div class="reviews__name">
                  <?php the_title(); ?>
                </div>
                <div class="reviews__date">
                  <?= get_the_date(); ?>
                </div>
              </div>
              <div class="reviews__content">
                <?php the_content(); ?>
              </div>
            </div>
          <?php endwhile; ?>

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

      </div>
    </section>
  </main>
</div>
<?php get_footer(); ?>