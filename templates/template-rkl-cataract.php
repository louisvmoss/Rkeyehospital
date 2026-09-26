<?php
/**
 * Template Name: RK Eye Cataract Surgery Guide
 * Description: Cataract Surgery in Indore — evaluation, IOL choice and
 *              surgical planning guide for R.K. Eye & Retina Centre.
 *              Renders inside the active theme's normal header/footer.
 *
 * @package RKL
 */

get_header();
$cataract_faqs = rkl_cataract_faqs();
?>

<main class="rkl-landing rkl-cataract-landing" data-page-service="cataract">
	<nav class="rkl-breadcrumb" aria-label="Breadcrumb">
		<div class="rkl-container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> /
			<span class="rkl-crumb-text">Treatments</span> /
			<span aria-current="page">Cataract Surgery in Indore</span>
		</div>
	</nav>

	<section class="rkl-hero rkl-cataract-hero">
		<div class="rkl-container rkl-hero-grid">
			<div>
				<h1>Cataract Surgery in Indore: Evaluation, IOL Choice and Surgical Planning</h1>
				<p>Blurred vision, glare from headlights, faded colours or frequent spectacle changes can be caused by cataract, but cataract is not the only reason vision becomes unclear. At R.K. Eye &amp; Retina Centre, Indore, cataract planning begins with a complete eye evaluation to confirm whether the cloudy natural lens is the main cause of the problem, whether surgery is needed now, and which intraocular lens option may suit the eye and the patient&#8217;s daily visual needs.</p>

				<ul class="rkl-simple-list rkl-hero-list">
					<li>Confirm whether cataract is the main cause of reduced vision.</li>
					<li>Understand whether surgery is required now or can be monitored.</li>
					<li>Discuss IOL options based on eye measurements, cornea, retina and lifestyle.</li>
					<li>Plan surgery and follow-up with clear expectations rather than one-size-fits-all promises.</li>
				</ul>

				<div class="rkl-hero-buttons">
					<a href="#rkl-cataract-form" class="rkl-btn rkl-btn-red" data-rkl-cta data-cta-type="book">Book Cataract &amp; IOL Evaluation</a>
					<a href="https://wa.me/917024154321?text=Hello%20RK%20Eye%2C%20I%20want%20to%20book%20a%20cataract%20and%20IOL%20evaluation%20appointment." target="_blank" rel="noopener" class="rkl-btn rkl-btn-outline" data-rkl-cta data-cta-type="whatsapp">WhatsApp for Appointment</a>
				</div>
				<div class="rkl-warning-box"><strong>Important:</strong> Sudden loss of vision, new flashes or floaters, severe pain or marked redness should not be assumed to be cataract. Seek prompt ophthalmic assessment.</div>
			</div>

			<div class="rkl-hero-photo">
				<img src="<?php echo rkl_get_page_image( 'cataract_hero', RKL_PLUGIN_URL . 'assets/images/cataract-hero.jpg' ); ?>" width="700" height="560" loading="eager" fetchpriority="high" alt="Ophthalmologist consulting a senior couple in an eye hospital consultation room">
				<div class="rkl-hero-badge">Cataract &amp; IOL evaluation in Indore</div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Overview</span>
			<h2>What is a cataract?</h2>
			<div class="rkl-content-grid">
				<div class="rkl-content-text">
					<p>A cataract is clouding of the natural lens inside the eye. The lens normally helps focus light on the retina. As it becomes cloudy, vision may become blurred, hazy or less colourful, and bright lights may become more uncomfortable.</p>
					<p>Age-related change is the most common reason cataracts develop, but cataracts can also be associated with diabetes, previous eye injury, some medicines such as long-term steroids, or other eye conditions. A cataract may affect one eye more than the other.</p>
				</div>
				<div class="rkl-content-image">
					<img src="<?php echo rkl_get_page_image( 'cataract_lens', RKL_PLUGIN_URL . 'assets/images/cataract-lens-illustration.jpg' ); ?>" width="600" height="460" loading="lazy" alt="Illustration comparing a clear eye lens with a cloudy cataract lens">
				</div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Symptoms</span>
			<h2>Symptoms that may suggest cataract</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<ul class="rkl-simple-list">
					<li>Blurred, cloudy or hazy vision that is gradually increasing.</li>
					<li>Glare from sunlight, vehicle headlights or bright indoor lighting.</li>
					<li>Halos around lights or increasing difficulty driving at night.</li>
					<li>Colours appearing duller or less vivid than before.</li>
					<li>Needing brighter light for reading or routine tasks.</li>
					<li>Frequent changes in spectacle prescription without satisfactory clarity.</li>
					<li>Double or ghosted vision in one eye in some cases.</li>
				</ul>
				<div class="rkl-key-box">
					<div class="rkl-key-label">Not every blur is cataract</div>
					<p>Retina disease, corneal disease, glaucoma, dry eye and uncorrected spectacle power can also reduce vision. Examination is important before attributing symptoms to cataract.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Treatment timing</span>
			<h2>When should cataract surgery be considered?</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>Cataract surgery is generally considered when the cataract is interfering with activities that matter to the patient, such as reading, driving, work, household tasks or independent mobility, or when removal of the cataract is needed to allow better examination or treatment of another eye condition.</p>
				<p>A cataract does not always need immediate surgery. If the cataract is mild and daily activities are not significantly affected, the ophthalmologist may recommend monitoring, a change in glasses or practical adjustments while reviewing the eye over time.</p>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Evaluation</span>
			<h2>What happens during a cataract and IOL evaluation?</h2>
			<p class="rkl-intro">The purpose of the pre-surgery evaluation is not only to confirm cataract. It is also to understand the cornea, retina, optic nerve, eye pressure and measurements that influence lens choice and expected vision after surgery.</p>
			<div class="rkl-content-grid">
				<div class="rkl-content-image">
					<img src="<?php echo rkl_get_page_image( 'cataract_evaluation', RKL_PLUGIN_URL . 'assets/images/cataract-evaluation.jpg' ); ?>" width="600" height="460" loading="lazy" alt="Slit-lamp eye examination during a cataract evaluation">
				</div>
				<aside class="rkl-checklist-card">
					<ul>
						<li><span class="rkl-check">1</span><span>Vision and refraction assessment.</span></li>
						<li><span class="rkl-check">2</span><span>Slit-lamp examination to assess the cataract and the front of the eye.</span></li>
						<li><span class="rkl-check">3</span><span>Eye-pressure measurement.</span></li>
						<li><span class="rkl-check">4</span><span>Dilated retinal examination when clinically appropriate.</span></li>
						<li><span class="rkl-check">5</span><span>Biometry and eye measurements used to calculate IOL power.</span></li>
						<li><span class="rkl-check">6</span><span>Corneal measurements when astigmatism or premium-lens planning is relevant.</span></li>
						<li><span class="rkl-check">7</span><span>OCT or other retinal testing when macular or retinal disease is suspected or needs documentation.</span></li>
					</ul>
				</aside>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Lens options</span>
			<h2>Choosing an intraocular lens (IOL)</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>During cataract surgery the cloudy natural lens is removed and replaced with an artificial intraocular lens, or IOL. Lens selection should be based on eye measurements and the patient&#8217;s visual priorities, not on the price or name of a lens alone.</p>
			</div>
			<div class="rkl-card-grid">
				<div class="rkl-card rkl-iol-card">
					<div class="rkl-card-icon" aria-hidden="true">&#9673;</div>
					<h3>Monofocal</h3>
					<p>A monofocal lens usually targets a selected focal distance and glasses may still be required for other distances.</p>
				</div>
				<div class="rkl-card rkl-iol-card">
					<div class="rkl-card-icon" aria-hidden="true">&#9678;</div>
					<h3>Toric</h3>
					<p>Toric lenses may be considered when corneal astigmatism is suitable for correction.</p>
				</div>
				<div class="rkl-card rkl-iol-card">
					<div class="rkl-card-icon" aria-hidden="true">&#10022;</div>
					<h3>Multifocal / EDOF</h3>
					<p>Multifocal or extended-depth-of-focus lens designs may reduce dependence on glasses for selected patients, but they are not appropriate for every eye and may have visual trade-offs such as glare or halos.</p>
				</div>
			</div>
			<div class="rkl-key-box">
				<div class="rkl-key-label">Suitability first</div>
				<p>Corneal condition, retina and macula status, glaucoma, pupil factors, existing astigmatism, previous eye surgery and personal visual expectations can all influence IOL selection.</p>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Surgery</span>
			<h2>How is cataract surgery performed?</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>Modern cataract surgery is commonly performed through a small incision. The cloudy lens is removed and the selected IOL is placed inside the eye. The exact technique, anaesthesia plan and timing are decided after examination and according to the surgeon&#8217;s recommendation.</p>
				<p>If RK Eye offers more than one cataract-surgery platform or technique, the website should describe only options that are currently available and clinically used. Do not imply that a newer or more expensive technology is automatically better for every patient.</p>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Recovery</span>
			<h2>What to expect after cataract surgery</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>Many cataract procedures are managed as day-care surgery, but discharge timing and activity advice depend on the individual patient. Vision can improve early, while the eye continues to heal and stabilise over the following weeks. Prescribed drops, eye protection and scheduled follow-up are important parts of recovery.</p>
				<p>Patients should contact the treating team promptly for unexpected or worsening pain, a marked increase in redness, sudden reduction of vision, new flashes or a sudden increase in floaters. The surgeon will provide patient-specific instructions about driving, work, screen use, bathing, exercise and other activities.</p>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Co-existing conditions</span>
			<h2>Cataract with diabetes, retina disease or glaucoma</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<p>Cataract planning can be more complex when the same eye has diabetic retinopathy, macular disease, glaucoma, corneal disease or a previous retinal procedure. In these situations, the quality of vision after cataract surgery may depend on more than the cataract itself.</p>
				<p>A super-specialty evaluation allows the cataract plan to be coordinated with retina, cornea or glaucoma assessment when needed. This is particularly important before selecting an advanced IOL or when the patient has an existing eye diagnosis.</p>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Why RK Eye</span>
			<h2>Why patients may choose RK Eye for this evaluation</h2>
			<div class="rkl-content-text" style="max-width: 860px;">
				<ul class="rkl-simple-list">
					<li>Evaluation-led cataract planning rather than procedure-first counselling.</li>
					<li>IOL discussion based on eye measurements, visual priorities and co-existing eye conditions.</li>
					<li>Access to retina and cornea assessment when cataract is not the only factor affecting vision.</li>
					<li>Clear pre-operative counselling, consent and post-operative follow-up instructions.</li>
					<li>Doctor-led explanation of likely benefits, limitations, risks and the possible need for glasses after surgery.</li>
				</ul>
				<p class="rkl-disclaimer">Treatment suitability, procedure choice and expected outcome depend on clinical evaluation. Results vary from patient to patient. This page is for awareness and appointment guidance and does not replace medical consultation.</p>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Doctors</span>
			<h2>Cataract care team</h2>
			<div class="rkl-card-grid">
				<div class="rkl-card rkl-doctor-card">
					<div class="rkl-doctor-avatar" aria-hidden="true">RA</div>
					<h3>Dr. Rajendra Agrawal</h3>
					<p>Cataract, Refractive &amp; Retinal Surgeon</p>
					<a class="rkl-doctor-link" href="https://rkeyehospital.com/dr-rajendra-agrawal/" data-rkl-doctor data-doctor-name="Dr. Rajendra Agrawal">View profile &#8594;</a>
				</div>
				<div class="rkl-card rkl-doctor-card">
					<div class="rkl-doctor-avatar" aria-hidden="true">SA</div>
					<h3>Dr. Sumeet Agrawal</h3>
					<p>Chief Vitreoretinal Surgeon and Cataract Surgeon</p>
					<a class="rkl-doctor-link" href="https://rkeyehospital.com/dr-sumeet-agrawal/" data-rkl-doctor data-doctor-name="Dr. Sumeet Agrawal">View profile &#8594;</a>
				</div>
				<div class="rkl-card rkl-doctor-card">
					<div class="rkl-doctor-avatar" aria-hidden="true">TA</div>
					<h3>Dr. Trushaa Agrawal</h3>
					<p>Cornea, Cataract, Refractive Surgery and Ocular Surface</p>
					<a class="rkl-doctor-link" href="https://rkeyehospital.com/dr-trushaa-agrawal/" data-rkl-doctor data-doctor-name="Dr. Trushaa Agrawal">View profile &#8594;</a>
				</div>
			</div>
		</div>
	</section>

	<section class="rkl-form-section rkl-fade" id="rkl-cataract-form">
		<div class="rkl-container">
			<div class="rkl-form-head">
				<span class="rkl-label">Book your visit</span>
				<h2>Book Cataract &amp; IOL Evaluation</h2>
			</div>
			<?php echo do_shortcode( '[rkl_form name="Cataract and IOL Evaluation Request"]' ); ?>
			<p class="rkl-address">RK Eye &amp; Retina Center • Jaora Compound, opposite M.Y. Hospital, Indore<br><a href="https://rkeyehospital.com/appointment-booking/">Book an appointment online</a></p>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<div class="rkl-faq-heading">
				<span class="rkl-label">Patient questions</span>
				<h2>Frequently Asked Questions</h2>
			</div>
			<div class="rkl-faq-container">
				<?php foreach ( $cataract_faqs as $faq ) : ?>
					<details class="rkl-faq-item">
						<summary class="rkl-faq-question"><span><?php echo esc_html( $faq['question'] ); ?></span><span class="rkl-faq-plus" aria-hidden="true">+</span></summary>
						<div class="rkl-faq-answer"><p><?php echo esc_html( $faq['answer'] ); ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Keep exploring</span>
			<h2>Related services</h2>
			<div class="rkl-card-grid rkl-card-grid--4">
				<a class="rkl-card rkl-related-card" href="<?php echo esc_url( home_url( '/retina-services-indore/' ) ); ?>">
					<h3>Retina Services</h3>
					<p>If retina or macular disease may also affect vision.</p>
					<span class="rkl-related-link">Learn more &#8594;</span>
				</a>
				<a class="rkl-card rkl-related-card" href="<?php echo esc_url( home_url( '/diabetic-retinopathy/' ) ); ?>">
					<h3>Diabetic Retinopathy</h3>
					<p>For patients with diabetes or known diabetic retinal disease.</p>
					<span class="rkl-related-link">Learn more &#8594;</span>
				</a>
				<a class="rkl-card rkl-related-card" href="<?php echo esc_url( home_url( '/glaucoma-treatment/' ) ); ?>">
					<h3>Glaucoma Treatment</h3>
					<p>When glaucoma co-exists or affects lens planning.</p>
					<span class="rkl-related-link">Learn more &#8594;</span>
				</a>
				<a class="rkl-card rkl-related-card" href="<?php echo esc_url( home_url( '/dry-eye-syndrome-eye-allergies/' ) ); ?>">
					<h3>Dry Eye &amp; Eye Allergy</h3>
					<p>For ocular-surface symptoms or pre-operative surface optimisation.</p>
					<span class="rkl-related-link">Learn more &#8594;</span>
				</a>
			</div>
		</div>
	</section>

	<section class="rkl-cta-band rkl-fade" aria-label="Final call to action">
		<div class="rkl-container">
			<p class="rkl-cta-lead">If cataract is affecting reading, night driving, work or daily independence, the next step is an eye evaluation &#8211; not automatically surgery. Book a cataract and IOL consultation to understand the cause of your vision change, the timing of treatment and the lens options that may be suitable for your eyes.</p>
			<div class="rkl-cta-buttons">
				<a href="#rkl-cataract-form" class="rkl-btn rkl-btn-red" data-rkl-cta data-cta-type="book">Book Cataract &amp; IOL Evaluation</a>
				<a href="https://wa.me/917024154321?text=Hello%20RK%20Eye%2C%20I%20want%20to%20book%20a%20cataract%20and%20IOL%20evaluation%20appointment." target="_blank" rel="noopener" class="rkl-btn rkl-btn-outline-white" data-rkl-cta data-cta-type="whatsapp">WhatsApp Appointment</a>
				<a href="tel:+917024154321" class="rkl-btn rkl-btn-blue" data-rkl-cta data-cta-type="call">Call RK Eye</a>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
