<?php
/**
 * Campus archive / finder.
 *
 * @package SMIT
 */

get_header();

$campuses = smit_get_campuses();
$total_cities   = count( $campuses );
$total_campuses = 0;
foreach ( $campuses as $campus ) {
	$total_campuses += (int) smit_meta( $campus->ID, 'campus_count', '1' );
}

$pin_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="map-pin-icon" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>';
?>

<section class="smit-hero-banner">
	<div class="glow-top-right" aria-hidden="true"></div>
	<div class="glow-bottom-left" aria-hidden="true"></div>
	<div class="smit-hero-container">
		<a href="<?php echo esc_url( smit_campuses_url() ); ?>" class="smit-pill-badge" data-reveal="left">
			<i class="fa-solid fa-graduation-cap"></i>
			<span class="pill-text"><?php esc_html_e( 'Campuses', 'smit' ); ?></span>
		</a>
		<h1 class="smit-hero-heading" data-reveal="right"><?php esc_html_e( 'Our Campuses', 'smit' ); ?></h1>
		<p class="smit-hero-subheading" data-reveal="left">
			<?php esc_html_e( 'Find SMIT training centers across Pakistan - bringing quality IT education closer to you', 'smit' ); ?>
		</p>
	</div>
</section>

<main class="campuses-section">
	<div class="campuses-container">
		<div class="map-wrapper" data-reveal="zoom">
			<div class="map-stage">
				<div class="map-image-frame">
					<img
						src="<?php echo esc_url( smit_asset( 'images/home/pk_map.svg' ) ); ?>"
						alt="<?php esc_attr_e( 'Pakistan Map showing SMIT campus locations', 'smit' ); ?>"
						class="map-image">
				</div>
				<div class="map-markers" id="map-markers">
					<?php foreach ( $campuses as $campus ) :
						$cid   = $campus->ID;
						$title = get_the_title( $campus );
						$city  = smit_meta( $cid, 'city_slug', $campus->post_name );
						$count = smit_meta( $cid, 'campus_count', '1' );
						$left  = smit_meta( $cid, 'map_left', '50' );
						$top   = smit_meta( $cid, 'map_top', '50' );
						$label = sprintf( '%s (%s)', $title, $count );
						?>
						<button type="button" class="map-marker" style="left: <?php echo esc_attr( $left ); ?>%; top: <?php echo esc_attr( $top ); ?>%;" data-city="<?php echo esc_attr( $city ); ?>" aria-label="<?php echo esc_attr( $label ); ?>">
							<span class="map-marker-hit"><?php echo $pin_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG ?></span>
							<span class="map-marker-label"><span><?php echo esc_html( $label ); ?></span></span>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<p class="map-hint" data-reveal="up"><?php esc_html_e( 'Click on a city marker to view campuses', 'smit' ); ?></p>

		<div class="city-select-wrapper" data-reveal="up">
			<label for="city-select" class="city-select-label"><?php esc_html_e( 'Select a City to View Campuses', 'smit' ); ?></label>
			<select id="city-select" class="city-select-input">
				<option value=""><?php esc_html_e( 'Choose a city...', 'smit' ); ?></option>
				<?php foreach ( $campuses as $campus ) :
					$city = smit_meta( $campus->ID, 'city_slug', $campus->post_name );
					?>
					<option value="<?php echo esc_attr( $city ); ?>"><?php echo esc_html( get_the_title( $campus ) ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="campus-stats-bar" data-reveal="up">
			<div class="stat-pill"><i class="fa-solid fa-location-dot"></i> <?php echo esc_html( (string) $total_cities ); ?> <?php esc_html_e( 'Cities', 'smit' ); ?></div>
			<div class="stat-pill"><i class="fa-solid fa-building"></i> <?php echo esc_html( (string) $total_campuses ); ?> <?php esc_html_e( 'Campuses', 'smit' ); ?></div>
		</div>

		<div class="campus-grid" data-reveal-stagger="up">
			<?php
			foreach ( $campuses as $campus ) {
				get_template_part( 'template-parts/campus-card', null, array( 'post' => $campus ) );
			}
			?>
		</div>
	</div>
</main>

<?php
get_footer();
