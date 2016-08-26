<?php
/**
 * _goha functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _goha
 */

if ( ! function_exists( '_goha_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _goha_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _goha, use a find and replace
	 * to change '_goha' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_goha', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', '_goha' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_goha_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', '_goha_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _goha_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_goha' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', '_goha' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', '_goha_widgets_init' );


function goha_setup(){

	register_nav_menus(array(
		'primary' => 'menu chính',
	));

}
add_action('after_setup_theme', 'goha_setup');




if (is_admin()) {
	include (TEMPLATEPATH . '/core/panel/mpanel-ui.php');
	include (TEMPLATEPATH . '/core/panel/mpanel-editor.php');
	include (TEMPLATEPATH . '/core/panel/mpanel-functions.php');
}
function tie_get_option( $name ) {
     $get_options = get_option( 'tie_options' );
     if( !empty( $get_options[$name] ))
          return $get_options[$name];
     return false ;
}
$themename = "Codex4u";
define ('theme_name', $themename );

add_filter( 'timber_context', 'add_to_context' );
function add_to_context( $context ) {
	$context['menu_main'] = wp_nav_menu( array(
		'theme_location' => 'primary', 
		'echo' => false, 
		'container' => ''
	));
	 
	$context['tie_options'] = get_option( 'tie_options' );
	 
	return $context;
}

require_once(TEMPLATEPATH . '/core/templateHelper/helper_template.php');