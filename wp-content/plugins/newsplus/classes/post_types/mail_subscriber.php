<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_PT_MailSubscriber extends TmMS_PT {

	public function __construct() {
		$this->set_parent_slug('mail_subscriber');
		//AJAX
		add_action('wp_ajax_ms_save_mail_html', array(&$this, 'save_mail_html'));
		//***
		$args = array(
			'labels' => array(
				'name' => __('NewsPlus', 'newsplus'),
				'singular_name' => __('Mail', 'newsplus'),
				'add_new' => __('Add New Mail', 'newsplus'),
				'add_new_item' => __('Add New Mail', 'newsplus'),
				'edit_item' => __('Edit Mail', 'newsplus'),
				'new_item' => __('New Mail', 'newsplus'),
				'view_item' => __('View Mail', 'newsplus'),
				'search_items' => __('Search Mails', 'newsplus'),
				'not_found' => __('No Mails found', 'newsplus'),
				'not_found_in_trash' => __('No Mails found in Trash', 'newsplus'),
				'parent_item_colon' => ''
			),
			'public' => true,
			'archive' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'excerpt'),
			'rewrite' => array('slug' => $this->slug),
			'show_in_admin_bar' => false,
			'taxonomies' => array('mail_subscriber_types'),
			'menu_icon' => ''
		);

		//*** taxonomies ****
		register_taxonomy("mail_subscriber_types", array($this->slug), array(
			"hierarchical" => true,
			"labels" => array(
				'name' => __('Mail Groups', 'newsplus'),
				'singular_name' => __('Mail Groups', 'newsplus'),
				'add_new' => __('Add New Mail Group', 'newsplus'),
				'add_new_item' => __('Add New Mail Group', 'newsplus'),
				'edit_item' => __('Edit Mail Group', 'newsplus'),
				'new_item' => __('New Mail Group', 'newsplus'),
				'view_item' => __('View Mail Group', 'newsplus'),
				'search_items' => __('Search Mail Groups', 'newsplus'),
				'not_found' => __('No Mail Groups found', 'newsplus'),
				'not_found_in_trash' => __('No Mail Groups found in Trash', 'newsplus'),
				'parent_item_colon' => ''
			),
			"singular_label" => __('mail_subscriber_type', 'newsplus'),
			"rewrite" => true,
			'show_in_nav_menus' => false,
			'capabilities' => array('manage_terms'),
			'show_ui' => true
		));
		
		add_filter("manage_" . $this->slug . "_posts_columns", array(&$this, "show_edit_columns"));
		add_action("manage_" . $this->slug . "_posts_custom_column", array(&$this, "show_edit_columns_content"));
		//***
		add_filter('manage_edit-mail_subscriber_types_columns', array(&$this, 'manage_edit_category_columns'), 10, 2);
		add_action('manage_mail_subscriber_types_custom_column', array(&$this, 'manage_category_custom_column'), 10, 3);

		//***
		parent::__construct($args);
	}

	//design by realmag777
	public function admin_init() {
		add_action('save_post', array(&$this, 'save_post'));
		add_meta_box("tm_mail_subscriber_meta", __("Mail constructor", 'newsplus'), array(&$this, 'draw_meta_panel'), $this->slug, "normal");
		add_meta_box("tm_mail_subscriber_stat", __("Mail statistic", 'newsplus'), array(&$this, 'draw_stat_panel'), $this->slug, "normal");

		//duplication
		add_action('admin_action_duplicate_email_post', array(&$this, 'duplicate_email_post'));
		add_filter('page_row_actions', array(&$this, 'duplicate_post_link_row'), 10, 2);
	}

	public function show_edit_columns() {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'newsplus'),
			"template" => __("Template", 'newsplus'),
			"email_subject" => __("Email subject", 'newsplus'),
			"date" => __("Date", 'newsplus')
		);

		return $columns;
	}

	public function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "template":
				$template = get_post_meta($post->ID, 'mail_template', true);
				$ini_data = parse_ini_file(THEMEMAKERS_MAIL_SUBSCRIBER_PATH . 'templates/' . $template . '/values.ini');
				echo '<img src="' . THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'templates/' . $template . '/screenshot.jpg" alt="' . $ini_data['name'] . '" /><br />';
				break;
			case "email_subject":
				$subject = get_post_meta($post->ID, 'email_subject', true);
				echo $subject;
				break;
		}

		return $column;
	}

	public function draw_meta_panel() {

		wp_enqueue_script('tm_mail_subscriber_meta', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . '/js/admin/pt_mail_subscriber/meta.js');
		wp_enqueue_script('tm_mail_subscriber_template', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . '/js/admin/pt_mail_subscriber/template.js', array('jquery', 'jquery-ui-core', 'jquery-ui-dialog'));
		wp_enqueue_style('tm_mail_subscriber_meta', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/admin/pt_mail_subscriber.css');
		wp_enqueue_style('tm_mail_subscriber_meta_ui', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/admin/jquery-ui.css');
		?>
		<script type="text/javascript">
			var post_templates_edition = 0;
			var ms_uri = "<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>";
			var ms_lang_chooce_email_groups = "<?php _e("Check e-mail groups!", 'newsplus') ?>";
			var ms_lang_confirm_sending = "<?php _e("Please confirm letter sending!", 'newsplus') ?>";
			var ms_lang_emails_sent = "<?php _e("All emails successfully sent!", 'newsplus') ?>";
			var ms_lang_email_successfully_sent = "<?php _e("Your email has been sent", 'newsplus') ?>";
		</script>


		<?php
		$data = array();
		global $post;
		$data['mail_template'] = get_post_meta($post->ID, 'mail_template', true);
		$data['email_subject'] = get_post_meta($post->ID, 'email_subject', true);
		$data['recipients_emails_mode'] = get_post_meta($post->ID, 'recipients_emails_mode', true);
		$data['recipients_emails'] = get_post_meta($post->ID, 'recipients_emails', true);
		$data['post_id'] = $post->ID;

		echo $this->draw_html('admin/pt_mail_subscriber/meta_panel', $data);
	}

	public function draw_stat_panel() {
		global $post;
		$data = array();
		$data['mail_stat_data'] = TmMS_Statistic::get_mail_stat_data($post->ID);
		$data['referred_by_link'] = TmMS_Statistic::get_stat('referred_by_link', array('mail_id' => $post->ID));
		echo $this->draw_html('admin/pt_mail_subscriber/stat_panel', $data);
	}

	public function save_post() {
		global $post;
		if (is_object($post)) {
			$post_type = get_post_type($post->ID);
			if ($post_type == $this->slug) {
				update_post_meta($post->ID, 'mail_template', $_POST['mail_template']);
				update_post_meta($post->ID, 'email_subject', $_POST['email_subject']);
				update_post_meta($post->ID, 'recipients_emails_mode', $_POST['recipients_emails_mode']);
				update_post_meta($post->ID, 'recipients_emails', $_POST['recipients_emails']);
				return false;
			}
		}
	}

	//ajax
	public function save_mail_html() {
		$my_post = array();
		$my_post['ID'] = $_REQUEST['post_id'];
		$my_post['post_content'] = $_REQUEST['mail_html'];
		wp_update_post($my_post);
		exit;
	}

	public function manage_edit_category_columns($cat_columns) {
		$cat_columns['mail_subscriber_users_count'] = __('Subscribed', 'newsplus');
		return $cat_columns;
	}

	public function manage_category_custom_column($deprecated, $column_name, $term_id) {
		if ($column_name == 'mail_subscriber_users_count') {
			global $wpdb;
			$count = 0;
			$res = $wpdb->get_results('SELECT meta_value FROM ' . $wpdb->usermeta . ' WHERE meta_key="tm_mail_subscriber_user_groups"', ARRAY_A);
			if (!empty($res)) {
				foreach ($res as $values) {
					$values = unserialize($values['meta_value']);
					if (in_array($term_id, $values)) {
						++$count;
					}
				}
			}

			echo $count;
		}
	}

}