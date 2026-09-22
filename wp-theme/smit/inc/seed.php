<?php
/**
 * Seed CMS content from the original HTML site (runs once after theme activation).
 *
 * @package SMIT
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function smit_seed_content() {
	if ( ! get_option( 'smit_needs_seed' ) ) {
		return;
	}
	if ( get_option( 'smit_seeded' ) ) {
		delete_option( 'smit_needs_seed' );
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	smit_seed_categories();
	smit_seed_courses();
	smit_seed_campuses();
	smit_seed_reviews();
	smit_seed_pages();
	smit_seed_menus();

	update_option( 'smit_seeded', 1 );
	delete_option( 'smit_needs_seed' );
	flush_rewrite_rules();
}
add_action( 'admin_init', 'smit_seed_content' );

function smit_seed_categories() {
	$cats = array(
		'open' => 'Admissions Open',
		'development' => 'Development',
		'designing' => 'Designing',
		'networking' => 'Networking',
		'entrepreneurship' => 'Entrepreneurship',
		'vocational' => 'Vocational',
	);
	foreach ( $cats as $slug => $name ) {
		if ( ! term_exists( $slug, 'course_category' ) ) {
			wp_insert_term( $name, 'course_category', array( 'slug' => $slug ) );
		}
	}
}

function smit_seed_courses() {
	if ( wp_count_posts( 'course' )->publish > 0 ) { return; }
	$items = array(
		array(
			'title'    => 'Freelancing',
			'desc'     => 'Learn computers, digital marketing, SEO, and freelance platforms so you can start earning independently.',
			'duration' => '8 months',
			'category' => 'open',
			'image'    => 'images/courses/FLC.jpg',
		),
		array(
			'title'    => 'Video Content Creation With AI',
			'desc'     => 'Plan, shoot, and edit professional video content with AI-assisted production workflows.',
			'duration' => '4 months',
			'category' => 'open',
			'image'    => 'images/courses/VCC.jpg',
		),
		array(
			'title'    => 'UI UX Design With AI',
			'desc'     => 'Design usable digital products with research, wireframes, prototypes, and AI design tools.',
			'duration' => '4 months',
			'category' => 'open',
			'image'    => 'images/courses/UIUXA.jpg',
		),
		array(
			'title'    => 'Graphic Designing With AI',
			'desc'     => 'Build commercial-ready visual design skills for brands, social media, and print.',
			'duration' => '6 months',
			'category' => 'open',
			'image'    => 'images/courses/GDA.jpg',
		),
		array(
			'title'    => 'Shopify E-Commerce Expert',
			'desc'     => 'Set up, customize, and manage Shopify stores for real e-commerce businesses.',
			'duration' => '3 months',
			'category' => 'open',
			'image'    => 'images/courses/SEC.jpg',
		),
		array(
			'title'    => 'Digital Marketing With AI',
			'desc'     => 'Run campaigns across search, social, and analytics with modern AI marketing tools.',
			'duration' => '5 months',
			'category' => 'open',
			'image'    => 'images/courses/DMA.jpg',
		),
		array(
			'title'    => 'Agentic AI',
			'desc'     => 'A year-long professional track covering AI agents, automation, and applied machine workflows.',
			'duration' => '12 months',
			'category' => 'open',
			'image'    => 'images/courses/AGI.jpg',
		),
		array(
			'title'    => 'Artificial Intelligence and Data Science',
			'desc'     => 'A complete professional track covering data analysis, machine learning, and AI applications.',
			'duration' => '10 months',
			'category' => 'open',
			'image'    => 'images/courses/AI.jpg',
		),
		array(
			'title'    => 'Bootcamp (Artificial Intelligence)',
			'desc'     => 'An intensive AI development bootcamp focused on practical projects and job-ready skills.',
			'duration' => '4 months',
			'category' => 'development',
			'image'    => 'images/courses/BAI.jpg',
		),
		array(
			'title'    => 'Bootcamp (Blockchain Development)',
			'desc'     => 'Learn blockchain fundamentals, smart contracts, and decentralized application development.',
			'duration' => '4 months',
			'category' => 'development',
			'image'    => 'images/courses/BBT.jpg',
		),
		array(
			'title'    => 'Odoo Functional Consultant',
			'desc'     => 'Train as an ERP consultant using Odoo for business operations and implementation.',
			'duration' => '10 months',
			'category' => 'development',
			'image'    => 'images/courses/OFC.jpg',
		),
		array(
			'title'    => 'DevOps Engineer',
			'desc'     => 'Cover CI/CD, cloud infrastructure, and deployment pipelines used in modern engineering teams.',
			'duration' => '6 months',
			'category' => 'development',
			'image'    => 'images/courses/DE.jpg',
		),
		array(
			'title'    => 'Video Content Creation',
			'desc'     => 'Create professional video content for brands, education, and social platforms.',
			'duration' => '4 months',
			'category' => 'designing',
			'image'    => 'images/courses/VCC.jpg',
		),
		array(
			'title'    => 'Video Animation',
			'desc'     => 'Build 2D and motion graphics skills for explainer videos and digital storytelling.',
			'duration' => '6 months',
			'category' => 'designing',
			'image'    => 'images/courses/VA.jpg',
		),
		array(
			'title'    => 'UI UX Design With AI',
			'desc'     => 'Product design with AI tools, from user research to high-fidelity prototypes.',
			'duration' => '4 months',
			'category' => 'designing',
			'image'    => 'images/courses/UIUXA.jpg',
		),
		array(
			'title'    => 'AutoCAD',
			'desc'     => 'Technical drafting and design for architecture, interiors, and engineering drawings.',
			'duration' => '3 months',
			'category' => 'designing',
			'image'    => 'images/courses/ATC.jpg',
		),
		array(
			'title'    => 'SOC Analyst CyberOps',
			'desc'     => 'Monitor, detect, and respond to security incidents in a security operations setting.',
			'duration' => '4 months',
			'category' => 'networking',
			'image'    => 'images/courses/SOC.jpg',
		),
		array(
			'title'    => 'Networking Essentials',
			'desc'     => 'Core networking fundamentals including routing, switching, and network troubleshooting.',
			'duration' => '3 months',
			'category' => 'networking',
			'image'    => 'images/courses/NE.jpg',
		),
		array(
			'title'    => 'Cybersecurity Essentials',
			'desc'     => 'Foundations of cybersecurity, threat awareness, and defensive practices.',
			'duration' => '3 months',
			'category' => 'networking',
			'image'    => 'images/courses/CSE.jpg',
		),
		array(
			'title'    => 'CyberOps Associate',
			'desc'     => 'A Cisco-aligned CyberOps associate track for security operations careers.',
			'duration' => '6 months',
			'category' => 'networking',
			'image'    => 'images/courses/COA.jpg',
		),
		array(
			'title'    => 'Professional Communication',
			'desc'     => 'Workplace communication, presentation, and career-readiness skills for IT professionals.',
			'duration' => '3 months',
			'category' => 'entrepreneurship',
			'image'    => 'images/courses/PCCR.jpg',
		),
		array(
			'title'    => 'English Language & Communication',
			'desc'     => 'Build spoken and written English for interviews, client work, and professional settings.',
			'duration' => '4 months',
			'category' => 'entrepreneurship',
			'image'    => 'images/courses/ELCS.jpg',
		),
		array(
			'title'    => 'AI & Game Creators',
			'desc'     => 'Create games and interactive experiences using AI-assisted design and development tools.',
			'duration' => '4 months',
			'category' => 'entrepreneurship',
			'image'    => 'images/courses/AGC.jpg',
		),
		array(
			'title'    => 'Little Geniuses: Coding for Kids',
			'desc'     => 'A fun lab introducing children to coding, design, and AI through guided projects.',
			'duration' => '3 months',
			'category' => 'entrepreneurship',
			'image'    => 'images/courses/LG.jpg',
		),
		array(
			'title'    => 'Health, Safety and Environment',
			'desc'     => 'Workplace HSE practices to keep teams and job sites compliant and safe.',
			'duration' => '3 months',
			'category' => 'vocational',
			'image'    => 'images/courses/SVTI-HSE.jpg',
		),
		array(
			'title'    => 'Fire Alarm System Installation',
			'desc'     => 'Install, test, and maintain fire alarm systems for residential and commercial sites.',
			'duration' => '3 months',
			'category' => 'vocational',
			'image'    => 'images/courses/SVTI-FASI.jpg',
		),
		array(
			'title'    => 'Domestic Electrician',
			'desc'     => 'Hands-on residential electrical installation, wiring, and safety procedures.',
			'duration' => '4 months',
			'category' => 'vocational',
			'image'    => 'images/courses/SVTI-DET.jpg',
		),
		array(
			'title'    => 'Plumber Technician',
			'desc'     => 'Plumbing installation and repair for homes, campuses, and commercial buildings.',
			'duration' => '4 months',
			'category' => 'vocational',
			'image'    => 'images/courses/PT.jpg',
		),
	);
	foreach ( $items as $i => $item ) {
		$id = wp_insert_post( array(
			'post_type'    => 'course',
			'post_title'   => $item['title'],
			'post_content' => $item['desc'],
			'post_excerpt' => $item['desc'],
			'post_status'  => 'publish',
			'menu_order'   => $i,
		) );
		if ( is_wp_error( $id ) || ! $id ) { continue; }
		update_post_meta( $id, 'duration', $item['duration'] );
		update_post_meta( $id, 'enroll_url', smit_enroll_url() );
		update_post_meta( $id, 'image_path', $item['image'] );
		wp_set_object_terms( $id, $item['category'], 'course_category' );
	}
}

function smit_seed_campuses() {
	if ( wp_count_posts( 'campus' )->publish > 0 ) { return; }
	$items = array(
		array(
			'title' => 'Karachi',
			'slug'  => 'karachi',
			'count' => '28',
			'left'  => '38',
			'top'   => '88',
		),
		array(
			'title' => 'Faisalabad',
			'slug'  => 'faisalabad',
			'count' => '1',
			'left'  => '60',
			'top'   => '40',
		),
		array(
			'title' => 'Hyderabad',
			'slug'  => 'hyderabad',
			'count' => '3',
			'left'  => '45',
			'top'   => '78',
		),
		array(
			'title' => 'Peshawar',
			'slug'  => 'peshawar',
			'count' => '1',
			'left'  => '57',
			'top'   => '19',
		),
		array(
			'title' => 'Quetta',
			'slug'  => 'quetta',
			'count' => '1',
			'left'  => '38',
			'top'   => '48',
		),
		array(
			'title' => 'Islamabad',
			'slug'  => 'islamabad',
			'count' => '1',
			'left'  => '60',
			'top'   => '20',
		),
		array(
			'title' => 'Rawalpindi',
			'slug'  => 'rawalpindi',
			'count' => '4',
			'left'  => '61',
			'top'   => '22',
		),
		array(
			'title' => 'Gujranwala',
			'slug'  => 'gujranwala',
			'count' => '2',
			'left'  => '65',
			'top'   => '33',
		),
		array(
			'title' => 'Sukkur',
			'slug'  => 'sukkur',
			'count' => '1',
			'left'  => '42',
			'top'   => '70',
		),
		array(
			'title' => 'Lakki Marwat',
			'slug'  => 'lakki-marwat',
			'count' => '1',
			'left'  => '52',
			'top'   => '38',
		),
		array(
			'title' => 'Multan',
			'slug'  => 'multan',
			'count' => '1',
			'left'  => '58',
			'top'   => '48',
		),
		array(
			'title' => 'Ghotki',
			'slug'  => 'ghotki',
			'count' => '1',
			'left'  => '48',
			'top'   => '65',
		),
		array(
			'title' => 'Turbat',
			'slug'  => 'turbat',
			'count' => '1',
			'left'  => '22',
			'top'   => '62',
		),
		array(
			'title' => 'Abbottabad',
			'slug'  => 'abbottabad',
			'count' => '1',
			'left'  => '62',
			'top'   => '16',
		),
		array(
			'title' => 'Lahore',
			'slug'  => 'lahore',
			'count' => '3',
			'left'  => '63',
			'top'   => '36',
		),
		array(
			'title' => 'Waziristan',
			'slug'  => 'waziristan',
			'count' => '2',
			'left'  => '50',
			'top'   => '22',
		),
	);
	foreach ( $items as $i => $item ) {
		$id = wp_insert_post( array(
			'post_type'    => 'campus',
			'post_title'   => $item['title'],
			'post_name'    => $item['slug'],
			'post_content' => sprintf( '%s campus locations available in %s.', $item['count'], $item['title'] ),
			'post_status'  => 'publish',
			'menu_order'   => $i,
		) );
		if ( is_wp_error( $id ) || ! $id ) { continue; }
		update_post_meta( $id, 'city_slug', $item['slug'] );
		update_post_meta( $id, 'campus_count', $item['count'] );
		update_post_meta( $id, 'map_left', $item['left'] );
		update_post_meta( $id, 'map_top', $item['top'] );
		update_post_meta( $id, 'image_path', 'images/campuses/campuses.png' );
	}
}

function smit_seed_reviews() {
	if ( wp_count_posts( 'review' )->publish > 0 ) { return; }
	$items = array(
		array(
			'title' => 'Muhammad Saad',
			'role'  => 'Mobile App Development Student',
			'video' => 'oRKupq13SsQ',
			'image' => 'images/reviews/muhammad_saad.png',
		),
		array(
			'title' => 'Muhammad Fasih',
			'role'  => 'Web Development Student',
			'video' => 'FiNMhLG1QlY',
			'image' => 'images/reviews/muhammad_fasih.png',
		),
		array(
			'title' => 'Kamran',
			'role'  => 'Web & Mobile Development Student',
			'video' => 'sN3cbEvKKRU',
			'image' => 'images/reviews/kamran.png',
		),
		array(
			'title' => 'Muhammad Ashir',
			'role'  => 'Graphic Design Student',
			'video' => 'BFXpQyowANA',
			'image' => 'images/reviews/muhammad_ashir.png',
		),
		array(
			'title' => 'Syed Ghulam Ali Shah',
			'role'  => 'IT Training Graduate',
			'video' => 'wYFWGKoYfvY',
			'image' => 'images/reviews/syed_ghulam_ali.png',
		),
		array(
			'title' => 'Wahaj Ahmed',
			'role'  => 'Web Development Student',
			'video' => 'JVMFQH_8pWg',
			'image' => 'images/reviews/wahaj_ahmed.png',
		),
		array(
			'title' => 'Hamza Abdul Rehman',
			'role'  => 'SMIT Student',
			'video' => 'mWpv4B1k2dY',
			'image' => 'images/reviews/hamza_abdul_rehman.png',
		),
		array(
			'title' => 'Arham',
			'role'  => 'SMIT Student',
			'video' => 'm-pAPx-zkx4',
			'image' => 'images/reviews/arham.png',
		),
	);
	foreach ( $items as $i => $item ) {
		$id = wp_insert_post( array(
			'post_type'   => 'review',
			'post_title'  => $item['title'],
			'post_status' => 'publish',
			'menu_order'  => $i,
		) );
		if ( is_wp_error( $id ) || ! $id ) { continue; }
		update_post_meta( $id, 'role', $item['role'] );
		update_post_meta( $id, 'video_id', $item['video'] );
		update_post_meta( $id, 'image_path', $item['image'] );
	}
}

function smit_seed_pages() {
	$pages = array(
		array(
			'title' => 'Home',
			'slug'  => 'home',
			'tpl'   => 'front-page',
			'content' => '',
		),
		array(
			'title' => 'About',
			'slug'  => 'about',
			'tpl'   => 'page-about.php',
			'content' => 'SMIT, an initiative of Saylani Welfare International Trust, is dedicated to providing high-quality, modern IT training to underprivileged and aspiring students across the globe.',
		),
		array(
			'title' => 'Check Results',
			'slug'  => 'check-results',
			'tpl'   => 'page-portal.php',
			'content' => '',
		),
		array(
			'title' => 'Privacy Policy',
			'slug'  => 'privacy',
			'tpl'   => '',
			'content' => 'Privacy Policy This is a student clone of the Saylani Mass IT Training website. The registration and search forms on this site are demonstrations only. They do not send your information to a live server. Theme preference is stored in your browser with localStorage . No other personal data is stored by this project. For official SMIT services, contact the institute at saylanimass@gmail.com .',
		),
		array(
			'title' => 'Terms of Service',
			'slug'  => 'terms',
			'tpl'   => '',
			'content' => 'Terms of Service This website is an educational clone created for a class assignment. Course listings, campus counts, and form responses are for demonstration and may not match official SMIT records. Use the local pages to browse courses, campuses, and the demo registration form. Official enrollment and results remain with Saylani Mass IT Training. Contact saylanimass@gmail.com for the live institute.',
		),
	);
	$ids = array();
	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );
		if ( $existing ) { $ids[ $page['slug'] ] = $existing->ID; continue; }
		$id = wp_insert_post( array(
			'post_type'    => 'page',
			'post_title'   => $page['title'],
			'post_name'    => $page['slug'],
			'post_content' => $page['content'],
			'post_status'  => 'publish',
		) );
		if ( is_wp_error( $id ) || ! $id ) { continue; }
		$ids[ $page['slug'] ] = $id;
		if ( ! empty( $page['tpl'] ) && 'front-page' !== $page['tpl'] ) {
			update_post_meta( $id, '_wp_page_template', $page['tpl'] );
		}
	}

	if ( ! empty( $ids['home'] ) ) {
		$hid = $ids['home'];
		update_post_meta( $hid, 'hero_title', "Building Pakistan's" );
		update_post_meta( $hid, 'hero_title_accent', 'Tech Future' );
		update_post_meta( $hid, 'hero_subtitle', 'Changing Lives. Building Careers. Shaping the Future.' );
		update_post_meta( $hid, 'stat_students', '200,000+' );
		update_post_meta( $hid, 'stat_trainers', '400+' );
		update_post_meta( $hid, 'stat_employment', '70%' );
		update_post_meta( $hid, 'stat_startups', '150+' );
		update_post_meta( $hid, 'vision_title', "Empowering 10 million IT experts to drive Pakistan's $100 billion digital economy" );
		update_post_meta( $hid, 'media_video_url', 'https://www.youtube.com/embed/m-pAPx-zkx4' );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $hid );
	}
	if ( ! empty( $ids['about'] ) ) {
		$aid = $ids['about'];
		update_post_meta( $aid, 'about_heading', 'About us' );
		update_post_meta( $aid, 'about_subheading', 'Bridging the Digital Divide Through Education' );
		update_post_meta( $aid, 'cta_title', "Join Pakistan's Tech Revolution – Enroll Today & Build Your Future!" );
		update_post_meta( $aid, 'cta_button', 'Enroll Now' );
		update_post_meta( $aid, 'image_path', 'images/about/student_hackethon.webp' );
	}
}

function smit_seed_menus() {
	$menu_name = 'Primary';
	$menu = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
	} else {
		$menu_id = $menu->term_id;
	}
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	$items = array(
		array( 'title' => 'Home', 'url' => home_url( '/' ) ),
		array( 'title' => 'About', 'url' => smit_page_url( 'about', '/about/' ) ),
		array( 'title' => 'Courses', 'url' => smit_courses_url() ),
		array( 'title' => 'Campuses', 'url' => smit_campuses_url() ),
		array( 'title' => 'Check Results', 'url' => smit_enroll_url() . '#result' ),
	);
	$existing = wp_get_nav_menu_items( $menu_id );
	if ( empty( $existing ) ) {
		foreach ( $items as $item ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => $item['title'],
				'menu-item-url'    => $item['url'],
				'menu-item-status' => 'publish',
				'menu-item-type'   => 'custom',
			) );
		}
	}
}

