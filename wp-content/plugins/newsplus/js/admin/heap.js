var THEMEMAKERS_MAIL_SUBSCRIBER_HEAP = function() {
	var self = {
		user_count: 0,
		init: function() {
			try {
				jQuery('#mail-subscriber-options-posts').sortable();
			} catch (e) {
				//***
			}
			//***
			jQuery('.add_post_to_send_heap').life('click', function() {
				/*
				 * in http://<site>/wp-admin/edit.php
				 * for button to add post to mailing list
				 */
				var post_id = jQuery(this).data('post-id');
				if (jQuery(this).hasClass('button-primary')) {
					jQuery(this).removeClass('button-primary');
					jQuery(this).addClass('button');
					jQuery(this).text(mail_subscriber_lang5);
					//***
					var link = jQuery('#mail-subscriber-options-posts').find('[data-post-id=' + post_id + ']');
					jQuery(link).parent().remove();
					//***
					self.remove_post_from_heap(post_id);
				} else {
					jQuery(this).removeClass('button');
					jQuery(this).addClass('button-primary');
					jQuery(this).text(mail_subscriber_lang6);
					//***
					jQuery('#mail-subscriber-options-posts').append('<li>' + jQuery(this).data('post-title') + ': <a class="mail_subscriber_remove_item_from_heap button" href="javascript:void(0);" data-post-id="' + post_id + '">X</a></li>');
					//***
					self.add_post_to_send_heap(post_id);
				}
			});
			jQuery('.mail_subscriber_remove_item_from_heap').life('click', function() {
				var post_id = jQuery(this).data('post-id');
				jQuery(this).parent().remove();
				self.remove_post_from_heap(post_id);
				//***
				var button = jQuery('[data-post-id=' + post_id + ']');
				jQuery(button).removeClass('button-primary');
				jQuery(button).addClass('button');
				jQuery(button).text(mail_subscriber_lang5);
			});
		},
		add_post_to_send_heap: function(post_id) {
			var data = {
				action: "ms_add_post_to_send_heap",
				post_id: post_id
			};
			jQuery.post(ajaxurl, data, function(responce) {
				mail_subscriber_options.show_info_popup(responce);
				if (!jQuery('#mail-subscriber-settings-link').hasClass('screen-meta-active')) {
					jQuery('#mail-subscriber-settings-link').trigger('click');
				}
			});
		},
		remove_post_from_heap: function(post_id) {
			var data = {
				action: "ms_remove_post_from_send_heap",
				post_id: post_id
			};
			jQuery.post(ajaxurl, data, function(responce) {
				mail_subscriber_options.show_info_popup(responce);
			});
		},
		mail_posts_heap: function() {
			var tpl_id=jQuery('#ms_tpls').val();
			if(tpl_id === undefined){
				alert(mail_subscriber_lang8);				
				return;
			}
			//***
			if (confirm(mail_subscriber_lang_sure)) {
				jQuery("#process_bar").show(333);
				var data = {
					action: "ms_mail_posts_heap"
				};
				jQuery.post(ajaxurl, data, function(responce) {
					//get users to subscribe
					var data = jQuery.parseJSON(responce);
					//resort data in 2 arrays
					if (Object.keys(data).length > 0) {
						var users_ids = [];
						var categories = [];
						//***
						jQuery.each(data, function(user_id, cats) {
							users_ids.push(user_id);
							categories.push(cats);
						});
						//start letters sending
						self.user_count = users_ids.length;
						self.send_one_letter(users_ids, categories, 0, tpl_id);
					} else {
						jQuery("#process_progress").css('width', '100%');
						jQuery("#process_bar span").html("");
						jQuery("#process_progress strong").html(mail_subscriber_lang2);
					}
				});
			}
		},
		send_one_letter: function(users_ids, categories, index, tpl_id) {
			var tmp = jQuery('#mail-subscriber-options-posts a');
			var posts_in_order = [];
			if (tmp.length) {
				for (var i = 0; i < tmp.length; i++) {
					posts_in_order.push(jQuery(tmp).eq(i).data('post-id'));
				}
			}
			var data = {
				action: "ms_send_post_one_letter",
				user_id: users_ids[index],
				categories: categories[index],
				tpl_id: tpl_id,
				posts_in_order: posts_in_order//for ordering in email
			};
			jQuery.post(ajaxurl, data, function() {
				if (index >= (users_ids.length - 1)) {
					/*
					 if (jQuery('#mail-subscriber-settings-link').hasClass('screen-meta-active')) {
					 jQuery('#mail-subscriber-settings-link').trigger('click');
					 }
					 */
					//***
					var data = {
						action: "ms_clean_heap"
					};
					jQuery.post(ajaxurl, data, function() {
						jQuery("#process_progress").css('width', '100%');
						jQuery("#process_bar span").html("");
						jQuery("#process_progress strong").html(mail_subscriber_lang7 + ': ' + self.user_count);
						//***
						self.user_count = 0;
						jQuery('#mail-subscriber-options-posts').html("");
						var buttons = jQuery('.add_post_to_send_heap');
						jQuery.each(buttons, function(index, value) {
							if (jQuery(value).hasClass('button-primary')) {
								jQuery(value).removeClass('button-primary');
								jQuery(value).addClass('button');
								jQuery(value).text(mail_subscriber_lang5);
							}
						});
					});
				} else {
					var progress = parseFloat(Math.round((index / users_ids.length) * 100));
					jQuery("#process_progress").css('width', progress + '%');
					jQuery("#process_progress").animate({
						backgroundPosition: '100% 0'
					}, 3000);
					jQuery("#process_bar span").html(progress + '%');
					//***
					if (index % letters_per_minute == 0 && index > 0) {
						mail_subscriber_options.show_static_info_popup(mail_subscriber_lang_paused_warning);
						window.setTimeout(function() {
							mail_subscriber_options.hide_static_info_popup();
							self.send_one_letter(users_ids, categories, ++index, tpl_id);
						}, 61000);
						return true;
					}

					self.send_one_letter(users_ids, categories, ++index, tpl_id);
				}
			});

		}

	};
	return self;
};
var mail_subscriber_heap = null;
jQuery(document).ready(function() {
	mail_subscriber_heap = new THEMEMAKERS_MAIL_SUBSCRIBER_HEAP();
	mail_subscriber_heap.init();
});
