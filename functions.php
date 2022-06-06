<?php

/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}



if (!function_exists('theme_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function theme_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme, use a find and replace
		 * to change 'theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('theme', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'theme'),
				'main-menu' => esc_html__('Secondary', 'theme'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('theme_content_width', 640);
}
add_action('after_setup_theme', 'theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'theme'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'theme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'theme_widgets_init');


function theme_scripts()
{
	wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), _S_VERSION);

	wp_enqueue_style('frontend', get_template_directory_uri() . '/dist/css/main.css');
	wp_enqueue_script('frontend-js', get_template_directory_uri() . '/dist/js/main.js', array(), true, true);
	wp_enqueue_script('custom' , get_stylesheet_directory_uri() , array() , true ,true);
	wp_localize_script('frontend-js', 'ajaxparam', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',

	));
}
add_action('wp_enqueue_scripts', 'theme_scripts');

function clear_phone($phone_str)
{
	$phone_str = preg_replace('/\D+/', '', $phone_str);

	return $phone_str;
}

if (function_exists('acf_add_options_page')) {



	acf_add_options_page(array(
		'page_title' => 'Настройки темы ',
		'menu_title' => 'Настройки темы ',
		'menu_slug'  => "site-options",
	));
}
add_filter(
	'ai1wm_exclude_themes_from_export',
	function ($exclude_filters) {
		$exclude_filters[] = 'theme/node_modules'; // insert your theme name
		return $exclude_filters;
	}
);

require_once(dirname(__FILE__) . '/breadcrumbs.php');
// хук для регистрации
add_action('init', 'create_taxonomy');
function create_taxonomy()
{

	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy('cars-category', ['cars'], [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Категории',
			'singular_name'     => 'Категория',
			'search_items'      => 'Искать',
			'all_items'         => 'Все категории',
			'view_item '        => 'Смотреть категорию',
			'parent_item'       => 'Родитель категории',
			'parent_item_colon' => 'Родители категории:',
			'edit_item'         => 'Редактировать',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить новую категорию',
			'new_item_name'     => 'Новое имя категории',
			'menu_name'         => 'Категории',
			'back_to_items'     => '← Назад к категориям',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false,
		'meta_box_cb' 					=> 'post_categories_meta_box',
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)

	]);
}
add_action('init', 'register_post_types');
function register_post_types()
{
	register_post_type('cars', [
		'labels' => [
			'name'               => 'Минивены', // основное название для типа записи
			'singular_name'      => 'Минивены', // название для одной записи этого типа
			'add_new'            => 'Добавить Минивены', // для добавления новой записи
			'add_new_item'       => 'Добавление Минивены', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Минивены', // для редактирования типа записи
			'new_item'           => 'Новое Минивены', // текст новой записи
			'view_item'          => 'Смотреть Минивены', // для просмотра записи этого типа.
			'search_items'       => 'Искать Минивены', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Минивены', // название меню
		],
		'description'         => '',
		'public'              => true,
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'thumbnail'],
		'taxonomies'          => ['cars-category'],

		'has_archive'         => false,
		'query_var'           => true,
		'taxonomies'          => array( 'cars-category' ),
	]);
	register_post_type('news', [
		'labels' => [
			'name'               => 'Новости', // основное название для типа записи
			'singular_name'      => 'Новость', // название для одной записи этого типа
			'add_new'            => 'Добавить', // для добавления новой записи
			'add_new_item'       => 'Добавление', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование', // для редактирования типа записи
			'new_item'           => 'Новое', // текст новой записи
			'view_item'          => 'Смотреть', // для просмотра записи этого типа.
			'search_items'       => 'Искать', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Новости', // название меню
		],
		'description'         => '',
		'public'              => true,
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'excerpt'],
		'taxonomies' => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	]);
	register_post_type('reviews', [
		'labels' => [
			'name'               => 'Отзывы', // основное название для типа записи
			'singular_name'      => 'Отзыв', // название для одной записи этого типа
			'add_new'            => 'Добавить', // для добавления новой записи
			'add_new_item'       => 'Добавление', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование', // для редактирования типа записи
			'new_item'           => 'Новое', // текст новой записи
			'view_item'          => 'Смотреть', // для просмотра записи этого типа.
			'search_items'       => 'Искать', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Отзывы', // название меню
		],
		'description'         => '',
		'public'              => true,
		'hierarchical'        => false,
		'supports'            => ['title', 'editor', 'excerpt'],
		'taxonomies' => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	]);
}


add_filter( 'post_type_link', 'category_permalink', 1, 2 );
function category_permalink( $permalink, $post ){

	// выходим если это не наш тип записи: без холдера %faqcat%
	if( strpos( $permalink, '%cars-category%' ) === false )
		return $permalink;

	// Получаем элементы таксы
	$terms = get_the_terms( $post, 'cars-category' );
	// если есть элемент заменим холдер
	if( ! is_wp_error( $terms ) && !empty( $terms ) && is_object( $terms[0] ) )
		$term_slug = array_pop( $terms )->slug;
	// элемента нет, а должен быть...
	else
		$term_slug = 'no-carscat';

	return str_replace( '%cars-category%', $term_slug, $permalink );
}


/**
 * Fix pagination on archive pages
 * After adding a rewrite rule, go to Settings > Permalinks and click Save to flush the rules cache
 */
function my_pagination_rewrite()
{
	add_rewrite_rule('cars-category/page/?([0-9]{1,})/?$', 'index.php?category_name=cars-category&paged=$matches[1]', 'top');
}
add_action('init', 'my_pagination_rewrite');

class Custom_Menu extends Walker_Nav_Menu
{

	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{

		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		//print_r($args);
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (empty($children)) {
			$output .= $indent . '<li class="menu-item">';
		} else {
			$output .= $indent . '<li class="dropdown menu-item">';
		}
		$atts = array();
		$atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target)     ? $item->target     : '';
		$atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
		$atts['href']   = !empty($item->url)        ? $item->url        : '';
		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		if ($children) {
			$item_output = $args->before;
			$item_output .= '<a class="dropdown-toggle js-activated" data-toggle="dropdown" href="' . $atts['href'] . '">';
			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$item_output .= '<span class="arrow"></span>';
			$item_output .= '</a>';
			$item_output .= $args->after;
		} else {
			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
		}

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	public function start_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\"><span class=\"dropdown-inner container\">\n";
	}
}



add_filter('excerpt_length', function () {
	return 10;
});

function na_remove_slug( $post_link, $post, $leavename ) {

	if ( 'cars' != $post->post_type || 'publish' != $post->post_status ) {
			return $post_link;
	}

	$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

	return $post_link;
}
add_filter( 'post_type_link', 'na_remove_slug', 10, 3 );

function na_parse_request( $query ) {

	if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
			return;
	}

	if ( ! empty( $query->query['name'] ) ) {
			$query->set( 'post_type', array( 'post', 'cars', 'page' ) );
	}
}
add_action( 'pre_get_posts', 'na_parse_request' );