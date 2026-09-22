<?php
/**
 * Custom nav walker that outputs flat site-nav links + Courses mega menu.
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Flat nav walker matching SMIT markup.
 */
class SMIT_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Start element.
	 *
	 * @param string   $output Output.
	 * @param WP_Post  $item   Item.
	 * @param int      $depth  Depth.
	 * @param stdClass $args   Args.
	 * @param int      $id     ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$url   = $item->url;
		$active = in_array( 'current-menu-item', (array) $item->classes, true ) || in_array( 'current_page_item', (array) $item->classes, true );

		if ( 'Courses' === $title || false !== stripos( $url, '/courses' ) && 'Courses' === trim( $title ) ) {
			$active_class = ( is_post_type_archive( 'course' ) || is_singular( 'course' ) || $active ) ? ' is-active' : '';
			$output      .= '<div class="courses-nav" id="courses-nav">';
			$output      .= '<button type="button" id="courses-trigger" class="site-nav__trigger' . $active_class . '" aria-expanded="false" aria-controls="courses-mega" aria-haspopup="true">';
			$output      .= '<span>' . esc_html( $title ) . '</span>';
			$output      .= '<svg class="site-nav__chevron" viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.25L6 7.75L9.5 4.25" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';
			$output      .= '</button>';
			$output      .= '<div id="courses-mega" class="courses-mega" role="region" aria-label="Courses menu">';
			$output      .= '<div class="courses-mega-bridge" aria-hidden="true"></div>';
			$output      .= '<div class="courses-mega__panel">';
			$output      .= '<div class="courses-mega__categories" id="courses-categories"></div>';
			$output      .= '<div class="courses-mega__top"><h3 class="courses-mega__top-title">Top Courses</h3><div class="courses-mega__cards" id="courses-top"></div></div>';
			$output      .= '<div class="courses-mega__footer"><a href="' . esc_url( smit_courses_url() ) . '" class="courses-mega__all">See All Courses <span aria-hidden="true">→</span></a></div>';
			$output      .= '</div></div></div>';
			return;
		}

		$classes = 'site-nav__link' . ( $active ? ' is-active' : '' );
		$output .= '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $classes ) . '">' . esc_html( $title ) . '</a>';
	}

	/**
	 * End element — no li wrappers.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}
