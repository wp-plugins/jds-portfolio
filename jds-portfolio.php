<?php
/**
 * Plugin Name: JDs Portfolio
 * Plugin URI: https://wordpress.org/plugins/jds-portfolio/
 * Description: JDs Portfolio Plugin enables you to Add a projects detailed and produce portfolio page to display information of past  Projects, Use [JDs_portfolio] shortcode for display portfolio.
 * Version: 2.0.0
 * Author: JayDeep Nimavat
 * Author URI:
 * License: GPLv2 or later
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions 
 * 
 * @package JDs Portfolio
 * @since 2.0.0
 */
global $wpdb;

if( !defined( 'WP_JDS_DIR' ) ) {
	define( 'WP_JDS_DIR', dirname( __FILE__ ) ); // plugin dir
}
if( !defined( 'WP_JDS_URL' ) ) {
	define( 'WP_JDS_URL', plugin_dir_url( __FILE__ ) ); // plugin url
}
if( !defined( 'WP_JDS_ADMIN_DIR' ) ) {
	define( 'WP_JDS_ADMIN_DIR', WP_JDS_DIR . '/includes/admin' ); // plugin admin dir
}
if( !defined( 'WP_JDS_POST_TYPE' ) ) {
	define( 'WP_JDS_POST_TYPE', 'jdsportfolio' ); // follow post custom post type's slug
}

/**
 * Load Text Domain
 *
 * This gets the plugin ready for translation.
 *
 * @package JDs Portfolio
 * @since 2.0.0
 */
load_plugin_textdomain( 'wpjdsp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package JDs Portfolio
 * @since 2.0.0
 */
register_activation_hook( __FILE__, 'wp_jds_install' );

/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package JDs Portfolio
 * @since 2.0.0
 */
register_deactivation_hook( __FILE__, 'wp_jds_uninstall');

/**
 * Plugin Setup (On Activation)
 *
 * Does the initial setup,
 * stest default values for the plugin options.
 *
 * @package JDs Portfolio
 * @since 2.0.0
 */
function wp_jds_install() {
	
	global $wpdb;

	//get all options of settings
	$wp_jds_options = get_option( 'wp_jds_options' );

	if ( empty($wp_jds_options) ) {
		
		$jds_options = array(
							'column'			=> 'col-md-4',
							'width'				=> '',
							'height'			=> '',
							'animation'			=> 'slide',
							'layer_bg_color'	=> 'green'
						);

		// Update options
		update_option( 'wp_jds_options', $jds_options );

		update_option( 'wp_jds_set_option', '2.0.0' );
	}
	
	$wpw_fp_set_option = get_option( 'wp_jds_set_option' );
}

/**
 * Plugin Setup (On Deactivation)
 *
 * Delete  plugin options.
 *
 * @package JDs Portfolio
 * @since 2.0.0
 */
function wp_jds_uninstall() {

	global $wpdb;
	
	//IMP Call of Function
	//Need to call when custom post type is being used in plugin
	flush_rewrite_rules();
	
	//get all options of settings
	$wp_jds_options = get_option( 'wp_jds_options' );
}

//global variables
global $wp_jds_model, $wp_jds_public, $wp_jds_admin,
		$wp_jds_script, $wp_jds_options,
		$wp_jds_message, $wp_jds_shortcode;

$wp_jds_options = get_option( 'wp_jds_options' );

//Register Post Types
require_once( WP_JDS_DIR . '/includes/wp-jds-post-types.php' );

//Script Class to add styles and scripts to admin and public side
require_once( WP_JDS_DIR . '/includes/class-wp-jds-scripts.php' );
$wp_jds_script = new Wp_Jds_Scripts();
$wp_jds_script->add_hooks();

//Model class handles most of functionalities related Data in plugin
require_once( WP_JDS_DIR . '/includes/class-wp-jds-model.php' );
$wp_jds_model = new Wp_Jds_Model();

//Shortcodes class for handling shortcodes
require_once( WP_JDS_DIR . '/includes/class-wp-jds-shortcodes.php' );
$wp_jds_shortcode = new Wp_Jds_Shortcodes();
$wp_jds_shortcode->add_hooks();

//Admin Pages Class for admin side
require_once( WP_JDS_ADMIN_DIR . '/class-wp-jds-admin.php' );
$wp_jds_admin = new Wp_Jds_Admin();
$wp_jds_admin->add_hooks();