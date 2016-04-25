<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<script type="text/javascript">
	tinyMCEPreInit = {
		base: "<?php echo site_url('wp-includes/js/tinymce', 'http'); ?>",
		suffix: "",
		query: "ver=358-23224",
		mceInit: {'': {mode: "exact", width: "100%", theme: "advanced", skin: "wp_theme", language: "en",
				spellchecker_languages: "+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv",
				theme_advanced_toolbar_location: "top", theme_advanced_toolbar_align: "left", theme_advanced_statusbar_location: "bottom",
				theme_advanced_resizing: true, theme_advanced_resize_horizontal: false,
				dialog_type: "modal",
				formats: {
					alignleft: [
						{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'left'}},
						{selector: 'img,table', classes: 'alignleft'}
					],
					aligncenter: [
						{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'center'}},
						{selector: 'img,table', classes: 'aligncenter'}
					],
					alignright: [
						{selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'right'}},
						{selector: 'img,table', classes: 'alignright'}
					],
					strikethrough: {inline: 'del'}
				}, relative_urls: false, remove_script_host: false,
				convert_urls: false, remove_linebreaks: true, gecko_spellcheck: true, fix_list_elements: true,
				keep_styles: false, entities: "38,amp,60,lt,62,gt", accessibility_focus: true, media_strict: false, paste_remove_styles: true,
				paste_remove_spans: true, paste_strip_class_attributes: "all", paste_text_use_dialog: true, webkit_fake_resize: false,
				spellchecker_rpc_url: "<?php echo site_url('wp-includes/js/tinymce/plugins/spellchecker/rpc.php', 'http'); ?>", schema: "html5",
				wpeditimage_disable_captions: false,
				wp_fullscreen_content_css: "<?php echo site_url('wp-includes/js/tinymce/plugins/wpfullscreen/css/wp-fullscreen.css', 'http'); ?>",
				plugins: "inlinepopups,spellchecker,tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs",
				content_css: "<?php echo site_url('wp-content/themes/twentytwelve/editor-style.css', 'http'); ?>", elements: "", wpautop: true, apply_source_formatting: false,
				theme_advanced_buttons1: "bold,italic,strikethrough,bullist,numlist,blockquote,justifyleft,justifycenter,justifyright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv",
				theme_advanced_buttons2: "formatselect,underline,justifyfull,forecolor,pastetext,pasteword,removeformat,charmap,outdent,indent,undo,redo,wp_help",
				theme_advanced_buttons3: "",
				theme_advanced_buttons4: "", tabfocus_elements: ":prev,:next", body_class: " post-type-slidermania", theme_advanced_resizing_use_cookie: true},
		},
		qtInit: {'': {id: "", buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,more,spell,close"}},
		ref: {plugins: "inlinepopups,spellchecker,tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs", theme: "advanced", language: "en"},
		load_ext: function(url, lang) {
			var sl = tinymce.ScriptLoader;
			sl.markDone(url + '/langs/' + lang + '.js');
			sl.markDone(url + '/langs/' + lang + '_dlg.js');
		}
	};
</script>
<script type='text/javascript' src='<?php echo site_url('wp-includes/js/tinymce/wp-tinymce.php?c=1', 'http'); ?>'></script>
<script type='text/javascript' src='<?php echo site_url('wp-includes/js/tinymce/tiny_mce.js', 'http'); ?>'></script>
<script type='text/javascript' src='<?php echo site_url('wp-includes/js/tinymce/wp-tinymce-schema.js', 'http'); ?>'></script>
<script type='text/javascript' src='<?php echo site_url('wp-includes/js/tinymce/langs/wp-langs-en.js', 'http'); ?>'></script>
<script type="text/javascript">
	var wpActiveEditor;

	(function() {
		var init, ed, qt, first_init, DOM, el, i, mce = 1;

		if (typeof(tinymce) == 'object') {
			DOM = tinymce.DOM;
			// mark wp_theme/ui.css as loaded
			DOM.files[tinymce.baseURI.getURI() + '/themes/advanced/skins/wp_theme/ui.css'] = true;

			DOM.events.add(DOM.select('.wp-editor-wrap'), 'mousedown', function(e) {
				if (this.id)
					wpActiveEditor = this.id.slice(3, -5);
			});

			for (ed in tinyMCEPreInit.mceInit) {
				if (first_init) {
					init = tinyMCEPreInit.mceInit[ed] = tinymce.extend({}, first_init, tinyMCEPreInit.mceInit[ed]);
				} else {
					init = first_init = tinyMCEPreInit.mceInit[ed];
				}

				if (mce)
					try {
						tinymce.init(init);
					} catch (e) {
					}
			}
		} else {
			if (tinyMCEPreInit.qtInit) {
				for (i in tinyMCEPreInit.qtInit) {
					el = tinyMCEPreInit.qtInit[i].id;
					if (el)
						document.getElementById('wp-' + el + '-wrap').onmousedown = function() {
							wpActiveEditor = this.id.slice(3, -5);
						};
				}
			}
		}

		if (typeof(QTags) == 'function') {
			for (qt in tinyMCEPreInit.qtInit) {
				try {
					quicktags(tinyMCEPreInit.qtInit[qt]);
				} catch (e) {
				}
			}
		}
	})();
	tinyMCEPreInit.load_ext("<?php echo site_url('wp-content/plugins/tm_mail_subscriber/js', 'http'); ?>", "en");

	(function() {
		var t = tinyMCEPreInit, sl = tinymce.ScriptLoader, ln = t.ref.language, th = t.ref.theme, pl = t.ref.plugins;
		sl.markDone(t.base + '/langs/' + ln + '.js');
		sl.markDone(t.base + '/themes/' + th + '/langs/' + ln + '.js');
		sl.markDone(t.base + '/themes/' + th + '/langs/' + ln + '_dlg.js');
		sl.markDone(t.base + '/themes/advanced/skins/wp_theme/ui.css');
		tinymce.each(pl.split(','), function(n) {
			if (n && n.charAt(0) != '-') {
				sl.markDone(t.base + '/plugins/' + n + '/langs/' + ln + '.js');
				sl.markDone(t.base + '/plugins/' + n + '/langs/' + ln + '_dlg.js');
			}
		});
	})();
</script>

<div class="clearfix">
	<p>
		<?php
		global $tm_ms_controller;
		$themes = $tm_ms_controller->template->get_mail_templates();
		?>

		<label class="out custom-label" for="email_layouts"><?php _e("Email Templates", 'newsplus') ?>:</label>
		<select name="mail_template" id="email_layouts">
			<?php if (!empty($themes)): ?>
				<?php foreach ($themes as $folder_key => $value) : ?>
					<option <?php echo($mail_template == $folder_key ? 'selected' : '') ?> value="<?php echo $folder_key ?>"><?php echo $value ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
		<input type="hidden" id="posts_mail_template" value="<?php echo $mail_template ?>" />
	</p>	
</div>

<div id="letter_content" style="overflow: hidden;"></div>
<div id="posts_letter_content" style="display: none;"><?php echo get_post_field('post_content', $post_id) ?></div>
<div id="content_dialog"></div>
