<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package JayDeep Nimavat
 * @since 2.0.0
 */
class Wp_Jds_Scripts {
	
	public function __construct() {
		
	}

	/**
	 * Handle public side scripts
	 *
	 * @package JayDeep Nimavat
	 * @since 2.0.0
	 */
	public function wp_jds_public_enqueue_scripts() {

		// enqueue bootstrap js
		wp_register_script( 'wp-jds-bootstrap-js', WP_JDS_URL.'/js/bootstrap.min.js', array('jquery'), NULL, false );
		wp_enqueue_script( 'wp-jds-bootstrap-js' );

		// enqueue prettyphoto js
		wp_register_script( 'wp-jds-prettyphoto-js', WP_JDS_URL.'/js/jquery.prettyPhoto.js', array('jquery'), NULL, false );
		wp_enqueue_script( 'wp-jds-prettyphoto-js' );

		// enqueue mixit js
		wp_register_script( 'wp-jds-mixit-js', WP_JDS_URL.'/js/jquery.mixitup.min.js', array('jquery'), NULL, false );
		wp_enqueue_script( 'wp-jds-mixit-js' );

		// enqueue public js
		wp_register_script( 'wp-jds-public-js', WP_JDS_URL.'/js/wp-jds-public.js', array('jquery'), NULL, false );
		wp_enqueue_script( 'wp-jds-public-js' );
	}

	/**
	 * Handle public side styles
	 *
	 * @package JayDeep Nimavat
	 * @since 2.0.0
	 */
	public function wp_jds_public_enqueue_styles() {

		// enqueue bootstrap css
		wp_register_style( 'wp-jds-bootstrap-css', WP_JDS_URL.'/css/bootstrap.min.css' );
		wp_enqueue_style( 'wp-jds-bootstrap-css' );

		// enqueue prettyphoto css
		wp_register_style( 'wp-jds-prettyphoto-css', WP_JDS_URL.'/css/prettyPhoto.css' );
		wp_enqueue_style( 'wp-jds-prettyphoto-css' );

		// enqueue font awesome css
		wp_register_style( 'wp-jds-font-awesome-css', WP_JDS_URL.'/css/font-awesome.min.css' );
		wp_enqueue_style( 'wp-jds-font-awesome-css' );

		// enqueue public css
		wp_register_style( 'wp-jds-public-css', WP_JDS_URL.'/css/wp-jds-public.css' );
		wp_enqueue_style( 'wp-jds-public-css' );		
	}

	/**
	 * Adding Hooks
	 *
	 * Adding proper hoocks for the scripts.
	 *
	 * @package JayDeep Nimavat
	 * @since 2.0.0
	 */
	public function add_hooks() {
		
		// Enqueue public scripts
		add_action( 'wp_enqueue_scripts', array($this, 'wp_jds_public_enqueue_scripts') );

		// Enqueue public styles
		add_action( 'wp_enqueue_scripts', array($this, 'wp_jds_public_enqueue_styles') );
	}
}