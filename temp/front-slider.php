<?php if (have_rows('slider')) : ?>

  <div class="slider swiper js-front-slider">
    <div class="swiper-wrapper">
      <?php while (have_rows('slider')) : the_row(); ?>

        <div class="swiper-slide">
          <div class="slider__image">
            <img src="<?php the_sub_field('image'); ?>" alt="">
          </div>
          <div class="slider__text">
            <?php the_sub_field('text'); ?>
          </div>
          <div class="slider__btn btn btn__primary">
            <a href="<?php the_sub_field('link'); ?>">
              Подробнее
            </a>
          </div>
        </div>

      <?php endwhile; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>

<?php endif; ?>