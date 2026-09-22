<?php
/**
 * Front page template.
 *
 * @package SMIT
 */

get_header();

$page_id = (int) get_queried_object_id();
if ( ! $page_id ) {
	$page_id = (int) get_option( 'page_on_front' );
}

$hero_title  = smit_meta( $page_id, 'hero_title', "Building Pakistan's" );
$hero_accent = smit_meta( $page_id, 'hero_title_accent', 'Tech Future' );
$hero_sub    = smit_meta( $page_id, 'hero_subtitle', 'Changing Lives. Building Careers. Shaping the Future.' );
$video_url   = smit_meta( $page_id, 'media_video_url', 'https://www.youtube.com/embed/m-pAPx-zkx4' );
$stat_students   = smit_meta( $page_id, 'stat_students', '200,000+' );
$stat_trainers   = smit_meta( $page_id, 'stat_trainers', '400+' );
$stat_employment = smit_meta( $page_id, 'stat_employment', '70%' );
$stat_startups   = smit_meta( $page_id, 'stat_startups', '150+' );
$vision_title    = smit_meta( $page_id, 'vision_title', "Empowering 10 million IT experts to drive Pakistan's \$100 billion digital economy" );

$reviews      = smit_get_reviews();
$campuses_url = smit_campuses_url();
$cities       = array(
	'karachi'      => 'Karachi',
	'faisalabad'   => 'Faisalabad',
	'hyderabad'    => 'Hyderabad',
	'peshawar'     => 'Peshawar',
	'quetta'       => 'Quetta',
	'islamabad'    => 'Islamabad',
	'rawalpindi'   => 'Rawalpindi',
	'gujranwala'   => 'Gujranwala',
	'sukkur'       => 'Sukkur',
	'lakki-marwat' => 'Lakki Marwat',
);
?>

<section class="relative mx-auto max-w-7xl px-4 pb-8 pt-28 sm:px-6 lg:px-10 lg:pt-32">
	<div class="relative z-10 mx-auto max-w-3xl text-center">
		<h1 class="text-3xl font-extrabold leading-tight tracking-tight text-[#1c1c1c] sm:text-5xl md:text-[56px]" data-reveal="left">
			<?php echo esc_html( $hero_title ); ?><br>
			<span class="text-[#2b7de9]"><?php echo esc_html( $hero_accent ); ?></span>
		</h1>
		<p class="mt-4 text-base text-gray-500 sm:text-lg md:text-xl" data-reveal="right">
			<?php echo esc_html( $hero_sub ); ?>
		</p>
		<img src="<?php echo esc_url( smit_asset( 'images/logos/saylani_logo.png' ) ); ?>" alt="Saylani Welfare" class="mx-auto mt-8 h-10 w-auto max-w-[220px] object-contain" width="220" height="40" data-reveal="up">
		<div class="mt-8 flex flex-wrap items-center justify-center gap-4" data-reveal-stagger="up">
			<a href="<?php echo esc_url( smit_enroll_url() ); ?>" class="inline-flex min-w-[150px] items-center justify-center rounded-full bg-[#2f80ed] px-7 py-2.5 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-brand-primary"><?php esc_html_e( 'Enroll Now', 'smit' ); ?></a>
			<a href="<?php echo esc_url( smit_courses_url() ); ?>" class="inline-flex min-w-[170px] items-center justify-center rounded-full border border-gray-300 bg-white px-7 py-2.5 text-xs font-semibold uppercase tracking-wide text-gray-500 transition hover:border-brand-primary hover:text-brand-primary"><?php esc_html_e( 'Explore Courses', 'smit' ); ?></a>
		</div>
	</div>

	<img src="<?php echo esc_url( smit_asset( 'images/home/laptop_icon.png' ) ); ?>" alt="" class="pointer-events-none absolute left-6 top-32 hidden h-16 w-auto sm:block md:left-16 md:top-36 md:h-20 lg:left-24" aria-hidden="true" data-reveal="left">
	<img src="<?php echo esc_url( smit_asset( 'images/home/up_arrow.png' ) ); ?>" alt="" class="pointer-events-none absolute right-8 top-28 hidden w-28 sm:block md:right-20 md:w-36" aria-hidden="true" data-reveal="right">
	<img src="<?php echo esc_url( smit_asset( 'images/home/down_arrow.png' ) ); ?>" alt="" class="pointer-events-none absolute bottom-8 left-8 hidden w-28 sm:block md:left-16 md:w-36" aria-hidden="true" data-reveal="left" style="--reveal-delay: 160ms">
	<img src="<?php echo esc_url( smit_asset( 'images/home/globe_icon.png' ) ); ?>" alt="" class="pointer-events-none absolute bottom-6 right-8 hidden h-20 w-auto sm:block md:right-16 md:h-24" aria-hidden="true" data-reveal="right" style="--reveal-delay: 160ms">
</section>

<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-10 lg:py-16">
	<div class="flex flex-col items-center justify-center gap-5 lg:flex-row lg:gap-6" data-reveal-stagger="up">
		<div class="h-[320px] w-full max-w-[320px] overflow-hidden rounded-[28px] bg-[#d7eaf6] shadow-[0_10px_25px_rgba(0,0,0,0.08)] transition hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(0,0,0,0.12)] sm:h-[360px]" data-reveal="left">
			<img src="<?php echo esc_url( smit_asset( 'images/home/shahmeerrizwan.png' ) ); ?>" alt="Student in Suit" class="h-full w-full object-cover object-top">
		</div>
		<div class="h-[320px] w-full max-w-[320px] overflow-hidden rounded-[28px] bg-black shadow-[0_10px_25px_rgba(0,0,0,0.08)] transition hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(0,0,0,0.12)] sm:h-[360px]" data-reveal="zoom">
			<iframe
				class="h-full w-full rounded-[28px] border-0"
				src="<?php echo esc_url( $video_url ); ?>"
				title="Saylani Welfare International Trust"
				loading="lazy"
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
				allowfullscreen>
			</iframe>
		</div>
		<div class="h-[320px] w-full max-w-[320px] overflow-hidden rounded-[28px] bg-[#f3edd4] shadow-[0_10px_25px_rgba(0,0,0,0.08)] transition hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(0,0,0,0.12)] sm:h-[360px]" data-reveal="right">
			<img src="<?php echo esc_url( smit_asset( 'images/home/home_girl.svg' ) ); ?>" alt="Student with books" class="h-full w-full object-cover object-bottom">
		</div>
	</div>
</section>

<section class="w-full bg-gradient-to-r from-[#0b73b7] via-[#3a9a7a] to-[#6da800] py-10 sm:py-12 md:py-14" aria-label="SMIT impact statistics">
	<div class="mx-auto grid max-w-6xl grid-cols-2 gap-8 px-4 text-center text-white sm:px-6 md:grid-cols-4 md:gap-4 lg:px-10" data-reveal-stagger="up">
		<div>
			<p class="text-2xl font-extrabold sm:text-3xl md:text-4xl"><?php echo esc_html( $stat_students ); ?></p>
			<p class="mt-2 text-xs font-medium uppercase tracking-wide sm:text-sm"><?php esc_html_e( 'Students Trained', 'smit' ); ?></p>
		</div>
		<div>
			<p class="text-2xl font-extrabold sm:text-3xl md:text-4xl"><?php echo esc_html( $stat_trainers ); ?></p>
			<p class="mt-2 text-xs font-medium uppercase tracking-wide sm:text-sm"><?php esc_html_e( 'Trainers', 'smit' ); ?></p>
		</div>
		<div>
			<p class="text-2xl font-extrabold sm:text-3xl md:text-4xl"><?php echo esc_html( $stat_employment ); ?></p>
			<p class="mt-2 text-xs font-medium uppercase tracking-wide sm:text-sm"><?php esc_html_e( 'Employment Success', 'smit' ); ?></p>
		</div>
		<div>
			<p class="text-2xl font-extrabold sm:text-3xl md:text-4xl"><?php echo esc_html( $stat_startups ); ?></p>
			<p class="mt-2 text-xs font-medium uppercase tracking-wide sm:text-sm"><?php esc_html_e( 'Startups Launched', 'smit' ); ?></p>
		</div>
	</div>
</section>

<section class="mx-auto max-w-6xl px-4 py-16 sm:px-6 lg:px-10 lg:py-20">
	<div class="why-orbit">
		<div class="why-orbit__item flex max-w-[180px] flex-col items-center text-center">
			<div data-reveal="left">
				<div class="mb-3 flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-white shadow-[0_10px_25px_rgba(0,0,0,0.06)]">
					<img src="<?php echo esc_url( smit_asset( 'images/home/apprenticeship.png' ) ); ?>" alt="" class="h-10 w-10 object-contain">
				</div>
				<p class="text-sm font-bold text-[#222]"><?php esc_html_e( 'Hands-On Training &', 'smit' ); ?></p>
				<p class="mt-0.5 text-xs text-gray-500"><?php esc_html_e( 'Real-World Projects', 'smit' ); ?></p>
			</div>
		</div>
		<div class="why-orbit__item flex max-w-[180px] flex-col items-center text-center">
			<div data-reveal="right">
				<div class="mb-3 flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-white shadow-[0_10px_25px_rgba(0,0,0,0.06)]">
					<img src="<?php echo esc_url( smit_asset( 'images/home/male_freelancer.png' ) ); ?>" alt="" class="h-10 w-10 object-contain">
				</div>
				<p class="text-sm font-bold text-[#222]"><?php esc_html_e( '70% Employment &', 'smit' ); ?></p>
				<p class="mt-0.5 text-xs text-gray-500"><?php esc_html_e( 'Freelancing Success Rate', 'smit' ); ?></p>
			</div>
		</div>
		<div class="why-orbit__item flex max-w-[180px] flex-col items-center text-center">
			<div data-reveal="left" style="--reveal-delay: 80ms">
				<div class="mb-3 flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-white shadow-[0_10px_25px_rgba(0,0,0,0.06)]">
					<img src="<?php echo esc_url( smit_asset( 'images/home/graduate_cap.png' ) ); ?>" alt="" class="h-10 w-10 object-contain">
				</div>
				<p class="text-sm font-bold text-[#222]"><?php esc_html_e( 'Affordable & Accessible', 'smit' ); ?></p>
				<p class="mt-0.5 text-xs text-gray-500"><?php esc_html_e( 'Education for All', 'smit' ); ?></p>
			</div>
		</div>
		<div class="why-orbit__item flex max-w-[180px] flex-col items-center text-center">
			<div data-reveal="right" style="--reveal-delay: 80ms">
				<div class="mb-3 flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-white shadow-[0_10px_25px_rgba(0,0,0,0.06)]">
					<img src="<?php echo esc_url( smit_asset( 'images/home/earth_icon.png' ) ); ?>" alt="" class="h-10 w-10 object-contain">
				</div>
				<p class="text-sm font-bold text-[#222]"><?php esc_html_e( '150+ Startups Launched', 'smit' ); ?></p>
				<p class="mt-0.5 text-xs text-gray-500"><?php esc_html_e( 'Globally', 'smit' ); ?></p>
			</div>
		</div>
		<div class="why-orbit__item flex max-w-[180px] flex-col items-center text-center">
			<div data-reveal="left" style="--reveal-delay: 160ms">
				<div class="mb-3 flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-white shadow-[0_10px_25px_rgba(0,0,0,0.06)]">
					<img src="<?php echo esc_url( smit_asset( 'images/home/cisco_icon.png' ) ); ?>" alt="" class="h-10 w-10 object-contain">
				</div>
				<p class="text-sm font-bold text-[#222]"><?php esc_html_e( 'Recognized by Cisco &', 'smit' ); ?></p>
				<p class="mt-0.5 text-xs text-gray-500"><?php esc_html_e( 'Global Tech Giants', 'smit' ); ?></p>
			</div>
		</div>
		<div class="why-orbit__item flex max-w-[180px] flex-col items-center text-center">
			<div data-reveal="right" style="--reveal-delay: 160ms">
				<div class="mb-3 flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-white shadow-[0_10px_25px_rgba(0,0,0,0.06)]">
					<img src="<?php echo esc_url( smit_asset( 'images/home/online_learning.png' ) ); ?>" alt="" class="h-10 w-10 object-contain">
				</div>
				<p class="text-sm font-bold text-[#222]"><?php esc_html_e( "Pakistan's Largest IT", 'smit' ); ?></p>
				<p class="mt-0.5 text-xs text-gray-500"><?php esc_html_e( 'Training Provider', 'smit' ); ?></p>
			</div>
		</div>
		<div class="why-orbit__center">
			<span class="inline-block rounded-full bg-[#2f80ed] px-5 py-2 text-sm font-semibold text-white" data-reveal="left"><?php esc_html_e( 'Why Choose SMIT?', 'smit' ); ?></span>
			<h2 class="mt-5 text-2xl font-extrabold leading-snug text-[#1a1a1a] sm:text-3xl md:text-[2.1rem]" data-reveal="right">
				<?php esc_html_e( 'Empowering You with World-Class', 'smit' ); ?><br><?php esc_html_e( 'IT Training & Proven Success', 'smit' ); ?>
			</h2>
		</div>
	</div>
</section>

<section class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-10">
	<h2 class="mb-8 text-center text-3xl font-extrabold text-[#1a1a1a] md:text-4xl" data-reveal="left"><?php esc_html_e( 'Browse Our', 'smit' ); ?> <span class="text-[#2b7de9]"><?php esc_html_e( 'Top Courses', 'smit' ); ?></span></h2>
	<div class="mb-6 flex flex-wrap items-center justify-center gap-2 sm:gap-4" data-reveal-stagger="up">
		<button type="button" data-course-tab="open" class="course-tab is-active inline-flex items-center gap-2 rounded-full bg-[#2f80ed] px-5 py-2.5 text-sm font-semibold text-white">
			<i class="fa-solid fa-star" aria-hidden="true"></i> <?php esc_html_e( 'Admissions Open', 'smit' ); ?>
		</button>
		<button type="button" data-course-tab="development" class="course-tab rounded-full px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-brand-primary"><?php esc_html_e( 'Development', 'smit' ); ?></button>
		<button type="button" data-course-tab="designing" class="course-tab rounded-full px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-brand-primary"><?php esc_html_e( 'Designing', 'smit' ); ?></button>
		<button type="button" data-course-tab="networking" class="course-tab rounded-full px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-brand-primary"><?php esc_html_e( 'Networking', 'smit' ); ?></button>
		<button type="button" data-course-tab="entrepreneurship" class="course-tab rounded-full px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-brand-primary"><?php esc_html_e( 'Entrepreneurship', 'smit' ); ?></button>
		<button type="button" data-course-tab="vocational" class="course-tab rounded-full px-4 py-2.5 text-sm font-medium text-slate-500 hover:text-brand-primary"><?php esc_html_e( 'Vocational Training Courses', 'smit' ); ?></button>
	</div>
	<div class="relative">
		<button type="button" id="course-prev" class="absolute -left-3 top-1/2 z-10 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 shadow md:flex" aria-label="<?php esc_attr_e( 'Scroll left', 'smit' ); ?>"><i class="fa-solid fa-chevron-left text-xs"></i></button>
		<div id="course-scroller" class="course-scroller" data-reveal-stagger="up"></div>
		<button type="button" id="course-next" class="absolute -right-3 top-1/2 z-10 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500 shadow md:flex" aria-label="<?php esc_attr_e( 'Scroll right', 'smit' ); ?>"><i class="fa-solid fa-chevron-right text-xs"></i></button>
	</div>
</section>

<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-10 lg:py-16">
	<div class="grid items-center gap-8 lg:grid-cols-[280px_1fr]">
		<div>
			<span class="inline-block rounded-full bg-[#2f80ed] px-4 py-1.5 text-sm font-semibold text-white" data-reveal="left"><?php esc_html_e( 'Student Reviews', 'smit' ); ?></span>
			<h2 class="mt-4 text-3xl font-extrabold leading-tight text-[#1a1a1a] md:text-4xl" data-reveal="right"><?php esc_html_e( 'What Our Students', 'smit' ); ?><br><?php esc_html_e( 'Say About Us', 'smit' ); ?></h2>
			<div class="mt-6 flex gap-3">
				<button type="button" id="review-prev" class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500" aria-label="<?php esc_attr_e( 'Previous review', 'smit' ); ?>"><i class="fa-solid fa-chevron-left text-xs"></i></button>
				<button type="button" id="review-next" class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-500" aria-label="<?php esc_attr_e( 'Next review', 'smit' ); ?>"><i class="fa-solid fa-chevron-right text-xs"></i></button>
			</div>
		</div>
		<div id="review-scroller" class="review-scroller" data-reveal-stagger="right">
			<?php foreach ( $reviews as $review ) :
				$rid       = $review->ID;
				$name      = get_the_title( $review );
				$role      = smit_meta( $rid, 'role', '' );
				$video_id  = smit_meta( $rid, 'video_id', '' );
				$img_path  = smit_meta( $rid, 'image_path', 'images/reviews/muhammad_saad.png' );
				$img_url   = smit_thumb_url( $rid, $img_path );
				$parts     = preg_split( '/\s+/', trim( $name ), 2 );
				$display   = count( $parts ) > 1 ? esc_html( $parts[0] ) . '<br>' . esc_html( $parts[1] ) . '.' : esc_html( $name );
				?>
				<button type="button" class="review-card relative h-[280px] w-[210px] shrink-0 overflow-hidden rounded-2xl" data-video="<?php echo esc_attr( $video_id ); ?>" data-name="<?php echo esc_attr( $name ); ?>" data-role="<?php echo esc_attr( $role ); ?>">
					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="h-full w-full object-cover">
					<span class="absolute inset-0 bg-gradient-to-t from-[#0b3a6b]/80 to-transparent"></span>
					<span class="absolute left-1/2 top-1/2 flex h-12 w-12 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-white text-[#2f80ed]"><i class="fa-solid fa-play ml-0.5" aria-hidden="true"></i></span>
					<p class="absolute bottom-4 left-4 text-left text-lg font-bold text-white"><?php echo $display; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above ?></p>
				</button>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="mx-auto max-w-6xl px-4 py-8 text-center sm:px-6 lg:px-10">
	<span class="inline-block rounded-full bg-[#2f80ed] px-4 py-1.5 text-sm font-semibold text-white" data-reveal="left"><?php esc_html_e( 'Join the revolution', 'smit' ); ?></span>
	<h2 class="mt-4 text-3xl font-extrabold text-[#1a1a1a] md:text-4xl" data-reveal="right"><?php esc_html_e( 'Find Saylani Campuses Near You', 'smit' ); ?></h2>
	<p class="mx-auto mt-3 max-w-2xl text-sm text-slate-500" data-reveal="fade" style="--reveal-delay: 140ms"><?php esc_html_e( 'Campuses of Saylani Welfare Trust are located in various cities across Pakistan. Select your city and view the nearest campus details.', 'smit' ); ?></p>
	<div class="relative mx-auto mt-8 max-w-3xl" data-reveal="zoom">
		<img src="<?php echo esc_url( smit_asset( 'images/home/pk_map.svg' ) ); ?>" alt="Pakistan Map showing SMIT campus locations" class="mx-auto w-full max-w-xl">
	</div>
	<div id="city-chips" class="mt-6 flex flex-wrap items-center justify-center gap-2" data-reveal-stagger="up">
		<?php
		$i = 0;
		foreach ( $cities as $slug => $label ) :
			$chip_class = 0 === $i ? 'city-chip is-active rounded-full px-4 py-2 text-sm font-medium' : 'city-chip rounded-full px-4 py-2 text-sm font-medium';
			?>
			<a href="<?php echo esc_url( add_query_arg( 'city', $slug, $campuses_url ) ); ?>" class="<?php echo esc_attr( $chip_class ); ?>"><?php echo esc_html( $label ); ?></a>
			<?php
			++$i;
		endforeach;
		?>
	</div>
	<a href="<?php echo esc_url( $campuses_url ); ?>" class="mt-8 inline-flex items-center gap-2 rounded-full bg-[#2f80ed] px-6 py-2.5 text-sm font-semibold text-white" data-reveal="up"><?php esc_html_e( 'See All Campuses', 'smit' ); ?></a>
</section>

<section class="mx-auto max-w-6xl px-4 py-16 text-center sm:px-6 lg:px-10">
	<h2 class="text-3xl font-extrabold text-[#1a1a1a] md:text-4xl" data-reveal="left"><?php esc_html_e( "We don't just teach IT", 'smit' ); ?></h2>
	<h3 class="mt-1 text-3xl font-extrabold text-[#2b7de9] md:text-4xl" data-reveal="right"><?php esc_html_e( 'We manufacture success stories', 'smit' ); ?></h3>
	<p class="mx-auto mt-4 max-w-2xl text-sm text-slate-500" data-reveal="fade" style="--reveal-delay: 140ms"><?php esc_html_e( 'Thousands of our alumni are powering the digital economy with innovation, skill, and passion.', 'smit' ); ?></p>
	<img src="<?php echo esc_url( smit_asset( 'images/home/alumni_grp.png' ) ); ?>" alt="SMIT alumni" class="mx-auto mt-8 w-full max-w-4xl rounded-2xl object-cover" data-reveal="zoom">

	<div class="mt-16 rounded-3xl bg-white px-6 py-12 shadow-[0_10px_40px_rgba(15,23,42,0.06)] sm:px-10">
		<p class="text-xs font-bold uppercase tracking-[0.2em] text-[#2f80ed]" data-reveal="left"><?php esc_html_e( 'SMIT Vision', 'smit' ); ?></p>
		<h2 class="mx-auto mt-3 max-w-3xl text-2xl font-extrabold text-[#1a1a1a] md:text-3xl" data-reveal="right"><?php echo esc_html( $vision_title ); ?></h2>
		<div class="mt-10 grid gap-6 md:grid-cols-3" data-reveal-stagger="up">
			<div class="rounded-2xl border border-slate-100 bg-[#f8fbff] p-6">
				<h3 class="text-2xl font-extrabold text-[#2b7de9]">10 Million+</h3>
				<p class="mt-1 font-semibold"><?php esc_html_e( 'IT Experts', 'smit' ); ?></p>
				<p class="mt-2 text-sm text-slate-500"><?php esc_html_e( 'Training the next generation of skilled IT professionals to compete globally and drive innovation', 'smit' ); ?></p>
			</div>
			<div class="rounded-2xl border border-slate-100 bg-[#f8fbff] p-6">
				<h3 class="text-2xl font-extrabold text-[#6da800]">$100 Billion</h3>
				<p class="mt-1 font-semibold"><?php esc_html_e( 'Digital Economy', 'smit' ); ?></p>
				<p class="mt-2 text-sm text-slate-500"><?php esc_html_e( "Contributing to Pakistan's economic growth through technology, innovation, and digital transformation", 'smit' ); ?></p>
			</div>
			<div class="rounded-2xl bg-gradient-to-br from-[#1c7ed6] to-[#6db51a] p-6 text-left text-white">
				<h3 class="text-xl font-extrabold"><?php esc_html_e( 'Be a Part of This Vision', 'smit' ); ?></h3>
				<p class="mt-2 text-sm text-white/90"><?php esc_html_e( "Join thousands of students who are already transforming their careers and contributing to Pakistan's digital future", 'smit' ); ?></p>
				<div class="mt-5 flex flex-wrap gap-3">
					<a href="<?php echo esc_url( smit_page_url( 'about', '/about/' ) ); ?>" class="rounded-full bg-white px-4 py-2 text-xs font-semibold text-slate-800"><?php esc_html_e( 'About Saylani Mass IT Training', 'smit' ); ?></a>
					<a href="<?php echo esc_url( smit_enroll_url() ); ?>" class="rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-semibold text-white"><?php esc_html_e( 'Enroll Now', 'smit' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="review-modal" class="review-modal" hidden>
	<div class="review-modal__dialog">
		<button type="button" id="review-modal-close" class="review-modal__close" aria-label="<?php esc_attr_e( 'Close video', 'smit' ); ?>"><i class="fa-solid fa-xmark"></i></button>
		<div class="review-modal__frame">
			<iframe id="review-frame" title="<?php esc_attr_e( 'Student review video', 'smit' ); ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			<div class="review-modal__meta">
				<p id="review-modal-name"></p>
				<span id="review-modal-role"></span>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
