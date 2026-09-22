<?php
/**
 * Scripts and styles.
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue front-end assets.
 */
function smit_enqueue_assets() {
	$ver = SMIT_VERSION;

	wp_enqueue_style(
		'smit-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
		array(),
		'6.5.1'
	);

	wp_enqueue_style(
		'smit-animate',
		'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
		array(),
		'4.1.1'
	);

	wp_enqueue_style( 'smit-fonts', smit_asset( 'css/fonts.css' ), array(), $ver );
	wp_enqueue_style( 'smit-nav', smit_asset( 'css/nav.css' ), array( 'smit-fonts' ), $ver );
	wp_enqueue_style( 'smit-theme-black', smit_asset( 'css/theme-black.css' ), array( 'smit-nav' ), $ver );
	wp_enqueue_style( 'smit-style', get_stylesheet_uri(), array( 'smit-theme-black' ), $ver );

	if ( is_front_page() ) {
		wp_enqueue_style( 'smit-clone', smit_asset( 'css/clone.css' ), array( 'smit-style' ), $ver );
	}

	if ( is_page_template( 'page-about.php' ) || is_page( 'about' ) ) {
		wp_enqueue_style( 'smit-legacy', smit_asset( 'css/style.css' ), array( 'smit-style' ), $ver );
	}

	if ( is_post_type_archive( 'course' ) || is_singular( 'course' ) || is_front_page() ) {
		wp_enqueue_style( 'smit-courses', smit_asset( 'css/courses.css' ), array( 'smit-style' ), $ver );
	}

	if ( is_post_type_archive( 'campus' ) || is_singular( 'campus' ) ) {
		wp_enqueue_style( 'smit-campuses', smit_asset( 'css/campuses.css' ), array( 'smit-style' ), $ver );
	}

	if ( is_page_template( 'page-portal.php' ) || is_page( 'check-results' ) ) {
		wp_enqueue_style( 'smit-portal', smit_asset( 'css/portal.css' ), array( 'smit-style' ), $ver );
	}

	// Tailwind CDN (matches static site).
	wp_enqueue_script( 'smit-tailwind', 'https://cdn.tailwindcss.com', array(), null, false );
	wp_enqueue_script( 'smit-tailwind-config', smit_asset( 'js/tailwind-config.js' ), array( 'smit-tailwind' ), $ver, false );

	wp_enqueue_script( 'smit-theme', smit_asset( 'js/theme.js' ), array(), $ver, true );
	wp_enqueue_script( 'smit-nav', smit_asset( 'js/nav.js' ), array( 'smit-theme' ), $ver, true );
	wp_enqueue_script( 'smit-reveal', smit_asset( 'js/reveal.js' ), array(), $ver, true );

	$courses_payload = array();
	foreach ( smit_get_courses( 'all' ) as $course ) {
		$terms = wp_get_post_terms( $course->ID, 'course_category', array( 'fields' => 'slugs' ) );
		$courses_payload[] = array(
			'id'       => $course->ID,
			'title'    => get_the_title( $course ),
			'desc'     => wp_strip_all_tags( $course->post_excerpt ? $course->post_excerpt : $course->post_content ),
			'duration' => smit_meta( $course->ID, 'duration', '' ),
			'category' => ! empty( $terms ) ? $terms[0] : 'open',
			'image'    => smit_thumb_url( $course->ID, 'images/courses/FLC.jpg' ),
			'url'      => get_permalink( $course ) ?: smit_enroll_url(),
			'enroll'   => smit_meta( $course->ID, 'enroll_url', smit_enroll_url() ),
		);
	}

	$mega = array();
	foreach ( smit_course_categories() as $term ) {
		$items = array();
		foreach ( smit_get_courses( $term->slug, 4 ) as $course ) {
			$items[] = array(
				'title' => get_the_title( $course ),
				'url'   => get_permalink( $course ),
			);
		}
		$mega[] = array(
			'name'    => $term->name,
			'slug'    => $term->slug,
			'courses' => $items,
		);
	}

	wp_localize_script(
		'smit-nav',
		'smitData',
		array(
			'homeUrl'     => home_url( '/' ),
			'coursesUrl'  => smit_courses_url(),
			'campusesUrl' => smit_campuses_url(),
			'enrollUrl'   => smit_enroll_url(),
			'aboutUrl'    => smit_page_url( 'about', '/about/' ),
			'portalUrl'   => smit_enroll_url(),
			'assetUrl'    => smit_asset( '' ),
			'logoUrl'     => smit_asset( 'images/logos/transparent_logo.png' ),
			'courses'     => $courses_payload,
			'megaMenu'    => $mega,
			'topCourses'  => array_slice( $courses_payload, 0, 4 ),
		)
	);

	if ( is_front_page() ) {
		wp_enqueue_script( 'smit-home', smit_asset( 'js/home.js' ), array( 'smit-nav', 'smit-reveal' ), $ver, true );
	}

	if ( is_post_type_archive( 'course' ) ) {
		wp_enqueue_script( 'smit-courses-js', smit_asset( 'js/courses.js' ), array(), $ver, true );
		wp_localize_script( 'smit-courses-js', 'smitCourses', array( 'items' => $courses_payload ) );
	}

	if ( is_post_type_archive( 'campus' ) ) {
		wp_enqueue_script( 'smit-campuses-js', smit_asset( 'js/campuses.js' ), array(), $ver, true );
	}

	if ( is_page_template( 'page-portal.php' ) || is_page( 'check-results' ) ) {
		wp_enqueue_script( 'smit-portal-js', smit_asset( 'js/portal.js' ), array(), $ver, true );
	}
}
add_action( 'wp_enqueue_scripts', 'smit_enqueue_assets' );

/**
 * Early dark-mode FOUC guard in <head>.
 */
function smit_theme_fouc_script() {
	?>
	<script>
	(function () {
		try {
			if (localStorage.getItem('smit-theme') === 'dark') {
				document.documentElement.classList.add('theme-dark');
			}
		} catch (e) {}
	})();
	</script>
	<?php
}
add_action( 'wp_head', 'smit_theme_fouc_script', 1 );
