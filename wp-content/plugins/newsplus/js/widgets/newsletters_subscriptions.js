var THEMEMAKERS_MAIL_SUBSCRIBER_NEWSLETTERS = function() {
	var self = {
		init: function() {

		},
		subscribe_user: function(unique_id) {

			jQuery("#newsletter_subscription_name_" + unique_id).removeClass('wrong-data');
			jQuery("#newsletter_subscription_email_" + unique_id).removeClass('wrong-data');

			var newsletter_subscription_name = jQuery("#newsletter_subscription_name_" + unique_id).val();
			var newsletter_subscription_email = jQuery("#newsletter_subscription_email_" + unique_id).val();
			var have_errors = false;
			var infobox = jQuery("#newsletter_subscription_info_" + unique_id);
			jQuery(infobox).html("");

			if (newsletter_subscription_name.length === 0) {
				jQuery("#newsletter_subscription_name_" + unique_id).attr('placeholder', mail_subscriber_lang4);
				jQuery("#newsletter_subscription_name_" + unique_id).addClass('wrong-data');
				have_errors = true;
			}

			if (newsletter_subscription_email.length === 0) {
				jQuery("#newsletter_subscription_email_" + unique_id).attr('placeholder', mail_subscriber_lang5);
				jQuery("#newsletter_subscription_email_" + unique_id).addClass('wrong-data');
				have_errors = true;
			}


			if (have_errors) {
				jQuery(infobox).show(333);
				return false;
			}

			var data = {
				action: "mail_subscriber_subscribe_user",
				user_name: newsletter_subscription_name,
				user_email: newsletter_subscription_email
			};
			jQuery.post(ajaxurl, data, function(response) {
				response = jQuery.parseJSON(response);

				jQuery(infobox).html("");
				jQuery(infobox).show(333);

				if (response.errors !== undefined) {
					if (response.errors.length) {
						jQuery(infobox).addClass('newsletter_subscription_errors');
						jQuery(infobox).html(response.errors);
					}
				}

				if (response.info !== undefined) {
					if (response.info.length) {
						jQuery(infobox).addClass('newsletter_subscription_success');
						jQuery('form[name="newsletter_subscription_' + unique_id + '"]').remove();
						jQuery(infobox).html(response.info);
					}
				}

				if (response.err_name !== undefined) {
					if (response.err_name.length) {
						jQuery("#newsletter_subscription_name_" + unique_id).val("");
						jQuery("#newsletter_subscription_name_" + unique_id).attr('placeholder', response.err_name);
						jQuery("#newsletter_subscription_name_" + unique_id).addClass('wrong-data');
					}
				}

				if (response.err_email !== undefined) {
					if (response.err_email.length) {
						jQuery("#newsletter_subscription_email_" + unique_id).val("");
						jQuery("#newsletter_subscription_email_" + unique_id).attr('placeholder', response.err_email);
						jQuery("#newsletter_subscription_email_" + unique_id).addClass('wrong-data');
					}
				}
			});

			return false;

		}
	};
	return self;
};
//***
var mail_subscriber_newsletters = null;
jQuery(document).ready(function() {
	mail_subscriber_newsletters = new THEMEMAKERS_MAIL_SUBSCRIBER_NEWSLETTERS();
	mail_subscriber_newsletters.init();
});

