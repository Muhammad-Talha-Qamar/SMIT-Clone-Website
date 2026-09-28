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
						<label for="country" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select Country', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="country" name="country" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select country', 'smit' ); ?></option>
							<option value="Pakistan">Pakistan</option>
							<option value="Turkey">Turkey</option>
							<option value="Yemen">Yemen</option>
							<option value="Africa">Africa</option>
						</select>
					</div>
					<div>
						<label for="class-preference" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select class preference', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="class-preference" name="classPreference" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select class preference', 'smit' ); ?></option>
							<option value="Online">Online</option>
							<option value="Onsite">Onsite</option>
						</select>
					</div>
					<div>
						<label for="gender" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select Gender', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="gender" name="gender" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select gender', 'smit' ); ?></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div>
						<label for="city" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select City', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="city" name="city" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select city', 'smit' ); ?></option>
							<option value="Karachi">Karachi</option>
							<option value="Lahore">Lahore</option>
							<option value="Islamabad">Islamabad</option>
							<option value="Rawalpindi">Rawalpindi</option>
							<option value="Faisalabad">Faisalabad</option>
							<option value="Hyderabad">Hyderabad</option>
							<option value="Peshawar">Peshawar</option>
							<option value="Quetta">Quetta</option>
							<option value="Multan">Multan</option>
							<option value="Gujranwala">Gujranwala</option>
							<option value="Sukkur">Sukkur</option>
							<option value="Abbottabad">Abbottabad</option>
							<option value="Ghotki">Ghotki</option>
							<option value="Lakki Marwat">Lakki Marwat</option>
							<option value="Turbat">Turbat</option>
							<option value="Waziristan">Waziristan</option>
							<option value="Wana">Wana</option>
							<option value="Balochistan">Balochistan</option>
							<option value="All Pakistan">All Pakistan</option>
						</select>
					</div>
					<div>
						<label for="course" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select Course', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="course" name="course" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select course or event', 'smit' ); ?></option>
							<option value="Freelancing">Freelancing</option>
							<option value="Video Content Creation With AI">Video Content Creation With AI</option>
							<option value="UI UX Design With AI">UI UX Design With AI</option>
							<option value="Graphic Designing With AI">Graphic Designing With AI</option>
							<option value="Shopify E-Commerce Expert">Shopify E-Commerce Expert</option>
							<option value="Digital Marketing With AI">Digital Marketing With AI</option>
							<option value="Agentic AI">Agentic AI</option>
							<option value="Artificial Intelligence and Data Science">Artificial Intelligence and Data Science</option>
							<option value="Bootcamp (Artificial Intelligence)">Bootcamp (Artificial Intelligence)</option>
							<option value="Bootcamp (Blockchain Development)">Bootcamp (Blockchain Development)</option>
							<option value="Odoo Functional Consultant">Odoo Functional Consultant</option>
							<option value="DevOps Engineer">DevOps Engineer</option>
							<option value="Video Content Creation">Video Content Creation</option>
							<option value="Video Animation">Video Animation</option>
							<option value="AutoCAD">AutoCAD</option>
							<option value="SOC Analyst CyberOps">SOC Analyst CyberOps</option>
							<option value="Networking Essentials">Networking Essentials</option>
							<option value="Cybersecurity Essentials">Cybersecurity Essentials</option>
							<option value="CyberOps Associate">CyberOps Associate</option>
							<option value="Professional Communication & Career Readiness">Professional Communication &amp; Career Readiness</option>
							<option value="English Language & Communication Skills">English Language &amp; Communication Skills</option>
							<option value="AI & Game Creators">AI &amp; Game Creators</option>
							<option value="Little Geniuses: Coding for Kids">Little Geniuses: Coding for Kids</option>
							<option value="Health, Safety and Environment">Health, Safety and Environment</option>
							<option value="Fire Alarm System Installation">Fire Alarm System Installation</option>
							<option value="Domestic Electrician">Domestic Electrician</option>
							<option value="Plumber Technician">Plumber Technician</option>
						</select>
					</div>
					<div>
						<label for="campus" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Select Campus', 'smit' ); ?></label>
						<select id="campus" name="campus" class="portal-input">
							<option value=""><?php esc_html_e( 'Select campus', 'smit' ); ?></option>
							<option value="Online">Online</option>
							<option value="Bahadurabad Campus">Bahadurabad Campus</option>
							<option value="Numaish Campus">Numaish Campus</option>
							<option value="Paposh Campus">Paposh Campus</option>
							<option value="Zaitoon Ashraf IT Park">Zaitoon Ashraf IT Park</option>
							<option value="Gulshan Campus">Gulshan Campus</option>
							<option value="North Nazimabad Campus">North Nazimabad Campus</option>
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
						<label for="full-name" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Full Name', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="full-name" name="fullName" type="text" autocomplete="name" required placeholder="<?php esc_attr_e( 'Enter your full name', 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="father-name" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Father Name', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="father-name" name="fatherName" type="text" required placeholder="<?php esc_attr_e( "Enter father's name", 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="dob" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Date of Birth', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="dob" name="dob" type="date" required class="portal-input">
					</div>
					<div>
						<label for="email" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Email', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="email" name="email" type="email" autocomplete="email" required placeholder="your.email@example.com" class="portal-input">
					</div>
					<div>
						<label for="phone" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Phone', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="phone" name="phone" type="tel" autocomplete="tel" required placeholder="<?php esc_attr_e( 'Enter phone number', 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="father-phone" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( "Father's Phone", 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="father-phone" name="fatherPhone" type="tel" required placeholder="<?php esc_attr_e( 'Enter phone number', 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="cnic" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'CNIC / ID Number', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="cnic" name="cnic" type="text" inputmode="numeric" required minlength="13" maxlength="13" placeholder="<?php esc_attr_e( 'Enter ID number', 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="father-cnic" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( "Father's CNIC / ID Number", 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="father-cnic" name="fatherCnic" type="text" inputmode="numeric" required minlength="13" maxlength="13" placeholder="<?php esc_attr_e( 'Enter ID number', 'smit' ); ?>" class="portal-input">
					</div>
					<div class="sm:col-span-2">
						<label for="address" class="block text-xs font-semibold text-slate-600 mb-1">
							<?php esc_html_e( 'Address', 'smit' ); ?> <span class="text-red-500">*</span>
							<span class="font-normal text-slate-400">(<span id="address-count">0</span>/220 <?php esc_html_e( 'characters', 'smit' ); ?>)</span>
						</label>
						<textarea id="address" name="address" required minlength="10" maxlength="220" rows="3" placeholder="<?php esc_attr_e( 'Enter your complete address (minimum 10 characters)', 'smit' ); ?>" class="portal-input resize-y"></textarea>
					</div>
				</div>
			</div>

			<div>
				<h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
					<i class="fa-solid fa-graduation-cap text-brand-primary"></i> <?php esc_html_e( 'Education & Technical Details', 'smit' ); ?>
				</h2>
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
					<div>
						<label for="computer-proficiency" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Computer Proficiency', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="computer-proficiency" name="computerProficiency" required class="portal-input">
							<option value=""><?php esc_html_e( 'Select your computer proficiency', 'smit' ); ?></option>
							<option value="Beginner">Beginner</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Advanced">Advanced</option>
							<option value="Expert">Expert</option>
						</select>
					</div>
					<div>
						<label for="last-qualification" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Last Qualification', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="last-qualification" name="lastQualification" required class="portal-input">
							<option value=""><?php esc_html_e( 'Last qualification', 'smit' ); ?></option>
							<option value="Matriculation">Matriculation</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Undergraduate">Undergraduate</option>
							<option value="Bachelor's Degree">Bachelor's Degree</option>
							<option value="Master's Degree">Master's Degree</option>
							<option value="Other">Other</option>
						</select>
					</div>
					<div>
						<label for="institution" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Institution', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<input id="institution" name="institution" type="text" required placeholder="<?php esc_attr_e( 'Select your institution', 'smit' ); ?>" class="portal-input">
					</div>
					<div>
						<label for="referral-source" class="block text-xs font-semibold text-slate-600 mb-1"><?php esc_html_e( 'Where did you hear about us?', 'smit' ); ?> <span class="text-red-500">*</span></label>
						<select id="referral-source" name="referral_source" required class="portal-input">
							<option value=""><?php esc_html_e( 'Where did you hear about us?', 'smit' ); ?></option>
							<option value="Facebook">Facebook</option>
							<option value="Instagram">Instagram</option>
							<option value="YouTube">YouTube</option>
							<option value="TikTok">TikTok</option>
							<option value="Google Search">Google Search</option>
							<option value="WhatsApp">WhatsApp</option>
							<option value="SMIT Website">SMIT Website</option>
							<option value="Friend / Family">Friend / Family</option>
							<option value="Teacher / Institute">Teacher / Institute</option>
							<option value="Twitter / X">Twitter / X</option>
							<option value="LinkedIn">LinkedIn</option>
							<option value="Other">Other</option>
						</select>
					</div>
					<div class="sm:col-span-2">
						<p class="block text-xs font-semibold text-slate-600 mb-2"><?php esc_html_e( 'Do you have a Laptop?', 'smit' ); ?> <span class="text-red-500">*</span></p>
						<div class="flex items-center gap-6">
							<label class="inline-flex items-center gap-2 text-sm text-slate-700">
								<input type="radio" name="hasLaptop" value="yes" required class="accent-[#0b73b7]"> <?php esc_html_e( 'Yes', 'smit' ); ?>
							</label>
							<label class="inline-flex items-center gap-2 text-sm text-slate-700">
								<input type="radio" name="hasLaptop" value="no" required class="accent-[#0b73b7]"> <?php esc_html_e( 'No', 'smit' ); ?>
							</label>
						</div>
					</div>
				</div>
			</div>

			<div>
				<h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
					<i class="fa-solid fa-camera text-brand-primary"></i> <?php esc_html_e( 'Upload Picture', 'smit' ); ?>
				</h2>
				<label for="picture-upload" class="portal-upload relative">
					<input id="picture-upload" name="picture" type="file" accept="image/jpeg,image/jpg,image/png">
					<span id="picture-label" class="text-sm font-semibold text-brand-primary"><?php esc_html_e( '+ Upload Picture', 'smit' ); ?></span>
					<span id="picture-filename" class="text-xs text-slate-500"></span>
				</label>
				<ul class="mt-3 space-y-1 text-xs text-slate-500">
					<li><?php esc_html_e( '• With white or blue background', 'smit' ); ?></li>
					<li><?php esc_html_e( '• File size must be less than 1MB', 'smit' ); ?></li>
					<li><?php esc_html_e( '• File type: jpg, jpeg, png', 'smit' ); ?></li>
					<li><?php esc_html_e( '• Upload your recent passport size picture', 'smit' ); ?></li>
					<li><?php esc_html_e( '• Your Face should be clearly visible without any Glasses', 'smit' ); ?></li>
				</ul>
			</div>

			<div class="portal-terms space-y-4">
				<h2 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
					<i class="fa-solid fa-file-contract text-brand-primary"></i> <?php esc_html_e( 'Terms and Conditions', 'smit' ); ?>
				</h2>
				<label>
					<input type="checkbox" name="agreement1" required>
					<span><?php esc_html_e( 'I hereby solemnly declare that all information provided in this application is true and accurate to the best of my knowledge. Furthermore, I agree to abide by all current and future rules, regulations, and policies established by SMIT.', 'smit' ); ?></span>
				</label>
				<label>
					<input type="checkbox" name="agreement2" required>
					<span><?php esc_html_e( 'I accept the responsibility to maintain good conduct throughout the program and commit to focusing solely on learning. I will not engage in any political, unethical, or unrelated activities during my enrollment. Any violation may result in immediate cancellation of my admission.', 'smit' ); ?></span>
				</label>
				<label>
					<input type="checkbox" name="agreement3" required>
					<span><?php esc_html_e( 'Upon completion of the course, I agree to successfully complete any project assigned by SMIT as part of the program requirements.', 'smit' ); ?></span>
				</label>
				<label>
					<input type="checkbox" name="agreement4" required>
					<span><?php esc_html_e( 'Female students are required to wear an abaya or hijab while attending classes.', 'smit' ); ?></span>
				</label>
				<p class="text-xs text-slate-500 pt-1">
					<?php esc_html_e( 'By submitting this form, you agree to our', 'smit' ); ?>
					<a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>" class="text-brand-primary underline"><?php esc_html_e( 'Privacy Policy', 'smit' ); ?></a>
					<?php esc_html_e( 'and', 'smit' ); ?>
					<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>" class="text-brand-primary underline"><?php esc_html_e( 'Terms of Service', 'smit' ); ?></a>.
				</p>
				<div class="portal-notice">
					<strong><?php esc_html_e( 'Important Notice:', 'smit' ); ?></strong>
					<?php esc_html_e( 'Please ensure all information provided is accurate. Incomplete or false information may result in rejection of your application.', 'smit' ); ?>
				</div>
			</div>

			<div class="text-center pt-2">
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
