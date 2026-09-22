<?php
/**
 * Custom post types and taxonomies.
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register CPTs and taxonomies.
 */
function smit_register_cpts() {
	register_post_type(
		'course',
		array(
			'labels'       => array(
				'name'          => __( 'Courses', 'smit' ),
				'singular_name' => __( 'Course', 'smit' ),
				'add_new_item'  => __( 'Add New Course', 'smit' ),
				'edit_item'     => __( 'Edit Course', 'smit' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'courses' ),
			'menu_icon'    => 'dashicons-welcome-learn-more',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);

	register_taxonomy(
		'course_category',
		'course',
		array(
			'labels'       => array(
				'name'          => __( 'Course Categories', 'smit' ),
				'singular_name' => __( 'Course Category', 'smit' ),
			),
			'public'       => true,
			'hierarchical' => true,
			'rewrite'      => array( 'slug' => 'course-category' ),
			'show_in_rest' => true,
		)
	);

	register_post_type(
		'campus',
		array(
			'labels'       => array(
				'name'          => __( 'Campuses', 'smit' ),
				'singular_name' => __( 'Campus', 'smit' ),
				'add_new_item'  => __( 'Add New Campus', 'smit' ),
				'edit_item'     => __( 'Edit Campus', 'smit' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'campuses' ),
			'menu_icon'    => 'dashicons-location-alt',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);

	register_post_type(
		'review',
		array(
			'labels'       => array(
				'name'          => __( 'Reviews', 'smit' ),
				'singular_name' => __( 'Review', 'smit' ),
				'add_new_item'  => __( 'Add New Review', 'smit' ),
				'edit_item'     => __( 'Edit Review', 'smit' ),
			),
			'public'       => true,
			'has_archive'  => false,
			'rewrite'      => array( 'slug' => 'reviews' ),
			'menu_icon'    => 'dashicons-format-quote',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'smit_register_cpts' );
