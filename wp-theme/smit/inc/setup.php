<?php
/**
 * Theme setup.
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * After setup theme.
 */
function smit_setup() {
	load_theme_textdomain( 'smit', SMIT_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus(
		array(
			'primary'          => __( 'Primary Menu', 'smit' ),
			'footer_quick'     => __( 'Footer Quick Links', 'smit' ),
			'footer_courses'   => __( 'Footer Courses', 'smit' ),
			'footer_resources' => __( 'Footer Resources', 'smit' ),
		)
	);

	add_image_size( 'smit-course', 560, 300, true );
	add_image_size( 'smit-review', 420, 560, true );
	add_image_size( 'smit-campus', 640, 400, true );
}
add_action( 'after_setup_theme', 'smit_setup' );

/**
 * Flush rewrite rules once after theme activation.
 */
function smit_theme_activation() {
	smit_register_cpts();
	flush_rewrite_rules();
	update_option( 'smit_needs_seed', 1 );
}
add_action( 'after_switch_theme', 'smit_theme_activation' );
