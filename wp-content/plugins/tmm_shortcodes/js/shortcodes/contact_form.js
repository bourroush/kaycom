jQuery(document).ready(function() {
	jQuery('body').prepend('<div class="info_popup"></div>');
	jQuery('.contact-form').submit(function() {
		show_static_info_popup(lang_mail_sending);
		var attachments = jQuery('.list_attach_file');
		if (attachments.length > 0) {
			var attachments_array = [];
			jQuery.each(attachments, function(key, fileinput) {
				attachments_array.push(fileinput);
			});
			contact_form_load_attach(0, attachments_array, this, []);
		} else {
			contact_form_submit(this, []);
		}

		return false;
	});

	jQuery('.contact_form_del_attach').life('click', function() {
		jQuery(this).parent().hide(200, function() {
			jQuery(this).remove();
		});

		return false;
	});

	jQuery('.contact_form_add_attach').click(function () {
		var max_items = jQuery(this).data('max-items');
		if (max_items <= jQuery(this).next('ul.contact_form_attach_list').find('li').size()) {
			var responce = jQuery(this).parents('form').find(".contact_form_responce ul");
				responce.addClass("error type-2");
			if (responce.children('li').size() == 0) {
				responce.append('<li>' + lang_attach_more_else + '</li>');
				jQuery(jQuery(this).parents('form')).find(".contact_form_responce").show(200);
			}
		} else {
			jQuery(this).next('ul.contact_form_attach_list').append('<li><input type="file" class="list_attach_file" name="">&nbsp;<a href="#" class="button default small contact_form_del_attach">X</a></li>');
		}
		return false;
	});


	jQuery(".contact_form_option_checkbox").life('click', function() {
		if (jQuery(this).is(":checked")) {
			jQuery(this).val(1);
		} else {
			jQuery(this).val(0);
		}
	});

});


function contact_form_submit(_this, contact_form_attachments) {

	$response = jQuery(_this).find(jQuery(".contact_form_responce"));
	$response.find("ul").html("");
	$response.find("ul").removeClass();

	var form_self = _this;
	var data = {
		action: "contact_form_request",
		attachments: contact_form_attachments,
		values: jQuery(_this).serialize()
	};
	jQuery.post(ajaxurl, data, function(response) {
		hide_static_info_popup();
		response = jQuery.parseJSON(response);
		if (response.is_errors) {

			jQuery(form_self).find(".contact_form_responce ul").addClass("error type-2");
			jQuery.each(response.info, function(input_name, input_label) {
				jQuery(form_self).find("[name=" + input_name + "]").addClass("wrong-data");
				jQuery(form_self).find(".contact_form_responce ul").append('<li>' + lang_enter_correctly + ' "' + input_label + '"!</li>');
			});

			$response.show(450);

		} else {

			jQuery(form_self).find(".contact_form_responce ul").addClass("success type-2");

			if (response.info == 'succsess') {
				jQuery(form_self).find(".contact_form_responce ul").append('<li>' + lang_sended_succsessfully + '!</li>');
				$response.show(450).delay(1800).hide(400);
			}

			if (response.info == 'server_fail') {
				jQuery(form_self).find(".contact_form_responce ul").append('<li>' + lang_server_failed + '!</li>');
			}

			jQuery(form_self).find("[type=text],[type=email],textarea,checkbox").val("");
			jQuery(form_self).find('.contact_form_attach_list').html('');
		}

		jQuery(form_self).find(".contact_form_responce").show(200);

		// Scroll to bottom of the form to show respond message
		var bottomPosition = jQuery(form_self).offset().top + jQuery(form_self).outerHeight() - jQuery(window).height();

		if (jQuery(document).scrollTop() < bottomPosition) {
			jQuery('html, body').animate({
				scrollTop: bottomPosition
			});
		}

		update_capcha(form_self, response.hash);
	});
}


function contact_form_load_attach(index, attachments_array, form_self, result) {

	// Create new JsHttpRequest object.
	var req = new JsHttpRequest();
	// Code automatically called on load finishing.
	req.onreadystatechange = function() {
		if (req.readyState == 4) {
			try {
				result.push(jQuery.parseJSON(req.responseText));
				if (index + 1 < attachments_array.length) {
					contact_form_load_attach(index + 1, attachments_array, form_self, result);
				} else {
					contact_form_submit(form_self, result);
					hide_static_info_popup();
				}
			} catch (e) {
				contact_form_submit(form_self, result);
				hide_static_info_popup();
			}

		}
	};
	// Prepare request object (automatically choose GET or POST).
	req.open(null, template_directory + 'helper/js_http_request/uploader.php', true);
	// Send data to backend.
	req.send({file: attachments_array[index]});
}
//contact_form_name: jQuery(form_self).find('[name=contact_form_name]').val()


function update_capcha(form_object, hash) {
	jQuery(form_object).find("[name=verify]").val("");
	jQuery(form_object).find("[name=verify_code]").val(hash);
	jQuery(form_object).find(".contact_form_capcha").attr('src', capcha_image_url + '?hash=' + hash);
}


function show_static_info_popup(text) {
	jQuery(".info_popup").text(text);
	jQuery(".info_popup").fadeTo(400, 0.9);
}

function hide_static_info_popup() {
	window.setTimeout(function() {
		jQuery(".info_popup").fadeOut(400);
	}, 777);
}


		