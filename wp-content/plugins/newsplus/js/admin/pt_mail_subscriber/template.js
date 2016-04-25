var THEMEMAKERS_PLUGIN_MAIL_SUBSCRIBER_TEMPLATE = function() {
	var self = {
		editing_box_id: null,
		active_editor_id: null,
		init: function() {

			jQuery(".content_area").life('click', function() {
				jQuery(this).find('.content_area_delete').remove();
				mail_subscriber_options.show_static_info_popup(mail_subscriber_lang3);
				if (self.editing_box_id != null) {
					return false;
				}
				var id = jQuery(this).attr('id');
				if (self.editing_box_id == id) {
					return false;
				} else {
					self.editing_box_id = id;
				}
				self.set_tiny_content(jQuery(this).html());
				mail_subscriber_options.hide_static_info_popup();
				return false;
			});

			jQuery(".content_area").life('mouseenter', function() {
				jQuery(this).prepend('<a href="javascript:void(0);" class="content_area_delete">delete</a>');
			});

			jQuery(".content_area").life('mouseleave', function() {
				jQuery(this).find('.content_area_delete').remove();
			});

			jQuery('.content_area_delete').life('click', function() {
				jQuery(this).parent().remove();
				return false;
			});

			//*******************************************************************

			jQuery(".js_set_simple_active_content").life('click', function() {
				var content = jQuery("#text_" + self.editing_box_id).val();
				jQuery("#" + self.editing_box_id).html(content);
				self.editing_box_id = null;
				return false;
			});

		},
		set_tiny_content: function(content) {

			var dialog = jQuery("#content_dialog");

			jQuery(dialog).html('<textarea id="content_editor">' + content + '</textarea>');

			jQuery(dialog).dialog({
				autoOpen: false,
				width: 800,
				height: 600,
				//position: [200, 200],
				zIndex: 1,
				stack: true,
				title: "Content editor",
				buttons: {
					"Apply": function() {
						jQuery("#" + self.editing_box_id).html(tinyMCE.get(self.active_editor_id).getContent());
						jQuery(this).dialog("close");
					},
					"Cancel": function() {
						jQuery(this).dialog("close");
					}
				},
				close: function(event, ui) {
					tinyMCE.execCommand('mceCleanup', false, self.active_editor_id);
					tinyMCE.execCommand('mceRemoveControl', false, self.active_editor_id);
					self.active_editor_id = null;
					self.editing_box_id = null;
					jQuery(this).dialog("destroy");
					jQuery("#content_editor").remove();
				},
				open: function(event, ui) {
					if (post_templates_edition == 1) {
						self.active_editor_id = 'content_editor';

						//tinyMCE.execCommand('mceAddControl', false, self.active_editor_id);
						//tinyMCE.execCommand('mceInsertContent', false, content);

						tinyMCE.init({
							// General options
							mode: "exact",
							elements: 'content_editor',
							theme: "advanced",
							//plugins: "table",
							// Theme options
							theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
							theme_advanced_buttons2: "undo,redo,|,link,unlink,code,image,|,forecolor,backcolor, | removeformat,php_cycle,php_user_name,php_current_data,php_post_title,php_post_content,php_post_excerpt,php_post_permalink",
							theme_advanced_toolbar_location: "top",
							theme_advanced_toolbar_align: "left",
							theme_advanced_statusbar_location: "bottom",
							theme_advanced_resizing: true,
							height: "500",
							width: "100%",
							// Skin options
							skin: "o2k7",
							skin_variant: "silver",
							relative_urls: false,
							remove_script_host: false,
							convert_urls: false,
							setup: function(ed) {
								ed.addButton('php_cycle', {
									title: 'Set in cycle',
									image: ms_plugin_url + "images/admin/icons/cycle.gif",
									onclick: function() {
										//ed.windowManager.alert('hello');
										var selected_text = ed.selection.getContent({format: 'html'});
										selected_text = '__POSTS_CYCLE_START__' + selected_text + '__POSTS_CYCLE_END__';
										ed.selection.setContent(selected_text);
									}
								});

								ed.addButton('php_user_name', {
									title: 'Set username',
									image: ms_plugin_url + "images/admin/icons/user.gif",
									onclick: function() {
										var selected_text = ed.selection.getContent({format: 'html'});
										selected_text = '__USER_NAME__';
										ed.selection.setContent(selected_text);
									}
								});

								ed.addButton('php_current_data', {
									title: 'Set current data',
									image: ms_plugin_url + "images/admin/icons/date.gif",
									onclick: function() {
										var selected_text = ed.selection.getContent({format: 'html'});
										selected_text = '__CURRENT_DATA__';
										ed.selection.setContent(selected_text);
									}
								});

								ed.addButton('php_post_title', {
									title: 'Set post title',
									image: ms_plugin_url + "images/admin/icons/title.gif",
									onclick: function() {
										var selected_text = ed.selection.getContent({format: 'html'});
										selected_text = '__POST_TITLE__';
										ed.selection.setContent(selected_text);
									}
								});

								ed.addButton('php_post_content', {
									title: 'Set post content',
									image: ms_plugin_url + "images/admin/icons/content.gif",
									onclick: function() {
										var selected_text = ed.selection.getContent({format: 'html'});
										selected_text = '__POST_CONTENT__';
										ed.selection.setContent(selected_text);
									}
								});

								ed.addButton('php_post_excerpt', {
									title: 'Set post excerpt',
									image: ms_plugin_url + "images/admin/icons/excerpt.gif",
									onclick: function() {
										var selected_text = ed.selection.getContent({format: 'html'});
										selected_text = '__POST_EXCERPT__';
										ed.selection.setContent(selected_text);
									}
								});

								ed.addButton('php_post_permalink', {
									title: 'Set post permalink',
									image: ms_plugin_url + "images/admin/icons/permalink.gif",
									onclick: function() {
										var selected_text = ed.selection.getContent({format: 'html'});
										selected_text = '__POST_PERMALINK__';
										ed.selection.setContent(selected_text);
									}
								});
							}
						});

					} else {
						self.active_editor_id = 'content_editor';

						//tinyMCE.execCommand('mceAddControl', false, self.active_editor_id);
						//tinyMCE.execCommand('mceInsertContent', false, content);

						tinyMCE.init({
							// General options
							mode: "exact",
							elements: 'content_editor',
							theme: "advanced",
							//plugins: "table",
							// Theme options
							theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
							theme_advanced_buttons2: "undo,redo,|,link,unlink,code,image,|,forecolor,backcolor, | removeformat",
							theme_advanced_toolbar_location: "top",
							theme_advanced_toolbar_align: "left",
							theme_advanced_statusbar_location: "bottom",
							theme_advanced_resizing: true,
							height: "500",
							width: "100%",
							// Skin options
							skin: "o2k7",
							skin_variant: "silver",
							relative_urls: false,
							remove_script_host: false,
							convert_urls: false
						});

					}






				}
			});
			jQuery(dialog).dialog('open');


			return false;
		}
	};
	return self;
};

var mail_subscriber_template = new THEMEMAKERS_PLUGIN_MAIL_SUBSCRIBER_TEMPLATE();
jQuery(document).ready(function() {
	jQuery.fn.life = function(types, data, fn) {
		"use strict";
		jQuery(this.context).on(types, this.selector, data, fn);
		return this;
	};
	//***
	mail_subscriber_template.init();
});

