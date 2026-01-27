<?php
if (!defined('ABSPATH')) exit;

require_once get_template_directory() . '/inc/class-vvt-navwalker.php';


function vvt_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);

  register_nav_menus([
    'primary' => __('Primary Menu', 'velovita-test'),

	'footer_product'   => __('Footer - Product', 'velovita-test'),
	'footer_company'   => __('Footer - Company', 'velovita-test'),
	'footer_resources' => __('Footer - Resources', 'velovita-test'),
  ]);
}
add_action('after_setup_theme', 'vvt_setup');


  

 function vvt_assets() {
	$ver = wp_get_theme()->get('Version');

	// AOS (Animate On Scroll)
	wp_enqueue_style(
		'aos',
		get_template_directory_uri() . '/assets/vendor/aos/aos.css',
		[],
		'2.3.4'
	);
	
	wp_enqueue_script(
		'aos',
		get_template_directory_uri() . '/assets/vendor/aos/aos.js',
		[],
		'2.3.4',
		true
	);
  
  
	// Bootstrap local
	wp_enqueue_style(
	  'bootstrap',
	  get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css',
	  [],
	  '5.3.0'
	);
  
	// Swiper (slider)
	wp_enqueue_style(
	  'swiper',
	  get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css',
	  [],
	  '11.0.0'
	);

	// Google Fonts (Montserrat + Nunito)
	wp_enqueue_style(
		'vvt-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Nunito:wght@400;500;600;700;800&display=swap',
		[],
		null
	);
  
	// Tu CSS encima (branding)
	wp_enqueue_style(
	  'vvt-main',
	  get_template_directory_uri() . '/assets/css/main.css',
	  ['bootstrap', 'swiper', 'vvt-fonts', 'aos'],
	  $ver
	);
  
	// Bootstrap bundle
	wp_enqueue_script(
	  'bootstrap',
	  get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
	  [],
	  '5.3.0',
	  true
	);
  
	// Swiper JS
	wp_enqueue_script(
	  'swiper',
	  get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js',
	  [],
	  '11.0.0',
	  true
	);
  
	// JS 
	wp_enqueue_script(
	  'vvt-main',
	  get_template_directory_uri() . '/assets/js/main.js',
	  ['bootstrap', 'swiper'],
	  $ver,
	  true
	);
  }
  add_action('wp_enqueue_scripts', 'vvt_assets');
  

// CPT: Team Members + Taxonomy: Department
function vvt_register_team_cpt() {

	// Taxonomy 
	register_taxonomy('team_department', ['team_member'], [
	  'labels' => [
		'name' => 'Departments',
		'singular_name' => 'Department',
	  ],
	  'public' => true,
	  'show_admin_column' => true,
	  'hierarchical' => true,
	  'rewrite' => ['slug' => 'department'],
	]);
  
	// CPT (requisito)
	register_post_type('team_member', [
	  'labels' => [
		'name' => 'Team Members',
		'singular_name' => 'Team Member',
		'add_new_item' => 'Add New Team Member',
		'edit_item' => 'Edit Team Member',
	  ],
	  'public' => true,
	  'menu_icon' => 'dashicons-groups',
	  'supports' => ['title', 'editor', 'thumbnail'],
	  'has_archive' => true,
	  'rewrite' => ['slug' => 'team'],
	  'show_in_rest' => true,
	]);
  }
  add_action('init', 'vvt_register_team_cpt');
  
  // Metaboxes
function vvt_team_metaboxes() {
	add_meta_box(
	  'vvt_team_details',
	  'Team Details',
	  'vvt_team_details_metabox_cb',
	  'team_member',
	  'normal',
	  'high'
	);
  }
  add_action('add_meta_boxes', 'vvt_team_metaboxes');
  
  function vvt_team_details_metabox_cb($post) {
	wp_nonce_field('vvt_save_team_details', 'vvt_team_nonce');
  
	$role = get_post_meta($post->ID, 'vvt_role', true);
	$linkedin = get_post_meta($post->ID, 'vvt_linkedin', true);
  
	?>
	<p>
	  <label><strong>Role/Title</strong></label><br>
	  <input type="text" name="vvt_role" value="<?php echo esc_attr($role); ?>" style="width:100%;" placeholder="e.g. Product Manager">
	</p>
	<p>
	  <label><strong>LinkedIn URL</strong></label><br>
	  <input type="url" name="vvt_linkedin" value="<?php echo esc_url($linkedin); ?>" style="width:100%;" placeholder="https://linkedin.com/in/...">
	</p>
	<?php
  }
  
  function vvt_save_team_details($post_id) {
	if (!isset($_POST['vvt_team_nonce']) || !wp_verify_nonce($_POST['vvt_team_nonce'], 'vvt_save_team_details')) return;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if (!current_user_can('edit_post', $post_id)) return;
  
	if (isset($_POST['vvt_role'])) {
	  update_post_meta($post_id, 'vvt_role', sanitize_text_field($_POST['vvt_role']));
	}
	if (isset($_POST['vvt_linkedin'])) {
	  update_post_meta($post_id, 'vvt_linkedin', esc_url_raw($_POST['vvt_linkedin']));
	}
  }
  add_action('save_post_team_member', 'vvt_save_team_details');
  
  // CPT privado: Inquiries 
function vvt_register_inquiry_cpt() {
	register_post_type('inquiry', [
	  'labels' => [
		'name' => 'Inquiries',
		'singular_name' => 'Inquiry',
	  ],
	  'public' => false,
	  'show_ui' => true,
	  'show_in_menu' => true,
	  'menu_icon' => 'dashicons-email',
	  'supports' => ['title'],
	  'capability_type' => 'post',
	  'map_meta_cap' => true,
	]);
  }
  add_action('init', 'vvt_register_inquiry_cpt');
  

  function vvt_handle_inquiry_form() {
	if (!isset($_POST['vvt_inquiry_nonce']) || !wp_verify_nonce($_POST['vvt_inquiry_nonce'], 'vvt_inquiry')) {
	  wp_die('Invalid request.');
	}
  
	// Honeypot anti-spam
	if (!empty($_POST['company'])) {
	  wp_safe_redirect(home_url('/?sent=1'));
	  exit;
	}
  
	$name  = sanitize_text_field($_POST['name'] ?? '');
	$email = sanitize_email($_POST['email'] ?? '');
	$msg   = sanitize_textarea_field($_POST['message'] ?? '');
  
	if ($name === '' || $msg === '' || !is_email($email)) {
	  wp_safe_redirect(home_url('/?sent=0'));
	  exit;
	}
  
	$post_id = wp_insert_post([
	  'post_type'   => 'inquiry',
	  'post_status' => 'publish',
	  'post_title'  => $name . ' — ' . current_time('Y-m-d H:i'),
	]);
  
	if ($post_id && !is_wp_error($post_id)) {
	  update_post_meta($post_id, 'vvt_name', $name);
	  update_post_meta($post_id, 'vvt_email', $email);
	  update_post_meta($post_id, 'vvt_message', $msg);
	}
  
	// Email admin 
	$admin_email = get_option('admin_email');
	$subject = 'New inquiry from ' . $name;
	$body = "Name: {$name}\nEmail: {$email}\n\nMessage:\n{$msg}\n";
	wp_mail($admin_email, $subject, $body);
  
	// Confirmación al usuario 
	$user_subject = 'We received your inquiry';
	$user_body = "Hi {$name},\n\nThanks for reaching out. We received your message and will respond soon.\n\n— Velovita Team";
	wp_mail($email, $user_subject, $user_body);
  
	wp_safe_redirect(home_url('/?sent=1'));
	exit;
  }
  add_action('admin_post_nopriv_vvt_inquiry', 'vvt_handle_inquiry_form');
  add_action('admin_post_vvt_inquiry', 'vvt_handle_inquiry_form');

  // Mostrar detalles del Inquiry en admin (metabox)
function vvt_inquiry_metaboxes() {
	add_meta_box(
	  'vvt_inquiry_details',
	  'Inquiry Details',
	  'vvt_inquiry_details_metabox_cb',
	  'inquiry',
	  'normal',
	  'high'
	);
  }
  add_action('add_meta_boxes', 'vvt_inquiry_metaboxes');
  
  function vvt_inquiry_details_metabox_cb($post) {
	$name  = get_post_meta($post->ID, 'vvt_name', true);
	$email = get_post_meta($post->ID, 'vvt_email', true);
	$msg   = get_post_meta($post->ID, 'vvt_message', true);
  
	echo '<p><strong>Name:</strong> ' . esc_html($name) . '</p>';
	echo '<p><strong>Email:</strong> <a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></p>';
	echo '<p><strong>Message:</strong></p>';
	echo '<pre style="white-space:pre-wrap;background:#f6f7f7;padding:12px;border-radius:8px;">' . esc_html($msg) . '</pre>';
  }
  