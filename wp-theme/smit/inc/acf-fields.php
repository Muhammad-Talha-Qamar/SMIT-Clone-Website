<?php
/**
 * Optional ACF field groups (used when ACF plugin is active).
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF groups if available.
 */
function smit_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_smit_course',
			'title'  => 'Course Details',
			'fields' => array(
				array(
					'key'   => 'field_smit_duration',
					'label' => 'Duration',
					'name'  => 'duration',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_enroll_url',
					'label' => 'Enroll URL',
					'name'  => 'enroll_url',
					'type'  => 'url',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'course',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_smit_campus',
			'title'  => 'Campus Details',
			'fields' => array(
				array(
					'key'   => 'field_smit_city_slug',
					'label' => 'City slug',
					'name'  => 'city_slug',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_campus_count',
					'label' => 'Campus count',
					'name'  => 'campus_count',
					'type'  => 'number',
				),
				array(
					'key'   => 'field_smit_map_left',
					'label' => 'Map left %',
					'name'  => 'map_left',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_map_top',
					'label' => 'Map top %',
					'name'  => 'map_top',
					'type'  => 'text',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'campus',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_smit_review',
			'title'  => 'Review Details',
			'fields' => array(
				array(
					'key'   => 'field_smit_role',
					'label' => 'Role',
					'name'  => 'role',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_video_id',
					'label' => 'YouTube video ID',
					'name'  => 'video_id',
					'type'  => 'text',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'review',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_smit_home',
			'title'  => 'Home Page Fields',
			'fields' => array(
				array(
					'key'   => 'field_smit_hero_title',
					'label' => 'Hero title',
					'name'  => 'hero_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_hero_title_accent',
					'label' => 'Hero accent',
					'name'  => 'hero_title_accent',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_hero_subtitle',
					'label' => 'Hero subtitle',
					'name'  => 'hero_subtitle',
					'type'  => 'textarea',
				),
				array(
					'key'   => 'field_smit_stat_students',
					'label' => 'Students trained',
					'name'  => 'stat_students',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_stat_trainers',
					'label' => 'Trainers',
					'name'  => 'stat_trainers',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_stat_employment',
					'label' => 'Employment success',
					'name'  => 'stat_employment',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_stat_startups',
					'label' => 'Startups launched',
					'name'  => 'stat_startups',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_vision_title',
					'label' => 'Vision title',
					'name'  => 'vision_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_smit_media_video_url',
					'label' => 'Media video URL',
					'name'  => 'media_video_url',
					'type'  => 'url',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'smit_register_acf_fields' );
