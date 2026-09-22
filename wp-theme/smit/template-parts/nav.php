<?php
/**
 * Primary navigation (replaces HTML injection from nav.js).
 *
 * @package SMIT
 */
$logo = smit_asset( 'images/logos/transparent_logo.png' );
?>
<div class="site-header__inner">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php esc_attr_e( 'SMIT home', 'smit' ); ?>">
		<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'SMIT Logo', 'smit' ); ?>" width="140" height="42">
	</a>
	<div class="site-header__overlay" id="nav-overlay" hidden></div>
	<div id="nav-menu" class="site-header__panel">
		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'smit' ); ?>">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'items_wrap'     => '%3$s',
						'fallback_cb'    => false,
						'walker'         => new SMIT_Nav_Walker(),
					)
				);
				?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-nav__link<?php echo is_front_page() ? ' is-active' : ''; ?>">Home</a>
				<a href="<?php echo esc_url( smit_page_url( 'about', '/about/' ) ); ?>" class="site-nav__link<?php echo is_page( 'about' ) ? ' is-active' : ''; ?>">About</a>
				<div class="courses-nav" id="courses-nav">
					<button type="button" id="courses-trigger" class="site-nav__trigger<?php echo is_post_type_archive( 'course' ) || is_singular( 'course' ) ? ' is-active' : ''; ?>" aria-expanded="false" aria-controls="courses-mega" aria-haspopup="true">
						<span>Courses</span>
						<svg class="site-nav__chevron" viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.25L6 7.75L9.5 4.25" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</button>
					<div id="courses-mega" class="courses-mega" role="region" aria-label="Courses menu">
						<div class="courses-mega-bridge" aria-hidden="true"></div>
						<div class="courses-mega__panel">
							<div class="courses-mega__categories" id="courses-categories"></div>
							<div class="courses-mega__top">
								<h3 class="courses-mega__top-title">Top Courses</h3>
								<div class="courses-mega__cards" id="courses-top"></div>
							</div>
							<div class="courses-mega__footer">
								<a href="<?php echo esc_url( smit_courses_url() ); ?>" class="courses-mega__all">See All Courses <span aria-hidden="true">→</span></a>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php echo esc_url( smit_campuses_url() ); ?>" class="site-nav__link<?php echo is_post_type_archive( 'campus' ) || is_singular( 'campus' ) ? ' is-active' : ''; ?>">Campuses</a>
				<a href="<?php echo esc_url( smit_enroll_url() ); ?>#result" class="site-nav__link<?php echo is_page( 'check-results' ) ? ' is-active' : ''; ?>">Check Results</a>
			<?php endif; ?>
		</nav>
		<a href="<?php echo esc_url( smit_enroll_url() ); ?>" class="site-cta">Enroll Now</a>
	</div>
	<button type="button" id="theme-toggle" class="theme-toggle" aria-label="Switch to dark mode" aria-pressed="false" title="Dark mode">
		<span class="theme-toggle__option theme-toggle__option--light" aria-hidden="true">
			<svg class="theme-toggle__icon" viewBox="0 0 24 24" fill="none">
				<circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/>
				<path d="M12 3v2M12 19v2M5.6 5.6l1.4 1.4M17 17l1.4 1.4M3 12h2M19 12h2M5.6 18.4l1.4-1.4M17 7l1.4-1.4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
			</svg>
		</span>
		<span class="theme-toggle__option theme-toggle__option--dark" aria-hidden="true">
			<svg class="theme-toggle__icon" viewBox="0 0 24 24" fill="currentColor">
				<path d="M21 14.5A8.5 8.5 0 1 1 9.5 3a7 7 0 0 0 11.5 11.5z"/>
			</svg>
		</span>
	</button>
	<button id="nav-toggle" class="nav-burger" type="button" aria-label="Toggle menu" aria-expanded="false" aria-controls="nav-menu">
		<span></span><span></span><span></span>
	</button>
</div>
