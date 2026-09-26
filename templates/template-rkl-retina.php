<?php
/**
 * Template Name: RK Eye Retinal Detachment Guide
 * Description: Retinal detachment treatment and emergency guide for Indore.
 *
 * @package RKL
 */

get_header();
$retina_faqs = rkl_retina_faqs();
?>

<main class="rkl-landing rkl-retina-landing">
	<nav class="rkl-breadcrumb" aria-label="Breadcrumb">
		<div class="rkl-container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> /
			<a href="<?php echo esc_url( home_url( '/retina-services-indore/' ) ); ?>">Retina Services</a> /
			<span aria-current="page">Retinal Detachment Treatment in Indore</span>
		</div>
	</nav>

	<section class="rkl-hero rkl-retina-hero">
		<div class="rkl-container rkl-hero-grid">
			<div>
				<span class="rkl-eyebrow">Retina emergency • patient guide</span>
				<h1>Retinal Detachment Treatment in Indore</h1>
				<div class="rkl-sub">Sudden flashes, new floaters or a dark curtain need urgent retinal evaluation</div>
				<p>Retinal detachment is a medical emergency and can be painless. Prompt examination helps a retina specialist identify a retinal tear, a partial detachment or a more extensive detachment—and plan the appropriate treatment.</p>

				<div class="rkl-pill-row">
					<span class="rkl-pill">Retina evaluation</span>
					<span class="rkl-pill">Retinal laser</span>
					<span class="rkl-pill">Vitrectomy care</span>
					<span class="rkl-pill">Urgent guidance</span>
				</div>

				<div class="rkl-hero-buttons">
					<a href="tel:+917024154321" class="rkl-btn rkl-btn-red">Call +91 7024154321</a>
					<a href="tel:+917312705058" class="rkl-btn rkl-btn-outline">Call +91 7312705058</a>
				</div>
				<p class="rkl-emergency-note"><strong>Do not wait for pain.</strong> Visit a retina specialist urgently if these symptoms are new or worsening.</p>
			</div>

			<div class="rkl-hero-photo">
				<img src="<?php echo rkl_get_landing_image( 'retina_hero', 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=700&h=560&fit=crop' ); ?>" width="700" height="560" loading="eager" fetchpriority="high" alt="Retina evaluation at an eye care center in Indore">
				<div class="rkl-hero-badge">Urgent retina evaluation in Indore</div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Emergency warning signs</span>
			<h2>Symptoms That Need Immediate Attention</h2>
			<p class="rkl-intro">Seek urgent eye evaluation if you notice a sudden increase in floaters, repeated flashes of light, a dark curtain or shadow, or a sudden change in side or central vision.</p>
			<div class="rkl-card-grid">
				<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">!</div><h3>New floaters</h3><p>Spots, specks, cobweb-like shapes or moving shadows that appear suddenly or increase quickly.</p></div>
				<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">✦</div><h3>Flashes of light</h3><p>New or repeated flashes, especially in the side of your vision, should be assessed without delay.</p></div>
				<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">◐</div><h3>Curtain or shadow</h3><p>A dark veil, curtain or shadow moving across any part of the visual field is an urgent warning sign.</p></div>
			</div>
			<div class="rkl-key-box">
				<div class="rkl-key-label">Important</div>
				<p>These symptoms can also occur with posterior vitreous detachment or other eye conditions. Symptoms alone cannot reliably distinguish a harmless vitreous change from a retinal tear or detachment; a dilated retinal examination is important.</p>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Understanding the condition</span>
			<h2>What Is Retinal Detachment?</h2>
			<div class="rkl-content-grid">
				<div class="rkl-content-text">
					<p>The retina is the light-sensitive layer of tissue at the back of the eye. Retinal detachment occurs when the retina separates from its normal position. Once detached, the affected retinal tissue cannot function normally, and untreated detachment can result in permanent loss of vision.</p>
					<p>A retinal tear is not the same as a retinal detachment. A tear or hole may allow fluid to pass underneath the retina and can progress to detachment. When a suitable tear is found before significant detachment develops, laser photocoagulation or cryopexy may sometimes seal the tear and reduce the risk of progression.</p>
				</div>
				<div class="rkl-content-image">
					<img src="<?php echo rkl_get_landing_image( 'retina_condition', 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=460&fit=crop' ); ?>" width="600" height="460" loading="lazy" alt="Retina examination and retinal health consultation">
				</div>
			</div>
			<div class="rkl-content-grid rkl-retina-types-grid">
				<div class="rkl-content-text">
					<h3>Types of retinal detachment</h3>
				</div>
				<aside class="rkl-checklist-card">
					<ul>
						<li><span class="rkl-check">1</span><span><strong>Rhegmatogenous:</strong> fluid passes through a retinal tear or break and collects beneath the retina.</span></li>
						<li><span class="rkl-check">2</span><span><strong>Tractional:</strong> scar tissue pulls the retina away, which can occur in advanced diabetic eye disease.</span></li>
						<li><span class="rkl-check">3</span><span><strong>Exudative / serous:</strong> fluid accumulates without a tear, usually because of another eye or systemic condition.</span></li>
					</ul>
				</aside>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Know your risk</span>
			<h2>Who Is at Higher Risk?</h2>
			<div class="rkl-content-grid">
				<div class="rkl-card">
					<ul class="rkl-simple-list">
						<li>High or severe myopia (high minus power)</li>
						<li>Previous retinal tear or retinal detachment in either eye</li>
						<li>Family history of retinal detachment</li>
						<li>Previous eye surgery, including cataract surgery</li>
					</ul>
				</div>
				<div class="rkl-card">
					<ul class="rkl-simple-list">
						<li>Significant eye injury or trauma</li>
						<li>Posterior vitreous detachment or lattice degeneration</li>
						<li>Diabetic retinopathy or other retinal scarring</li>
						<li>Other conditions that can produce retinal traction</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Diagnosis</span>
			<h2>How Retinal Detachment Is Diagnosed</h2>
			<p class="rkl-intro">The key examination is a dilated retinal examination. The retina specialist assesses the location and extent of any retinal tear or detachment and whether the macula is involved.</p>
			<div class="rkl-content-grid">
				<div class="rkl-content-image">
					<img src="<?php echo rkl_get_landing_image( 'retina_diagnosis', 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&h=460&fit=crop' ); ?>" width="600" height="460" loading="lazy" alt="Retinal diagnostic examination and imaging">
				</div>
				<div class="rkl-card-grid rkl-card-grid--stacked">
					<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">◉</div><h3>Dilated fundus examination</h3><p>Inspects the peripheral retina and helps identify retinal breaks.</p></div>
					<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">⌁</div><h3>Ocular ultrasound (B-scan)</h3><p>May be recommended when the retina cannot be seen clearly, such as with vitreous haemorrhage.</p></div>
					<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">⊙</div><h3>OCT imaging</h3><p>Provides detailed assessment of the macula or retinal layers when clinically useful.</p></div>
				</div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Treatment before detachment</span>
			<h2>Retinal Tear Treatment</h2>
			<p class="rkl-intro">Some retinal tears or holes can be treated before a full retinal detachment develops. The correct approach depends on the tear, its location, symptoms and retinal findings.</p>
			<div class="rkl-card-grid">
				<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">✧</div><h3>Laser photocoagulation</h3><p>Laser spots are placed around the retinal break to create a sealing adhesion around the tear.</p></div>
				<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">❄</div><h3>Cryopexy</h3><p>A freezing probe is applied externally over the retinal break to create a sealing scar.</p></div>
				<div class="rkl-card"><div class="rkl-card-icon" aria-hidden="true">?</div><h3>Individual decision</h3><p>Not every retinal hole or tear needs the same treatment. Observation, laser, cryopexy or another approach may be advised after examination.</p></div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-fade">
		<div class="rkl-container">
			<div class="rkl-navy-panel">
				<span class="rkl-label">Retinal detachment surgery in Indore</span>
				<h2>Repair Is Chosen for the Individual Eye</h2>
				<p>Once a clinically significant retinal detachment is present, surgical repair is often required. The objective is to close or support the retinal break, remove traction where necessary and reposition the retina.</p>
				<div class="rkl-table-wrap">
					<table class="rkl-treatment-table">
						<thead><tr><th scope="col">Procedure</th><th scope="col">What it does</th><th scope="col">When it may be considered</th></tr></thead>
						<tbody>
							<tr><th scope="row">Pneumatic retinopexy</th><td>A gas bubble pushes the detached retina toward the eye wall; laser or cryotherapy seals the break.</td><td>Selected detachments where the break pattern and position are suitable.</td></tr>
							<tr><th scope="row">Scleral buckle</th><td>A silicone band or element supports the outer wall of the eye and reduces traction.</td><td>Particular rhegmatogenous detachments, based on break pattern and surgeon assessment.</td></tr>
							<tr><th scope="row">Pars plana vitrectomy</th><td>The vitreous gel is removed through small openings; traction is relieved and gas or silicone oil may support the retina.</td><td>Many detachments, including complex cases, vitreous haemorrhage or proliferative vitreoretinopathy.</td></tr>
							<tr><th scope="row">Combined surgery</th><td>More than one technique is used when it offers better anatomical support.</td><td>Complex or selected cases based on retinal findings.</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

	<section class="rkl-section rkl-section-tint rkl-fade">
		<div class="rkl-container">
			<span class="rkl-label">Vitrectomy and recovery</span>
			<h2>What to Expect After Retinal Detachment Surgery</h2>
			<div class="rkl-content-grid">
				<div class="rkl-content-text">
					<p>During vitrectomy, the surgeon removes most of the vitreous gel to access the retina and relieve traction. Laser or cryotherapy may treat retinal breaks. Air, a gas bubble or silicone oil may be placed inside the eye while it heals.</p>
					<p>Recovery varies with the procedure, severity and duration of detachment, whether the macula was involved and the health of the retina. Vision can remain blurred early on and may improve gradually. Anatomical reattachment does not always mean vision will return to its pre-detachment level.</p>
					<ul class="rkl-simple-list">
						<li>Use prescribed eye drops exactly as advised.</li>
						<li>Attend scheduled post-operative retinal examinations.</li>
						<li>Follow positioning instructions if gas or oil has been used.</li>
						<li>Avoid strenuous activity, driving or travel until specifically cleared.</li>
					</ul>
				</div>
				<div>
					<div class="rkl-content-image">
						<img src="<?php echo rkl_get_landing_image( 'retina_recovery', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=460&fit=crop' ); ?>" width="600" height="460" loading="lazy" alt="Post-operative retina care and follow-up">
					</div>
					<div class="rkl-tip-box">
						<div class="rkl-tip-label">Gas bubble safety</div>
						<p>If a gas bubble is used, you may need a specific head position. Air travel and travel to high altitude can be unsafe while an intraocular gas bubble is present. Always confirm with your retina surgeon before flying, driving, exercise or resuming routine activities.</p>
					</div>
				</div>
			</div>
			<div class="rkl-warning-box"><strong>Seek urgent review</strong> for worsening vision, severe or increasing pain, marked redness, discharge or any new concerning symptom.</div>
		</div>
	</section>

	<section class="rkl-form-section rkl-fade">
		<div class="rkl-container">
			<div class="rkl-form-head">
				<span class="rkl-label">Need urgent retina evaluation?</span>
				<h2>Contact RK Eye &amp; Retina Center, Indore</h2>
				<p class="rkl-intro" style="margin: 0 auto;">Share a few details for appointment coordination. If symptoms are sudden or worsening, call the center directly rather than waiting for an online response.</p>
			</div>
			<?php echo do_shortcode( '[rkl_form name="Retinal Detachment Evaluation Request"]' ); ?>
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
				<?php foreach ( $retina_faqs as $faq ) : ?>
					<details class="rkl-faq-item">
						<summary class="rkl-faq-question"><span><?php echo esc_html( $faq['question'] ); ?></span><span class="rkl-faq-plus" aria-hidden="true">+</span></summary>
						<div class="rkl-faq-answer"><p><?php echo esc_html( $faq['answer'] ); ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="rkl-cta-band rkl-fade">
		<div class="rkl-container">
			<h2>Sudden flashes, floaters or a curtain in vision?</h2>
			<p>Call RK Eye &amp; Retina Center for urgent retina guidance in Indore.</p>
			<div class="rkl-cta-buttons">
				<a href="tel:+917024154321" class="rkl-btn rkl-btn-red">Call +91 7024154321</a>
				<a href="tel:+917312705058" class="rkl-btn rkl-btn-blue">Call +91 7312705058</a>
				<a href="https://rkeyehospital.com/appointment-booking/" class="rkl-btn rkl-btn-outline-white">Book Appointment</a>
			</div>
			<p class="rkl-cta-note">This page is for awareness and appointment guidance. Treatment timing and procedure choice require a retinal examination.</p>
		</div>
	</section>
</main>

<?php get_footer(); ?>