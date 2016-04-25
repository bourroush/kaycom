function tmm_init_tabs() {
	if (jQuery('.tabs-holder').length) {

		var $tabsHolder = jQuery('.tabs-holder');

		$tabsHolder.each(function(i, val) {

			var $tabsNav = jQuery('.tabs-nav', val),
					tabsNavLis = $tabsNav.children('li'),
					$tabsContainer = jQuery('.tabs-container', val);

			$tabsNav.each(function() {
				jQuery(this).next().children('.tab-content').first().stop(true, true).show();
				jQuery(this).children('li').first().addClass('active').stop(true, true).show();
			});

			jQuery(val).on('click', 'a', function(e) {

				var $this = jQuery(this).parent('li'), $index = $this.index();
				$this.siblings().removeClass('active').end().addClass('active');
				$this.parent().next().children('.tab-content').stop(true, true).hide().eq($index).stop(true, true).fadeIn(250, function() {

					var self = $(this);

					self.parent('.tabs-container').animate({
						height: self.outerHeight(true)
					}, 200);

				});
				e.preventDefault();
			});

			function adjustTabs() {
				$tabsContainer.each(function() {
					var $this = $(this);
					$this.height($this.children('.tab-content:visible').outerHeight());
				});
			}

			// Init
			adjustTabs();

			// Window resize
			jQuery(win).on('resize', function() {

				var timer = win.setTimeout(function() {
					win.clearTimeout(timer);
					adjustTabs();
				}, 30);
			});

		});
	}
}