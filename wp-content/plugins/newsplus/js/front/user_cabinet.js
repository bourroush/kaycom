var THEMEMAKERS_MAIL_USER_CABINET = function() {
	var self = {
		init: function() {
			jQuery("#tmm_mail_subscriber_user_cabinet").submit(function() {

				var data = {
					action: "mail_subscriber_save_user_cabinet_settings",
					values: jQuery("#tmm_mail_subscriber_user_cabinet").serialize()
				};
				jQuery.post(ajaxurl, data, function() {
					mail_subscriber_options.show_info_popup('Saved');
				});

				return false;
			});

			//***

			jQuery("#unsubscribe_and_delete").click(function() {
				if (confirm(mail_subscriber_lang_sure)) {
					var data = {
						action: "mail_subscriber_delete_account"
					};
					jQuery.post(ajaxurl, data, function() {
						window.location=homeurl;
					});
				}
			});
		}
	};
	return self;
};


var mail_subscriber_user_cabinet = null;
jQuery(document).ready(function() {
	mail_subscriber_user_cabinet = new THEMEMAKERS_MAIL_USER_CABINET();
	mail_subscriber_user_cabinet.init();
});
