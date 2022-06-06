<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
    <section class="container">
      <div class="breadcrumbs">
        <?php bcn_display() ?>
      </div>
      <h1 class="single-title">
        <?php the_title() ?>
      </h1>
      <div class="page-content">
        <?php the_content(); ?>
      </div>
    </section>
  </main>
</div>
<?php
get_footer();
