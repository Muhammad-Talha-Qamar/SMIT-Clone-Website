<?php
/**
 * Template Name: Student Portal
 *
 * Demo registration / ID card / results UI (client-side only).
 *
 * @package SMIT
 */

get_header();
?>

<section class="smit-hero-banner">
	<div class="glow-top-right" aria-hidden="true"></div>
	<div class="glow-bottom-left" aria-hidden="true"></div>
	<div class="smit-hero-container">
		<a href="<?php echo esc_url( smit_enroll_url() ); ?>" id="hero-badge" class="smit-pill-badge" data-reveal="left">
			<i class="fa-solid fa-arrow-right-to-bracket"></i>
			<span id="hero-badge-text"><?php esc_html_e( 'Registration Form', 'smit' ); ?></span>
		</a>
		<h1 id="hero-title" class="text-3xl md:text-5xl font-extrabold text-white mb-3" data-reveal="right"><?php esc_html_e( 'Registration Form', 'smit' ); ?></h1>
		<p id="hero-subtitle" class="text-sm md:text-base text-white/90 max-w-2xl" data-reveal="left">
			<?php esc_html_e( 'Start your journey towards excellence. Fill out the form to apply for our courses', 'smit' ); ?>
		</p>
	</div>
</section>

<section class="max-w-6xl mx-auto px-4 mt-8">
	<div class="flex flex-wrap items-center justify-center gap-3 sm:gap-4 border-b border-slate-200 pb-6" role="tablist" aria-label="<?php esc_attr_e( 'Student portal sections', 'smit' ); ?>" data-reveal-stagger="up">
		<button type="button" class="tab-btn active" data-tab="registration" aria-selected="true">
			<i class="fa-regular fa-id-card" aria-hidden="true"></i>
			<span><?php esc_html_e( 'Registration Form', 'smit' ); ?></span>
		</button>
		<button type="button" class="tab-btn" data-tab="idcard" aria-selected="false">
			<i class="fa-solid fa-address-card" aria-hidden="true"></i>
			<span><?php esc_html_e( 'Download ID Card', 'smit' ); ?></span>
		</button>
		<button type="button" class="tab-btn" data-tab="entrytest" aria-selected="false">
			<i class="fa-solid fa-file-pen" aria-hidden="true"></i>
			<span><?php esc_html_e( 'Entry Test Status', 'smit' ); ?></span>
		</button>
		<button type="button" class="tab-btn" data-tab="result" aria-selected="false">
			<i class="fa-solid fa-square-poll-vertical" aria-hidden="true"></i>
			<span><?php esc_html_e( 'Result', 'smit' ); ?></span>
		</button>
	</div>
</section>

<main class="max-w-4xl mx-auto px-4 py-8">

	<div id="tab-registration" class="tab-content">
		<form id="registration-form" class="space-y-8 bg-white p-6 sm:p-10 rounded-2xl border border-slate-200 shadow-sm" novalidate>
			<p id="form-message" class="hidden rounded-lg px-4 py-3 text-sm font-semibold" role="status"></p>

			<div>
				<h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
					<i class="fa-solid fa-location-dot text-brand-primary"></i> <?php esc_html_e( 'Location & Course Details', 'smit' ); ?>
				</h2>
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
					<div>
						<label for="country" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select Country*', 'smit' ); ?></label>
						<select id="country" name="country" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select country', 'smit' ); ?></option>
							<option value="Pakistan">Pakistan</option>
						</select>
					</div>
					<div>
						<label for="class-preference" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select class preference*', 'smit' ); ?></label>
						<select id="class-preference" name="classPreference" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select class preference', 'smit' ); ?></option>
							<option value="Onsite">Onsite</option>
							<option value="Online">Online</option>
						</select>
					</div>
					<div>
						<label for="gender" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select Gender*', 'smit' ); ?></label>
						<select id="gender" name="gender" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select gender', 'smit' ); ?></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div>
						<label for="city" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select City*', 'smit' ); ?></label>
						<select id="city" name="city" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select city', 'smit' ); ?></option>
							<option value="Karachi">Karachi</option>
							<option value="Lahore">Lahore</option>
						</select>
					</div>
				</div>
			</div>

			<div>
				<h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
					<i class="fa-solid fa-user text-brand-primary"></i> <?php esc_html_e( 'Personal Information', 'smit' ); ?>
				</h2>
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
					<div>
						<label for="full-name" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Full Name *', 'smit' ); ?></label>
						<input id="full-name" name="fullName" type="text" autocomplete="name" required placeholder="<?php esc_attr_e( 'Enter your full name', 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="father-name" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Father Name *', 'smit' ); ?></label>
						<input id="father-name" name="fatherName" type="text" required placeholder="<?php esc_attr_e( "Enter father's name", 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="email" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Email *', 'smit' ); ?></label>
						<input id="email" name="email" type="email" autocomplete="email" required placeholder="your.email@example.com" class="portal-input">
					</div>
					<div>
						<label for="phone" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Phone *', 'smit' ); ?></label>
						<input id="phone" name="phone" type="tel" autocomplete="tel" required placeholder="<?php esc_attr_e( 'Enter phone number', 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="cnic" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'CNIC / B-Form *', 'smit' ); ?></label>
						<input id="cnic" name="cnic" type="text" required minlength="13" maxlength="13" placeholder="4201012345671" class="portal-input">
					</div>
					<div>
						<label for="father-cnic" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( "Father's CNIC *", 'smit' ); ?></label>
						<input id="father-cnic" name="fatherCnic" type="text" required minlength="13" maxlength="13" placeholder="4201012345671" class="portal-input">
					</div>
				</div>
			</div>

			<div class="text-center pt-4">
				<button type="submit" class="w-full sm:w-auto px-10 py-3 bg-brand-primary text-white font-bold rounded-lg shadow-lg hover:bg-blue-700 transition">
					<?php esc_html_e( 'Submit Registration', 'smit' ); ?>
				</button>
			</div>
		</form>
	</div>

	<div id="tab-idcard" class="tab-content hidden">
		<div class="bg-white p-8 sm:p-12 rounded-2xl border border-slate-200 text-center max-w-xl mx-auto shadow-sm">
			<h2 class="text-2xl font-extrabold text-slate-800 mb-2"><?php esc_html_e( 'Download ID Card', 'smit' ); ?></h2>
			<p class="text-xs text-slate-500 mb-6"><?php esc_html_e( 'Enter the CNIC you provided during form submission.', 'smit' ); ?><br>⚠️ <?php esc_html_e( "Don't use dashes (-) in CNIC number.", 'smit' ); ?></p>
			<div class="text-left mb-6">
				<label for="idcard-cnic" class="block text-xs font-bold text-slate-700 mb-2"><?php esc_html_e( 'CNIC Number*', 'smit' ); ?></label>
				<input id="idcard-cnic" type="text" required minlength="13" maxlength="13" inputmode="numeric" placeholder="4220109966883" class="portal-input text-center text-lg tracking-wider">
			</div>
			<p class="portal-feedback hidden mb-4 text-sm font-semibold" role="status"></p>
			<button type="button" class="portal-search w-full py-3 bg-brand-primary text-white font-bold rounded-lg shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
				<i class="fa-solid fa-magnifying-glass"></i> <?php esc_html_e( 'Search', 'smit' ); ?>
			</button>
		</div>
	</div>

	<div id="tab-entrytest" class="tab-content hidden">
		<div class="bg-white p-8 sm:p-12 rounded-2xl border border-slate-200 text-center max-w-xl mx-auto shadow-sm">
			<h2 class="text-2xl font-extrabold text-slate-800 mb-2"><?php esc_html_e( 'Check Your Entry Test Status', 'smit' ); ?></h2>
			<p class="text-xs text-slate-500 mb-6"><?php esc_html_e( 'Enter your roll number to view your entry test / induction status', 'smit' ); ?></p>
			<div class="text-left mb-6">
				<label for="entry-roll" class="block text-xs font-bold text-slate-700 mb-2"><?php esc_html_e( 'Roll Number*', 'smit' ); ?></label>
				<input id="entry-roll" type="text" required placeholder="<?php esc_attr_e( 'ENTER YOUR ROLL NUMBER', 'smit' ); ?>" class="portal-input text-center text-lg uppercase">
			</div>
			<p class="portal-feedback hidden mb-4 text-sm font-semibold" role="status"></p>
			<button type="button" class="portal-search w-full py-3 bg-brand-primary text-white font-bold rounded-lg shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
				<i class="fa-solid fa-magnifying-glass"></i> <?php esc_html_e( 'Check Status', 'smit' ); ?>
			</button>
		</div>
	</div>

	<div id="tab-result" class="tab-content hidden">
		<div class="bg-white p-8 sm:p-12 rounded-2xl border border-slate-200 text-center max-w-xl mx-auto shadow-sm">
			<h2 class="text-2xl font-extrabold text-slate-800 mb-2"><?php esc_html_e( 'Check Your Result', 'smit' ); ?></h2>
			<p class="text-xs text-slate-500 mb-6"><?php esc_html_e( 'Enter your roll number to view your examination results', 'smit' ); ?></p>
			<div class="text-left mb-6">
				<label for="result-roll" class="block text-xs font-bold text-slate-700 mb-2"><?php esc_html_e( 'Roll Number*', 'smit' ); ?></label>
				<input id="result-roll" type="text" required placeholder="<?php esc_attr_e( 'ENTER YOUR ROLL NUMBER', 'smit' ); ?>" class="portal-input text-center text-lg uppercase">
			</div>
			<p class="portal-feedback hidden mb-4 text-sm font-semibold" role="status"></p>
			<button type="button" class="portal-search w-full py-3 bg-brand-primary text-white font-bold rounded-lg shadow-md hover:bg-blue-700 transition flex items-center justify-center gap-2">
				<i class="fa-solid fa-magnifying-glass"></i> <?php esc_html_e( 'Search Result', 'smit' ); ?>
			</button>
		</div>
	</div>

</main>

<?php
get_footer();
