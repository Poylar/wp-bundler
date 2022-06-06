<div class="car__price-position">
  <?php if (have_rows('price')) : ?>

    <?php while (have_rows('price')) : the_row(); ?>

      <div class="price__item row">
        <div class="price__icon">
          <img src="<?php the_sub_field('icon'); ?>" alt="">
        </div>
        <div class="price__where">
          <?php the_sub_field('where');echo '&nbsp;';?>
        </div>
        <div class="price__value">
          <?php the_sub_field('price');?>
        </div>
      </div>

    <?php endwhile; ?>

  <?php endif; ?>


</div>