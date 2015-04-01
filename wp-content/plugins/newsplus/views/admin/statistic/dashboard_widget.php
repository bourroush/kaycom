<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<script type="text/javascript">

	jQuery(document).ready(function() {

		(function($) {

			jQuery('.dash-tabs').each(function(i, val) {

				var $tabsNav = jQuery('.dash-tabs-nav', val), $tabsNavLis = $tabsNav.children('li');

				$tabsNavLis.on('click', function(e) {
					e.preventDefault();
					var $this = $(this);
					$this.siblings().removeClass('active').end().addClass('active');
					$this.parent().next().children('.dash-tab-content')
							.stop(true, true)
							.hide()
							.siblings($this.find('a').attr('href')).fadeIn(250);
				});

			});



			//***
			jQuery('#dash-tabs').show(250);

		})(jQuery);

	});

</script>

<div class="dash-tabs" id="dash-tabs" style="display: none;">

	<ul class="dash-tabs-nav clearfix">
		<li class="active"><a href="#dash-tabs-1"><?php _e('Users by Status', 'newsplus') ?></a></li>
		<li><a href="#dash-tabs-2"><?php _e('Users by Category', 'newsplus') ?></a></li>
		<li><a href="#dash-tabs-3"><?php _e('Emails have been sent by groups', 'newsplus') ?></a></li>
		<li><a href="#dash-tabs-4"><?php _e('Unsubscribed Users', 'newsplus') ?></a></li>
	</ul><!--/ .dash-tabs-nav-->

	<div class="dash-tabs-container" style="height: 350px; overflow: hidden;">
		<div class="dash-tab-content" id="dash-tabs-1">
			<?php echo TmMS_Statistic::draw_pie_chart($subscribers_stat) ?>
		</div>
		<div class="dash-tab-content" id="dash-tabs-2">
			<?php if (isset($subscribers_by_themes)) echo TmMS_Statistic::draw_pie_chart($subscribers_by_themes); ?>
		</div>
		<div class="dash-tab-content" id="dash-tabs-3">
			<?php echo TmMS_Statistic::draw_pie_chart($emails_sent_by_groups) ?>
		</div>
		<div class="dash-tab-content" id="dash-tabs-4">
			<?php echo TmMS_Statistic::draw_column_chart($deleted_accounts) ?>
		</div>
	</div><!--/ .dash-tabs-container-->

</div><!--/ .dash-tabs-->

