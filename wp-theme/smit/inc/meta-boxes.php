<?php
/**
 * Native meta boxes for full CMS editing without requiring ACF.
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register meta boxes.
 */
function smit_add_meta_boxes() {
	add_meta_box( 'smit_course_details', __( 'Course Details', 'smit' ), 'smit_render_course_meta', 'course', 'side', 'high' );
	add_meta_box( 'smit_campus_details', __( 'Campus Details', 'smit' ), 'smit_render_campus_meta', 'campus', 'side', 'high' );
	add_meta_box( 'smit_review_details', __( 'Review Details', 'smit' ), 'smit_render_review_meta', 'review', 'side', 'high' );
	add_meta_box( 'smit_home_fields', __( 'Home Page Fields', 'smit' ), 'smit_render_home_meta', 'page', 'normal', 'high' );
	add_meta_box( 'smit_about_fields', __( 'About Page Fields', 'smit' ), 'smit_render_about_meta', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'smit_add_meta_boxes' );

/**
 * Text field helper.
 */
function smit_field_text( $post_id, $key, $label, $placeholder = '' ) {
	$value = esc_attr( (string) get_post_meta( $post_id, $key, true ) );
	printf(
		'<p><label for="%1$s"><strong>%2$s</strong></label><br><input type="text" class="widefat" id="%1$s" name="%1$s" value="%3$s" placeholder="%4$s"></p>',
		esc_attr( $key ),
		esc_html( $label ),
		$value,
		esc_attr( $placeholder )
	);
}

/**
 * Textarea helper.
 */
function smit_field_textarea( $post_id, $key, $label, $rows = 4 ) {
	$value = esc_textarea( (string) get_post_meta( $post_id, $key, true ) );
	printf(
		'<p><label for="%1$s"><strong>%2$s</strong></label><br><textarea class="widefat" id="%1$s" name="%1$s" rows="%3$d">%4$s</textarea></p>',
		esc_attr( $key ),
		esc_html( $label ),
		(int) $rows,
		$value
	);
}

/**
 * Course meta.
 */
function smit_render_course_meta( $post ) {
	wp_nonce_field( 'smit_save_meta', 'smit_meta_nonce' );
	smit_field_text( $post->ID, 'duration', __( 'Duration', 'smit' ), '4 months' );
	smit_field_text( $post->ID, 'enroll_url', __( 'Enroll URL', 'smit' ), '/check-results/' );
	smit_field_text( $post->ID, 'image_path', __( 'Theme image path (fallback)', 'smit' ), 'images/courses/FLC.jpg' );
}

/**
 * Campus meta.
 */
function smit_render_campus_meta( $post ) {
	wp_nonce_field( 'smit_save_meta', 'smit_meta_nonce' );
	smit_field_text( $post->ID, 'city_slug', __( 'City slug', 'smit' ), 'karachi' );
	smit_field_text( $post->ID, 'campus_count', __( 'Campus count', 'smit' ), '1' );
	smit_field_text( $post->ID, 'map_left', __( 'Map left %', 'smit' ), '38' );
	smit_field_text( $post->ID, 'map_top', __( 'Map top %', 'smit' ), '88' );
	smit_field_text( $post->ID, 'image_path', __( 'Theme image path (fallback)', 'smit' ), 'images/campuses/campuses.png' );
}

/**
 * Review meta.
 */
function smit_render_review_meta( $post ) {
	wp_nonce_field( 'smit_save_meta', 'smit_meta_nonce' );
	smit_field_text( $post->ID, 'role', __( 'Role / Program', 'smit' ), 'Web Development Student' );
	smit_field_text( $post->ID, 'video_id', __( 'YouTube video ID', 'smit' ), 'oRKupq13SsQ' );
	smit_field_text( $post->ID, 'image_path', __( 'Theme image path (fallback)', 'smit' ), 'images/reviews/muhammad_saad.png' );
}

/**
 * Show home fields only on front page.
 */
function smit_render_home_meta( $post ) {
	$front_id = (int) get_option( 'page_on_front' );
	if ( $front_id && (int) $post->ID !== $front_id && 'home' !== $post->post_name ) {
		echo '<p>' . esc_html__( 'These fields apply when this page is set as the Front Page.', 'smit' ) . '</p>';
	}
	wp_nonce_field( 'smit_save_meta', 'smit_meta_nonce' );
	smit_field_text( $post->ID, 'hero_title', __( 'Hero title (line 1)', 'smit' ), "Building Pakistan's" );
	smit_field_text( $post->ID, 'hero_title_accent', __( 'Hero accent title', 'smit' ), 'Tech Future' );
	smit_field_textarea( $post->ID, 'hero_subtitle', __( 'Hero subtitle', 'smit' ), 2 );
	smit_field_text( $post->ID, 'stat_students', __( 'Stat: Students', 'smit' ), '200,000+' );
	smit_field_text( $post->ID, 'stat_trainers', __( 'Stat: Trainers', 'smit' ), '400+' );
	smit_field_text( $post->ID, 'stat_employment', __( 'Stat: Employment', 'smit' ), '70%' );
	smit_field_text( $post->ID, 'stat_startups', __( 'Stat: Startups', 'smit' ), '150+' );
	smit_field_text( $post->ID, 'vision_title', __( 'Vision title', 'smit' ) );
	smit_field_textarea( $post->ID, 'vision_text', __( 'Vision supporting text', 'smit' ), 3 );
	smit_field_text( $post->ID, 'media_video_url', __( 'Home media YouTube embed URL', 'smit' ) );
}

/**
 * About fields.
 */
function smit_render_about_meta( $post ) {
	if ( 'about' !== $post->post_name && 'page-about.php' !== get_page_template_slug( $post->ID ) ) {
		echo '<p>' . esc_html__( 'Assign the About template or use the about slug to use these fields.', 'smit' ) . '</p>';
	}
	wp_nonce_field( 'smit_save_meta', 'smit_meta_nonce' );
	smit_field_text( $post->ID, 'about_heading', __( 'About heading', 'smit' ), 'About us' );
	smit_field_text( $post->ID, 'about_subheading', __( 'About subheading', 'smit' ), 'Bridging the Digital Divide Through Education' );
	smit_field_textarea( $post->ID, 'about_body', __( 'About body (overrides editor if set)', 'smit' ), 6 );
	smit_field_text( $post->ID, 'cta_title', __( 'CTA title', 'smit' ) );
	smit_field_text( $post->ID, 'cta_button', __( 'CTA button label', 'smit' ), 'Enroll Now' );
	smit_field_text( $post->ID, 'image_path', __( 'Hero image path', 'smit' ), 'images/about/student_hackethon.webp' );
}

/**
 * Save meta.
 *
 * @param int $post_id Post ID.
 */
function smit_save_meta_boxes( $post_id ) {
	if ( ! isset( $_POST['smit_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['smit_meta_nonce'] ) ), 'smit_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array(
		'duration',
		'enroll_url',
		'image_path',
		'city_slug',
		'campus_count',
		'map_left',
		'map_top',
		'role',
		'video_id',
		'hero_title',
		'hero_title_accent',
		'hero_subtitle',
		'stat_students',
		'stat_trainers',
		'stat_employment',
		'stat_startups',
		'vision_title',
		'vision_text',
		'media_video_url',
		'about_heading',
		'about_subheading',
		'about_body',
		'cta_title',
		'cta_button',
	);

	foreach ( $keys as $key ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$value = wp_unslash( $_POST[ $key ] );
		if ( in_array( $key, array( 'hero_subtitle', 'vision_text', 'about_body' ), true ) ) {
			$value = sanitize_textarea_field( $value );
		} else {
			$value = sanitize_text_field( $value );
		}
		update_post_meta( $post_id, $key, $value );
	}
}
add_action( 'save_post', 'smit_save_meta_boxes' );
