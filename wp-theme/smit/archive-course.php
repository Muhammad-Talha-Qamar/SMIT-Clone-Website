<?php
/**
 * Course archive template.
 *
 * @package SMIT
 */

get_header();

$categories = array(
	'all'             => __( 'All Courses', 'smit' ),
	'open'            => __( 'Admissions Open', 'smit' ),
	'development'     => __( 'Development', 'smit' ),
	'designing'       => __( 'Designing', 'smit' ),
	'networking'      => __( 'Networking', 'smit' ),
	'entrepreneurship'=> __( 'Entrepreneurship', 'smit' ),
	'vocational'      => __( 'Vocational Training', 'smit' ),
);

$query = new WP_Query(
	array(
		'post_type'      => 'course',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);
?>

<section class="smit-hero-banner">
	<div class="glow-top-right" aria-hidden="true"></div>
	<div class="glow-bottom-left" aria-hidden="true"></div>
	<div class="smit-hero-container">
		<span class="smit-pill-badge" data-reveal="left">
			<i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
			<?php esc_html_e( 'Courses', 'smit' ); ?>
		</span>
		<h1 class="smit-hero-heading" data-reveal="right"><?php esc_html_e( 'Browse Our Top Courses', 'smit' ); ?></h1>
		<p class="smit-hero-subheading" data-reveal="left"><?php esc_html_e( 'Industry-ready programs designed to launch careers across development, design, networking, and vocational skills.', 'smit' ); ?></p>
	</div>
</section>

<main class="catalog">
	<div class="catalog-intro">
		<h2 data-reveal="left"><?php esc_html_e( 'Choose a program that fits your goals', 'smit' ); ?></h2>
		<p data-reveal="right"><?php esc_html_e( 'Filter by category and enroll through our local registration form. Every course is listed with duration and a clear next step.', 'smit' ); ?></p>
	</div>

	<div class="catalog-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Course categories', 'smit' ); ?>" data-reveal-stagger="up">
		<?php foreach ( $categories as $slug => $label ) : ?>
			<button type="button" class="catalog-tab<?php echo 'all' === $slug ? ' is-active' : ''; ?>" data-filter="<?php echo esc_attr( $slug ); ?>" role="tab" aria-selected="<?php echo 'all' === $slug ? 'true' : 'false'; ?>">
				<?php echo esc_html( $label ); ?>
			</button>
		<?php endforeach; ?>
	</div>

	<div id="catalog-grid" class="catalog-grid" data-reveal-stagger="up">
		<?php
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'template-parts/course-card', null, array( 'post' => get_post() ) );
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>
	<p id="catalog-empty" class="catalog-empty" hidden><?php esc_html_e( 'No courses found in this category.', 'smit' ); ?></p>

	<div class="catalog-cta">
		<div data-reveal="left">
			<h3><?php esc_html_e( 'Ready to start your IT career?', 'smit' ); ?></h3>
			<p><?php esc_html_e( 'Submit the registration form and our team will guide you to the nearest campus.', 'smit' ); ?></p>
		</div>
		<a href="<?php echo esc_url( smit_enroll_url() ); ?>" data-reveal="right"><?php esc_html_e( 'Enroll Now', 'smit' ); ?></a>
	</div>
</main>

<?php
get_footer();
