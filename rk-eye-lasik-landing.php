<?php
/**
 * Plugin Name:       RK Eye Landing Page Templates
 * Plugin URI:        https://rkeyehospital.com/
 * Description:       LASIK and retina service landing page templates + reusable
 *                     consultation lead form for RK Eye & Retina Center.
 *                     • Leads save as a WordPress CPT (Admin: RK Forms > RK Leads)
 *                     • Every form has its own name + notification email — change from
 *                       admin, no code editing required
 *                     • Shortcode [rkl_form] — reuse the same form on future pages
 *                     • Renders inside the theme's normal header/footer, auto-hides
 *                       the page title
 *                     Install -> Activate -> Pages > Add New > Template
 *                     "RK Eye LASIK Landing" or "RK Eye Retinal Detachment" -> Publish.
 * Version:           1.3.0
 * Author:             RK Eye & Retina Center
 * License:           GPL-2.0-or-later
 * Text Domain:       rk-eye-lasik
 *
 * @package RKL
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access block.
}

define( 'RKL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'RKL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RKL_VERSION', '1.3.0' );

/* ===========================================================================
 * CONFIG — DEFAULT notification email (fallback).
 * Har form ki apni email admin panel se set hoti hai:
 * Admin > RK Forms > kisi bhi form ko Edit karo > "Notification Email" field.
 * ========================================================================= */
if ( ! defined( 'RKL_NOTIFY_EMAIL' ) ) {
	define( 'RKL_NOTIFY_EMAIL', 'info@rkeyehospital.com' );
}

/* ===========================================================================
 * 1) CUSTOM POST TYPES
 *    - rkl_form : form definition (naam + notification email + shortcode)
 *    - rkl_lead : form se aayi har lead (CPT post)
 * ========================================================================= */
add_action( 'init', 'rkl_register_post_types' );
function rkl_register_post_types() {

	register_post_type(
		'rkl_form',
		array(
			'labels' => array(
				'name'          => __( 'RK Forms', 'rk-eye-lasik' ),
				'singular_name' => __( 'Form', 'rk-eye-lasik' ),
				'menu_name'     => __( 'RK Forms', 'rk-eye-lasik' ),
				'add_new'       => __( 'Add New Form', 'rk-eye-lasik' ),
				'add_new_item'  => __( 'Add New Form', 'rk-eye-lasik' ),
				'edit_item'     => __( 'Edit Form', 'rk-eye-lasik' ),
				'all_items'     => __( 'All Forms', 'rk-eye-lasik' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'show_in_rest'    => false,
			'menu_position'   => 26,
			'menu_icon'       => 'dashicons-visibility',
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
		)
	);

	register_post_type(
		'rkl_lead',
		array(
			'labels' => array(
				'name'          => __( 'RK Leads', 'rk-eye-lasik' ),
				'singular_name' => __( 'Lead', 'rk-eye-lasik' ),
				'menu_name'     => __( 'RK Leads', 'rk-eye-lasik' ),
				'edit_item'     => __( 'View Lead', 'rk-eye-lasik' ),
				'all_items'     => __( 'All Leads', 'rk-eye-lasik' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'show_in_rest'    => false,
			'menu_position'   => 27,
			'menu_icon'       => 'dashicons-email-alt',
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
		)
	);
}

/**
 * Safety net — agar CPT ka apna menu na bane (theme/plugin conflict),
 * toh admin ke liye menu manually add karo.
 */
add_action( 'admin_menu', 'rkl_ensure_admin_menus', 999 );
function rkl_ensure_admin_menus() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( ! rkl_menu_slug_exists( 'edit.php?post_type=rkl_form' ) ) {
		add_menu_page( __( 'RK Forms', 'rk-eye-lasik' ), __( 'RK Forms', 'rk-eye-lasik' ), 'manage_options', 'edit.php?post_type=rkl_form', '', 'dashicons-visibility', 26 );
	}
	if ( ! rkl_menu_slug_exists( 'edit.php?post_type=rkl_lead' ) ) {
		add_menu_page( __( 'RK Leads', 'rk-eye-lasik' ), __( 'RK Leads', 'rk-eye-lasik' ), 'manage_options', 'edit.php?post_type=rkl_lead', '', 'dashicons-email-alt', 27 );
	}
}

function rkl_menu_slug_exists( $slug ) {
	global $menu, $submenu;
	foreach ( (array) $menu as $item ) {
		if ( isset( $item[2] ) && $item[2] === $slug ) {
			return true;
		}
	}
	foreach ( (array) $submenu as $items ) {
		foreach ( (array) $items as $item ) {
			if ( isset( $item[2] ) && $item[2] === $slug ) {
				return true;
			}
		}
	}
	return false;
}

/* ===========================================================================
 * 2) ACTIVATION — default LASIK + retina forms banao
 * ========================================================================= */
register_activation_hook( __FILE__, 'rkl_activate' );
function rkl_activate() {
	rkl_register_post_types();
	rkl_create_default_form();
	rkl_create_retina_form();
	rkl_create_cataract_form();
	flush_rewrite_rules();
}

add_action( 'admin_init', 'rkl_maybe_setup' );
function rkl_maybe_setup() {
	if ( ! get_option( 'rkl_setup_done' ) ) {
		rkl_create_default_form();
		update_option( 'rkl_setup_done', 1 );
	}
	// Also runs after an upgrade so existing installs receive the retina + cataract forms.
	rkl_create_retina_form();
	rkl_create_cataract_form();
}

function rkl_create_default_form() {
	$existing = get_posts(
		array(
			'post_type'   => 'rkl_form',
			'numberposts' => 1,
			'post_status' => 'publish',
		)
	);
	if ( ! empty( $existing ) ) {
		return (int) $existing[0]->ID;
	}
	$form_id = wp_insert_post(
		array(
			'post_type'   => 'rkl_form',
			'post_status' => 'publish',
			'post_title'  => 'LASIK Consultation Request',
		)
	);
	if ( $form_id && ! is_wp_error( $form_id ) ) {
		update_post_meta( $form_id, '_rkl_notify_email', RKL_NOTIFY_EMAIL );
	}
	return $form_id;
}

/**
 * Add the retina form during upgrades too, without changing an existing form.
 */
function rkl_create_retina_form() {
	$existing = get_posts(
		array(
			'post_type'   => 'rkl_form',
			'numberposts' => 1,
			'post_status' => 'publish',
			'title'       => 'Retinal Detachment Evaluation Request',
		)
	);
	if ( ! empty( $existing ) ) {
		return (int) $existing[0]->ID;
	}

	$form_id = wp_insert_post(
		array(
			'post_type'   => 'rkl_form',
			'post_status' => 'publish',
			'post_title'  => 'Retinal Detachment Evaluation Request',
		)
	);
	if ( $form_id && ! is_wp_error( $form_id ) ) {
		update_post_meta( $form_id, '_rkl_notify_email', RKL_NOTIFY_EMAIL );
	}
	return $form_id;
}

/**
 * Add the cataract form during upgrades too, without changing an existing form.
 */
function rkl_create_cataract_form() {
	$existing = get_posts(
		array(
			'post_type'   => 'rkl_form',
			'numberposts' => 1,
			'post_status' => 'publish',
			'title'       => 'Cataract and IOL Evaluation Request',
		)
	);
	if ( ! empty( $existing ) ) {
		return (int) $existing[0]->ID;
	}

	$form_id = wp_insert_post(
		array(
			'post_type'   => 'rkl_form',
			'post_status' => 'publish',
			'post_title'  => 'Cataract and IOL Evaluation Request',
		)
	);
	if ( $form_id && ! is_wp_error( $form_id ) ) {
		update_post_meta( $form_id, '_rkl_notify_email', RKL_NOTIFY_EMAIL );
	}
	return $form_id;
}

function rkl_get_default_form_id() {
	$existing = get_posts(
		array(
			'post_type'   => 'rkl_form',
			'numberposts' => 1,
			'post_status' => 'publish',
			'orderby'     => 'ID',
			'order'       => 'ASC',
		)
	);
	if ( ! empty( $existing ) ) {
		return (int) $existing[0]->ID;
	}
	return rkl_create_default_form();
}

/* ===========================================================================
 * 3) TEMPLATE REGISTRATION + LOAD + PAGE TITLE HIDE
 * ========================================================================= */
add_filter( 'theme_page_templates', 'rkl_register_page_template' );
function rkl_register_page_template( $templates ) {
	$templates['template-rkl-lasik.php'] = __( 'RK Eye LASIK Landing', 'rk-eye-lasik' );
	$templates['template-rkl-retina.php'] = __( 'RK Eye Retinal Detachment Guide', 'rk-eye-lasik' );
	$templates['template-rkl-cataract.php'] = __( 'RK Eye Cataract Surgery Guide', 'rk-eye-lasik' );
	return $templates;
}

add_filter( 'body_class', 'rkl_page_body_class' );
function rkl_page_body_class( $classes ) {
	if ( rkl_is_landing_template() ) {
		$classes[] = 'rkl-title-hidden';
	}
	return $classes;
}

add_filter( 'template_include', 'rkl_load_page_template' );
function rkl_load_page_template( $template ) {
	if ( is_page_template( 'template-rkl-lasik.php' ) ) {
		return RKL_PLUGIN_DIR . 'templates/template-rkl-lasik.php';
	}
	if ( is_page_template( 'template-rkl-retina.php' ) ) {
		return RKL_PLUGIN_DIR . 'templates/template-rkl-retina.php';
	}
	if ( is_page_template( 'template-rkl-cataract.php' ) ) {
		return RKL_PLUGIN_DIR . 'templates/template-rkl-cataract.php';
	}
	return $template;
}

function rkl_is_landing_template() {
	return is_page_template( 'template-rkl-lasik.php' ) || is_page_template( 'template-rkl-retina.php' ) || is_page_template( 'template-rkl-cataract.php' );
}

function rkl_is_retina_template() {
	return is_page_template( 'template-rkl-retina.php' );
}

function rkl_is_cataract_template() {
	return is_page_template( 'template-rkl-cataract.php' );
}

function rkl_landing_image_fields() {
	return array(
		'lasik_hero'      => array( 'LASIK hero image', 'Main image at the top of the LASIK page.' , 'lasik'),
		'lasik_intro'     => array( 'LASIK introduction image', 'Image beside the “What Is LASIK Surgery” section.' , 'lasik'),
		'retina_hero'     => array( 'Retina hero image', 'Main image at the top of the retinal detachment page.' , 'retina'),
		'retina_condition' => array( 'Retina condition image', 'Image beside the “What Is Retinal Detachment?” section.' , 'retina'),
		'retina_diagnosis' => array( 'Retina diagnosis image', 'Image beside the diagnosis and examination section.' , 'retina'),
		'retina_recovery'  => array( 'Retina recovery image', 'Image beside the vitrectomy and recovery section.' , 'retina'),
		'cataract_hero'       => array( 'Cataract hero image', 'Main image at the top of the cataract surgery page.', 'cataract' ),
		'cataract_lens'       => array( 'Cataract lens illustration', 'Image beside the “What is a cataract?” section.', 'cataract' ),
		'cataract_evaluation' => array( 'Cataract evaluation image', 'Image beside the cataract and IOL evaluation section.', 'cataract' ),
	);
}

function rkl_get_landing_image( $key, $fallback = '' ) {
	$images = get_option( 'rkl_landing_images', array() );
	if ( ! empty( $images[ $key ] ) ) {
		return esc_url( $images[ $key ] );
	}
	return esc_url( $fallback );
}

function rkl_landing_image_groups() {
	return array(
		'cataract' => __( 'Cataract page', 'rk-eye-lasik' ),
		'lasik'    => __( 'LASIK page', 'rk-eye-lasik' ),
		'retina'   => __( 'Retina page', 'rk-eye-lasik' ),
	);
}

/**
 * Page-level image with global fallback.
 * Priority: current page meta > global Landing Images option > template default.
 */
function rkl_get_page_image( $key, $fallback = '', $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_queried_object_id();
	}
	if ( $post_id ) {
		$images = get_post_meta( $post_id, '_rkl_page_images', true );
		if ( is_array( $images ) && ! empty( $images[ $key ] ) ) {
			return esc_url( $images[ $key ] );
		}
	}
	return rkl_get_landing_image( $key, $fallback );
}

add_action( 'admin_menu', 'rkl_add_landing_images_menu' );
function rkl_add_landing_images_menu() {
	add_submenu_page(
		'edit.php?post_type=rkl_form',
		__( 'Landing Images', 'rk-eye-lasik' ),
		__( 'Landing Images', 'rk-eye-lasik' ),
		'manage_options',
		'rkl-landing-images',
		'rkl_landing_images_page'
	);
}

add_action( 'admin_enqueue_scripts', 'rkl_enqueue_landing_image_admin' );
function rkl_enqueue_landing_image_admin( $hook ) {
	$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : '';
	if ( 'rkl-landing-images' === $page ) {
		wp_enqueue_media();
		return;
	}
	// Media picker for the per-page images box on the Page edit screen.
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( $screen && 'page' === $screen->post_type ) {
			wp_enqueue_media();
		}
	}
}

function rkl_landing_images_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$fields = rkl_landing_image_fields();
	if ( isset( $_POST['rkl_save_landing_images'] ) ) {
		check_admin_referer( 'rkl_save_landing_images', 'rkl_landing_images_nonce' );
		$submitted = isset( $_POST['rkl_landing_images'] ) ? (array) wp_unslash( $_POST['rkl_landing_images'] ) : array();
		$images = array();
		foreach ( $fields as $key => $field ) {
			$images[ $key ] = isset( $submitted[ $key ] ) ? esc_url_raw( $submitted[ $key ] ) : '';
		}
		update_option( 'rkl_landing_images', $images );
		echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Landing images saved.', 'rk-eye-lasik' ) . '</p></div>';
	}

	$images = get_option( 'rkl_landing_images', array() );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'RK Eye Landing Images', 'rk-eye-lasik' ); ?></h1>
		<p><?php esc_html_e( 'Choose the default images used by the landing page templates. Images are stored as URLs and can be replaced any time from the Media Library. To override these for a single page, use the “RK Landing Page Images” box on that Page’s edit screen.', 'rk-eye-lasik' ); ?></p>
		<form method="post">
			<?php wp_nonce_field( 'rkl_save_landing_images', 'rkl_landing_images_nonce' ); ?>
			<table class="form-table" role="presentation">
				<tbody>
					<?php foreach ( $fields as $key => $field ) : ?>
						<?php $value = isset( $images[ $key ] ) ? $images[ $key ] : ''; ?>
						<tr>
							<th scope="row"><label for="rkl-image-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[0] ); ?></label></th>
							<td>
								<input type="url" class="regular-text rkl-image-url" id="rkl-image-<?php echo esc_attr( $key ); ?>" name="rkl_landing_images[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>" placeholder="https://...">
								<button type="button" class="button rkl-media-upload" data-target="rkl-image-<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Choose image', 'rk-eye-lasik' ); ?></button>
								<button type="button" class="button-link-delete rkl-media-clear" data-target="rkl-image-<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Clear', 'rk-eye-lasik' ); ?></button>
								<p class="description"><?php echo esc_html( $field[1] ); ?></p>
								<?php if ( $value ) : ?>
									<img class="rkl-admin-image-preview" data-preview-for="rkl-image-<?php echo esc_attr( $key ); ?>" src="<?php echo esc_url( $value ); ?>" alt="" style="display:block;max-width:260px;height:auto;margin-top:10px;border:1px solid #dcdcde;padding:3px;">
								<?php else : ?>
									<img class="rkl-admin-image-preview" data-preview-for="rkl-image-<?php echo esc_attr( $key ); ?>" src="" alt="" style="display:none;max-width:260px;height:auto;margin-top:10px;border:1px solid #dcdcde;padding:3px;">
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php submit_button( __( 'Save Landing Images', 'rk-eye-lasik' ), 'primary', 'rkl_save_landing_images' ); ?>
		</form>
	</div>
	<script>
		document.querySelectorAll('.rkl-media-upload').forEach(function (button) {
			button.addEventListener('click', function () {
				var target = document.getElementById(button.getAttribute('data-target'));
				var preview = document.querySelector('[data-preview-for="' + button.getAttribute('data-target') + '"]');
				var frame = wp.media({ title: 'Select landing image', button: { text: 'Use this image' }, multiple: false });
				frame.on('select', function () {
					var attachment = frame.state().get('selection').first().toJSON();
					target.value = attachment.url || '';
					if (preview && target.value) {
						preview.src = target.value;
						preview.style.display = 'block';
					}
				});
				frame.open();
			});
		});
		document.querySelectorAll('.rkl-media-clear').forEach(function (button) {
			button.addEventListener('click', function () {
				var target = document.getElementById(button.getAttribute('data-target'));
				var preview = document.querySelector('[data-preview-for="' + button.getAttribute('data-target') + '"]');
				target.value = '';
				if (preview) {
					preview.src = '';
					preview.style.display = 'none';
				}
			});
		});
	</script>
	<?php
}

/* ===========================================================================
 * 3b) PER-PAGE LANDING IMAGES — Page edit screen meta box.
 *     Overrides the global defaults (RK Forms > Landing Images) for one page.
 * ========================================================================= */
add_action( 'add_meta_boxes', 'rkl_page_images_meta_box' );
function rkl_page_images_meta_box() {
	add_meta_box(
		'rkl_page_images',
		__( 'RK Landing Page Images', 'rk-eye-lasik' ),
		'rkl_page_images_box',
		'page',
		'normal',
		'default'
	);
}

function rkl_page_images_box( $post ) {
	wp_nonce_field( 'rkl_save_page_images', 'rkl_page_images_nonce' );
	$fields = rkl_landing_image_fields();
	$groups = rkl_landing_image_groups();
	$images = get_post_meta( $post->ID, '_rkl_page_images', true );
	if ( ! is_array( $images ) ) {
		$images = array();
	}
	?>
	<p class="description"><?php esc_html_e( 'Set the images for this page only. Leave a field empty to use the global default (RK Forms > Landing Images) or the template fallback image.', 'rk-eye-lasik' ); ?></p>
	<?php foreach ( $groups as $group_key => $group_label ) : ?>
		<h3 style="margin:18px 0 6px;"><?php echo esc_html( $group_label ); ?></h3>
		<table class="form-table" role="presentation">
			<tbody>
				<?php foreach ( $fields as $key => $field ) : ?>
					<?php if ( ( isset( $field[2] ) ? $field[2] : '' ) !== $group_key ) { continue; } ?>
					<?php $value = isset( $images[ $key ] ) ? $images[ $key ] : ''; ?>
					<tr>
						<th scope="row"><label for="rkl-page-image-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[0] ); ?></label></th>
						<td>
							<input type="url" class="regular-text rkl-image-url" id="rkl-page-image-<?php echo esc_attr( $key ); ?>" name="rkl_page_images[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>" placeholder="https://...">
							<button type="button" class="button rkl-media-upload" data-target="rkl-page-image-<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Choose image', 'rk-eye-lasik' ); ?></button>
							<button type="button" class="button-link-delete rkl-media-clear" data-target="rkl-page-image-<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Clear', 'rk-eye-lasik' ); ?></button>
							<p class="description"><?php echo esc_html( $field[1] ); ?></p>
							<img class="rkl-admin-image-preview" data-preview-for="rkl-page-image-<?php echo esc_attr( $key ); ?>" src="<?php echo esc_url( $value ); ?>" alt="" style="<?php echo $value ? 'display:block;' : 'display:none;'; ?>max-width:260px;height:auto;margin-top:10px;border:1px solid #dcdcde;padding:3px;">
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endforeach; ?>
	<script>
		document.querySelectorAll('#rkl_page_images .rkl-media-upload').forEach(function (button) {
			button.addEventListener('click', function () {
				var target = document.getElementById(button.getAttribute('data-target'));
				var preview = document.querySelector('[data-preview-for="' + button.getAttribute('data-target') + '"]');
				var frame = wp.media({ title: 'Select landing image', button: { text: 'Use this image' }, multiple: false });
				frame.on('select', function () {
					var attachment = frame.state().get('selection').first().toJSON();
					target.value = attachment.url || '';
					if (preview && target.value) {
						preview.src = target.value;
						preview.style.display = 'block';
					}
				});
				frame.open();
			});
		});
		document.querySelectorAll('#rkl_page_images .rkl-media-clear').forEach(function (button) {
			button.addEventListener('click', function () {
				var target = document.getElementById(button.getAttribute('data-target'));
				var preview = document.querySelector('[data-preview-for="' + button.getAttribute('data-target') + '"]');
				target.value = '';
				if (preview) {
					preview.src = '';
					preview.style.display = 'none';
				}
			});
		});
	</script>
	<?php
}

add_action( 'save_post_page', 'rkl_save_page_images', 10, 2 );
function rkl_save_page_images( $post_id, $post ) {
	if ( ! isset( $_POST['rkl_page_images_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['rkl_page_images_nonce'] ), 'rkl_save_page_images' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	$fields    = rkl_landing_image_fields();
	$submitted = isset( $_POST['rkl_page_images'] ) ? (array) wp_unslash( $_POST['rkl_page_images'] ) : array();
	$images    = array();
	foreach ( $fields as $key => $field ) {
		$images[ $key ] = isset( $submitted[ $key ] ) ? esc_url_raw( $submitted[ $key ] ) : '';
	}
	update_post_meta( $post_id, '_rkl_page_images', $images );
}

function rkl_retina_faqs() {
	return array(
		array(
			'question' => 'Is retinal detachment a medical emergency?',
			'answer'   => 'Yes. New flashes, a sudden shower of floaters, a curtain or shadow in vision, or sudden vision loss require urgent retinal evaluation. Early treatment can help protect vision.',
		),
		array(
			'question' => 'Can a retinal tear be treated without major surgery?',
			'answer'   => 'In suitable cases, a retinal tear or small hole may be treated with laser photocoagulation or cryopexy before it progresses to a retinal detachment. The decision depends on the retinal findings.',
		),
		array(
			'question' => 'Which surgery is best for retinal detachment?',
			'answer'   => 'There is no single operation that is best for every retinal detachment. Pneumatic retinopexy, scleral buckle, vitrectomy or a combination may be recommended depending on the detachment pattern and the individual eye.',
		),
		array(
			'question' => 'Will vision return completely after surgery?',
			'answer'   => 'Visual recovery varies. It depends on factors such as how long the retina was detached, whether the macula was involved, the underlying retinal condition and whether complications are present. Surgery aims first to reattach and stabilize the retina; the final visual outcome cannot be guaranteed.',
		),
		array(
			'question' => 'Can retinal detachment happen again after treatment?',
			'answer'   => 'Yes. Re-detachment can occur, and some eyes require additional treatment or surgery. Follow-up examinations are therefore important.',
		),
		array(
			'question' => 'Can I fly after vitrectomy or retinal detachment surgery?',
			'answer'   => 'If a gas bubble has been placed inside the eye, flying or travelling to high altitude may be dangerous until the gas has fully absorbed. Follow the retina surgeon’s specific instructions before air travel.',
		),
		array(
			'question' => 'Does retinal detachment always cause pain?',
			'answer'   => 'No. Retinal detachment is commonly painless. Sudden visual symptoms—not pain—are the key warning signs.',
		),
		array(
			'question' => 'Should the other eye also be checked?',
			'answer'   => 'Yes. A complete retinal examination of both eyes is often relevant because some risk factors can affect both eyes. Your retina specialist will advise whether preventive treatment or closer follow-up is needed in the fellow eye.',
		),
	);
}

/**
 * Keep page-level SEO useful even when an SEO plugin is not installed.
 * Yoast/Rank Math remain the source of truth when present.
 */
add_filter( 'document_title_parts', 'rkl_document_title_parts', 20 );
function rkl_document_title_parts( $parts ) {
	if ( rkl_is_retina_template() ) {
		$parts['title'] = 'Retinal Detachment Treatment in Indore | RK Eye & Retina Center';
	}
	if ( rkl_is_cataract_template() ) {
		$parts['title'] = 'Cataract Surgery in Indore | Cataract & IOL Evaluation | RK Eye';
	}
	return $parts;
}

add_action( 'wp_head', 'rkl_retina_seo_head', 1 );
function rkl_retina_seo_head() {
	if ( ! rkl_is_retina_template() || defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}

	$description = 'Sudden flashes, floaters or a curtain in vision may signal retinal detachment. Learn diagnosis, retinal laser and surgery options at RK Eye & Retina Center, Indore.';
	$canonical  = get_permalink();
	$faqs       = function_exists( 'rkl_retina_faqs' ) ? rkl_retina_faqs() : array();
	$faq_schema = array();
	foreach ( $faqs as $faq ) {
		$faq_schema[] = array(
			'@type'          => 'Question',
			'name'           => $faq['question'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq['answer'] ),
			),
		);
	}

	$schema = array(
		'@context'    => 'https://schema.org',
		'@graph'      => array(
			array(
				'@type'         => 'MedicalWebPage',
				'@id'            => trailingslashit( $canonical ) . '#webpage',
				'url'           => $canonical,
				'name'          => 'Retinal Detachment Treatment in Indore',
				'description'   => $description,
				'about'         => array( '@type' => 'MedicalCondition', 'name' => 'Retinal detachment' ),
				'isPartOf'      => array( '@type' => 'WebSite', 'name' => 'RK Eye & Retina Center' ),
				'medicalAudience' => array( '@type' => 'MedicalAudience', 'audienceType' => 'Patient' ),
			),
			array(
				'@type'       => 'MedicalClinic',
				'name'        => 'RK Eye & Retina Center',
				'url'         => home_url( '/' ),
				'telephone'   => '+91-7024154321',
				'address'     => array(
					'@type'           => 'PostalAddress',
					'streetAddress'   => 'Jaora Compound, opposite M.Y. Hospital',
					'addressLocality' => 'Indore',
					'addressCountry' => 'IN',
				),
			),
			array(
				'@type'       => 'BreadcrumbList',
				'itemListElement' => array(
					array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
					array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Treatments', 'item' => home_url( '/retina-services-indore/' ) ),
					array( '@type' => 'ListItem', 'position' => 3, 'name' => 'Retinal Detachment Treatment in Indore', 'item' => $canonical ),
				),
			),
			array(
				'@type'       => 'FAQPage',
				'mainEntity'  => $faq_schema,
			),
		),
	);
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">
	<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
	<?php
}

function rkl_cataract_faqs() {
	return array(
		array(
			'question' => 'Does every cataract need surgery immediately?',
			'answer'   => 'No. Surgery is usually considered when cataract is affecting useful vision or daily activities, or when removal is needed for another clinical reason. Mild cataract can often be monitored after examination.',
		),
		array(
			'question' => 'Can cataract be treated with eye drops or medicines?',
			'answer'   => 'There is currently no eye drop or medicine that removes an established cataract. Glasses or brighter lighting may help in early stages, but surgery is the treatment that removes the cloudy lens when treatment is required.',
		),
		array(
			'question' => 'Which IOL lens is best for cataract surgery?',
			'answer'   => 'There is no single best IOL for every patient. The choice depends on eye measurements, corneal astigmatism, retina and optic-nerve health, lifestyle, reading and driving needs, and the patient’s tolerance for possible visual trade-offs.',
		),
		array(
			'question' => 'Will I be completely free from glasses after cataract surgery?',
			'answer'   => 'Not necessarily. Some IOL strategies can reduce dependence on glasses, but no lens should be presented as a guarantee of complete spectacle freedom. Residual power, healing and other eye conditions can affect the final result.',
		),
		array(
			'question' => 'How long does cataract surgery recovery take?',
			'answer'   => 'Many people notice useful improvement early, but healing and visual stabilisation continue over several weeks. Activity restrictions and follow-up schedules should be based on the surgeon’s advice for the individual eye.',
		),
		array(
			'question' => 'Is cataract surgery possible if I have diabetes or retina disease?',
			'answer'   => 'Often yes, but the retina and overall eye condition should be assessed because they can influence timing, treatment sequence, IOL choice and expected vision. A combined cataract-retina plan may be appropriate in some cases.',
		),
		array(
			'question' => 'When should I seek urgent help after cataract surgery?',
			'answer'   => 'Seek prompt ophthalmic advice for sudden vision loss, severe or worsening pain, marked redness, new flashes, a sudden increase in floaters or any unexpected symptom that concerns you.',
		),
	);
}

function rkl_cataract_doctors() {
	return array(
		array(
			'name'      => 'Dr. Rajendra Agrawal',
			'job_title' => 'Cataract, Refractive & Retinal Surgeon',
			'url'       => 'https://rkeyehospital.com/dr-rajendra-agrawal/',
		),
		array(
			'name'      => 'Dr. Sumeet Agrawal',
			'job_title' => 'Chief Vitreoretinal Surgeon and Cataract Surgeon',
			'url'       => 'https://rkeyehospital.com/dr-sumeet-agrawal/',
		),
		array(
			'name'      => 'Dr. Trushaa Agrawal',
			'job_title' => 'Cornea, Cataract, Refractive Surgery and Ocular Surface',
			'url'       => 'https://rkeyehospital.com/dr-trushaa-agrawal/',
		),
	);
}

add_action( 'wp_head', 'rkl_cataract_seo_head', 1 );
function rkl_cataract_seo_head() {
	if ( ! rkl_is_cataract_template() || defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
		return;
	}

	$description = 'Understand cataract symptoms, when surgery may be needed, IOL options, tests and recovery. Book a cataract and lens evaluation at RK Eye & Retina Centre, Indore.';
	$canonical   = get_permalink();
	$og_image    = rkl_get_page_image( 'cataract_hero', RKL_PLUGIN_URL . 'assets/images/cataract-hero.jpg' );

	$faq_schema = array();
	foreach ( rkl_cataract_faqs() as $faq ) {
		$faq_schema[] = array(
			'@type'          => 'Question',
			'name'           => $faq['question'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq['answer'] ),
			),
		);
	}

	$physicians = array();
	foreach ( rkl_cataract_doctors() as $doctor ) {
		$physicians[] = array(
			'@type'            => 'Physician',
			'name'             => $doctor['name'],
			'url'              => $doctor['url'],
			'jobTitle'         => $doctor['job_title'],
			'medicalSpecialty' => 'Ophthalmology',
		);
	}

	$schema = array(
		'@context' => 'https://schema.org',
		'@graph'   => array(
			array(
				'@type'           => 'MedicalWebPage',
				'@id'             => trailingslashit( $canonical ) . '#webpage',
				'url'             => $canonical,
				'name'            => 'Cataract Surgery in Indore: Evaluation, IOL Choice and Surgical Planning',
				'description'     => $description,
				'about'           => array(
					array( '@type' => 'MedicalCondition', 'name' => 'Cataract' ),
					array( '@type' => 'MedicalProcedure', 'name' => 'Cataract surgery' ),
				),
				'isPartOf'        => array( '@type' => 'WebSite', 'name' => 'RK Eye & Retina Center' ),
				'medicalAudience' => array( '@type' => 'MedicalAudience', 'audienceType' => 'Patient' ),
			),
			array(
				'@type'       => 'Service',
				'name'        => 'Cataract Evaluation and Surgery',
				'serviceType' => 'Cataract Surgery',
				'provider'    => array(
					'@type'     => 'MedicalClinic',
					'name'      => 'RK Eye & Retina Center',
					'url'       => home_url( '/' ),
					'telephone' => '+91-7024154321',
					'address'   => array(
						'@type'           => 'PostalAddress',
						'streetAddress'   => 'Jaora Compound, opposite M.Y. Hospital',
						'addressLocality' => 'Indore',
						'addressCountry'  => 'IN',
					),
				),
				'areaServed'  => array( '@type' => 'City', 'name' => 'Indore' ),
			),
			array(
				'@type'           => 'BreadcrumbList',
				'itemListElement' => array(
					array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
					array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Cataract Surgery in Indore', 'item' => $canonical ),
				),
			),
			array(
				'@type'      => 'FAQPage',
				'mainEntity' => $faq_schema,
			),
		),
	);
	foreach ( $physicians as $physician ) {
		$schema['@graph'][] = $physician;
	}
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( 'Cataract Surgery in Indore | Cataract & IOL Evaluation | RK Eye' ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $og_image ); ?>">
	<script type="application/ld+json"><?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
	<?php
}

/* ===========================================================================
 * 4) ASSETS — sirf template page par, ya jis page par [rkl_form] shortcode ho
 * ========================================================================= */
add_action( 'wp_enqueue_scripts', 'rkl_enqueue_assets', 999 );
function rkl_enqueue_assets() {
	if ( ! rkl_should_load_assets() ) {
		return;
	}

	wp_enqueue_style(
		'rkl-style',
		RKL_PLUGIN_URL . 'assets/css/rkl-style.css',
		array(),
		RKL_VERSION
	);

	wp_enqueue_script(
		'rkl-script',
		RKL_PLUGIN_URL . 'assets/js/rkl-script.js',
		array(),
		RKL_VERSION,
		true
	);

	wp_localize_script(
		'rkl-script',
		'rklAjax',
		array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'rkl_lead_nonce' ),
		)
	);
}

function rkl_should_load_assets() {
	if ( rkl_is_landing_template() ) {
		return true;
	}
	if ( is_singular() ) {
		$post = get_post();
		if ( $post && has_shortcode( $post->post_content, 'rkl_form' ) ) {
			return true;
		}
	}
	return false;
}

/* ===========================================================================
 * 5) REUSABLE FORM SHORTCODE — [rkl_form] / [rkl_form id="12"] / [rkl_form name="..."]
 * ========================================================================= */
add_shortcode( 'rkl_form', 'rkl_shortcode_render' );
function rkl_shortcode_render( $atts ) {
	$atts = shortcode_atts(
		array(
			'id'   => 0,
			'name' => '',
		),
		$atts,
		'rkl_form'
	);

	$form_id = 0;
	if ( ! empty( $atts['id'] ) ) {
		$form_id = absint( $atts['id'] );
	} elseif ( ! empty( $atts['name'] ) ) {
		$forms = get_posts(
			array(
				'post_type'   => 'rkl_form',
				'post_status' => 'publish',
				'numberposts' => 1,
				'title'       => $atts['name'],
			)
		);
		if ( ! empty( $forms ) ) {
			$form_id = (int) $forms[0]->ID;
		}
	}

	if ( ! $form_id ) {
		$form_id = rkl_get_default_form_id();
	}

	return rkl_render_form( $form_id );
}

/**
 * Form + success modal ka HTML (har instance unique ids ke saath).
 */
function rkl_render_form( $form_id = 0 ) {
	static $instance = 0;
	$instance++;
	$prefix = 'rklf' . $instance;

	if ( ! $form_id ) {
		$form_id = rkl_get_default_form_id();
	}
	$form_title = get_the_title( $form_id );
	$is_retina  = false !== stripos( $form_title, 'retinal' ) || false !== stripos( $form_title, 'retina' );
	$is_cataract = false !== stripos( $form_title, 'cataract' );
	$service      = $is_cataract ? 'cataract' : ( $is_retina ? 'retina' : 'lasik' );
	$procedure_label = $is_retina ? 'Concern / Service Needed' : 'Procedure of Interest';
	$message_label   = $is_retina ? 'Tell Us About Your Symptoms (Optional)' : 'Tell Us About Your Vision Concern (Optional)';
	$message_placeholder = $is_retina
		? 'e.g. new floaters, flashes, curtain/shadow, when symptoms started, preferred appointment time...'
		: 'e.g. current spectacle number, prior eye conditions, preferred appointment time...';

	ob_start();
	?>
	<div class="rkl-form-wrap" data-form-id="<?php echo (int) $form_id; ?>" data-service="<?php echo esc_attr( $service ); ?>">

		<form id="<?php echo esc_attr( $prefix ); ?>_form" class="rkl-form" method="post" action="#" novalidate="novalidate"<?php echo $is_cataract ? ' enctype="multipart/form-data"' : ''; ?>>

			<!-- Honeypot (spam protection — insaan ko nahi dikhta) -->
			<div style="position:absolute;left:-9999px;top:-9999px;opacity:0;height:0;overflow:hidden;" aria-hidden="true">
				<label for="<?php echo esc_attr( $prefix ); ?>_website">Website</label>
				<input type="text" id="<?php echo esc_attr( $prefix ); ?>_website" name="rk_company_website" tabindex="-1" autocomplete="off">
			</div>

			<input type="hidden" name="rk_form_id" value="<?php echo (int) $form_id; ?>">
			<input type="hidden" name="rk_form_name" value="<?php echo esc_attr( $form_title ); ?>">

			<?php if ( $is_cataract ) : ?>

			<div class="rkl-form-grid">
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_full_name">Patient Name <span class="rkl-req">*</span></label>
					<input type="text" id="<?php echo esc_attr( $prefix ); ?>_full_name" name="rk_full_name" required placeholder="Patient's full name" class="rkl-input" autocomplete="name">
				</div>
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_phone">Mobile Number <span class="rkl-req">*</span></label>
					<input type="tel" id="<?php echo esc_attr( $prefix ); ?>_phone" name="rk_phone" required placeholder="+91 98765 43210" class="rkl-input" autocomplete="tel">
				</div>
			</div>

			<div class="rkl-form-grid">
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_email">Email Address (Optional)</label>
					<input type="email" id="<?php echo esc_attr( $prefix ); ?>_email" name="rk_email" placeholder="you@example.com" class="rkl-input" autocomplete="email">
				</div>
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_age">Age</label>
					<input type="number" id="<?php echo esc_attr( $prefix ); ?>_age" name="rk_age" min="1" max="120" placeholder="e.g. 62" class="rkl-input">
				</div>
			</div>

			<div class="rkl-form-grid">
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_city">City</label>
					<input type="text" id="<?php echo esc_attr( $prefix ); ?>_city" name="rk_city" placeholder="e.g. Indore" class="rkl-input" autocomplete="address-level2">
				</div>
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_concern">Main Concern <span class="rkl-req">*</span></label>
					<select id="<?php echo esc_attr( $prefix ); ?>_concern" name="rk_concern" required class="rkl-select">
						<option value="">Select an option...</option>
						<option value="blurred_vision">Blurred vision</option>
						<option value="glare">Glare</option>
						<option value="diagnosed_cataract">Diagnosed cataract</option>
						<option value="lens_discussion">Lens discussion</option>
						<option value="second_opinion">Second opinion</option>
						<option value="urgent_symptoms">Urgent symptom — sudden vision loss, pain, flashes or floaters</option>
					</select>
				</div>
			</div>

			<div class="rkl-form-grid">
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_eye">Which Eye <span class="rkl-req">*</span></label>
					<select id="<?php echo esc_attr( $prefix ); ?>_eye" name="rk_eye" required class="rkl-select">
						<option value="">Select an option...</option>
						<option value="right">Right eye</option>
						<option value="left">Left eye</option>
						<option value="both">Both eyes</option>
						<option value="unsure">Unsure</option>
					</select>
				</div>
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_report">Upload Prescription or Report (Optional)</label>
					<input type="file" id="<?php echo esc_attr( $prefix ); ?>_report" name="rk_report" accept=".pdf,.jpg,.jpeg,.png" class="rkl-input rkl-file-input">
					<p class="rkl-file-hint">Prescription, cataract report or prior surgery summary (PDF/JPG/PNG, max 5 MB).</p>
				</div>
			</div>

			<div class="rkl-urgent-notice" id="<?php echo esc_attr( $prefix ); ?>_urgent_notice" hidden>
				<strong>Urgent symptom selected:</strong> sudden vision loss, severe pain, new flashes/floaters or marked redness need prompt ophthalmic assessment. Please call <a href="tel:+917024154321">+91 7024154321</a> now — submitting this form does not constitute emergency care.
			</div>

			<?php else : ?>

			<div class="rkl-form-grid">
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_full_name">Full Name <span class="rkl-req">*</span></label>
					<input type="text" id="<?php echo esc_attr( $prefix ); ?>_full_name" name="rk_full_name" required placeholder="Your full name" class="rkl-input" autocomplete="name">
				</div>
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_phone">Phone / WhatsApp <span class="rkl-req">*</span></label>
					<input type="tel" id="<?php echo esc_attr( $prefix ); ?>_phone" name="rk_phone" required placeholder="+91 98765 43210" class="rkl-input" autocomplete="tel">
				</div>
			</div>

			<div class="rkl-form-grid">
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_email">Email Address <span class="rkl-req">*</span></label>
					<input type="email" id="<?php echo esc_attr( $prefix ); ?>_email" name="rk_email" required placeholder="you@example.com" class="rkl-input" autocomplete="email">
				</div>
				<div>
					<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_procedure"><?php echo esc_html( $procedure_label ); ?> <span class="rkl-req">*</span></label>
					<select id="<?php echo esc_attr( $prefix ); ?>_procedure" name="rk_procedure" required class="rkl-select">
						<option value="">Select an option...</option>
						<?php if ( $is_retina ) : ?>
							<option value="urgent_retina_evaluation">Urgent retina evaluation</option>
							<option value="retinal_tear_laser">Retinal tear laser / cryopexy</option>
							<option value="retinal_detachment_surgery">Retinal detachment surgery</option>
							<option value="vitrectomy">Vitrectomy consultation</option>
							<option value="retina_follow_up">Retina follow-up</option>
							<option value="not_sure">Not sure — need guidance</option>
						<?php else : ?>
							<option value="not_sure">Not sure — need guidance</option>
							<option value="standard_lasik">Standard LASIK</option>
							<option value="femto_lasik">Bladeless Femto LASIK</option>
							<option value="contoura_lasik">Contoura Vision LASIK</option>
							<option value="smile">SMILE LASIK</option>
							<option value="silk">SILK LASIK</option>
							<option value="prk">PRK / TransPRK</option>
						<?php endif; ?>
					</select>
				</div>
			</div>

			<div>
				<label class="rkl-label-f" for="<?php echo esc_attr( $prefix ); ?>_message"><?php echo esc_html( $message_label ); ?></label>
				<textarea id="<?php echo esc_attr( $prefix ); ?>_message" name="rk_message" rows="3" placeholder="<?php echo esc_attr( $message_placeholder ); ?>" class="rkl-textarea"></textarea>
			</div>

			<?php endif; ?>

			<div class="rkl-privacy-note">
				<i class="fa-solid fa-lock" aria-hidden="true"></i>
				<strong>Privacy Note:</strong> Please share only the details needed to schedule your consultation. Detailed medical history will be reviewed in person by the clinical team.
			</div>

			<div class="rkl-consent">
				<input type="checkbox" id="<?php echo esc_attr( $prefix ); ?>_consent" name="rk_consent" required value="1">
				<label for="<?php echo esc_attr( $prefix ); ?>_consent">
					<?php if ( $is_cataract ) : ?>
						I consent to RK Eye &amp; Retina Center contacting me by phone, WhatsApp or email regarding this appointment request.
						<?php $privacy_url = get_privacy_policy_url(); ?>
						<?php if ( $privacy_url ) : ?>
							Read our <a href="<?php echo esc_url( $privacy_url ); ?>" target="_blank" rel="noopener">privacy policy</a>.
						<?php endif; ?>
					<?php else : ?>
						I consent to RK Eye &amp; Retina Center contacting me by phone, WhatsApp or email regarding this consultation request.
					<?php endif; ?>
				</label>
			</div>

			<button type="submit" class="rkl-submit">
				<span>Request My Consultation</span>
				<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
			</button>

		</form>

		<!-- Success modal (is form instance ka) -->
		<div class="rkl-modal" hidden>
			<div class="rkl-modal-box" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr( $prefix ); ?>_modal_title">
				<div class="rkl-modal-icon">
					<i class="fa-solid fa-circle-check" aria-hidden="true"></i>
				</div>
				<h3 id="<?php echo esc_attr( $prefix ); ?>_modal_title" class="rkl-modal-title">Request Received</h3>
				<p class="rkl-modal-text">
					Thank you! Our team at RK Eye &amp; Retina Center will contact you shortly to schedule your consultation.
				</p>
				<button type="button" class="rkl-modal-close" data-close-modal>Close Window</button>
			</div>
		</div>

	</div>
	<?php
	return ob_get_clean();
}

/* ===========================================================================
 * 6) FORM HANDLER (AJAX) — lead CPT mein save + email notify + autoresponder
 * ========================================================================= */
add_action( 'wp_ajax_rkl_submit_lead', 'rkl_handle_lead_submit' );
add_action( 'wp_ajax_nopriv_rkl_submit_lead', 'rkl_handle_lead_submit' );

function rkl_handle_lead_submit() {
	// 1) Nonce (CSRF)
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['nonce'] ), 'rkl_lead_nonce' ) ) {
		wp_send_json_error( array( 'message' => 'Security check failed. Please refresh the page and try again.' ) );
	}

	// 2) Honeypot — spam bots ise bhar dete hain
	if ( ! empty( $_POST['rk_company_website'] ) ) {
		wp_send_json_success( array( 'message' => 'Received.' ) );
	}

	// 3) Form identify karo
	$form_id = isset( $_POST['rk_form_id'] ) ? absint( $_POST['rk_form_id'] ) : 0;
	if ( ! $form_id || 'rkl_form' !== get_post_type( $form_id ) ) {
		$form_id = rkl_get_default_form_id();
	}
	$form_title  = get_the_title( $form_id );
	$is_cataract = false !== stripos( $form_title, 'cataract' );

	// 4) Fields sanitize
	$full_name = isset( $_POST['rk_full_name'] ) ? sanitize_text_field( wp_unslash( $_POST['rk_full_name'] ) ) : '';
	$phone     = isset( $_POST['rk_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['rk_phone'] ) ) : '';
	$email     = isset( $_POST['rk_email'] ) ? sanitize_email( wp_unslash( $_POST['rk_email'] ) ) : '';
	$procedure = isset( $_POST['rk_procedure'] ) ? sanitize_text_field( wp_unslash( $_POST['rk_procedure'] ) ) : '';
	$message   = isset( $_POST['rk_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['rk_message'] ) ) : '';
	$age       = isset( $_POST['rk_age'] ) ? absint( $_POST['rk_age'] ) : 0;
	$city      = isset( $_POST['rk_city'] ) ? sanitize_text_field( wp_unslash( $_POST['rk_city'] ) ) : '';
	$concern   = isset( $_POST['rk_concern'] ) ? sanitize_key( wp_unslash( $_POST['rk_concern'] ) ) : '';
	$eye       = isset( $_POST['rk_eye'] ) ? sanitize_key( wp_unslash( $_POST['rk_eye'] ) ) : '';
	$consent   = ! empty( $_POST['rk_consent'] ) ? 1 : 0;

	// 5) Validation
	if ( $is_cataract ) {
		if ( empty( $full_name ) || empty( $phone ) || empty( $concern ) || empty( $eye ) || ! $consent ) {
			wp_send_json_error( array( 'message' => 'Please fill all required (*) fields.' ) );
		}
		if ( '' !== $email && ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
		}
		if ( 0 !== $age && ( $age < 1 || $age > 120 ) ) {
			wp_send_json_error( array( 'message' => 'Please enter a valid age.' ) );
		}
	} else {
		if ( empty( $full_name ) || empty( $phone ) || empty( $email ) || empty( $procedure ) || ! $consent ) {
			wp_send_json_error( array( 'message' => 'Please fill all required (*) fields.' ) );
		}
		if ( ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
		}
	}

	// 6) LEAD CPT mein save
	$lead_id = wp_insert_post(
		array(
			'post_type'   => 'rkl_lead',
			'post_status' => 'private',
			'post_title'  => $full_name . ' — ' . $phone,
		)
	);

	if ( ! $lead_id || is_wp_error( $lead_id ) ) {
		wp_send_json_error( array( 'message' => 'Could not save your request. Please try again.' ) );
	}

	update_post_meta( $lead_id, '_rkl_form_id', $form_id );
	update_post_meta( $lead_id, '_rkl_full_name', $full_name );
	update_post_meta( $lead_id, '_rkl_phone', $phone );
	update_post_meta( $lead_id, '_rkl_email', $email );
	update_post_meta( $lead_id, '_rkl_procedure', $procedure );
	update_post_meta( $lead_id, '_rkl_message', $message );
	update_post_meta( $lead_id, '_rkl_consent', $consent );
	update_post_meta( $lead_id, '_rkl_ip', isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );

	$report_url = '';
	$tags       = array();
	if ( $is_cataract ) {
		update_post_meta( $lead_id, '_rkl_age', $age );
		update_post_meta( $lead_id, '_rkl_city', $city );
		update_post_meta( $lead_id, '_rkl_concern', $concern );
		update_post_meta( $lead_id, '_rkl_eye', $eye );

		$tags = array( 'SERVICE_CATARACT' );
		if ( 'diagnosed_cataract' === $concern ) {
			$tags[] = 'DIAGNOSED_CATARACT';
		}
		if ( 'lens_discussion' === $concern ) {
			$tags[] = 'IOL_COUNSELLING';
		}
		if ( 'second_opinion' === $concern ) {
			$tags[] = 'CATARACT_SECOND_OPINION';
		}
		if ( '' !== $city ) {
			$city_code = strtoupper( preg_replace( '/[^A-Za-z0-9]+/', '', $city ) );
			if ( '' !== $city_code ) {
				$tags[] = 'CITY_' . $city_code;
			}
		}
		update_post_meta( $lead_id, '_rkl_tags', $tags );

		$report_result = rkl_handle_report_upload( $lead_id );
		if ( is_wp_error( $report_result ) ) {
			update_post_meta( $lead_id, '_rkl_report_error', $report_result->get_error_message() );
		} elseif ( is_array( $report_result ) ) {
			$report_url = $report_result['url'];
			update_post_meta( $lead_id, '_rkl_report_url', $report_result['url'] );
			update_post_meta( $lead_id, '_rkl_report_id', $report_result['id'] );
		}
	}

	// 7) Notification email — is form ki email par
	$notify_email = rkl_get_form_notify_email( $form_id );
	rkl_send_notification_email(
		$lead_id,
		$form_title,
		$notify_email,
		array(
			'full_name'  => $full_name,
			'phone'      => $phone,
			'email'      => $email,
			'procedure'  => $procedure,
			'message'    => $message,
			'age'        => $age,
			'city'       => $city,
			'concern'    => $concern,
			'eye'        => $eye,
			'report_url' => $report_url,
			'tags'       => $tags,
			'consent'    => $consent,
		)
	);

	// 8) Autoresponder — lead ko thank-you email (sirf jab email diya gaya ho)
	if ( is_email( $email ) ) {
		rkl_send_autoresponder( $full_name, $email, $form_title );
	}

	wp_send_json_success( array( 'message' => 'Received.' ) );
}

/**
 * Optional medical-report upload for the cataract form.
 * Returns false (no file), array( url, id ) or WP_Error (lead is still saved).
 */
function rkl_handle_report_upload( $lead_id ) {
	if ( empty( $_FILES['rk_report'] ) || ! is_array( $_FILES['rk_report'] ) ) {
		return false;
	}
	$file = $_FILES['rk_report'];
	if ( UPLOAD_ERR_NO_FILE === $file['error'] ) {
		return false;
	}
	if ( UPLOAD_ERR_OK !== $file['error'] ) {
		return new WP_Error( 'rkl_upload_error', 'Report upload failed. The request was still saved.' );
	}
	if ( $file['size'] > 5 * 1024 * 1024 ) {
		return new WP_Error( 'rkl_upload_size', 'Report must be smaller than 5 MB. The request was still saved.' );
	}
	$check = wp_check_filetype_and_ext(
		$file['tmp_name'],
		$file['name'],
		array(
			'pdf'  => 'application/pdf',
			'jpg'  => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'png'  => 'image/png',
		)
	);
	if ( empty( $check['type'] ) ) {
		return new WP_Error( 'rkl_upload_type', 'Report must be a PDF, JPG or PNG file. The request was still saved.' );
	}
	if ( ! function_exists( 'wp_handle_upload' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}
	$move = wp_handle_upload( $file, array( 'test_form' => false ) );
	if ( isset( $move['error'] ) ) {
		return new WP_Error( 'rkl_upload_failed', 'Report upload failed. The request was still saved.' );
	}
	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => $move['type'],
			'post_title'     => sanitize_file_name( $file['name'] ),
			'post_status'    => 'inherit',
			'post_parent'    => $lead_id,
		),
		$move['file'],
		$lead_id
	);
	if ( $attachment_id && ! is_wp_error( $attachment_id ) && 0 === strpos( $move['type'], 'image/' ) ) {
		require_once ABSPATH . 'wp-admin/includes/image.php';
		wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $move['file'] ) );
	}
	return array( 'url' => $move['url'], 'id' => $attachment_id );
}

function rkl_get_form_notify_email( $form_id ) {
	$email = get_post_meta( $form_id, '_rkl_notify_email', true );
	if ( ! is_email( $email ) ) {
		$email = apply_filters( 'rkl_notify_email', RKL_NOTIFY_EMAIL );
	}
	return $email;
}

function rkl_send_notification_email( $lead_id, $form_title, $to, $lead ) {
	$procedure_labels = array(
		'not_sure'                   => 'Not sure — needs guidance',
		'standard_lasik'             => 'Standard LASIK',
		'femto_lasik'                => 'Bladeless Femto LASIK',
		'contoura_lasik'             => 'Contoura Vision LASIK',
		'smile'                      => 'SMILE LASIK',
		'silk'                       => 'SILK LASIK',
		'prk'                        => 'PRK / TransPRK',
		'urgent_retina_evaluation'   => 'Urgent retina evaluation',
		'retinal_tear_laser'         => 'Retinal tear laser / cryopexy',
		'retinal_detachment_surgery' => 'Retinal detachment surgery',
		'vitrectomy'                 => 'Vitrectomy consultation',
		'retina_follow_up'           => 'Retina follow-up',
		'blurred_vision'             => 'Blurred vision',
		'glare'                      => 'Glare',
		'diagnosed_cataract'         => 'Diagnosed cataract',
		'lens_discussion'            => 'Lens discussion',
		'second_opinion'             => 'Second opinion',
		'urgent_symptoms'            => 'Urgent symptom (needs prompt assessment)',
		'right'                      => 'Right eye',
		'left'                       => 'Left eye',
		'both'                       => 'Both eyes',
		'unsure'                     => 'Unsure',
	);
	$procedure = isset( $procedure_labels[ $lead['procedure'] ] ) ? $procedure_labels[ $lead['procedure'] ] : $lead['procedure'];

	$subject = sprintf( '[RK Eye] New Lead #%d: %s (%s)', $lead_id, $lead['full_name'], $form_title );

	$message  = '<h2 style="margin:0 0 12px;">New Consultation Lead — ' . esc_html( $form_title ) . '</h2>';
	$message .= '<table cellpadding="8" cellspacing="0" style="border-collapse:collapse;width:100%;max-width:560px;font-family:Arial,sans-serif;font-size:13px;">';
	$message .= rkl_mail_row( 'Lead ID', '#' . $lead_id );
	$message .= rkl_mail_row( 'Date', wp_date( 'd M Y, h:i A' ) );
	$message .= rkl_mail_row( 'Form', $form_title );
	$message .= rkl_mail_row( 'Full Name', $lead['full_name'] );
	$message .= rkl_mail_row( 'Phone / WhatsApp', $lead['phone'] );
	$message .= rkl_mail_row( 'Email', ! empty( $lead['email'] ) ? $lead['email'] : '—' );
	if ( false !== stripos( $form_title, 'cataract' ) ) {
		$message .= rkl_mail_row( 'Age', ! empty( $lead['age'] ) ? $lead['age'] : '—' );
		$message .= rkl_mail_row( 'City', ! empty( $lead['city'] ) ? $lead['city'] : '—' );
		$message .= rkl_mail_row( 'Main Concern', isset( $procedure_labels[ $lead['concern'] ] ) ? $procedure_labels[ $lead['concern'] ] : $lead['concern'] );
		$message .= rkl_mail_row( 'Which Eye', isset( $procedure_labels[ $lead['eye'] ] ) ? $procedure_labels[ $lead['eye'] ] : $lead['eye'] );
		$message .= rkl_mail_row( 'Report', ! empty( $lead['report_url'] ) ? '<a href="' . esc_url( $lead['report_url'] ) . '">View uploaded report</a>' : '—' );
		$message .= rkl_mail_row( 'Lead Tags', ! empty( $lead['tags'] ) ? implode( ', ', (array) $lead['tags'] ) : '—' );
	} else {
		$message .= rkl_mail_row( 'Procedure of Interest', $procedure );
		$message .= rkl_mail_row( 'Message', $lead['message'] ? nl2br( esc_html( $lead['message'] ) ) : '—' );
	}
	$message .= rkl_mail_row( 'Consent', $lead['consent'] ? 'Yes' : 'No' );
	$message .= '</table>';
	$message .= '<p style="font-size:12px;color:#666;">Lead is also saved in admin: WordPress Admin &gt; RK Forms &gt; RK Leads</p>';

	$headers = array( 'Content-Type: text/html; charset=UTF-8' );

	return wp_mail( $to, $subject, $message, $headers );
}

function rkl_send_autoresponder( $full_name, $email, $form_title = '' ) {
	$to      = $email;
	$is_retina   = false !== stripos( $form_title, 'retina' );
	$is_cataract = false !== stripos( $form_title, 'cataract' );
	$service     = $is_cataract ? 'cataract and lens evaluation' : ( $is_retina ? 'retina evaluation' : 'LASIK consultation' );
	$subject = 'Thank you — your ' . $service . ' request has been received';

	$message  = '<p>Dear ' . esc_html( $full_name ) . ',</p>';
	$message .= '<p>Thank you for reaching out to RK Eye &amp; Retina Center about ' . esc_html( $service ) . ' in Indore.</p>';
	$message .= '<p>Our team will contact you shortly to schedule your appointment and explain the next steps.</p>';
	$message .= '<p style="font-size:12px;color:#666;">RK Eye &amp; Retina Center, Jaora Compound, Indore | +91 7024154321<br>This message is for appointment scheduling only and does not constitute medical advice.</p>';

	$headers = array( 'Content-Type: text/html; charset=UTF-8' );

	return wp_mail( $to, $subject, $message, $headers );
}

function rkl_mail_row( $label, $value ) {
	return '<tr><td style="border:1px solid #ddd;background:#fdeef1;font-weight:bold;width:170px;">' . esc_html( $label ) . '</td>'
		. '<td style="border:1px solid #ddd;">' . wp_kses_post( $value ) . '</td></tr>';
}

/* ===========================================================================
 * 7) ADMIN META BOXES — Form settings, shortcode, related leads
 * ========================================================================= */
add_action( 'add_meta_boxes', 'rkl_form_meta_boxes' );
function rkl_form_meta_boxes() {
	add_meta_box( 'rkl_form_settings', __( 'Form Settings', 'rk-eye-lasik' ), 'rkl_form_settings_box', 'rkl_form', 'normal', 'high' );
	add_meta_box( 'rkl_form_shortcode', __( 'Shortcode', 'rk-eye-lasik' ), 'rkl_form_shortcode_box', 'rkl_form', 'side', 'default' );
	add_meta_box( 'rkl_form_leads', __( 'Leads From This Form', 'rk-eye-lasik' ), 'rkl_form_leads_box', 'rkl_form', 'normal', 'default' );
}

function rkl_form_settings_box( $post ) {
	wp_nonce_field( 'rkl_save_form_settings', 'rkl_form_settings_nonce' );
	$email = get_post_meta( $post->ID, '_rkl_notify_email', true );
	?>
	<p>
		<label for="rkl_notify_email"><strong><?php esc_html_e( 'Notification Email', 'rk-eye-lasik' ); ?></strong></label><br>
		<input type="email" style="width:100%;max-width:420px;" id="rkl_notify_email" name="rkl_notify_email" value="<?php echo esc_attr( $email ); ?>" placeholder="<?php echo esc_attr( RKL_NOTIFY_EMAIL ); ?>">
	</p>
	<p class="description"><?php esc_html_e( 'New leads submitted through this form will be emailed here. Leave blank to use the default address.', 'rk-eye-lasik' ); ?></p>
	<?php
}

function rkl_form_shortcode_box( $post ) {
	?>
	<p><?php esc_html_e( 'Paste this shortcode on any page to show this form:', 'rk-eye-lasik' ); ?></p>
	<input type="text" readonly onclick="this.select();" style="width:100%;" value="[rkl_form id=&quot;<?php echo (int) $post->ID; ?>&quot;]">
	<?php
}

function rkl_form_leads_box( $post ) {
	$leads = get_posts(
		array(
			'post_type'   => 'rkl_lead',
			'numberposts' => 10,
			'meta_key'    => '_rkl_form_id',
			'meta_value'  => $post->ID,
			'orderby'     => 'date',
			'order'       => 'DESC',
		)
	);
	if ( empty( $leads ) ) {
		echo '<p>' . esc_html__( 'No leads yet.', 'rk-eye-lasik' ) . '</p>';
		return;
	}
	echo '<table class="widefat"><thead><tr><th>Name</th><th>Phone</th><th>Email</th><th>Date</th></tr></thead><tbody>';
	foreach ( $leads as $lead ) {
		printf(
			'<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',
			esc_html( get_post_meta( $lead->ID, '_rkl_full_name', true ) ),
			esc_html( get_post_meta( $lead->ID, '_rkl_phone', true ) ),
			esc_html( get_post_meta( $lead->ID, '_rkl_email', true ) ),
			esc_html( get_the_date( 'd M Y, h:i A', $lead ) )
		);
	}
	echo '</tbody></table>';
}

add_action( 'save_post_rkl_form', 'rkl_save_form_settings', 10, 2 );
function rkl_save_form_settings( $post_id, $post ) {
	if ( ! isset( $_POST['rkl_form_settings_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['rkl_form_settings_nonce'] ), 'rkl_save_form_settings' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['rkl_notify_email'] ) ) {
		update_post_meta( $post_id, '_rkl_notify_email', sanitize_email( wp_unslash( $_POST['rkl_notify_email'] ) ) );
	}
}

/* ===========================================================================
 * 8) LEAD ADMIN LIST — columns, filter, CSV export
 * ========================================================================= */
add_filter( 'manage_rkl_lead_posts_columns', 'rkl_lead_columns' );
function rkl_lead_columns( $columns ) {
	$new = array();
	$new['cb']        = $columns['cb'];
	$new['rkl_name']  = __( 'Full Name', 'rk-eye-lasik' );
	$new['rkl_phone'] = __( 'Phone', 'rk-eye-lasik' );
	$new['rkl_email'] = __( 'Email', 'rk-eye-lasik' );
	$new['rkl_proc']  = __( 'Procedure', 'rk-eye-lasik' );
	$new['rkl_form']  = __( 'Form', 'rk-eye-lasik' );
	$new['date']      = $columns['date'];
	return $new;
}

add_action( 'manage_rkl_lead_posts_custom_column', 'rkl_lead_column_content', 10, 2 );
function rkl_lead_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'rkl_name':
			echo esc_html( get_post_meta( $post_id, '_rkl_full_name', true ) );
			break;
		case 'rkl_phone':
			echo esc_html( get_post_meta( $post_id, '_rkl_phone', true ) );
			break;
		case 'rkl_email':
			echo esc_html( get_post_meta( $post_id, '_rkl_email', true ) );
			break;
		case 'rkl_proc':
			$procedure = get_post_meta( $post_id, '_rkl_procedure', true );
			if ( '' === $procedure ) {
				$procedure = get_post_meta( $post_id, '_rkl_concern', true );
			}
			echo esc_html( $procedure );
			break;
		case 'rkl_form':
			$form_id = (int) get_post_meta( $post_id, '_rkl_form_id', true );
			echo $form_id ? esc_html( get_the_title( $form_id ) ) : '—';
			break;
	}
}

add_filter( 'views_edit-rkl_lead', 'rkl_lead_export_link' );
function rkl_lead_export_link( $views ) {
	$url             = wp_nonce_url( admin_url( 'edit.php?post_type=rkl_lead&rkl_export=csv' ), 'rkl_export_csv' );
	$views['export'] = '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Export CSV', 'rk-eye-lasik' ) . '</a>';
	return $views;
}

add_action( 'admin_init', 'rkl_handle_csv_export' );
function rkl_handle_csv_export() {
	if ( empty( $_GET['rkl_export'] ) || 'csv' !== $_GET['rkl_export'] ) {
		return;
	}
	if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'rkl_export_csv' ) ) {
		return;
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$leads = get_posts(
		array(
			'post_type'      => 'rkl_lead',
			'post_status'    => 'private',
			'numberposts'    => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=rk-eye-lasik-leads-' . gmdate( 'Y-m-d' ) . '.csv' );

	$out = fopen( 'php://output', 'w' );
	fputcsv( $out, array( 'Lead ID', 'Date', 'Form', 'Full Name', 'Phone', 'Email', 'Procedure', 'Message', 'Consent', 'IP', 'Age', 'City', 'Main Concern', 'Which Eye', 'Report', 'Tags' ) );

	foreach ( $leads as $lead ) {
		$form_id = (int) get_post_meta( $lead->ID, '_rkl_form_id', true );
		$tags    = get_post_meta( $lead->ID, '_rkl_tags', true );
		fputcsv(
			$out,
			array(
				$lead->ID,
				get_the_date( 'd M Y, h:i A', $lead ),
				$form_id ? get_the_title( $form_id ) : '',
				get_post_meta( $lead->ID, '_rkl_full_name', true ),
				get_post_meta( $lead->ID, '_rkl_phone', true ),
				get_post_meta( $lead->ID, '_rkl_email', true ),
				get_post_meta( $lead->ID, '_rkl_procedure', true ),
				get_post_meta( $lead->ID, '_rkl_message', true ),
				get_post_meta( $lead->ID, '_rkl_consent', true ) ? 'Yes' : 'No',
				get_post_meta( $lead->ID, '_rkl_ip', true ),
				get_post_meta( $lead->ID, '_rkl_age', true ),
				get_post_meta( $lead->ID, '_rkl_city', true ),
				get_post_meta( $lead->ID, '_rkl_concern', true ),
				get_post_meta( $lead->ID, '_rkl_eye', true ),
				get_post_meta( $lead->ID, '_rkl_report_url', true ),
				is_array( $tags ) ? implode( ', ', $tags ) : '',
			)
		);
	}
	fclose( $out );
	exit;
}

/* ===========================================================================
 * 9) LEAD DETAIL VIEW (single lead edit screen)
 * ========================================================================= */
add_action( 'add_meta_boxes', 'rkl_lead_details_meta_box' );
function rkl_lead_details_meta_box() {
	add_meta_box( 'rkl_lead_details', __( 'Lead Details', 'rk-eye-lasik' ), 'rkl_lead_details_box', 'rkl_lead', 'normal', 'high' );
}

function rkl_lead_details_box( $post ) {
	$fields = array(
		'Full Name'    => '_rkl_full_name',
		'Phone'        => '_rkl_phone',
		'Email'        => '_rkl_email',
		'Age'          => '_rkl_age',
		'City'         => '_rkl_city',
		'Procedure'    => '_rkl_procedure',
		'Main Concern' => '_rkl_concern',
		'Which Eye'    => '_rkl_eye',
		'Lead Tags'    => '_rkl_tags',
		'Message'      => '_rkl_message',
		'Consent'      => '_rkl_consent',
		'IP Address'   => '_rkl_ip',
	);

	echo '<table class="widefat">';
	foreach ( $fields as $label => $key ) {
		$value = get_post_meta( $post->ID, $key, true );
		if ( '_rkl_consent' === $key ) {
			$value = $value ? 'Yes' : 'No';
		}
		if ( '_rkl_tags' === $key && is_array( $value ) ) {
			$value = implode( ', ', $value );
		}
		if ( '' === $value ) {
			$value = '—';
		}
		printf( '<tr><td style="width:180px;"><strong>%s</strong></td><td>%s</td></tr>', esc_html( $label ), esc_html( $value ) );
	}
	$report_url = get_post_meta( $post->ID, '_rkl_report_url', true );
	if ( $report_url ) {
		printf( '<tr><td style="width:180px;"><strong>%s</strong></td><td><a href="%s" target="_blank" rel="noopener">%s</a></td></tr>', esc_html__( 'Report', 'rk-eye-lasik' ), esc_url( $report_url ), esc_html__( 'View uploaded report', 'rk-eye-lasik' ) );
	}
	echo '</table>';
}
