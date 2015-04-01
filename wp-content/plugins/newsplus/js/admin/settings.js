var THEMEMAKERS_MAIL_SUBSCRIBER_SETTINGS = function() {
	var self = {
		show_delay: 333,
		hide_delay: 777,
		init: function() {
			mail_subscriber_options.show_static_info_popup(mail_subscriber_lang3);

			self.init_tabs();

			   jQuery("#tm_mail_subscriber_settings").show(self.show_delay, function() {
				       mail_subscriber_options.hide_static_info_popup();
			   });

			//option_checkbox
			jQuery(".option_checkbox").live('click', function() {
				if (jQuery(this).is(":checked")) {
					jQuery(this).next("input[type=hidden]").val(1);
				} else {
					jQuery(this).next("input[type=hidden]").val(0);
				}
			});



			//*****
			mail_subscriber_options.hide_static_info_popup();

		},
		init_tabs: function() {

			var slideSpeed = 500; // 'slow', 'normal', 'fast', or miliseconds
			var $nav = jQuery('#tm ul.admin-nav');
			var $sub = $nav.find('ul');
			var $navLi = $nav.children('li');
			var $navliFirst = $nav.find('li:first');

			if ($navliFirst.length) {
				$navliFirst.addClass('current-shortcut');
				if ($navliFirst.find('ul')) {
					$navliFirst.find('ul').css('display', 'block');
					$navliFirst.find('ul li:first').addClass('sub-current');
				}
			}

			$nav.on('click', 'a', function(e) {

				var $cont = jQuery('#admin-content');
				$cont.attr('style', '');

				var window_height = jQuery(window).outerHeight(true)
				var admin_height = $cont.outerHeight(true);

				if (admin_height <= window_height) {
					jQuery('#admin-aside, #admin-content').css('min-height', window_height
							- jQuery('#title-bar').outerHeight(true)
							- jQuery('.set-holder').outerHeight(true) - 200);
				}
				e.preventDefault();
			});

			$sub.find('a').on('click', function(e) {

				$target = jQuery(e.target);
				$sub.children('li').removeClass();
				$target.parent('li').addClass('sub-current');

				e.preventDefault();
			})

			$navLi.children('a').on('click', function(e) {

				$target = jQuery(e.target);
				jQuery(this).parent('li').children('ul').slideUp(slideSpeed);

				if (jQuery(this).parent('li').children('ul').css('display') == "block") {
					jQuery(this).parent('li').children('ul').slideUp(slideSpeed);
					$target.parent('li').removeClass();

				} else {
					$sub.slideUp(slideSpeed);
					$sub.find('li').removeClass();
					jQuery(this).parent('li').children('ul').slideDown(slideSpeed).find('li:first').addClass('sub-current');
				}

				$navLi.removeClass();
				$target.parent('li').addClass('current-shortcut');

				e.preventDefault();

			});

			var $contentTabs = jQuery('.admin-container');

			jQuery.fn.tabs = function($obj) {
				$tabsNavLis = $obj.find('ul.admin-nav').children('li'),
						$tabContent = $obj.find('#admin-content').children('.tab-content');

				$tabContent.hide();
				$tabsNavLis.first().addClass('active').show();
				$tabContent.first().show();

				$obj.find('ul.admin-nav li > a').on('click', function(e) {

					var $this = jQuery(this);

					$obj.find('ul.admin-nav li').removeClass('active');
					$this.addClass('active');
					$obj.find('.tab-content').hide();
					jQuery($this.attr('href')).fadeIn();

					e.preventDefault();
				});
			}

			$contentTabs.tabs($contentTabs);
		}
	};
	return self;
};


var mail_subscriber_settings = null;
jQuery(document).ready(function() {
	mail_subscriber_settings = new THEMEMAKERS_MAIL_SUBSCRIBER_SETTINGS();
	mail_subscriber_settings.init();
});
