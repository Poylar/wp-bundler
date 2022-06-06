<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>
<?php $args = array(
	'taxonomy' => 'cars-category',
	'hide_empty' => false
) ?>
<?php $terms = get_terms($args); ?>

<aside class="sidebar">
	<div class="category col">
		<?php foreach ($terms as $term) : ?>
			<div class="category__item">
				<a href="<?= get_term_link($term) ?>" class="category__link">
					<?php echo $term->name ?>
				</a>
			</div>
		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>
	</div>
	<?php $args = array(
		'posts_per_page' => 3,
		'post_type' => 'news',

	) ?>
	<?php $query = new WP_Query($args) ?>

	<?php if ($query->have_posts()) : ?>
		<div class="news">
			<h3 class="news__heading">
				Наши новости
			</h3>
			<?php while ($query->have_posts()) : $query->the_post() ?>
				<article class="news__item">
					<span class="news__date">
						<?= get_the_date('j F Y') ?>
					</span>
					<h4 class="news__title">
						<a href="<?php the_permalink() ?>">
							<?php the_title() ?>
						</a>
					</h4>
					<div class="news__description">
						<?php the_excerpt() ?>
					</div>
				</article>

			<?php endwhile ?>
			<?php wp_reset_postdata($query) ?>
		</div>
	<?php endif; ?>

</aside>