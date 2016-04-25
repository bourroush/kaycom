<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TmMS_PT extends TmMS {

	public $slug = NULL;

	public function __construct($args) {
		register_post_type($this->slug, $args);
		flush_rewrite_rules(false);
		//***
		add_action("admin_init", array(&$this, 'admin_init'));
	}

	protected function set_parent_slug($slug) {
		$this->slug = $slug;
	}
	
	/**
	 * Add the link to action list for post_row_actions
	 */
	function duplicate_post_link_row($actions, $post) {
		if ($post->post_type == $this->slug) {
			$actions['duplicate_email_post'] = '<a href="' . admin_url('admin.php?action=duplicate_email_post&post=' . $post->ID) . '" title="'
					. esc_attr(__("Duplicate", 'newsplus'))
					. '">' . __('Duplicate', 'newsplus') . '</a>';
		}

		return $actions;
	}

	public function duplicate_email_post() {
		// Get the original post
		$id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
		$post = get_post($id);
		$new_id = $this->create_duplicate($post, $status);
		wp_redirect(admin_url('post.php?action=edit&post=' . $new_id));
		return false;
	}

	/**
	 * Create a duplicate from a post
	 */
	private function create_duplicate($post, $status = '') {

		$prefix = __('Copy', 'newsplus') . ': ';
		$suffix = "";
		if (!empty($prefix))
			$prefix.= " ";
		if (!empty($suffix))
			$suffix = " " . $suffix;

		$new_post_author = wp_get_current_user();

		$new_post = array(
			'menu_order' => $post->menu_order,
			'comment_status' => $post->comment_status,
			'ping_status' => $post->ping_status,
			'post_author' => $new_post_author->ID,
			'post_content' => $post->post_content,
			'post_excerpt' => $post->post_excerpt,
			'post_mime_type' => $post->post_mime_type,
			'post_password' => $post->post_password,
			'post_status' => $new_post_status = (empty($status)) ? $post->post_status : $status,
			'post_title' => $prefix . $post->post_title . $suffix,
			'post_type' => $post->post_type,
		);

		$new_post_id = wp_insert_post($new_post);

		//copy metas
		global $wpdb;
		$metas = $wpdb->get_results('SELECT meta_key,meta_value FROM ' . $wpdb->postmeta . ' WHERE post_id=' . $post->ID, ARRAY_A);
		if (!empty($metas)) {
			foreach ($metas as $value) {
				$wpdb->insert($wpdb->postmeta, array('post_id' => $new_post_id, 'meta_key' => $value['meta_key'], 'meta_value' => $value['meta_value']));
			}
		}

		//copy categories
		$cats = $wpdb->get_results('SELECT term_taxonomy_id FROM ' . $wpdb->term_relationships . ' WHERE object_id=' . $post->ID, ARRAY_A);
		if (!empty($cats)) {
			foreach ($cats as $value) {
				$wpdb->insert($wpdb->term_relationships, array('object_id' => $new_post_id, 'term_taxonomy_id' => $value['term_taxonomy_id']));
			}
		}


		// If the copy is published or scheduled, we have to set a proper slug.
		$post_name = wp_unique_post_slug($post->post_name, $new_post_id, $new_post_status, $post->post_type);

		$new_post = array();
		$new_post['ID'] = $new_post_id;
		$new_post['post_name'] = $post_name;

		// Update the post into the database
		wp_update_post($new_post);

		//reset stat
		update_post_meta($new_post_id, 'mail_stat_data', '');


		return $new_post_id;
	}

}