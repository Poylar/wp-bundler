<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>


	<header class="header">
		<div class="header__top">
			<div class="container row space-between align-center header__top-inner">
				<div class="header__top-menu">
					<?php wp_nav_menu(array(
						'menu' => 'header-top',
						'container' => 'nav'
					)) ?>
				</div>

			</div>
		</div>
		<div class="header__main">
			<div class="header__main-inner container row space-between align-center">
				<div class="header__logo">
					<a href="/">
						<img src="<?php the_field('logo', 'option'); ?>" alt="">
					</a>
				</div>
				<div class="header__work-mode col">
					<div class="header__work-mode--text">
						Режим работы:
					</div>
					<div class="header__work-mode--term">
						<?php the_field('work-time', 'option'); ?>
					</div>
				</div>
				<div class="header__email row align-center">
					<svg class="icon" width="20" height="20">
						<use xlink:href="#email"></use>
					</svg>
					<a class="header__email-link" href="mailto:<?php the_field('email', 'option'); ?>">
						<?php the_field('email', 'option'); ?>
					</a>
				</div>
				<div class="header__phone-wrapper row">
					<?php if (have_rows('phones', 'option')) : ?>

						<?php while (have_rows('phones', 'option')) : the_row(); ?>

							<div class="header__phone row align-center">
								<svg class="icon" width="14" height="14">
									<use xlink:href="#phone"></use>
								</svg>
								<a href="tel:<?= clear_phone(get_sub_field('phone')); ?>" class="header__phone-link">
									<?php the_sub_field('phone'); ?>
								</a>
							</div>

						<?php endwhile; ?>

					<?php endif; ?>

				</div>
				<div class="btn btn__primary header__btn js-open-modal">
					<a href="<?php the_permalink(122) ?>">
						Заказать минивен
					</a>
				</div>
			</div>
		</div>
		<div class="header__nav">
			<div class="container header__nav-inner">
				<?php wp_nav_menu(array(
					'menu' => 'main-menu',
					'container' => 'nav'
				)) ?>
			</div>
		</div>
	</header>

	<header class="header_mobile">
		<div class="header__payment row ">
			<?php
			$payment = get_field('payment', 'option');
			?>
			<?php foreach ($payment as $item) : ?>
				<div class="header__payment-item">
					<img src="<?= $item['url'] ?>" alt="">
				</div>
			<?php endforeach ?>


		</div>
		<div class="header_mobile-inner col">
			<div class="header__top row align-center space-between">
				<div class="header__logo">
					<a href="/">
						<img src="<?php the_field('logo', 'option'); ?>" alt="">
					</a>
				</div>
				<div class="header__btn btn btn__primary js-open-modal">
					<a href="<?php the_permalink(122) ?>">
						Заказать минивен
					</a>
				</div>
				<div class="header__nav-btn js-nav-btn">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
			<div class="header__phone-wrapper row">
				<?php if (have_rows('phones', 'option')) : ?>

					<?php while (have_rows('phones', 'option')) : the_row(); ?>

						<div class="header__phone row align-center">
							<svg class="icon" width="14" height="14">
								<use xlink:href="#phone"></use>
							</svg>
							<a href="tel:<?= clear_phone(get_sub_field('phone')); ?>" class="header__phone-link">
								<?php the_sub_field('phone'); ?>
							</a>
						</div>

					<?php endwhile; ?>

				<?php endif; ?>



			</div>
		</div>
		<div class="header__nav js-header-nav">
			<?php wp_nav_menu(array(
				'menu' => 'mobile-menu',
				'container' => 'nav',
				'walker' => new Custom_Menu
			)) ?>
		</div>
	</header>