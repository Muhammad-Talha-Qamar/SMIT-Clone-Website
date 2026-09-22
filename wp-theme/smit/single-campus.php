<?php
/**
 * Single campus template.
 *
 * @package SMIT
 */

get_header();

while ( have_posts() ) :
	the_post();
	$post_id = get_the_ID();
	$count   = (int) smit_meta( $post_id, 'campus_count', '1' );
	$city    = smit_meta( $post_id, 'city_slug', get_post_field( 'post_name', $post_id ) );
	$image   = smit_thumb_url( $post_id, smit_meta( $post_id, 'image_path', 'images/campuses/campuses.png' ) );
	$label   = 1 === $count ? __( 'Campus', 'smit' ) : __( 'Campuses', 'smit' );
	?>

	<section class="smit-hero-banner">
		<div class="glow-top-right" aria-hidden="true"></div>
		<div class="glow-bottom-left" aria-hidden="true"></div>
		<div class="smit-hero-container">
			<a href="<?php echo esc_url( smit_campuses_url() ); ?>" class="smit-pill-badge" data-reveal="left">
				<i class="fa-solid fa-location-dot"></i>
				<span class="pill-text"><?php esc_html_e( 'Campuses', 'smit' ); ?></span>
			</a>
			<h1 class="smit-hero-heading" data-reveal="right"><?php the_title(); ?></h1>
			<p class="smit-hero-subheading" data-reveal="left">
				<?php echo esc_html( sprintf( _n( '%d campus location in this city', '%d campus locations in this city', $count, 'smit' ), $count ) ); ?>
			</p>
		</div>
	</section>

	<main class="mx-auto max-w-4xl px-4 py-12 sm:px-6">
		<article class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-10">
			<?php if ( $image ) : ?>
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(); ?>" class="mb-6 w-full max-w-md rounded-xl object-cover">
			<?php endif; ?>
			<p class="text-sm font-semibold text-slate-500">
				<?php echo esc_html( (string) $count ); ?> <?php echo esc_html( $label ); ?>
				· <span class="text-slate-700"><?php echo esc_html( ucwords( str_replace( '-', ' ', $city ) ) ); ?></span>
			</p>
			<div class="prose mt-4 max-w-none text-slate-600">
				<?php the_content(); ?>
			</div>
			<div class="mt-8 flex flex-wrap gap-3">
				<a href="<?php echo esc_url( add_query_arg( 'city', $city, smit_campuses_url() ) ); ?>" class="inline-flex items-center rounded-full bg-[#2f80ed] px-6 py-2.5 text-sm font-semibold text-white"><?php esc_html_e( 'View on Map', 'smit' ); ?></a>
				<a href="<?php echo esc_url( smit_enroll_url() ); ?>" class="inline-flex items-center rounded-full border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-600"><?php esc_html_e( 'Enroll Now', 'smit' ); ?></a>
			</div>
		</article>
	</main>

	<?php
endwhile;

get_footer();
