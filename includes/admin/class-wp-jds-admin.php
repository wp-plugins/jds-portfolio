<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Handles all admin functionalities of plugin
 *
 * @package JDs Portfolio
 * @since 2.0.0
 */
class Wp_Jds_Admin {

	var $model;
	function __construct () {
				
		global $wp_jds_model;
		$this->model = $wp_jds_model;
	}

	/**
	 * Manage menu/submenu page
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function wp_jds_add_menu_page() {

		// add submenu page for settings
		add_submenu_page( 'edit.php?post_type=jdsportfolio', __('Settings', 'wpjdsp'), __('Settings', 'wpjdsp'), 'manage_options', 'jds-settings', array($this,'wp_jds_settings_page') );
	}

	/**
	 * Include settings/options page
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function wp_jds_settings_page() {
		// include settings page
		include_once( WP_JDS_DIR. '/includes/admin/forms/wp-jds-settings.php' );
	}

	/**
	 * Manage register settings
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function wp_jds_register_settings() {
		register_setting( 'wp_jds_options_settings', 'wp_jds_options', array($this, 'wp_jds_validate_options') );
	}

	/**
	 * Validate plugin options
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function wp_jds_validate_options($input) {

		$input['column']			= isset($input['column']) ? trim($input['column']) : 'col-md-4';
		$input['width']				= isset($input['width']) ? trim($input['width']) : '';
		$input['height']			= isset($input['height']) ? trim($input['height']) : '';
		$input['animation']			= isset($input['animation']) ? trim($input['animation']) : 'slide';
		$input['layer_bg_color']	= isset($input['layer_bg_color']) ? trim($input['layer_bg_color']) : 'grey';

		return $input;
	}

	/**
	 * Adding portfolio meta
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function wp_jds_add_portfolio_meta() {

		add_meta_box( 'wp_jds_meta', __( 'JDs Portfolio Settings', 'wpjdsp' ), array($this, 'wp_jds_add_meta_fields'), 'jdsportfolio' );
	}

	/**
	 * Adding portfolio meta
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function wp_jds_add_meta_fields($post) {

		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'wp_jds_save_meta_box_data', 'wp_jds_meta_box_nonce' );

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$pf_link = get_post_meta( $post->ID, '_wpjdsp_portfolio_link', true ); ?>

		<table class="form_table">
			<tr>
				<th scope="row">
					<label for="wpjdsp_portfolio_link"><?php echo __('Portfolio Link', 'wpjdsp'); ?></label>
				</th>
				<td>
					<input type="text" id="wpjdsp_portfolio_link" class="regular-text" name="wpjdsp_portfolio_link" value="<?php echo esc_attr($pf_link); ?>" />
				</td>
			</tr>
		</table>

	<?php	
	}

	/**
	 * Save portfolio meta options
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function wp_jds_save_posrfolio_meta( $post_id ) {

		// Check if our nonce is set.
		if ( ! isset( $_POST['wp_jds_meta_box_nonce'] ) ) {
			return;
		}
		
		$pf_url = isset($_POST['wpjdsp_portfolio_link']) ? sanitize_text_field(trim($_POST['wpjdsp_portfolio_link'])) : '';

		// Update the meta field in the database.
		update_post_meta( $post_id, '_wpjdsp_portfolio_link', $pf_url );
	}

	/**
	 * Adding Hooks
	 *
	 * @package JDs Portfolio
	 * @since 2.0.0
	 */
	public function add_hooks() {

		// Add submenu page for settings
		add_action( 'admin_menu', array($this, 'wp_jds_add_menu_page') );

		// register portfolio options
		add_action( 'admin_init', array($this, 'wp_jds_register_settings') );
		
		// add metaboxes in portfolio
		add_action( 'add_meta_boxes', array($this, 'wp_jds_add_portfolio_meta') );

		// Save meta box options
		add_action( 'save_post', array($this, 'wp_jds_save_posrfolio_meta') );
	}
}