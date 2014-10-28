<?php
$custom_metabox = $JDs_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'JDs Portfolio Meta',
	'types' => array('portfolio'),
	'template' => WP_PLUGIN_DIR . "/" . basename(JDs_PORTFOLIO_DIR) . '/inc/metaboxes/simple-meta.php',
));

/* eof */