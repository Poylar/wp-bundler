<div class="car__item">
  <div class="car__photo">
    <a href="<?php the_permalink() ?>">
      <img src="<?php the_post_thumbnail_url() ?>" alt="">
    </a>
  </div>
  <div class="car__info">
    <div class="car__class">
      <?php the_field('class'); ?>
    </div>
    <div class="car__name">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </div>
    <?php get_template_part('temp/car-price') ?>
    <div class="car__price-hour">
      <?php the_field('price-h'); ?>
    </div>
    <div class="car__btn btn btn__secondary">
      <a href="<?php the_permalink() ?>">
        Подробнее
      </a>
    </div>
    <div class="car__btn btn btn__primary js-open-modal">
      <a href="<?php the_permalink(122) ?>">
        Заказать
      </a>
    </div>
  </div>
</div>