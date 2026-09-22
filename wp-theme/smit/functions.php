<?php
/**
 * SMIT theme functions and definitions.
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SMIT_VERSION', '1.0.0' );
define( 'SMIT_DIR', get_template_directory() );
define( 'SMIT_URI', get_template_directory_uri() );

require_once SMIT_DIR . '/inc/helpers.php';
require_once SMIT_DIR . '/inc/setup.php';
require_once SMIT_DIR . '/inc/enqueue.php';
require_once SMIT_DIR . '/inc/cpt.php';
require_once SMIT_DIR . '/inc/nav-walker.php';
require_once SMIT_DIR . '/inc/meta-boxes.php';
require_once SMIT_DIR . '/inc/acf-fields.php';
require_once SMIT_DIR . '/inc/seed.php';
