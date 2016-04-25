<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
//contact form on front by shortcode
$form_name = $content;
$contact_form = TMM_Contact_Form::get_form($form_name);
wp_enqueue_script("tmm_shortcode_contact_form_js", TMM_Ext_Shortcodes::get_application_uri() . '/js/shortcodes/contact_form.js');

$unique_id = uniqid();
//output fields
if (!empty($contact_form['inputs'])) {
	?>

	<form method="post" class="contact-form" enctype="multipart/form-data">

		<input type="hidden" name="contact_form_name" value="<?php echo $form_name ?>" />

		<?php foreach ($contact_form['inputs'] as $input) : ?>

			<?php
			$name = strtolower(trim(urlencode($input['label'])));
			$name = str_replace(" ", "_", $name);
			$pattern = "/[^a-zA-Z0-9_]+/i";
			$name = preg_replace($pattern, "", $name);
			//***

			switch ($input['type']) {
				case "email":
					?>
					<p class="message-form-email">
						<label for="email_<?php echo $unique_id ?>"><?php echo $input['label'] ?><?php echo($input['is_required'] ? ': <span class="required">(' . __('required', 'tmm_shortcodes') . ')</span>' : '') ?></label><span class="icon-form"><input id="email_<?php echo $unique_id ?>" <?php echo($input['is_required'] ? "required" : "") ?> type="email" name="<?php echo $name ?>" value="<?php echo(!empty($_POST) ? $dont_fill_inputs ? "" : $_POST[$name]  : "") ?>" /></span>
					</p>
					<?php
					break;

				case "textinput":
					?>
					<p class="message-form-name">
						<label for="name_<?php echo $unique_id ?>"><?php echo $input['label'] ?><?php echo($input['is_required'] ? ': <span class="required">(' . __('required', 'tmm_shortcodes') . ')</span>' : '') ?></label><span class="icon-form"><input id="name_<?php echo $unique_id ?>" <?php echo($input['is_required'] ? "required" : "") ?> type="text" name="<?php echo $name ?>" value="<?php echo(!empty($_POST) ? $dont_fill_inputs ? "" : $_POST[$name]  : "") ?>" /></span>
					</p>
					<?php
					break;


				case "checkbox":
					?>
					<p class="message-form-checkbox">
						<label>
							<input type="checkbox" name="<?php echo $name ?>" value="0" class="contact_form_option_checkbox" /><?php echo $input['label'] ?>
						</label>
					</p>
					<?php
					break;

				case "radio":
					$radio_items = explode(",", $input['options']);
					if (!empty($radio_items)):
						?>
						<p class="message-form-radio">

							<?php foreach ($radio_items as $item) : ?>
								<label>
									<input type="radio" name="<?php echo $name ?>" value="<?php echo $item ?>" />&nbsp;<?php echo $item ?>
								</label>
							<?php endforeach; ?>

						</p>
						<?php
					endif;
					break;

				case "website":
					?>
					<p class="message-form-url">
						<label for="url_<?php echo $unique_id ?>"><?php echo $input['label'] ?><?php echo($input['is_required'] ? ': <span class="required">(' . __('required', 'tmm_shortcodes') . ')</span>' : '') ?></label><span class="icon-form"><input id="url_<?php echo $unique_id ?>" <?php echo($input['is_required'] ? "required" : "") ?> type="url" name="<?php echo $name ?>" value="<?php echo(!empty($_POST) ? $dont_fill_inputs ? "" : $_POST[$name]  : "") ?>" /></span>
					</p>
					<?php
					break;

				case "messagebody":
					if (empty($name)) {
						$name = "messagebody";
					}
					?>
					<p class="message-form-message">
						<label for="message_<?php echo $unique_id ?>"><?php echo $input['label'] ?><?php echo($input['is_required'] ? ': <span class="required">(' . __('required', 'tmm_shortcodes') . ')</span>' : '') ?></label><span class="icon-form"><textarea id="message_<?php echo $unique_id ?>" <?php echo($input['is_required'] ? "required" : "") ?> name="<?php echo $name ?>"><?php echo(!empty($_POST) ? $dont_fill_inputs ? "" : $_POST[$name]  : "") ?></textarea></span>
					</p>
					<?php
					break;

				case "select":
					$select_options = explode(",", $input['options']);
					?>
					<p>
						<label for="url_<?php echo $unique_id ?>"><?php echo $input['label'] ?><?php echo($input['is_required'] ? ': <span class="required">(' . __('required', 'tmm_shortcodes') . ')</span>' : '') ?></label><select id="url_<?php echo $unique_id ?>" name="<?php echo $name ?>">
							<?php if (!empty($select_options)): ?>
								<?php foreach ($select_options as $value) : ?>
									<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</p>
					<?php
					break;
				default:
					break;
			}
			?>

		<?php endforeach; ?>

		<?php if ($contact_form['has_capture']): ?>

			<p class="input-block">
				<?php $hash = md5(time()); ?>
				<img class="contact_form_capcha" src="<?php echo get_stylesheet_directory_uri(); ?>/helper/capcha/image.php?hash=<?php echo $hash ?>" height="27" width="72" /><input type="text" value="" name="verify" class="verify" /><input type="hidden" name="verify_code" value="<?php echo $hash ?>" />
			</p><!--/ .row-->

		<?php endif; ?>

		<?php if ($contact_form['has_attach']): ?>
			<?php if ((is_user_logged_in() AND ($contact_form['attach_only_logged_in'] OR !$contact_form['attach_only_logged_in'])) OR (!is_user_logged_in() AND !$contact_form['attach_only_logged_in'])): ?>
				<?php wp_enqueue_script('js_http_request', TMM_THEME_URI . '/helper/js_http_request/JsHttpRequest.js'); ?>
				<a href="#" class="button default small contact_form_add_attach" data-max-items="<?php echo $contact_form['attach_count'] ?>"><?php _e('Add file', 'axioma'); ?></a>
				<ul id="list_attach_<?php echo $unique_id ?>" class="contact_form_attach_list"></ul>

				<div class="desc-max-file">
					<i><?php _e('Max file size', 'tmm_shortcodes'); ?>:&nbsp;<?php echo $contact_form['attach_item_max_weight'] ?>MB</i>
					<i><?php _e('Max file count', 'tmm_shortcodes'); ?>:&nbsp;<?php echo $contact_form['attach_count'] ?></i>	
				</div>

			<?php endif; ?>
		<?php endif; ?>


		<p>
			<button class="button <?php echo $contact_form['submit_button'] ?> medium" type="submit"><?php if (!empty($contact_form['submit_button_text']) AND isset($contact_form['submit_button_text'])): ?><?php echo $contact_form['submit_button_text'] ?><?php else: ?><?php _e('Submit', 'tmm_shortcodes'); ?><?php endif; ?></button>
		</p>


		<div class="contact_form_responce" style="display: none;"><ul></ul></div>
	</form>


	<?php
}
?>
<div class="clear"></div>

