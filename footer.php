<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

?>
<div class="mobile-callback">
  <div class="mobile-callback__item">
    <a href="https://wa.me/<?= clear_phone(get_field('phones', 'option')[0]['phone']) ?>">
      <svg class="icon" width="14" height="14">
        <use xlink:href="#waw"></use>
      </svg>
      <span class="mobile-callback__text">
        WhatsApp
      </span>
    </a>
  </div>
  <div class="mobile-callback__item">
    <a href="https://t.me/taximusminivan">
      <svg class="icon" width="14" height="14">
        <use xlink:href="#tgw"></use>
      </svg>
      <span class="mobile-callback__text">
        Telegram
      </span>
    </a>
  </div>
  <div class="mobile-callback__item">
    <a href="tel:<?= clear_phone(get_field('phones', 'option')[0]['phone']) ?>">
      <svg class="icon" width="14" height="14">
        <use xlink:href="#phone"></use>
      </svg>
      <span class="mobile-callback__text">
        Позвонить
      </span>
    </a>
  </div>
</div>
</div>
<footer class="footer">
  <div class="container footer-inner col">
    <div class="footer-top">
      <div class=" footer__col">
        <div class="footer__logo">
          <a href="/">
            <img src="<?php the_field('logo', 'option'); ?>" alt="">
          </a>
        </div>
        <div class="footer__btn btn btn__primary js-open-modal">
      		<a href="<?php the_permalink(122) ?>">
				Заказать минивен
			</a>
        </div>
        <div class="footer__work-mode col">
          <div class="footer__work-mode--text">
            График работы:
          </div>
          <div class="footer__work-mode--term">
            <?php the_field('work-time', 'option'); ?>
          </div>
        </div>
        <div class="footer__payment row">
          <?php
          $payment = get_field('payment', 'option');
          ?>
          <?php foreach ($payment as $item) : ?>
            <div class="footer__payment-item">
              <img src="<?= $item['url'] ?>" alt="">
            </div>
          <?php endforeach ?>

        </div>
      </div>
      <div class="footer__col col">
        <div class="footer__title">
          Варианты аренды
        </div>
        <?php $args = array(
          'taxonomy' => 'cars-category',
          'hide_empty' => false
        ) ?>
        <?php $terms = get_terms($args); ?>
        <ul class="footer__terms">
          <?php foreach ($terms as $term) : ?>
            <li class="footer__terms-item">
              <a href="<?php get_Term_link($term); ?>">
                <?= $term->name  ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="footer__col col">
        <div class="footer__title">
          Контакты
        </div>
        <div class="footer__item footer__phone">
          <div class="footer__item--text">
            Телефон
          </div>
          <div class="footer__item--value">
            <?php if (have_rows('phones', 'option')) : ?>

              <?php while (have_rows('phones', 'option')) : the_row(); ?>

                <div class="footer__phone">
                  <a href="tel:<?= clear_phone(get_sub_field('phone')); ?>">
                    <?php the_sub_field('phone'); ?>
                  </a>
                </div>

              <?php endwhile; ?>

            <?php endif; ?>

          </div>
        </div>
        <div class="footer__item footer__email">
          <div class="footer__item--text">
            Email
          </div>
          <div class="footer__item--value">
            <a href="mailto:<?php the_field('email', 'option'); ?>">
              <?php the_field('email', 'option'); ?>
            </a>
          </div>
        </div>
        <div class="footer__item footer__address">
          <div class="footer__item--text">
            Адрес
          </div>
          <div class="footer__item--value">
            <address>
              <?php the_field('address', 'option'); ?>
            </address>
          </div>
        </div>
        <div class="footer__socials row">

          <?php if (have_rows('socials', 'option')) : ?>

            <?php while (have_rows('socials', 'option')) : the_row(); ?>
              <div class="footer__socials-item">
                <a href="<?php the_sub_field('link'); ?>">
                  <img src="<?php the_sub_field('icon'); ?>" alt="">
                </a>
              </div>
            <?php endwhile; ?>

          <?php endif; ?>


        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer__copyright">
        © 2019 Taximus.ru - минивены в аренду. <br>
        Все права защищены.
      </div>
      <div class="footer__info">
        ОГРНИП 313402916400027
      </div>
      <div class="footer__policy">
        <?php the_privacy_policy_link() ?>
      </div>
    </div>
  </div>
</footer>
<div class="sprites">
  <?php require_once(dirname(__FILE__) . '/dist/sprite.svg'); ?>
</div>
<?php wp_footer(); ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(88491260, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/88491260" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


</body>


</html>