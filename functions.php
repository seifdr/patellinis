<?php

// update_option( 'siteurl', 'http://www.duncanseif.com/patellinis' );
// update_option( 'home', 'http://www.duncanseif.com/patellinis' );

/**
 * patellinis_base functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package patellinis_base
 */



function look( $value, $margin = NULL ){

	if( $margin ){
		echo "<div style='margin-left: 200px'>";
	}

	echo "<pre>";
	print_r( $value );
	echo "</pre>";

	if( $margin ){
		echo "</div>";
	}

}

function not_Blank($var){
	if( isset($var) && !empty($var) ){
		return TRUE;
	} else {
		return FALSE;
	}
}

function displayImg( $imgID = NULL, $size = "thumbnail", $class = NULL, $echo = FALSE ){
	if( $imgID != NULL && !empty( $imgID ) ){
			$image_url 	  = wp_get_attachment_image_src( $imgID, $size );
			$image_alt 	  = get_post_meta( $imgID, '_wp_attachment_image_alt', true);
			$image_title  = get_the_title( $imgID );

			$output = '<img src="'. $image_url[0] .'"';

			if( !empty( $image_alt ) ){ 
				$ouput .= ' alt="'. $image_alt .'" ';
			}  

			if( !empty( $image_title ) ){ 
				$output .= ' title="'. $image_title .'" ';
			}  

			if( !empty( $class ) ){ 
				$output .= ' class="'. $class .'" ';
			}  

			$output .= ' />';
			
			if( $echo ){
				echo $output; 
			} else {
				return $output;
			}
	}
}

if ( ! function_exists( 'patelinis_base_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function patelinis_base_setup() {

	/*-------------------------------------------------------------------------------
		Register custom navigation walker
	-------------------------------------------------------------------------------*/
	require_once('wp-bootstrap-navwalker-master/wp_bootstrap_navwalker.php');


	/*-------------------------------------------------------------------------------
		Enable custom footer widgets
	-------------------------------------------------------------------------------*/

	//Built in widgets 

	function footer_widgets_init() {
		register_sidebar( 
			array(
				'name'          => esc_html__( 'Footer Widgets', 'patelinis_base' ),
				'id'            => 'patellinis-footer-widgets',
				'description'   => __('Footer widgets appear in the footer of each page.',  'patelinis_base'),
				'before_widget' => '<div id="%1$s" class="widget %2$s col-xs-12 col-sm-4 footer-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) 
		);
	}

	add_action( 'widgets_init', 'footer_widgets_init' );


	/*-------------------------------------------------------------------------------
			Change Wordpress default posts to menu items
	-------------------------------------------------------------------------------*/
	require_once('inc/menu.php');

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on patelinis_base, use a find and replace
	 * to change 'patelinis_base' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'patelinis_base', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	//add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'patelinis_base' ),
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
	add_theme_support( 'custom-background', apply_filters( 'patelinis_base_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'patelinis_base_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function patelinis_base_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'patelinis_base_content_width', 640 );
}
add_action( 'after_setup_theme', 'patelinis_base_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function patelinis_base_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'patelinis_base' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'patelinis_base' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'patelinis_base_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function patelinis_base_scripts() {
	wp_enqueue_style( 'patelinis_base-style', get_stylesheet_uri() );

	wp_enqueue_style( 'patellinis_bootstrap-style', get_template_directory_uri() . "/patellinis-bootstrap/css/bootstrap.min.css" );
	wp_enqueue_style( 'patellinis_main-style', get_template_directory_uri() . "/css/main.css" );

	wp_enqueue_style( 'patellinis_font_awesome-style', get_template_directory_uri() . "/font-awesome-4.7.0/css/font-awesome.min.css" );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.1.1.min.js', array(), '20151215', true );

	wp_enqueue_script( 'patelinnis_bootstrap_js', get_template_directory_uri() . '/patellinis-bootstrap/js/bootstrap.min.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'patelinnis_main_js', get_template_directory_uri() . '/js/main.js', array('jquery'), '20170619', true );

	wp_enqueue_script( 'patelinis_base-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'patelinis_base-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'patelinis_base_scripts' );

/*ADDS STYLESHEET ON WP-ADMIN*/
add_action( 'admin_enqueue_scripts', 'patellinis_add_stylesheet_to_admin' );
function patellinis_add_stylesheet_to_admin() {
	wp_enqueue_style( 'patellinis-admin-overrides', get_template_directory_uri(). '/css/menu-admin.css' );
}

/**
 * Implement the Breadcrumbs feature.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

//remove customizer 

// add_action( 'wp_before_admin_bar_render', 'patellinis_before_admin_bar_render' ); 

add_action('admin_menu', 'remove_comment_support');
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

add_action( 'admin_init', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'customize.php' );
}

//remove comments from upper admin bar
add_action( 'admin_bar_menu', 'remove_items_upper_admin_bar', 999 );

function remove_items_upper_admin_bar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'comments' );
	$wp_admin_bar->remove_node( 'customize' );
}

/**
 * Remove Admin Menu Link to Theme Customizer
 */
add_action( 'admin_menu', function () {
    global $submenu;

    if ( isset( $submenu[ 'themes.php' ] ) ) {
        foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
            if ( in_array( 'Customize', $menu_item ) ) {
                unset( $submenu[ 'themes.php' ][ $index ] );
            }
        }
    }
});

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/** 
* Custom Title Tag
*/ 

function patellinis_slug_render_title() 
{
	?>
	<title>
		<?php wp_title( '| '. get_bloginfo('name') . ' - ' . get_bloginfo('description') . " - Sarasota, FL", true, 'right' ); ?>
	</title>
	<?php
}
add_action( 'wp_head', 'patellinis_slug_render_title' );
