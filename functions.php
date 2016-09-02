<?php
/**
 * To The Nines functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage To_The_Nines
 * @since To The Nines 1.0
 */

/**
 * To The Nines only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'tothenines_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own tothenines_setup() function to override in a child theme.
 *
 * @since To The Nines 1.0
 */
function tothenines_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/tothenines
	 * If you're building a theme based on To The Nines, use a find and replace
	 * to change 'tothenines' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tothenines' );

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
	 * Enable support for custom logo.
	 *  @since To The Nines 1.0
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tothenines' ),
		'social'  => __( 'Social Links Menu', 'tothenines' ),
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

	/*
	 * Enable support for Post Formats.
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', tothenines_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // tothenines_setup
add_action( 'after_setup_theme', 'tothenines_setup' );


/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since To The Nines 1.0
 */
function tothenines_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Left', 'tothenines' ),
		'id'            => 'sidebar-left',
		'description'   => __( 'Add widgets here to appear in your left sidebar.', 'tothenines' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
    'name'          => __( 'Sidebar Right', 'tothenines' ),
		'id'            => 'sidebar-right',
    'description'   => __( 'Add widgets here to appear in your right sidebar.', 'tothenines' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'tothenines' ),
		'id'            => 'sidebar-footer',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'tothenines' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tothenines_widgets_init' );

if ( ! function_exists( 'tothenines_fonts_url' ) ) :
/**
 * Register Google fonts for To The Nines.
 * Create your own tothenines_fonts_url() function to override in a child theme.
 *
 * @since To The Nines 1.0
 * @return string Google fonts URL for the theme.
 */
function tothenines_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	// /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	// if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'tothenines' ) ) {
	// 	$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	// }
  //
	// /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	// if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'tothenines' ) ) {
	// 	$fonts[] = 'Montserrat:400,700';
	// }
  //
	// /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	// if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'tothenines' ) ) {
	// 	$fonts[] = 'Inconsolata:400';
	// }

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since To The Nines 1.0
 */
function tothenines_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'tothenines_javascript_detection', 0 );


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since To The Nines 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function tothenines_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'tothenines_post_thumbnail_sizes_attr', 10 , 3 );


/**
 * Enqueues scripts and styles.
 *
 * @since To The Nines 1.0
 */
function tothenines_scripts() {

	// Theme stylesheet.
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'tothenines-ie', get_template_directory_uri() . '/css/ie.css', array( 'tothenines-style' ), '20160816' );
	wp_style_add_data( 'tothenines-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'tothenines-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'tothenines-style' ), '20160816' );
	wp_style_add_data( 'tothenines-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'tothenines-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'tothenines-style' ), '20160816' );
	wp_style_add_data( 'tothenines-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'tothenines-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'tothenines-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'tothenines-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tothenines-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'tothenines-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'tothenines-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'tothenines' ),
		'collapse' => __( 'collapse child menu', 'tothenines' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'tothenines_scripts' );


