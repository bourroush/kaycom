<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_PT_MailSubscriberTemplate extends TmMS_PT {

	//public $slug = "mail_subscriber_template";

	public function __construct() {
		$this->set_parent_slug('ms_tpls');
		//***
		$args = array(
			'labels' => array(
				'name' => __('Post Templates', 'newsplus'),
				'singular_name' => __('Post Template', 'newsplus'),
				'add_new' => __('Add New Post Template', 'newsplus'),
				'add_new_item' => __('Add New Post Template', 'newsplus'),
				'edit_item' => __('Edit Post Template', 'newsplus'),
				'new_item' => __('New Post Template', 'newsplus'),
				'view_item' => __('View Post Template', 'newsplus'),
				'search_items' => __('Search Post Template', 'newsplus'),
				'not_found' => __('No Post Templates found', 'newsplus'),
				'not_found_in_trash' => __('No Post Templates found in Trash', 'newsplus'),
				'parent_item_colon' => ''
			),
			'public' => false,
			'archive' => false,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'_builtin' => false,
			'has_archive' => false,
			'hierarchical' => true,
			'menu_position' => null,
			'supports' => array('title', 'excerpt'),
			'rewrite' => array('slug' => $this->slug),
			'show_in_admin_bar' => false,
			'taxonomies' => array(),
			'menu_icon' => ''
		);
		parent::__construct($args);
	}

	public function save_post() {
		global $post;
		if (is_object($post)) {
			$post_type = get_post_type($post->ID);
			if ($post_type == $this->slug) {
				update_post_meta($post->ID, 'mail_template', $_POST['mail_template']);
				return false;
			}
		}
	}

	public function admin_init() {
		add_action('save_post', array(&$this, 'save_post'));
		add_meta_box("tm_mail_subscriber_meta2", __("Template constructor", 'newsplus'), array(&$this, 'draw_meta_panel'), $this->slug, "normal");
		add_meta_box("tm_mail_subscriber_meta2_snippets", __("Snippets", 'newsplus'), array(&$this, 'draw_snippets_panel'), $this->slug, "side");
		//duplication
		add_action('admin_action_duplicate_email_post', array(&$this, 'duplicate_email_post'));
		add_filter('page_row_actions', array(&$this, 'duplicate_post_link_row'), 10, 2);
	}

	public function draw_snippets_panel() {
		?>
		<ul>
			<?php foreach (TmMS_Heap::$snippets as $key => $description) : ?>
				<li><b><?php echo $key ?></b><br /><i><?php echo $description ?></i></li>
			<?php endforeach; ?>
		</ul>
		<?php
	}

	public function draw_meta_panel() {

		wp_enqueue_script('tm_mail_subscriber_meta', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . '/js/admin/pt_mail_subscriber/meta.js');
		wp_enqueue_script('tm_mail_subscriber_template', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . '/js/admin/pt_mail_subscriber/template.js', array('jquery', 'jquery-ui-core', 'jquery-ui-dialog'));
		wp_enqueue_style('tm_mail_subscriber_meta', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/admin/pt_mail_subscriber.css');
		wp_enqueue_style('tm_mail_subscriber_meta_ui', THEMEMAKERS_MAIL_SUBSCRIBER_LINK . 'css/admin/jquery-ui.css');
		?>
		<script type="text/javascript">
			var post_templates_edition = 1;
			var ms_uri = "<?php echo THEMEMAKERS_MAIL_SUBSCRIBER_LINK ?>";
		</script>


		<?php
		$data = array();
		global $post;
		$data['mail_template'] = get_post_meta($post->ID, 'mail_template', true);
		$data['post_id'] = $post->ID;

		echo $this->draw_html('admin/pt_mail_subscriber_template/meta_panel', $data);
	}

	public static function get_templates_array() {
		$args = array(
			'numberposts' => -1,
			'orderby' => 'post_title',
			'order' => 'ASC',
			'post_type' => 'ms_tpls'
		);
		$posts = get_posts($args);
		$result = array();

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$result[$post->ID] = $post->post_title;
			}
		}

		return $result;
	}

}