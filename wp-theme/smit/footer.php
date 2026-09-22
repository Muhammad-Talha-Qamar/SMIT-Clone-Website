<?php
/**
 * Theme footer.
 *
 * @package SMIT
 */
$privacy = smit_page_url( 'privacy', '/privacy/' );
$terms   = smit_page_url( 'terms', '/terms/' );
?>
<footer class="site-footer mt-8 w-full bg-gradient-to-br from-[#1a1a1a] via-[#2d2d2d] to-[#1a1a1a] font-montserrat text-gray-300">
	<div class="relative mx-auto max-w-6xl overflow-hidden px-6 py-8 md:px-10">
		<div class="mb-4 flex items-center justify-start" data-reveal="left">
			<div class="relative w-[92px]">
				<img src="<?php echo esc_url( smit_asset( 'images/logos/transparent_logo.png' ) ); ?>" alt="Saylani Mass IT Training" class="block h-auto w-full object-contain" width="80" height="40">
			</div>
			<div class="ml-4 mt-2 w-[152px]">
				<a href="https://saylaniwelfare.com/" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo esc_url( smit_asset( 'images/logos/saylani_logo.webp' ) ); ?>" alt="Saylani Logo" class="block h-auto w-full object-contain" width="120" height="40">
				</a>
			</div>
		</div>

		<div class="grid grid-cols-1 gap-8 md:grid-cols-2 md:gap-x-12 lg:grid-cols-12 lg:gap-12" data-reveal-stagger="up">
			<div class="md:col-span-2 lg:col-span-4">
				<p class="mb-6 text-left text-sm leading-relaxed text-gray-400 md:text-base">
					Empowering Pakistan's youth with world-class IT education and training programs to build a brighter digital future.
				</p>
				<div class="mb-6 flex flex-col gap-3">
					<div class="flex items-start gap-3 text-xs text-gray-400 sm:text-sm">
						<i class="fa-solid fa-location-dot mt-0.5 w-[1.1em] shrink-0 text-center text-brand-primary" aria-hidden="true"></i>
						<span>A-25, Bahadurabad Chowrangi, Karachi, Pakistan</span>
					</div>
					<div class="flex items-start gap-3 text-xs text-gray-400 sm:text-sm">
						<i class="fa-solid fa-phone mt-0.5 w-[1.1em] shrink-0 text-center text-brand-green" aria-hidden="true"></i>
						<a href="tel:+9221111729526" class="text-gray-400 transition hover:text-white">+92 21 111 729 526</a>
					</div>
					<div class="flex items-start gap-3 text-xs text-gray-400 sm:text-sm">
						<i class="fa-solid fa-envelope mt-0.5 w-[1.1em] shrink-0 text-center text-brand-primary" aria-hidden="true"></i>
						<a href="mailto:saylanimass@gmail.com" class="text-gray-400 transition hover:text-white">saylanimass@gmail.com</a>
					</div>
				</div>
				<div class="mb-6 flex flex-wrap justify-start gap-3">
					<a href="https://www.facebook.com/saylani.smit" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#2d2d2d] text-gray-300 transition hover:scale-110 hover:text-white"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
					<a href="https://x.com/OfficialSwit" target="_blank" rel="noopener noreferrer" aria-label="Twitter" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#2d2d2d] text-gray-300 transition hover:scale-110 hover:text-white"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
					<a href="https://www.linkedin.com/company/saylanimassit/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#2d2d2d] text-gray-300 transition hover:scale-110 hover:text-white"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
					<a href="https://www.instagram.com/saylani.smit/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#2d2d2d] text-gray-300 transition hover:scale-110 hover:text-white"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
					<a href="https://www.youtube.com/@SaylaniMassITTraining" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="flex h-10 w-10 items-center justify-center rounded-full bg-[#2d2d2d] text-gray-300 transition hover:scale-110 hover:text-white"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
				</div>
				<a href="https://play.google.com/store/apps/details?id=com.saylanitech.smitlmsapp&hl=en" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2.5 rounded-xl bg-gradient-to-r from-brand-primary to-[rgba(109,168,0,0.71)] px-4 py-2.5 text-white transition hover:scale-[1.03]">
					<svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true" class="shrink-0">
						<path fill="#ffc107" d="m23 12c0 .75-.42 1.41-1.03 1.75l-5.2 2.89-4.4-4.64 4.4-4.64 5.2 2.89c.61.34 1.03 1 1.03 1.75z"></path>
						<path fill="#03a9f4" d="m12.37 12-10.8 11.39c-.36-.36-.57-.85-.57-1.39v-20c0-.54.21-1.03.57-1.39z"></path>
						<path fill="#f44336" d="m12.37 12 4.4 4.64-12.8 7.11c-.29.16-.62.25-.97.25-.56 0-1.07-.23-1.43-.61z"></path>
						<path fill="#4caf50" d="m12.37 12 4.4-4.64-12.8-7.11c-.36-.38-.87-.61-1.43-.61-.35 0-.68.09-.97.25z"></path>
					</svg>
					<span class="flex flex-col leading-tight">
						<span class="text-[0.65rem] font-medium uppercase tracking-wide">GET IT ON</span>
						<span class="text-base font-semibold">Google Play</span>
					</span>
				</a>
			</div>

			<div class="lg:col-span-2">
				<h3 class="relative mb-6 inline-block text-lg font-bold text-white after:absolute after:left-0 after:-bottom-2 after:h-1 after:w-12 after:rounded-full after:bg-gradient-to-r after:from-brand-primary after:to-[rgba(109,168,0,0.71)]">Quick Links</h3>
				<?php if ( has_nav_menu( 'footer_quick' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_quick',
							'container'      => false,
							'menu_class'     => 'flex flex-col gap-3',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<ul class="flex flex-col gap-3">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm text-gray-400 transition hover:text-white">Home</a></li>
						<li><a href="<?php echo esc_url( smit_page_url( 'about', '/about/' ) ); ?>" class="text-sm text-gray-400 transition hover:text-white">About</a></li>
						<li><a href="<?php echo esc_url( smit_enroll_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">Enroll Now</a></li>
						<li><a href="<?php echo esc_url( smit_enroll_url() ); ?>#idcard" class="text-sm text-gray-400 transition hover:text-white">Download ID Card</a></li>
						<li><a href="<?php echo esc_url( smit_enroll_url() ); ?>#entrytest" class="text-sm text-gray-400 transition hover:text-white">Entry Test Status</a></li>
						<li><a href="<?php echo esc_url( smit_enroll_url() ); ?>#result" class="text-sm text-gray-400 transition hover:text-white">Check Results</a></li>
					</ul>
				<?php endif; ?>
			</div>

			<div class="lg:col-span-3">
				<h3 class="relative mb-6 inline-block text-lg font-bold text-white after:absolute after:left-0 after:-bottom-2 after:h-1 after:w-12 after:rounded-full after:bg-gradient-to-r after:from-brand-primary after:to-[rgba(109,168,0,0.71)]">Our Courses</h3>
				<ul class="flex flex-col gap-3">
					<li><a href="<?php echo esc_url( smit_courses_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">Web Development</a></li>
					<li><a href="<?php echo esc_url( smit_courses_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">Agentic AI</a></li>
					<li><a href="<?php echo esc_url( smit_courses_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">AI &amp; Data Science</a></li>
					<li><a href="<?php echo esc_url( smit_courses_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">Graphic Design</a></li>
					<li><a href="<?php echo esc_url( smit_courses_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">3D Animation</a></li>
				</ul>
			</div>

			<div class="lg:col-span-3">
				<h3 class="relative mb-6 inline-block text-lg font-bold text-white after:absolute after:left-0 after:-bottom-2 after:h-1 after:w-12 after:rounded-full after:bg-gradient-to-r after:from-brand-primary after:to-[rgba(109,168,0,0.71)]">Resources</h3>
				<ul class="flex flex-col gap-3">
					<li><a href="<?php echo esc_url( smit_courses_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">Courses</a></li>
					<li><a href="<?php echo esc_url( smit_campuses_url() ); ?>" class="text-sm text-gray-400 transition hover:text-white">Campuses</a></li>
					<li><a href="<?php echo esc_url( smit_page_url( 'about', '/about/' ) ); ?>#contact" class="text-sm text-gray-400 transition hover:text-white">Contact Us</a></li>
					<li><a href="<?php echo esc_url( $privacy ); ?>" class="text-sm text-gray-400 transition hover:text-white">Privacy Policy</a></li>
					<li><a href="<?php echo esc_url( $terms ); ?>" class="text-sm text-gray-400 transition hover:text-white">Terms of Service</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="border-t border-gray-700 bg-[rgba(26,26,26,0.5)]">
		<div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-3 px-6 py-8 text-sm text-gray-400 md:flex-row md:px-10">
			<p class="order-2 m-0 text-center md:order-1 md:text-left">
				© 2013 - <?php echo esc_html( gmdate( 'Y' ) ); ?> <span class="font-semibold text-white">Saylani Mass IT Training</span>. All rights reserved.
				<span class="mt-1 block text-gray-400">Made by M. Talha Qamar</span>
			</p>
			<div class="order-1 mb-1 flex flex-wrap justify-center gap-6 md:order-2 md:mb-0">
				<a href="<?php echo esc_url( $privacy ); ?>" class="whitespace-nowrap text-gray-400 transition hover:text-white">Privacy Policy</a>
				<a href="<?php echo esc_url( $terms ); ?>" class="whitespace-nowrap text-gray-400 transition hover:text-white">Terms of Service</a>
			</div>
		</div>
	</div>
</footer>

<a href="mailto:saylanimass@gmail.com" class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#2f80ed] text-white shadow-lg transition hover:scale-105" aria-label="Chat with us" data-reveal="right">
	<i class="fa-regular fa-comment-dots text-2xl" aria-hidden="true"></i>
</a>

<?php wp_footer(); ?>
</body>
</html>
