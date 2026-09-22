<?php
/**
 * Template Name: About
 *
 * @package SMIT
 */

get_header();

while ( have_posts() ) :
	the_post();
	$post_id     = get_the_ID();
	$heading     = smit_meta( $post_id, 'about_heading', 'About us' );
	$subheading  = smit_meta( $post_id, 'about_subheading', 'Bridging the Digital Divide Through Education' );
	$body        = smit_meta( $post_id, 'about_body', '' );
	$cta_title   = smit_meta( $post_id, 'cta_title', "Join Pakistan's Tech Revolution – Enroll Today & Build Your Future!" );
	$cta_button  = smit_meta( $post_id, 'cta_button', 'Enroll Now' );
	$image_path  = smit_meta( $post_id, 'image_path', 'images/about/student_hackethon.webp' );
	$image_url   = smit_thumb_url( $post_id, $image_path );
	?>

	<div id="contact">
		<a href="mailto:saylanimass@gmail.com" aria-label="<?php esc_attr_e( 'Email SMIT', 'smit' ); ?>">
			<img class="contact-img" src="<?php echo esc_url( smit_asset( 'images/shared/contact.png' ) ); ?>" alt="<?php esc_attr_e( 'Contact', 'smit' ); ?>">
		</a>
	</div>

	<section class="smit-hero-banner">
		<div class="glow-top-right" aria-hidden="true"></div>
		<div class="glow-bottom-left" aria-hidden="true"></div>
		<div class="smit-hero-container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="smit-pill-badge" data-reveal="left">
				<i class="fa-regular fa-house"></i>
				<span class="pill-text"><?php esc_html_e( 'About Us', 'smit' ); ?></span>
			</a>
			<h1 class="smit-hero-heading" data-reveal="right"><?php the_title(); ?></h1>
			<p class="smit-hero-subheading" data-reveal="left">
				<?php esc_html_e( 'Empowering individuals through world-class IT education', 'smit' ); ?>
			</p>
		</div>
	</section>

	<section id="center">
		<img id="pic1" src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Students at a SMIT hackathon', 'smit' ); ?>" data-reveal="left">
		<div id="inter">
			<h2 class="h2" data-reveal="right"><?php echo esc_html( $heading ); ?></h2>
			<h3 class="h1" data-reveal="left"><?php echo esc_html( $subheading ); ?></h3>
			<?php if ( $body ) : ?>
				<div class="p" data-reveal="right"><?php echo wp_kses_post( wpautop( $body ) ); ?></div>
			<?php else : ?>
				<div class="p" data-reveal="right"><?php the_content(); ?></div>
			<?php endif; ?>
		</div>
	</section>

	<section class="mx-auto my-12 max-w-5xl overflow-hidden rounded-3xl bg-gradient-to-r from-[#1c7ed6] to-[#6db51a] px-6 py-10 text-white sm:px-10">
		<div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
			<h2 class="max-w-xl text-2xl font-extrabold leading-snug md:text-3xl" data-reveal="left"><?php echo esc_html( $cta_title ); ?></h2>
			<a href="<?php echo esc_url( smit_enroll_url() ); ?>" class="inline-flex shrink-0 items-center rounded-full bg-white px-6 py-3 text-sm font-bold text-[#1c7ed6]" data-reveal="right"><?php echo esc_html( $cta_button ); ?></a>
		</div>
	</section>

	<?php
endwhile;

get_footer();
