<?php



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
