<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Contact_Form {

	public static $types = array(
		'textinput' => 'Textinput',
		'email' => 'Email',
		'website' => 'Website',
		'messagebody' => 'Message',
		'select' => 'Select',
		'checkbox' => 'Checkbox',
		'radio' => 'Radio'
	);
	public $options_description = array(), $contacts_form_titles = array(), $forms_count = 1;

	public static function save($data) {
		TMM::update_option('contact_form', $data);
	}

	public static function get_form($form_name) {
		$contact_forms = TMM::get_option('contact_form');
		if (!empty($contact_forms)) {
			//after import
			if (!empty($contact_forms) AND is_string($contact_forms)) {
				$contact_forms = unserialize($contact_forms);
			}
			foreach ($contact_forms as $form) {
				if ($form['title'] == $form_name) {
					return $form;
				}
			}
		}

		return array();
	}

	public static function get_forms_names() {
		$contact_forms = TMM::get_option('contact_form');
		$result = array();

		if (!empty($contact_forms)) {
			//after import
			if (!empty($contact_forms) AND is_string($contact_forms)) {
				$contact_forms = unserialize($contact_forms);
			}

			if (!empty($contact_forms) AND is_array($contact_forms)) {
				foreach ($contact_forms as $form) {
					if ($form['title'] == '__FORM_NAME__' OR empty($form['title'])) {
						continue;
					}
					$result[$form['title']] = $form['title'];
				}
			}
		}

		return $result;
	}

	public static function contact_form_request() {
		$data = array();
		parse_str($_REQUEST['values'], $data);
		$errors = array();
		$form = self::get_form($data['contact_form_name']);
		$website = "";
		$messagebody = "";
		$pre_messagebody_info = "";

		if (!empty($form['inputs'])) {
			foreach ($form['inputs'] as $input) {
				$name = strtolower(trim(urlencode($input['label'])));
				$name = str_replace(" ", "_", $name);
				$pattern = "/[^a-zA-Z0-9_]+/i";
				$name = preg_replace($pattern, "", $name);

				if ($input['is_required'] AND ($input['type'] != 'radio' AND $input['type'] != 'checkbox')) {
					if (empty($data[$name])) {
						$errors[$name] = trim($name);
					}
				}

				if ($input['type'] == 'email') {
					if (!is_email(@$data[$name])) {
						$errors[$name] = trim($name);
					}
				}

				if ($input['type'] == 'messagebody') {
					$messagebody = @$data[$name];
				}

				if ($input['type'] == 'website') {
					$website = @$data[$name];
				}

				if ($input['type'] != 'website' AND $input['type'] != 'messagebody') {
					$st=empty($data[$name]) ? '0' : @$data[$name];
					$pre_messagebody_info.="<strong>" . $input['label'] . "</strong>" . ": " . $st . "<br /><br />";
				}
			}
		}


		//capcha	
		if (@$form['has_capture']) {
			if (substr($data['verify_code'], 7, 5) != $data['verify']) {
				$errors["verify"] = "Capcha";
			}
		}


		//*****
		$result = array(
			"is_errors" => 0,
			"info" => ""
		);
		if (!empty($errors)) {
			$result['is_errors'] = 1;
			$result['hash'] = md5(time());
			$result['info'] = $errors;
			echo json_encode($result);
			exit;
		}

		//*****
		if (empty($website)) {
			$website = __("Email from contact form", 'axioma');
		}

		//*****
		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
		add_filter('wp_mail_from_name', 'my_mail_from_name');

		function my_mail_from_name($name) {
			return get_option('blogname');
		}

		//*****
		$after_message = "\r\n<br />--------------------------------------------------------------------------------------------------\r\n<br /> " . __('This mail was sent via', 'axioma') . " " . site_url() . " " . __('contact form', 'axioma');

		//*****
		$recepient_mail = $form['recepient_email'];
		if (empty($form['recepient_email'])) {
			$recepient_mail = get_bloginfo('admin_email');
		}
		//******
		$attachments = array();
		if (!empty($_REQUEST['attachments'])) {
			$attach_counter = 0;
			foreach ($_REQUEST['attachments'] as $value) {
				if (is_file($value['file_path'])) {

					if (filesize($value['file_path']) > $form['attach_item_max_weight'] * 1024000) {
						continue;
					}

					if ($attach_counter >= $form['attach_count']) {
						break;
					}

					$attachments[] = $value['file_path'];
					$attach_counter++;
				}
			}
		}
		//***
		if (wp_mail($recepient_mail, $website, $pre_messagebody_info . nl2br($messagebody) . $after_message, '', $attachments)) {
			$result["info"] = "succsess";
		} else {
			$result["info"] = "server_fail";
		}

		if (!empty($_REQUEST['attachments'])) {
			foreach ($_REQUEST['attachments'] as $value) {
				TMM_Helper::delete_dir(dirname($value['file_path']));
			}
		}

		$result['hash'] = md5(time()); //for capcha

		echo json_encode($result);
		exit;
	}

}
