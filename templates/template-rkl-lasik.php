<?php
/**
 * Template Name: RK Eye LASIK Landing
 * Description: LASIK Surgery in Indore — service landing page for RK Eye & Retina Center.
 *              Renders inside the active theme's normal header/footer (nav, top bar,
 *              WhatsApp/Second Opinion buttons etc. all stay exactly as the theme provides).
 *
 * @package RKL
 */

get_header();
?>

<div class="rkl-landing">

	<!-- Breadcrumb -->
	<div class="rkl-breadcrumb">
		<div class="rkl-container">
			Home / Treatments / <span>LASIK Surgery in Indore</span>
		</div>
	</div>

	<!-- ================= HERO ================= -->
	<section class="rkl-hero">
		<div class="rkl-container rkl-hero-grid">
			<div>
				<span class="rkl-eyebrow">RK Eye &amp; Retina Center</span>
				<h1>LASIK Surgery in Indore</h1>
				<div class="rkl-sub">Modified, tailored vision correction — guided by experienced eye surgeons</div>
				<p>Discover LASIK, its requirements, and the entire process from the first consultation to full recovery, at RK Eye &amp; Retina Center, Indore.</p>

				<div class="rkl-pill-row">
					<span class="rkl-pill">Contoura LASIK</span>
					<span class="rkl-pill">Femto LASIK</span>
					<span class="rkl-pill">SMILE / SILK</span>
					<span class="rkl-pill">PRK &amp; TransPRK</span>
				</div>

				<div class="rkl-hero-buttons">
					<a href="https://rkeyehospital.com/appointment-booking/" class="rkl-btn rkl-btn-red">
						<i class="fa-solid fa-calendar-check" aria-hidden="true"></i> Book Your Appointment
					</a>
					<a href="tel:+917024154321" class="rkl-btn rkl-btn-outline">
						<i class="fa-solid fa-phone" aria-hidden="true"></i> Call +91 7024154321
					</a>
				</div>
			</div>

			<div class="rkl-hero-photo">
				<img src="<?php echo rkl_get_landing_image( 'lasik_hero', 'https://images.unsplash.com/photo-1551884170-09fb70a3a2ed?w=700&h=560&fit=crop' ); ?>" width="700" height="560" loading="eager" fetchpriority="high" alt="LASIK procedure at RK Eye &amp; Retina Center, Indore">
				<div class="rkl-hero-badge"><i class="fa-solid fa-check-circle" aria-hidden="true"></i> Personalised suitability-first evaluation</div>
			</div>
		</div>
	</section>

	<!-- ================= WHAT IS LASIK ================= -->
	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">What Is LASIK Surgery</span>
			<h2>A Precise, Laser-Guided Path to Clearer Vision</h2>
			<div class="rkl-content-grid">
				<div class="rkl-content-text">
					<p>LASIK, short for Laser Assisted In Situ Keratomileusis, is one of the most widely performed refractive treatments in the world today. A precise excimer laser reshapes the cornea so light can focus directly on the retina, resulting in sharper, clearer vision without constant dependence on glasses or contact lenses.</p>
					<p>For people living in and around central India, LASIK eye surgery in Indore has become a trusted route to spectacle independence. At RK Eye &amp; Retina Center, every patient goes through a thorough pre-operative assessment that goes beyond standard checks — including corneal topography, tear film analysis, and pupil size evaluation — so that only the right candidates move forward with treatment.</p>
					<p>The procedure typically takes under twenty minutes per eye and is performed on an outpatient basis. Most patients walk out the same day, with many noticing improved clarity within just a few hours.</p>
					<div class="rkl-highlight">
						<p><strong>Dr. Trushaa Agrawal, MBBS, MS Ophthalmology,</strong> leads the LASIK practice at RK Eye &amp; Retina Center. With years of focused experience in refractive and corneal surgery, she personally evaluates each case and decides which laser technique will work best for a particular eye.</p>
					</div>
				</div>
				<div class="rkl-content-image">
					<img src="<?php echo rkl_get_landing_image( 'lasik_intro', 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=600&h=460&fit=crop' ); ?>" width="600" height="460" loading="lazy" alt="Personalised LASIK procedure in progress at RK Eye &amp; Retina Center">
				</div>
			</div>
		</div>
	</section>

	<!-- ================= BENEFITS ================= -->
	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Why Patients Choose Us</span>
			<h2>Benefits of LASIK Surgery in Indore</h2>
			<p class="rkl-intro">Patients choosing laser eye surgery in Indore often value the quick recovery, minimal discomfort, and long-term convenience this procedure offers.</p>
			<div class="rkl-card-grid">
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-bolt" aria-hidden="true"></i></div>
					<h3>Fast Recovery</h3>
					<p>Many patients regain functional vision within a day or two. Light activities can usually resume within 48 hours, and most are back at work within a week.</p>
				</div>
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-person-running" aria-hidden="true"></i></div>
					<h3>Freedom to Move</h3>
					<p>Greater freedom in sports, travel, and daily routines once you no longer depend on corrective eyewear — swimming, running, outdoor adventures all become easier.</p>
				</div>
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-face-smile" aria-hidden="true"></i></div>
					<h3>High Satisfaction</h3>
					<p>Results vary by individual, but LASIK is consistently associated with high satisfaction — studies put long-term satisfaction above 95% among properly screened candidates.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= ELIGIBILITY ================= -->
	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Eligibility</span>
			<h2>Who Is an Ideal Candidate for Specs Removal Surgery</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>Not everyone is automatically suited for LASIK, which is why a thorough evaluation matters so much. Good candidates are generally over eighteen years of age, have a stable eyeglass prescription for at least a year, and do not have conditions such as severe dry eye, keratoconus, or uncontrolled diabetes.</p>
				<p>Corneal thickness and shape are assessed using advanced diagnostic mapping to confirm the eye can safely support surgery. During your consultation for LASIK eye treatment in Indore, our specialists review your history and discuss realistic expectations before recommending treatment.</p>
				<div class="rkl-tip-box">
					<div class="rkl-tip-label">Pro Tip</div>
					<p>If you have been told your cornea is too thin for traditional LASIK, do not lose hope. Procedures like PRK surgery in Indore or TransPRK in Indore can often work well for thinner corneas because they do not require a flap to be created. Dr. Trushaa Agrawal evaluates each case individually to find the safest, most effective path forward.</p>
				</div>
				<p>Your surgeon will recommend the most suitable option after reviewing your corneal profile, lifestyle needs, and refractive error.</p>
			</div>
		</div>
	</section>

	<!-- ================= PROCEDURE TYPES ================= -->
	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Procedure Options</span>
			<h2>Types of LASIK Procedures Available at RK Eye &amp; Retina Center</h2>
			<p class="rkl-intro">LASIK technology has evolved considerably over the past two decades, and our hospital offers multiple options based on individual eye characteristics, corneal health, and patient goals.</p>
			<div class="rkl-card-grid" style="margin-bottom: 24px;">
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-eye" aria-hidden="true"></i></div>
					<h3>Standard LASIK</h3>
					<p>Uses a microkeratome blade to create a corneal flap with a well-established track record — an effective, affordable option for many patients who meet the criteria.</p>
				</div>
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-crosshairs" aria-hidden="true"></i></div>
					<h3>Bladeless Femto LASIK</h3>
					<p>Also called bladeless LASIK in Indore, this relies entirely on laser technology for greater precision and faster healing — no blade touches the eye.</p>
				</div>
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-star" aria-hidden="true"></i></div>
					<h3>Contoura Vision LASIK</h3>
					<p>A topography-guided approach that maps thousands of unique points on the corneal surface for extremely personalised correction.</p>
				</div>
			</div>
			<div class="rkl-card-grid">
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-microscope" aria-hidden="true"></i></div>
					<h3>SMILE LASIK Surgery</h3>
					<p>Small Incision Lenticule Extraction removes a tiny lenticule through a small opening — no flap, less disruption to corneal nerves, typically drier eye symptoms are reduced.</p>
				</div>
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i></div>
					<h3>SILK LASIK Surgery</h3>
					<p>Smooth Incision Lenticule Keratomileusis is among the newest flapless refractive procedures, offering refined precision and faster visual recovery.</p>
				</div>
				<div class="rkl-card">
					<div class="rkl-card-icon"><i class="fa-solid fa-shield-heart" aria-hidden="true"></i></div>
					<h3>PRK and TransPRK</h3>
					<p>Surface ablation techniques especially helpful for thinner corneas. Recovery takes a few days longer than LASIK, with excellent long-term outcomes.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= DAY OF SURGERY (navy panel) ================= -->
	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<div class="rkl-navy-panel">
				<span class="rkl-label">On the Day of Surgery</span>
				<h2>What Happens During the Procedure</h2>
				<p>Numbing drops are applied, so the procedure is generally painless. A thin corneal flap is created and gently lifted, after which the excimer laser reshapes the underlying tissue according to your customised prescription map.</p>
				<p>The flap is then repositioned and adheres naturally without stitches. The process is quick, and patients are monitored briefly before heading home with post-operative instructions.</p>
				<div class="rkl-key-box">
					<div class="rkl-key-label">Key Takeaway</div>
					<p>The actual laser application usually lasts less than 30 seconds per eye. Most patients describe the experience as surprisingly easy and far less intimidating than they expected.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= RECOVERY ================= -->
	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Healing Timeline</span>
			<h2>Recovery After LASIK Eye Surgery</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>Recovery after LASIK eye surgery in Indore is generally fast, though it varies from person to person. Mild irritation, light sensitivity, or watering are common in the first day and usually settle within forty-eight hours.</p>
				<p>Most patients resume normal routines, including desk work, within one to two days, though strenuous activity and eye makeup are typically avoided for a couple of weeks. Follow-up visits track healing and confirm your vision is stabilising as expected.</p>
				<p>Results are generally stable long-term, though normal age-related changes such as presbyopia can still occur later in life — a natural part of aging, regardless of whether someone has had LASIK.</p>
			</div>
		</div>
	</section>

	<!-- ================= WHY CHOOSE US ================= -->
	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Our Difference</span>
			<h2>Why Choose RK Eye &amp; Retina Center</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>Our hospital has built its reputation on combining modern diagnostic technology with attentive, patient-centred care. Every LASIK candidate undergoes thorough pre-operative screening, including corneal topography, to confirm safety before any procedure is planned.</p>
				<p>Dr. Trushaa Agrawal (MBBS, MS Ophthalmology) personally oversees each surgical case. Her years of clinical experience, combined with a genuine commitment to patient education, mean you are never left guessing about what is happening or why.</p>
				<p>Our team practices clear communication and consistent follow-up so patients feel supported at every stage — from the first consultation right through the final post-operative check.</p>
			</div>
		</div>
	</section>

	<!-- ================= BEST DOCTOR ================= -->
	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<div class="rkl-info-card">
				<span class="rkl-label">Meet Our Team</span>
				<h2>Best LASIK Eye Surgery Doctor in Indore</h2>
				<p>Choosing the right eye surgeon matters as much as choosing the right technology. Patients researching the best LASIK eye surgery doctor in Indore often look for the experience, transparent communication, and careful patient screening that comes from genuine specialisation.</p>
				<br>
				<p>At RK Eye &amp; Retina Center, Dr. Trushaa Agrawal brings years of focused expertise in refractive surgery and takes time to explain each step so patients can make informed decisions about their vision. She treats every patient as an individual, not a number, and that philosophy shows in the outcomes her patients achieve.</p>
			</div>
		</div>
	</section>

	<!-- ================= HOSPITAL FACILITY ================= -->
	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<div class="rkl-info-card">
				<span class="rkl-label">Our Facility</span>
				<h2>LASIK Eye Surgery Hospital in Indore</h2>
				<p>As a dedicated LASIK eye surgery hospital in Indore, RK Eye &amp; Retina Center maintains a sterile, well-equipped surgical environment supported by trained staff and modern laser systems. From consultation to follow-up, the facility is designed to feel comfortable, efficient, and safe.</p>
				<br>
				<p>Our operation theatres follow strict infection control protocols, and all diagnostic equipment is calibrated regularly to ensure accuracy. Patients frequently mention the clean, organised atmosphere and the warmth of our support staff as reasons they chose to trust us with their eyes.</p>
			</div>
		</div>
	</section>

	<!-- ================= LEAD FORM ================= -->
	<section class="rkl-form-section rkl-fade">
		<div class="rkl-container">
			<div class="rkl-form-head">
				<span class="rkl-label">Book A Consultation</span>
				<h2>Speak to Dr. Trushaa Agrawal About LASIK</h2>
				<p class="rkl-intro" style="margin: 0 auto;">Share a few details and our team will get back to you to schedule your suitability evaluation.</p>
			</div>
			<?php echo do_shortcode( '[rkl_form]' ); ?>
		</div>
	</section>

	<!-- ================= FAQ ================= -->
	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<div style="text-align: center; margin-bottom: 44px;">
				<span class="rkl-label">Common Questions</span>
				<h2>Frequently Asked Questions</h2>
			</div>
			<div class="rkl-faq-container">

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>Is LASIK surgery painful?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Most patients feel minimal discomfort. Numbing drops are applied before the procedure, and any mild irritation usually goes away within a day.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>How long does LASIK surgery take?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>The actual laser treatment takes about 30 seconds per eye. The entire visit, including preparation and post-operative observation, typically takes around two hours.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>Is LASIK safe in Indore?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Yes. When performed by a qualified specialist like Dr. Trushaa Agrawal using modern equipment and proper patient screening, LASIK is considered a very safe procedure.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>What are the side effects of LASIK surgery?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Temporary side effects may include dry eyes, glare, halos around lights, and light sensitivity. These typically resolve within a few weeks as healing progresses.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>What are the LASIK eligibility criteria?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>You should be at least 18 years old, have a stable prescription for one year or more, adequate corneal thickness, and no active eye diseases. A thorough evaluation determines your suitability.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>Can LASIK be done for thin corneas?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Traditional LASIK may not be suitable for very thin corneas. However, alternatives like PRK, TransPRK, or ICL implantation can provide excellent results for such patients.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>What is the difference between LASIK and ICL?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>LASIK reshapes the cornea using a laser, while ICL involves placing a lens inside the eye. ICL is often recommended for high prescriptions or thin corneas where LASIK is not advisable.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>How much does LASIK surgery cost in Indore?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>The cost depends on the type of procedure chosen. Standard LASIK, Femto LASIK, and Contoura LASIK each have different pricing. Contact RK Eye &amp; Retina Center at +91 7024154321 for accurate, transparent pricing.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>Is LASIK a permanent solution for glasses?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>LASIK permanently reshapes the cornea, and most patients do not need glasses again for the treated prescription. However, age-related changes like presbyopia may require reading glasses later.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>How soon can I return to work after LASIK?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Most patients return to desk jobs within one to two days. Physical or outdoor jobs may require a slightly longer recovery period.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>What is Contoura LASIK, and how is it different?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Contoura LASIK uses topography-guided mapping to personalise treatment beyond just your spectacle number. It addresses corneal irregularities, often delivering vision sharper than what glasses provided.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>What is the difference between Femto LASIK and standard LASIK?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Femto LASIK, also called bladeless LASIK, uses a femtosecond laser to create the corneal flap instead of a blade. This offers greater precision and can result in faster healing.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>Who is the best LASIK eye surgery doctor in Indore?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Dr. Trushaa Agrawal (MBBS, MS Ophthalmology) at RK Eye &amp; Retina Center is a highly experienced LASIK specialist known for thorough patient evaluation and excellent surgical outcomes.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>Can both eyes be treated on the same day?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Yes, it is standard practice to treat both eyes during the same session. This reduces overall recovery time and the need for multiple visits.</p></div>
				</div>

				<div class="rkl-faq-item">
					<div class="rkl-faq-question"><span>What precautions should I take after specs removal surgery?</span><i class="fa-solid fa-plus" aria-hidden="true"></i></div>
					<div class="rkl-faq-answer"><p>Avoid rubbing your eyes, skip swimming and eye makeup for at least two weeks, use prescribed eye drops regularly, and attend all follow-up appointments to ensure proper healing.</p></div>
				</div>

			</div>
		</div>
	</section>

	<!-- ================= CTA BAND ================= -->
	<section class="rkl-cta-band rkl-fade">
		<div class="rkl-container">
			<h2>Planning LASIK, Ready to Explore Clearer Vision?</h2>
			<p>Take the next step toward glasses-free living with expert guidance from our specialists at RK Eye &amp; Retina Center, Indore.</p>
			<div class="rkl-cta-buttons">
				<a href="https://rkeyehospital.com/appointment-booking/" class="rkl-btn rkl-btn-red">
					<i class="fa-solid fa-calendar-check" aria-hidden="true"></i> Book Appointment
				</a>
				<a href="https://wa.me/917024154321" class="rkl-btn rkl-btn-blue">
					<i class="fa-brands fa-whatsapp" aria-hidden="true"></i> WhatsApp Appointment
				</a>
				<a href="tel:+917024154321" class="rkl-btn rkl-btn-outline-white">
					<i class="fa-solid fa-phone" aria-hidden="true"></i> Call RK Eye
				</a>
			</div>
			<p class="rkl-cta-note">Treatment suitability depends on clinical evaluation. Results may vary. This content is for awareness and does not replace medical consultation.</p>
		</div>
	</section>

</div>

<?php get_footer(); ?>
