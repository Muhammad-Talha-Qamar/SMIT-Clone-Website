<?php
/**
 * Single course template.
 *
 * @package SMIT
 */

get_header();

while ( have_posts() ) :
	the_post();
	$post_id  = get_the_ID();
	$duration = smit_meta( $post_id, 'duration', '' );
	$enroll   = smit_meta( $post_id, 'enroll_url', smit_enroll_url() );
	$image    = smit_thumb_url( $post_id, smit_meta( $post_id, 'image_path', 'images/courses/FLC.jpg' ) );
	$terms    = get_the_terms( $post_id, 'course_category' );
	?>

	<section class="smit-hero-banner">
		<div class="glow-top-right" aria-hidden="true"></div>
		<div class="glow-bottom-left" aria-hidden="true"></div>
		<div class="smit-hero-container">
			<a href="<?php echo esc_url( smit_courses_url() ); ?>" class="smit-pill-badge" data-reveal="left">
				<i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
				<?php esc_html_e( 'Courses', 'smit' ); ?>
			</a>
			<h1 class="smit-hero-heading" data-reveal="right"><?php the_title(); ?></h1>
			<?php if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) : ?>
				<p class="smit-hero-subheading" data-reveal="left"><?php echo esc_html( $terms[0]->name ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<main class="mx-auto max-w-4xl px-4 py-12 sm:px-6">
		<article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
			<?php if ( $image ) : ?>
				<div class="aspect-[16/9] overflow-hidden bg-slate-100">
					<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(); ?>" class="h-full w-full object-cover">
				</div>
			<?php endif; ?>
			<div class="p-6 sm:p-10">
				<?php if ( $duration ) : ?>
					<p class="text-sm font-semibold text-slate-500"><?php esc_html_e( 'Duration', 'smit' ); ?>: <span class="text-slate-800"><?php echo esc_html( $duration ); ?></span></p>
				<?php endif; ?>
				<div class="prose mt-4 max-w-none text-slate-600">
					<?php the_content(); ?>
				</div>
				<div class="mt-8 flex flex-wrap gap-3">
					<a href="<?php echo esc_url( $enroll ); ?>" class="inline-flex items-center rounded-full bg-[#2f80ed] px-6 py-2.5 text-sm font-semibold text-white"><?php esc_html_e( 'Enroll Now', 'smit' ); ?></a>
					<a href="<?php echo esc_url( smit_courses_url() ); ?>" class="inline-flex items-center rounded-full border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-600"><?php esc_html_e( 'All Courses', 'smit' ); ?></a>
				</div>
			</div>
		</article>
	</main>

	<?php
endwhile;

get_footer();
