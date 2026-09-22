<?php
/**
 * Theme helpers.
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme asset URL.
 *
 * @param string $path Relative path under theme assets/.
 * @return string
 */
function smit_asset( $path = '' ) {
	$path = ltrim( (string) $path, '/' );
	return SMIT_URI . '/assets/' . $path;
}

/**
 * Get post meta with fallback.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Meta key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function smit_meta( $post_id, $key, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $key, $post_id );
		if ( null !== $value && false !== $value && '' !== $value ) {
			return $value;
		}
	}

	$value = get_post_meta( $post_id, $key, true );
	return ( '' === $value || null === $value ) ? $default : $value;
}

/**
 * Safe option helper for theme options stored as page meta / options.
 *
 * @param string $key     Option key.
 * @param mixed  $default Default.
 * @return mixed
 */
function smit_option( $key, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $key, 'option' );
		if ( null !== $value && false !== $value && '' !== $value ) {
			return $value;
		}
	}

	$value = get_option( 'smit_' . $key, $default );
	return ( '' === $value || null === $value ) ? $default : $value;
}

/**
 * Resolve page URL by slug with fallback.
 *
 * @param string $slug Page slug.
 * @param string $fallback Fallback path.
 * @return string
 */
function smit_page_url( $slug, $fallback = '/' ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( $fallback );
}

/**
 * Enroll / portal URL.
 *
 * @return string
 */
function smit_enroll_url() {
	return smit_page_url( 'check-results', '/check-results/' );
}

/**
 * Courses archive URL.
 *
 * @return string
 */
function smit_courses_url() {
	$link = get_post_type_archive_link( 'course' );
	return $link ? $link : home_url( '/courses/' );
}

/**
 * Campuses archive URL.
 *
 * @return string
 */
function smit_campuses_url() {
	$link = get_post_type_archive_link( 'campus' );
	return $link ? $link : home_url( '/campuses/' );
}

/**
 * Course categories for mega menu / filters.
 *
 * @return WP_Term[]
 */
function smit_course_categories() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'course_category',
			'hide_empty' => false,
			'orderby'    => 'term_order',
		)
	);

	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Query courses by category slug.
 *
 * @param string $slug Category slug (or 'all').
 * @param int    $limit Posts per page.
 * @return WP_Post[]
 */
function smit_get_courses( $slug = 'all', $limit = -1 ) {
	$args = array(
		'post_type'      => 'course',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	);

	if ( $slug && 'all' !== $slug ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'course_category',
				'field'    => 'slug',
				'terms'    => $slug,
			),
		);
	}

	return get_posts( $args );
}

/**
 * Get all campuses.
 *
 * @return WP_Post[]
 */
function smit_get_campuses() {
	return get_posts(
		array(
			'post_type'      => 'campus',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
		)
	);
}

/**
 * Get reviews.
 *
 * @param int $limit Limit.
 * @return WP_Post[]
 */
function smit_get_reviews( $limit = -1 ) {
	return get_posts(
		array(
			'post_type'      => 'review',
			'posts_per_page' => $limit,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
		)
	);
}

/**
 * Featured image or theme asset fallback.
 *
 * @param int    $post_id Post ID.
 * @param string $fallback Relative asset path.
 * @param string $size    Image size.
 * @return string
 */
function smit_thumb_url( $post_id, $fallback = '', $size = 'large' ) {
	$url = get_the_post_thumbnail_url( $post_id, $size );
	if ( $url ) {
		return $url;
	}
	return $fallback ? smit_asset( $fallback ) : '';
}
