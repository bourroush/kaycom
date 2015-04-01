var THEMEMAKERS_MAIL_SUBSCRIBER_OPTIONS = function() {
	var self = {
		show_delay: 333,
		hide_delay: 777,
		init: function() {
			jQuery('body').append('<div class="info_popup"></div>');
			jQuery(".mail_subscriber_user_set_group").life('click', function() {
				var user_id = jQuery(this).attr('user-id');
				var mode = 0;
				if (jQuery(this).is(":checked")) {
					mode = 1;
				}

				var data = {
					action: "mail_subscriber_user_set_group",
					user_id: user_id,
					mode: mode,
					group_id: jQuery(this).val()
				};
				jQuery.post(ajaxurl, data, function() {
					self.show_info_popup(mail_subscriber_lang1);
				});
			});
			//***

			jQuery("#tm_mail_subscriber_settings").submit(function() {
				var data = {
					action: "mail_subscriber_save_settings",
					values: jQuery(this).serialize()
				};
				jQuery.post(ajaxurl, data, function() {
					self.show_info_popup(mail_subscriber_lang_saved);
				});
				return false;
			});		
		},
		show_info_popup: function(text) {
			jQuery(".info_popup").text(text);
			jQuery(".info_popup").fadeTo(self.show_delay, 0.9);
			window.setTimeout(function() {
				jQuery(".info_popup").fadeOut(self.show_delay);
			}, 1000);
		},
		show_static_info_popup: function(text) {
			jQuery(".info_popup").text(text);
			jQuery(".info_popup").fadeTo(self.show_delay, 0.9);
		},
		hide_static_info_popup: function() {
			window.setTimeout(function() {
				jQuery(".info_popup").fadeOut(self.show_delay);
			}, self.hide_delay);
		},
		goToByIdScroll: function(id) {
			jQuery('html,body').animate({
				scrollTop: jQuery("#" + id).offset().top
			}, 'slow');
		},
		getUrlVars: function() {
			var vars = {};
			var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
				vars[key] = value;
			});
			return vars;
		}
	};
	return self;
};
var mail_subscriber_options = null;
jQuery(document).ready(function() {
	jQuery.fn.life = function(types, data, fn) {
		"use strict";
		jQuery(this.context).on(types, this.selector, data, fn);
		return this;
	};
//***
	mail_subscriber_options = new THEMEMAKERS_MAIL_SUBSCRIBER_OPTIONS();
	mail_subscriber_options.init();
});
