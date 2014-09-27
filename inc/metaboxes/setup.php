<?php

include_once WP_PLUGIN_DIR . "/" . basename(JDs_PORTFOLIO_DIR) . "/inc/metaboxes/wpalchemy/MetaBox.php";

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', plugins_url() . "/" . basename(JDs_PORTFOLIO_DIR) . '/inc/metaboxes/meta.css');
}

/* eof */