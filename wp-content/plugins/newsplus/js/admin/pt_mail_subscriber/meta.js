var THEMEMAKERS_MAIL_SUBSCRIBER_META = function() {
	var self = {
		process_mail_counter: 0,
		current_mail_send_time: 0,
		chooced_groups: [],
		letters_per_minute: letters_per_minute,
		clean_email_send_mode: false, //(clean_email_send_mode == 1)if sending n0t to users but to emails in textarea
		init: function() {
			//*** mark taxonomies checkboxes
			jQuery("#mail_subscriber_typeschecklist").find(':checkbox').addClass('email_groups_values');
			//***
			jQuery("#email_layouts").change(function() {
				var template = jQuery(this).val();
				jQuery.get(ms_uri + 'templates/' + template + '/layout.php', function(data) {
					var posts_mail_template = jQuery("#posts_mail_template").val();
					if (posts_mail_template == template) {
						jQuery('#letter_content').html(jQuery("#posts_letter_content").html());
					} else {
						jQuery('#letter_content').html(data);
					}
				});
			});


			var GET_template = mail_subscriber_options.getUrlVars()['template'];
			if (GET_template !== undefined) {
				jQuery("#email_layouts").val(GET_template);
			}


			jQuery("#email_layouts").trigger('change');

			//****

			jQuery('#publish').click(function() {
				var data = {
					action: "ms_save_mail_html",
					mail_html: jQuery("#letter_content").html(),
					post_id: jQuery('#post_ID').val()
				};
				jQuery.post(ajaxurl, data, function() {
					jQuery("#letter_content").remove();
					jQuery("#posts_letter_content").remove();
					jQuery("#publish").unbind('click');
					jQuery("#publish").trigger('click');
					//jQuery("#post").submit();
					return true;
				});

				return false;
			});

			//*****

			jQuery('[name=recipients_emails_mode]').click(function() {
				if (parseInt(jQuery(this).val(), 10) === 1) {
					jQuery('#tm_mail_subscriber_recipients_emails').show(333);
				} else {
					jQuery('#tm_mail_subscriber_recipients_emails').hide(333);
				}

				return true;
			});

			//*****


			jQuery(".js_send_letter").click(function() {
				var content = jQuery("#letter_content").html();
				jQuery('#sent_letters_errors').find('li:not(:eq(0))').remove();
				jQuery('#sent_letters_errors').hide();
				//******
				self.chooced_groups = [];
				var subscribe_theme_checkboxes = jQuery(".email_groups_values");
				jQuery.each(jQuery(subscribe_theme_checkboxes), function(index, item) {
					if (jQuery(item).is(':checked')) {
						self.chooced_groups.push(jQuery(item).val());
					}
				});


				if (self.chooced_groups.length == 0) {
					mail_subscriber_options.show_info_popup(ms_lang_chooce_email_groups);
					return false;
				}

				if (confirm(ms_lang_confirm_sending)) {
					var recipients_emails_mode = jQuery('input[name=recipients_emails_mode]:checked').val();

					//**************************************
					jQuery("#move_to_top").trigger('click');
					jQuery("#process_bar").show(333);
					//***

					if (recipients_emails_mode == 0) {
						var data = {
							action: "ms_save_mail_html",
							mail_html: jQuery("#letter_content").html(),
							post_id: jQuery('#post_ID').val()
						};
						jQuery.post(ajaxurl, data, function() {
							var data = {
								action: "mail_subscriber_get_letter_recepients",
								subscribe_groups: self.chooced_groups
							};
							jQuery.post(ajaxurl, data, function(response) {

								var users_ids = jQuery.parseJSON(response);
								self.current_mail_send_time = parseInt(new Date().getTime() / 1000);
								//content = content.replace(/__LETTER_TIME__/gi, self.current_mail_send_time);

								if (users_ids != null) {
									if (users_ids.length > 0) {
										if (!self.letters_per_minute) {
											self.letters_per_minute = 50;
										}
										self.send_one_letter(content, users_ids, 0);
									} else {
										jQuery("#process_progress").css('width', '100%');
										jQuery("#process_bar span").html("");
										jQuery("#process_progress strong").html(mail_subscriber_lang4);
									}
								}

							});

						});

					} else {
						var emails = jQuery('#tm_mail_subscriber_recipients_emails').val().split(',');
						if (emails.length > 0) {
							if (!self.letters_per_minute) {
								self.letters_per_minute = 50;
							}
							self.clean_email_send_mode = true;
							self.current_mail_send_time = parseInt(new Date().getTime() / 1000);
							self.send_one_letter(content, emails, 0);
						} else {
							jQuery("#process_progress").css('width', '100%');
							jQuery("#process_bar span").html("");
							jQuery("#process_progress strong").html(mail_subscriber_lang2);
						}
					}

					//***
					jQuery('html, body').animate({
						scrollTop: 0
					}, 600);
				}


				return false;
			});


		},
		send_one_letter: function(content, users_ids, index) {
			var data = null;

			if (!self.clean_email_send_mode) {
				var data = {
					action: "mail_subscriber_send_one_letter",
					content: content,
					user_id: users_ids[index],
					post_id: jQuery('#post_ID').val(),
					subscribe_groups: self.chooced_groups
				};
			} else {
				//users_ids is array of emails
				var data = {
					action: "mail_subscriber_send_one_letter",
					content: content,
					user_id: 0,
					email: users_ids[index],
					post_id: jQuery('#post_ID').val(),
					subscribe_groups: self.chooced_groups
				};
			}


			jQuery.post(ajaxurl, data, function(responce) {
				responce = jQuery.parseJSON(responce);
				if (responce.error.length) {
					jQuery("#sent_letters_errors").show();
					jQuery("#sent_letters_errors").append("<li>" + responce.error + "</li>");
				}

				//*****
				++index;
				if (index < users_ids.length) {
					var progress = parseFloat(Math.round((index / users_ids.length) * 100));
					jQuery("#process_progress").css('width', progress + '%');
					jQuery("#process_progress").animate({
						backgroundPosition: '100% 0'
					}, 3000);
					jQuery("#process_bar span").html(progress + '%');

					if (self.process_mail_counter == self.letters_per_minute) {
						mail_subscriber_options.show_static_info_popup(mail_subscriber_lang_paused_warning);
						window.setTimeout(function() {
							self.process_mail_counter = 0;
							mail_subscriber_options.hide_static_info_popup();
							self.send_one_letter(content, users_ids, index);
						}, 61000);

						return true;
					}

					++self.process_mail_counter;
					self.send_one_letter(content, users_ids, index);
				} else {
					mail_subscriber_options.show_info_popup(ms_lang_emails_sent);
					self.process_mail_counter = 0;
					self.current_mail_send_time = 0;
					//****
					jQuery("#process_progress").css('width', '100%');
					jQuery("#process_bar span").html("");
					jQuery("#process_progress strong").html(ms_lang_email_successfully_sent + ": " + users_ids.length);
					self.clean_email_send_mode = false;
				}

			});
		}
	};
	return self;
};

var mail_subscriber_meta = null;
jQuery(document).ready(function() {
	jQuery.fn.life = function(types, data, fn) {
		"use strict";
		jQuery(this.context).on(types, this.selector, data, fn);
		return this;
	};
	//***
	mail_subscriber_meta = new THEMEMAKERS_MAIL_SUBSCRIBER_META();
	mail_subscriber_meta.init();
});

