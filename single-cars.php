<?php get_header() ?>
<div id="root" class="page-wrapper page-sidebar container">
  <?php get_sidebar(); ?>
  <main class="main">

    <div class="breadcrumbs">
      <?php bcn_display() ?>
    </div>
    <div class="single-content">
      <h1 class="single-title">
        <?php the_field('name'); ?>
      </h1>
      <?php $gallery = get_field('gallery'); ?>
      <div class="car-wrapper row">
        <div class="car__gallery">
          <div class="swiper gallery-main js-gallery-main">
            <div class="swiper-wrapper">
              <?php foreach ($gallery as $image) : ?>
                <div class="swiper-slide">
                  <a href="<?= $image['url'] ?>" data-fancybox="gallery">
                    <img src="<?= $image['url'] ?>" alt="">
                  </a>
                </div>
              <?php endforeach; ?>
              <?php wp_reset_postdata() ?>
            </div>
          </div>
          <div class="swiper gallery-thumbs js-gallery-thumbs">
            <div class="swiper-wrapper">
              <?php foreach ($gallery as $image) : ?>
                <div class="swiper-slide">
                  <img src="<?= $image['url'] ?>" alt="">
                </div>
              <?php endforeach; ?>

            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <div class="car__info">
          <div class="car__class">
            <?php the_field('class'); ?>
          </div>
          <?php get_template_part('temp/car-price') ?>
          <div class="car__bottom row align-center">
            <div class="btn btn__primary js-open-modal">
              <a href="<?php the_permalink(122) ?>">
                Взять в аренду
              </a>
            </div>
            <div class="car__price">
              <?php the_field('price-h'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="features">
        <h4 class="features__title">
          Характеристики:
        </h4>
        <?php if (have_rows('features')) : ?>

          <div class="features__inner">
            <?php while (have_rows('features')) : the_row(); ?>

              <div class="features__item">
                <?php the_sub_field('text'); ?>
              </div>

            <?php endwhile; ?>
          </div>

        <?php endif; ?>

      </div>
      <div class="price-table">
        <h4 class="single-title">
          Цены на аренду авто в рублях:
        </h4>
        <div class="price-table__inner">
          <?php if (have_rows('price-table')) : ?>

            <?php while (have_rows('price-table')) : the_row(); ?>

              <div class="price-table__item">
                <div class="price-table__title">
                  <?php the_sub_field('title'); ?>
                </div>
                <div class="price-table__value">
                  <?php the_sub_field('price'); ?>
                </div>
              </div>

            <?php endwhile; ?>

          <?php endif; ?>

        </div>
        <div class="price-table__btn btn btn__primary">
          Взять в аренду
        </div>
      </div>
      <div class="page-content">
        <?php the_content() ?>
      </div>
      <div class="other-posts">
        <h4 class="single-title">
          Предлагаем взять в аренду
        </h4>
        <?php

        $args = array(
          'posts_per_page' => 3,
          'post_type' => 'cars',
          'orderby' => 'rand',
          'order'    => 'ASC'

        );

        $query = new WP_Query($args);

        ?>

        <?php if ($query->have_posts()) : ?>

          <div class="car">

            <?php while ($query->have_posts()) : $query->the_post(); ?>
              <?php get_template_part('temp/car__item') ?>
            <?php endwhile; ?>
          </div>

        <?php endif; ?>

        <?php wp_reset_query(); ?>
      </div>
    </div>


  </main>
</div>
<?php get_footer(); ?>