jQuery(function() {

	tinymce.create("tinymce.plugins.tmm_tiny_shortcodes",
			{
				_self: null,
				sc_info: {},
				init: function(ed, url)
				{
					_self = this;

					ed.addCommand("tmm_shortcode_tiny_popup", function(a, params)
					{
						var mode = 'new';
						var shortcode_text = '';
						if (params.mode !== undefined) {
							mode = params.mode;
						}

						if (mode == 'edit') {
							shortcode_text = params.shortcode_text;
						}

						//***
						jQuery('body').append('<div id="tmm_shortcode_tiny_popup"></div>');
						tmm_ext_shortcodes.show_static_info_popup(tmm_lang_loading);
						//***
						var data = {
							action: "app_shortcodes_get_shortcode_template",
							shortcode_name: params.identifier,
							mode: mode,
							shortcode_text: shortcode_text
						};
						jQuery.post(ajaxurl, data, function(html) {
							tmm_ext_shortcodes.hide_static_info_popup();

							var popup_params = {
								content: html,
								title: params.title,
								overlay: true,
								open: function() {
									//***
								},
								buttons: {
									0: {
										name: 'Apply',
										action: function(__self) {
											var shortcode = tmm_ext_shortcodes.get_html_from_buffer();
											var editor = _self.get_active_editor();
											//***
											if (mode == 'edit') {
												//replacing old shortcode text by new one
												var html = tinyMCE.activeEditor.getContent();
												html = html.replace(params.shortcode_text, jQuery.trim(shortcode));
												ed.setContent(html);
												tmm_ext_shortcodes.show_static_info_popup(tmm_ext_shortcodes_lang1 + ': ' + params.identifier);
												tmm_ext_shortcodes.hide_static_info_popup();
											} else {
												if (window.tinyMCE) {
													window.tinyMCE.execInstanceCommand(editor, 'mceInsertContent', false, jQuery.trim(shortcode));
													//updating editor content view
													//ed.execCommand('mceRepaint');
													ed.execCommand('mceSetContent', false, tinyMCE.activeEditor.getContent());
												}
											}
										},
										close: true
									},
									1: {
										name: 'Close',
										action: 'close'
									}
								}
							};
							tmm_advanced_wp_popup2.popup(popup_params);
						});

					});


					//***

					ed.onNodeChange.add(function(ed, cm, n) {
						cm.setActive('tmm_tiny_shortcodes', n.nodeName === 'IMG' && ed.dom.hasClass(n, 'shortcode-placeholder'));
					});


					ed.onBeforeSetContent.add(function(ed, o) {
						o.content = _self.toHTML(o.content);
					});

					ed.onPostProcess.add(function(ed, o) {
						if (o.get) {
							o.content = _self.toText(o.content);
						}
					});

				},
				get_active_editor: function() {
					/*
					 var editor = 'content';
					 //for layout_constructor app
					 if (typeof tmm_ext_layout_constructor != 'undefined') {
					 if (tmm_ext_layout_constructor.active_editor_id != null) {
					 editor = 'layout_constructor_editor';
					 }
					 }
					 */
					return tinyMCE.activeEditor.editorId;
				},
				createControl: function(btn, e)
				{
					if (btn == "tmm_shortcodes")
					{
						var a = this;

						//tinymce button adding
						btn = e.createMenuButton("tmm_tinymce_button",
								{
									title: tmm_ext_shortcodes_lang2,
									image: tmm_ext_shortcodes_app_link + "images/add_icon.png",
									icons: false,
									onclick: function() {

										var popup_params = {
											content: '<ul id="tmm_shortcodes_list"></ul>',
											title: 'ThemeMakers Shortcodes Package',
											overlay: true,
											open: function() {
												jQuery.each(tmm_ext_shortcodes_items, function(key, value) {
													jQuery('#tmm_shortcodes_list').css('opacity', 0).append(
															jQuery('<li>').append(
															jQuery('<a>').attr('href', '#').attr('data-shortcode', value.key).attr('href', '#').attr('title', value.name).click(function() {
														//****************************************************
														jQuery('#tmm_shortcodes_list').animate({
															opacity: 0.10,
															height: "toggle"
														}, 222, function() {
															jQuery(this).remove();
															//***
															tmm_ext_shortcodes.show_static_info_popup(tmm_lang_loading);
															var data = {
																action: "app_shortcodes_get_shortcode_template",
																shortcode_name: value.key,
																mode: 'new',
																shortcode_text: value.name
															};
															jQuery.post(ajaxurl, data, function(html) {
																tmm_ext_shortcodes.hide_static_info_popup();
																tmm_advanced_wp_popup2.set_height(0, true, 1);
																tmm_advanced_wp_popup2.set_content(html);
																tmm_advanced_wp_popup2.set_height('auto', true, 333, 1);
																tmm_advanced_wp_popup2.set_title(value.name);
																tmm_advanced_wp_popup2.show_button('Apply');
															});
														});
														//***
														return false;
														//****************************************************
													}).append(jQuery('<img>').attr('src', value.icon))));

												});

												//***

												jQuery('#tmm_shortcodes_list').animate({
													opacity: 1
												}, 222);
											},
											buttons: {
												0: {
													name: 'Apply',
													display: 'none',
													action: function() {
														var shortcode_txt = tmm_ext_shortcodes.get_html_from_buffer();
														var editor = _self.get_active_editor();
														if (window.tinyMCE) {
															window.tinyMCE.execInstanceCommand(editor, 'mceInsertContent', false, jQuery.trim(shortcode_txt));
															window.tinyMCE.execInstanceCommand(editor, 'mceSetContent', false, tinyMCE.activeEditor.getContent());
														}
													},
													close: true
												},
												1: {
													name: 'Close',
													action: 'close'
												}
											}
										};
										tmm_advanced_wp_popup2.popup(popup_params);
									}
								});


						/*
						 // adds the dropdown to the button
						 btn.onRenderMenu.add(function(c, b)
						 {
						 jQuery.each(tmm_ext_shortcodes_items, function(key, value) {
						 a.addWithPopup(b, value.name, value.key);
						 });
						 
						 });
						 */
						return btn;
					}

					return null;
				},
				addWithPopup: function(ed, title, id) {
					ed.add({
						title: title,
						onclick: function() {
							tinyMCE.activeEditor.execCommand("tmm_shortcode_tiny_popup", false, {
								title: title,
								identifier: id
							});
						}
					});
				},
				addImmediate: function(ed, title, sc) {
					ed.add({
						title: title,
						onclick: function() {
							tinyMCE.activeEditor.execCommand("mceInsertContent", false, sc);
						}
					});
				},
				cache: function(key, val) {
					if (key && !val)
						return _self.sc_info[key] || null;
					if (key && val) {
						_self.sc_info[key] = val;
						return true;
					}
					return false;
				},
				toText: function(str) {
					return str.replace(/<img [^>]*\bclass="[^"]*shortcode-placeholder\b[^"]* scid-([^\s"]+)[^>]+>/g, function(a, id) {
						return _self.cache(id);
					});
				},
				parseProperties: function(str) {
					var parts = str.split(/\"/), props = {};
					for (var i = 0; i < parts.length; i += 2) {
						if (typeof parts[i] != 'string' || typeof parts[i + 1] != 'string') {
							continue;
						}

						var n = parts[i].replace(/^\s+|\s+$/g, '').replace('=', ''), v = parts[i + 1];
						if (n && v) {
							props[n] = v;
						}

					}
					return props;
				},
				toHTML: function(str) {
					return str.replace(tmm_ext_shortcodes_items_keys,
							function(str, tag, properties, rawconts, conts) {
								var props = _self.parseProperties(properties);
								if (props.sc_id === undefined) {
									props.sc_id = _self.getId();
									properties += ' sc_id="' + props.sc_id + '"';
								}
								_self.cache(props.sc_id, '[' + tag + ' ' + properties + (conts ? ']' + conts + '[/' + tag + ']' : ']'));
								var _properties = properties.replace(/ sc_id="[^"]+"/, '').replace(/="([^"]+)"/g, ': $1;');
								var shortcode_icon_url = _self.get_shortcode_icon_url(tag);
								return '<img onDblClick="window.parent.tinyMCE.get(\'' + _self.get_active_editor() + '\').plugins.tmm_tiny_shortcodes.edit_shortcode(\'' + tag + '\',\'' + props.sc_id + '\')" src="' + shortcode_icon_url + '" class="shortcode-placeholder mceItem scid-' + props.sc_id + '" title="Shortcode: ' + tag + ' ' + _properties + '" />';
							});
						},
						get_shortcode_icon_url: function(tag) {
							var icon_url = "";
							jQuery.each(tmm_ext_shortcodes_items, function(key, value) {
								if (value.key == tag) {
									icon_url = value.icon;
									return;
								}
							});

							return icon_url;
						},
						edit_shortcode: function(tag, sc_id) {
							var shortcode_text = _self.cache(sc_id);
							window.tinyMCE.execInstanceCommand(_self.get_active_editor(), 'tmm_shortcode_tiny_popup', false, {identifier: tag, title: tmm_ext_shortcodes_lang3 + ': ' + tag, mode: 'edit', shortcode_text: shortcode_text, sc_id: sc_id});
						},
						getId: function() {
							return 'sc' + tmm_ext_shortcodes.get_time_miliseconds();
						},
						getInfo: function() {
							return {
								longname: 'Shortcodes of ThemeMakers by realmag777',
								version: "1.1.1"
							};
						}
					});

					tinymce.PluginManager.add("tmm_tiny_shortcodes", tinymce.plugins.tmm_tiny_shortcodes);

				});
