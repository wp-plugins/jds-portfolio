<?php
/*
  Plugin Name: JDs Portfolio
  Plugin URI: 
  Description:
  Version: 1.0.1
  Author: JD Nimavat
  Author URI:
  License:
 */
 
define('JDs_PORTFOLIO_DIR', dirname(__FILE__));
define('JDs_PORTFOLIO_URL', plugins_url() . "/". basename(JDs_PORTFOLIO_DIR));
define('JDs_PORTFOLIO_VERSION', '1.0.1');

/******* Include Metabox class *********/
include_once 'inc/metaboxes/setup.php';
include_once 'inc/metaboxes/simple-spec.php';

/*********** Enqueue JDs Styles/Scripts *************/
wp_enqueue_style('JDs_portfolio_css', JDs_PORTFOLIO_URL . "/JDs_portfolio.css", null, null, "");

function JDs_add_styles() { 

	/* Bootstrep */
	wp_enqueue_style('JDs_bootstrap_css', JDs_PORTFOLIO_URL . "/css/bootstrap.min.css", null, null, "");
	/* Font Awesome */
	wp_enqueue_style('JDs_font-awesome_css', JDs_PORTFOLIO_URL . "/css/font-awesome.min.css", null, null, "");
	//jquery.prettyPhoto
	wp_enqueue_style('JDs_prettyphoto', JDs_PORTFOLIO_URL . '/inc/prettyphoto/css/prettyPhoto.css', null, "");
	
	/*********** Enqueue JDs Script *************/
	wp_register_script('JDs_bootstrap', JDs_PORTFOLIO_URL . '/js/bootstrap.min.js', array('jquery'));
	wp_register_script('JDs_mixitup', JDs_PORTFOLIO_URL . '/js/jquery.mixitup.min.js', array('jquery'));
	wp_register_script('JDs_prettyphoto', JDs_PORTFOLIO_URL . '/inc/prettyphoto/js/jquery.prettyPhoto.js', array('jquery'));
	
	wp_enqueue_script('JDs_prettyphoto');
	wp_enqueue_script('JDs_mixitup');
	wp_enqueue_script('JDs_bootstrap');

}

add_action( 'wp_enqueue_scripts', 'JDs_add_styles' );

add_action( 'init', 'register_JDs_portfolio' );
function register_JDs_portfolio() {

    $labels = array(
        'name' => _x( 'Portfolio', 'portfolio' ),
        'singular_name' => _x( 'Portfolio', 'portfolio' ),
        'add_new' => _x( 'Add New', 'portfolio' ),
        'add_new_item' => _x( 'Add New Portfolio', 'portfolio' ),
        'edit_item' => _x( 'Edit Portfolio', 'portfolio' ),
        'new_item' => _x( 'New Portfolio', 'portfolio' ),
        'view_item' => _x( 'View Portfolio', 'portfolio' ),
        'search_items' => _x( 'Search Portfolio', 'portfolio' ),
        'not_found' => _x( 'No portfolio found', 'portfolio' ),
        'not_found_in_trash' => _x( 'No portfolio found in Trash', 'portfolio' ),
        'parent_item_colon' => _x( 'Parent portfolio:', 'portfolio' ),
        'menu_name' => _x( 'JDs Portfolio', 'portfolio' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'A post type for portfolio add Portfolio short code in description field.',
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions' ),
        'taxonomies' => array( 'portfolio-categories' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 10,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' =>  array('slug' => 'portfolio'),
        'capability_type' => 'page'
    );

    register_post_type( 'portfolio', $args );
}

// register portfolio categories
add_action( 'init', 'register_taxonomy_portfolio_categories' );

function register_taxonomy_portfolio_categories() {

    $labels = array( 
        'name' => _x( 'portfolio categories', 'portfolio-categories' ),
        'singular_name' => _x( 'Portfolio Category', 'portfolio-categories' ),
        'search_items' => _x( 'Search portfolio categories', 'portfolio-categories' ),
        'popular_items' => _x( 'Popular portfolio categories', 'portfolio-categories' ),
        'all_items' => _x( 'All Portfolio categories', 'portfolio-categories' ),
        'parent_item' => _x( 'Parent Portfolio Category', 'portfolio-categories' ),
        'parent_item_colon' => _x( 'Parent Portfolio Category:', 'portfolio-categories' ),
        'edit_item' => _x( 'Edit Portfolio Category', 'portfolio-categories' ),
        'update_item' => _x( 'Update Portfolio Category', 'portfolio-categories' ),
        'add_new_item' => _x( 'Add New Portfolio Category', 'portfolio-categories' ),
        'new_item_name' => _x( 'New Portfolio Category', 'portfolio-categories' ),
        'separate_items_with_commas' => _x( 'Separate portfolio categories with commas', 'portfolio-categories' ),
        'add_or_remove_items' => _x( 'Add or remove portfolio categories', 'portfolio-categories' ),
        'choose_from_most_used' => _x( 'Choose from the most used portfolio categories', 'portfolio-categories' ),
        'menu_name' => _x( 'Portfolio Categories', 'portfolio-categories' ),
	);

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'hierarchical' => true,

        'rewrite' => array('with_front' => false, 'hierarchical' => true),
        'query_var' => true
    );

    register_taxonomy( 'portfolio-categories', array('portfolio'), $args );
}

/******** Settings Page ********/
function JDs_enable_pages() {
	add_submenu_page('edit.php?post_type=portfolio', 'Custom Post Type Admin', 'JDs Settings', 'edit_posts', basename(__FILE__), 'JDs_custom_setting');
}

add_action('admin_menu' , 'JDs_enable_pages');

function JDs_custom_setting()
{
	include('inc/JDs_custom_setting.php');
}

/********* Create Shortcode *************/
add_shortcode('JDs_portfolio', 'JDs_portfolio_function');

function JDs_portfolio_function($atts = array()) {
    ob_start();
    JDs_portfolio_view($atts);
    $content = ob_get_clean();
    return $content;
}

function JDs_portfolio_view($atts = array()) {

	require_once( JDs_PORTFOLIO_DIR . "/inc/JDs_portfolio_view.php");
}

function JDs_portfolio_list_categories() {
    $_categories = get_categories('taxonomy=portfolio-categories');
    foreach ($_categories as $_cat) {
        ?>
        <button class="filter" data-filter=".<?php echo $_cat->slug; ?>"><?php echo $_cat->name; ?></button>
        <?php
    }
}

function JDs_portfolio_add_classes($post_id = null) {
    if ($post_id === null)
        return;
    $_terms = wp_get_post_terms($post_id, 'portfolio-categories');
    foreach ($_terms as $_term) {
        $retu .= $_term->slug." ";
    }
	return $retu;
}