/*global jQuery, window, Modernizr, navigator, lang_home, is_single_page*/

(function($, win, Modernizr, nav, doc) {

	'use strict';

	$(function() {

		/* Facebook comments*/
		if (jQuery('.fb-comments').length) {
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id))
					return;
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_EN/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		}


		/* ---------------------------------------------------- */
		/*	Init Parallax										*/
		/* ---------------------------------------------------- */

		(function() {

			if (!Modernizr.touch) {
				$('.page-header-bg').parallax("center", 0.5);
				$('.full-bg-image-fixed').parallax("center", 0.4);
			}

		}());

		/* ---------------------------------------------------- */
		/*	Init Progress Bar									*/
		/* ---------------------------------------------------- */

		(function() {

			if ($('.progress-bar').length) {
				$('.progress-bar').progressBar();
			}

		}());

		/* ---------------------------------------------------- */
		/*	Shortcode Image										*/
		/* ---------------------------------------------------- */

		(function() {

			if ($('.absolute-image').length) {
				$('.absolute-image').absImage();
			}

		}());
		
		/* ---------------------------------------------------- */
		/*	Tabs												*/
		/* ---------------------------------------------------- */

		(function() {

			if ($('.tabs-holder').length) {

				var $tabsHolder = $('.tabs-holder');

				$tabsHolder.each(function(i, val) {

					var $tabsNav = $('.tabs-nav', val),
							tabsNavLis = $tabsNav.children('li'),
							$tabsContainer = $('.tabs-container', val);

					$tabsNav.each(function() {
						$(this).next().children('.tab-content').first().stop(true, true).show();
						$(this).children('li').first().addClass('active').stop(true, true).show();
					});

					$(val).on('click', 'a', function(e) {

						var $this = $(this).parent('li'),
								$index = $this.index();
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
					$(win).on('resize', function() {

						var timer = win.setTimeout(function() {
							win.clearTimeout(timer);
							adjustTabs();
						}, 30);
					});

				});
			}

		}());

		/* end Tabs */

		/* ---------------------------------------------------- */
		/*	Accordion and Toggle								*/
		/* ---------------------------------------------------- */

		(function() {

			if ($('.acc-box').length) {

				var $box = $('.acc-box');

				$box.each(function(idx, val) {

					var $trigger = $('.acc-trigger', $(val));

					$trigger.on('click', function() {
						var $this = $(this);
						if ($this.data('mode') === 'toggle') {
							$this.toggleClass('active').next().stop(true, true).slideToggle(300);
						} else {
							if ($this.next().is(':hidden')) {
								$trigger.removeClass('active').next().slideUp(300);
								$this.toggleClass('active').next().slideDown(300);
							} else if ($this.hasClass('active')) {
								$this.removeClass('active').next().slideUp(300);
							}
						}
						return false;
					});

				});

			}

		}());

		/* end Accordion and Toggle */

		/* ---------------------------------------------------- */
		/*	Alert Boxes											*/
		/* ---------------------------------------------------- */

		(function() {

			var $notifications = $('.error, .success, .info, .notice');

			if ($notifications.length) {
				$notifications.notifications({
					speed: 300
				});
			}

		}());

		/* ---------------------------------------------------- */
		/*	Back to Top											*/
		/* ---------------------------------------------------- */

		(function() {

			var extend = {
				button: '#back-top',
				text: 'Back to Top',
				min: 200,
				fadeIn: 600,
				fadeOut: 800,
				speed: 800,
				easing: 'easeOutQuint'
			}, oldiOS = false, oldAndroid = false;

			// Detect if older iOS device, which doesn't support fixed position
			if (/(iPhone|iPod|iPad)\sOS\s[0-4][_\d]+/i.test(nav.userAgent)) {
				oldiOS = true;
			}

			// Detect if older Android device, which doesn't support fixed position
			if (/Android\s+([0-2][\.\d]+)/i.test(nav.userAgent)) {
				oldAndroid = true;
			}

			$('body').append('<a href="#" id="' + extend.button.substring(1) + '" title="' + extend.text + '"><i class="icon-chevron-up"></i></a>');

			$(win).scroll(function() {
				var pos = $(win).scrollTop();

				if (oldiOS || oldAndroid) {
					$(extend.button).css({
						'position': 'absolute',
						'top': pos + $(win).height()
					});
				}

				if (pos > extend.min) {
					$(extend.button).fadeIn(extend.fadeIn);
				} else {
					$(extend.button).fadeOut(extend.fadeOut);
				}

			});

			$(extend.button).click(function(e) {
				$('html, body').animate({
					scrollTop: 0
				}, extend.speed, extend.easing);
				e.preventDefault();
			});

		}());

		/* end Back to Top */

		/* ---------------------------------------------------- */
		/*	Custom Functions									*/
		/* ---------------------------------------------------- */

		// Fixed scrollHorz effect

		$.fn.cycle.transitions.fixedScrollHorz = function($cont, $slides, opts) {

			$('.post-slider-nav a').on('click', function(e) {
				$cont.data('dir', '');
				if (e.target.className.indexOf('prev') > -1) {
					$cont.data('dir', 'prev');
				}
			});

			$cont.css('overflow', 'hidden');
			opts.before.push($.fn.cycle.commonReset);
			var w = $cont.width();
			opts.animIn.left = 0;
			opts.animOut.left = 0 - w,
					opts.cssFirst.left = 0;
			opts.cssBefore.left = w;
			opts.cssBefore.top = 0;

			if ($cont.data('dir') === 'prev') {
				opts.cssBefore.left = -w;
				opts.animOut.left = w;
			}

		};

		/* ---------------------------------------------------- */
		/*	Cycles												*/
		/* ---------------------------------------------------- */

		(function() {

			function swipeFunc(e, dir) {
				var $currentTarget = $(e.currentTarget);

				// Enable swipes if more than one slide
				if ($currentTarget.data('slideCount') > 1) {
					$currentTarget.data('dir', '');
					if (dir === 'left') {
						$currentTarget.cycle('next');
					}
					if (dir === 'right') {
						$currentTarget.data('dir', 'prev');
						$currentTarget.cycle('prev');
					}
				}
			}

			/* ---------------------------------------------------- */
			/*	Recent Projects										*/
			/* ---------------------------------------------------- */

			if ($('.recent-projects.type-2').length) {

				var $projects = $('.recent-projects.type-2');

				// Run slider when all images are fully loaded
				$(win).load(function() {

					$projects.each(function(i) {

						var $this = $(this);

						if ($this.children('li').length < 2) {
							return;
						}

						$this.css('height', $this.children('li:first').height())
								.after('<div class="recent-projects-nav"><a class="prevBtn recent-nav-prev-' + i + '">Prev</a> <a class="nextBtn recent-nav-next-' + i + '">Next</a> </div>')
								.cycle({
							before: function(curr, next, opts) {
								var $this = $(this);
								$this.parent().stop().animate({
									height: $this.height()
								}, opts.speed);
							},
							containerResize: false,
							easing: 'easeInOutExpo',
							fit: true,
							next: '.recent-nav-next-' + i,
							pause: true,
							prev: '.recent-nav-prev-' + i,
							slideResize: true,
							speed: 600,
							timeout: 5000,
							width: '100%'
						}).data('slideCount', $projects.children('li').length);

						// Pause on Nav Hover
						$('.recent-projects-nav a', $this).on('mouseenter', function() {
							$(this).parent().prev().cycle('pause');
						}).on('mouseleave', function() {
							$(this).parent().prev().cycle('resume');
						});

						// Hide navigation if only a single slide
						if ($this.data('slideCount') <= 1) {
							$this.next('.recent-projects-nav').hide();
						}

						// Resize
						$(win).on('resize', function() {
							$this.css('height', $this.find('li:visible').height());
						});

						// Include Swipe
						if (Modernizr.touch) {

							$this.swipe({
								swipeLeft: swipeFunc,
								swipeRight: swipeFunc,
								allowPageScroll: 'auto'
							});

						}

					});
				});
			}

			/* ---------------------------------------------------- */
			/*	Testimonials										*/
			/* ---------------------------------------------------- */

			if ($('.quotes').length) {

				var $quotes = $('.quotes');

				$quotes.each(function(i) {

					var $this = $(this);

					if ($this.children('li').length < 2) {
						return;
					}

					$this.css('height', $this.children('li:first').height())
							.after('<div class="quotes-nav"><a class="prevBtn quotes-nav-prev-' + i + '">Prev</a><a class="nextBtn quotes-nav-next-' + i + '">Next</a></div>')
							.cycle({
						before: function(curr, next, opts) {
							var $this = $(this);
							$this.parent().stop().animate({
								height: $this.height()
							}, opts.speed);
						},
						containerResize: false,
						easing: 'easeInOutExpo',
						fit: true,
						next: '.quotes-nav-next-' + i,
						pause: true,
						prev: '.quotes-nav-prev-' + i,
						slideResize: true,
						speed: 600,
						timeout: $this.data('timeout') ? $this.data('timeout') : '',
						width: '100%'
					}).data('slideCount', $quotes.children('li').length);

					// Pause on Nav Hover
					$('.quotes-nav a', $this).on('mouseenter', function() {
						$(this).parent().prev().cycle('pause');
					}).on('mouseleave', function() {
						$(this).parent().prev().cycle('resume');
					});

					// Hide Navigation if only a Single Slide
					if ($this.data('slideCount') <= 1) {
						$this.next('.quotes-nav').hide();
					}

					// Resize
					$(win).on('resize', function() {
						$this.css('height', $this.find('li:visible').height());
					});

					// Include Swipe
					if (Modernizr.touch) {

						$this.swipe({
							swipeLeft: swipeFunc,
							swipeRight: swipeFunc,
							allowPageScroll: 'auto'
						});

					}

				});

			}

			/* ---------------------------------------------------- */
			/*	Image Post Slider									*/
			/* ---------------------------------------------------- */

			if ($('.image-post-slider > ul').length) {

				var $postslider = $('.image-post-slider > ul');

				$(win).load(function() {

					$postslider.each(function(i) {

						var $this = $(this);

						if ($this.children('li').length < 2) {
							return;
						}

						$this.css('height', $this.children('li:first').height())
								.after('<div class="post-slider-nav"><a class="prevBtn post-nav-prev-' + i + '">Prev</a><a class="nextBtn post-nav-next-' + i + '">Next</a> </div>')
								.cycle({
							before: function(curr, next, opts) {
								var $this = $(this);
								$this.parent().stop().animate({
									height: $this.height()
								}, opts.speed);
							},
							containerResize: false,
							easing: 'easeInOutExpo',
							fx: 'fixedScrollHorz',
							fit: true,
							next: '.post-nav-next-' + i,
							pause: true,
							prev: '.post-nav-prev-' + i,
							slideResize: true,
							speed: 600,
							timeout: 5000,
							width: '100%'
						}).data('slideCount', $this.children('li').length);

					});

					// Pause on Nav Hover
					$('.post-slider-nav a').on('mouseenter', function() {
						$(this).parent().prev().cycle('pause');
					}).on('mouseleave', function() {
						$(this).parent().prev().cycle('resume');
					});

					// Hide navigation if only a single slide
					if ($postslider.data('slideCount') <= 1) {
						$postslider.next('.post-slider-nav').hide();
					}

					// Resize
					$(win).on('resize', function() {
						$postslider.css('height', $postslider.find('li:visible').height());
					});

					// Include Swipe
					if (Modernizr.touch) {
						$postslider.swipe({
							swipeLeft: swipeFunc,
							swipeRight: swipeFunc,
							allowPageScroll: 'auto'
						});
					}

				});
			}

		}());

		/* ---------------------------------------------------- */
		/*	Tooltip Init										*/
		/* ---------------------------------------------------- */

		(function() {

			if ($('.tooltip').length) {
				$('.tooltip').tooltipster({
					'animation': 'grow'
				});
			}

		}());

		/* end Tooltip */

		/* ---------------------------------------------------- */
		/*	Fancybox											*/
		/* ---------------------------------------------------- */

		(function() {

			if ($('.single-image').length) {

				// Single Image
				$('.single-image').fancybox({
					'titleShow': true,
					'padding': '10',
					'transitionIn': 'fade',
					'transitionOut': 'fade',
					'easingIn': 'easeOutBack',
					'easingOut': 'easeInBack',
					helpers: {
						title: {
							type: 'over'
						}
					}
				}).each(function() {
					$(this).append('<span class="curtain"></span>');
				});

				// Iframe
				$('.iframe').fancybox({
					type: 'iframe',
					openEffect: 'fade',
					closeEffect: 'fade',
					nextEffect: 'fade',
					prevEffect: 'fade',
					helpers: {
						title: {
							type: 'over'
						}
					},
					width: '70%',
					height: '70%',
					maxWidth: 800,
					maxHeight: 600,
					fitToView: false,
					autoSize: false,
					closeClick: false
				});
			}

		}());

		/* end Fancybox --> End */

		/* ---------------------------------------------------- */
		/*	Portfolio											*/
		/* ---------------------------------------------------- */

		(function() {

			var $cont = $('#portfolio-items'),
					$itemsFilter = $('#portfolio-filter');

			if ($cont.length && $itemsFilter.length) {

				$('article', $cont).each(function(i) {
					var $this = $(this);
					$this.addClass($this.attr('data-categories'));
				});

				// Run Isotope when all images are fully loaded
				$(win).on('load', function() {

					$cont.isotope({
						itemSelector: 'article',
						layoutMode: 'fitRows'
					});

				});

				// Filter projects
				$itemsFilter.on('click', 'a', function(e) {
					var $this = $(this),
							currentOption = $this.attr('data-categories');

					$itemsFilter.find('a').removeClass('active');
					$this.addClass('active');

					if (currentOption) {
						if (currentOption !== '*') {
							currentOption = currentOption.replace(currentOption, '.' + currentOption);
						}
						$cont.isotope({
							filter: currentOption
						});
					}
					e.preventDefault();
				});

				// $itemsFilter.find('a').first().addClass('active');
				$itemsFilter.children("li:nth-child(2)").children("a").trigger("click");
			}

		}());

		/* end Portfolio  */

		/* ---------------------------------------------------- */
		/*	Player Full Width									*/
		/* ---------------------------------------------------- */

		(function() {

			if ($('.player').length) {

				$('.player').mb_YTPlayer({
					onReady: function() {

						var bgnd = $('#' + this.id);

						$('.video-full-container').on('click', function() {
							var $this = $(this);
							if ($this.hasClass('pause')) {
								$this.removeClass('pause').addClass('play');
								bgnd.playYTP();
							} else {
								$this.removeClass('play').addClass('pause');
								bgnd.pauseYTP();
							}
							return false;
						});
					}
				});

			}

		}());

		/* ---------------------------------------------------- */
		/*	FitVids												*/
		/* ---------------------------------------------------- */

		(function() {

			function adjustVideos() {

				var $videos = $('.video-container');

				$videos.each(function() {

					var $this = $(this),
							playerWidth = $this.parent().actual('width'),
							playerHeight = playerWidth / $this.data('aspectRatio');

					$this.css({
						'height': playerHeight,
						'width': playerWidth
					});

				});

			}

			$('#content').each(function() {

				var selectors = [
					"iframe[src^='http://player.vimeo.com']",
					"iframe[src^='http://www.youtube.com']",
					"object",
					"embed"
				], $allVideos = $(this).find(selectors.join(','));

				$allVideos.each(function() {

					var $this = $(this),
							videoHeight = $this.attr('height') || $this.actual('width'),
							videoWidth = $this.attr('width') || $this.actual('width');

					$this.css({
						'height': '100%',
						'width': '100%'
					}).removeAttr('height').removeAttr('width')
							.wrap('<div class="video-container"></div>').parent('.video-container').css({
						'height': videoHeight,
						'width': videoWidth
					}).data('aspectRatio', videoWidth / videoHeight);

					adjustVideos();

				});

			});

			$(win).on('resize', function() {
				var timer = win.setTimeout(function() {
					win.clearTimeout(timer);
					adjustVideos();
				}, 30);

			});

		}());

		/* end FitVids */

		/* ---------------------------------------------------- */
		/*	Media												*/
		/* ---------------------------------------------------- */

		(function() {

			var $player = $('audio, video');

			if ($player.length) {

				$player.mediaelementplayer({
					audioWidth: '100%',
					audioHeight: '30px',
					videoWidth: '100%',
					videoHeight: '100%'
				});

			}

		}());

		/* end Media --> End */

		/* ---------------------------------------------------- */
		/*	Placeholder											*/
		/* ---------------------------------------------------- */

		(function() {

			if (typeof doc.createElement("input").placeholder === 'undefined') {
				$('[placeholder]').focus(function() {
					var input = $(this);
					if (input.val() === input.attr('placeholder')) {
						input.val('');
						input.removeClass('placeholder');
					}
				}).blur(function() {
					var input = $(this);
					if (input.val() === '' || input.val() === input.attr('placeholder')) {
						input.addClass('placeholder');
						input.val(input.attr('placeholder'));
					}
				}).blur().parents('form').submit(function() {
					$(this).find('[placeholder]').each(function() {
						var input = $(this);
						if (input.val() === input.attr('placeholder')) {
							input.val('');
						}
					});
				});
			}

		}());

		/* end Placeholder --> End */

		/* ---------------------------------------------------- */
		/*	Breadcrumbs											*/
		/* ---------------------------------------------------- */

		(function() {

			try {
				if (!is_single_page) {
					if ($('.breadcrumbs').length) {
						$('.breadcrumbs .menu').prepend('<a href="/">' + lang_home + '</a>');
						var last_breadcrumb_link = $('.breadcrumbs').find('a').last();
						$(last_breadcrumb_link).replaceWith($(last_breadcrumb_link).text());
					}
				}
			} catch (e) {

			}

		}());

		/* end Breadcrumbs --> End */

	});

	/* ---------------------------------------------------- */
	/*	Main Navigation										*/
	/* ---------------------------------------------------- */

	var Navigation = function(el, options) {
		this.el = $(el);
		this.init(options);
	};

	Navigation.defaults = {
		arrowimages: {
			down: 'downarrowclass',
			right: 'rightarrowclass'
		},
		onFixed: 1
	};

	Navigation.prototype = {
		init: function(options) {
			this.o = $.extend({}, Navigation.defaults, options);
			this.el.before('<a id="responsive-nav-button" class="responsive-nav-button" href="#"></a>');
			this.refreshElements();
			this.preProcessing();
			this.initEvents();
		},
		elements: {
			'#responsive-nav-button': 'navButton',
			'#header': 'header'
		},
		$: function(selector) {
			return $(selector);
		},
		refreshElements: function() {
			for (var key in this.elements) {
				this[this.elements[key]] = this.$(key);
			}
		},
		preProcessing: function() {
			var self = this,
					$mainNav = this.el.find('ul').eq(0),
					$submenu = $mainNav.find('ul').parent();
					
			$submenu.each(function(idx, val) {
				var $curobj = $(val), $class;
				$curobj.istopheader = $curobj.parents('ul').length === 1 ? true : false;
				$curobj.addClass($curobj.istopheader ? self.o.arrowimages.down : self.o.arrowimages.right);
			});
		},
		initEvents: function() {
			var self = this;

			// Click
			this.navButton.on('click', function(e) {
				e.preventDefault();
				var $this = $(e.target);
				if (!$this.hasClass('active') && !self.el.hasClass('active')) {
					$this.addClass('active');
					self.el.stop(true, true).slideDown('fast').css('display', 'inline-block').addClass('active');
				} else {
					$this.removeClass('active');
					self.el.stop(true, true).slideUp('fast').removeClass('active');
				}
			});

			// Resize
			$(win).on('resize', function(e) {
				self.removeAttr();
			});

			// Scroll
			if (!Modernizr.touch) {
				if (this.o.onFixed) {
					this.fixedMenu(self);
				}
			}

		},
		removeAttr: function() {
			if ($(win).width() > 959) {
				this.el.attr('style', '');
			}
		},
		fixedMenu: function(self) {
			$(win).on('scroll', function() {
				$(this).scrollTop() > 0 ? self.header.addClass('header-shrink') : self.header.removeClass('header-shrink');
			});
		}
	}

	$.fn.mainNav = function(options) {
		return $.data(this, 'navigation', new Navigation(this, options));
	};

	/* ---------------------------------------------------- */
	/*	Parallax											*/
	/* ---------------------------------------------------- */

	$.fn.parallax = function(xpos, speedFactor) {

		var firstTop, methods = {};

		return this.each(function(idx, value) {

			var $this = $(value), firstTop = $this.offset().top;

			if (arguments.length < 1 || xpos === null)
				xpos = "50%";
			if (arguments.length < 2 || speedFactor === null)
				speedFactor = 0.1;

			methods = {
				update: function() {
					var pos = $(win).scrollTop();
					$this.each(function() {
						$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
					});
				},
				init: function() {
					this.update();
					$(win).on('scroll', methods.update);
				}
			}
			return methods.init();

		});

	};

	/* ---------------------------------------------------- */
	/*	Ticker												*/
	/* ---------------------------------------------------- */

	var intervalID = false;
	var current = 0;

	$.fn.ticker = function(options) {
		var $this = $(this),
				headings = $this.children(), intervalIDs,
				count = headings.length,
				first = $this.children(':first');

		return this.each(function() {

			var self = $(this);

			if (typeof options === 'string') {
				switch (options.toLowerCase()) {
					case 'play':
						self.data('action', 'play');
						break;
					case 'pause':
						self.data('action', 'pause');
						break;
				}
			}

			var obj = {
				fitText: function(text, compressor, options) {
					var settings = $.extend({
						'minFontSize': Number.NEGATIVE_INFINITY,
						'maxFontSize': Number.POSITIVE_INFINITY
					}, options);

					return text.each(function(idx, val) {
						var $this = $(val), resizer = function() {
							$this.css('font-size', Math.max(Math.min($this.actual('width') / (compressor * 10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
						};
						resizer();
						$(window).on('resize.fittext', resizer);
					});
				},
				anim: function() {

					var height = $this.height(),
							offset = current * (-height);
					$this.children().height(height);
					headings.css('line-height', height + 'px');
					if (current === count) {
						current = 0;
					} else {
						first.css('margin-top', offset + 'px');
						current++;
					}
					if ($(win).width() < 959) {
						this.fitText(headings, 1.4, {'minFontSize': '30px', 'maxFontSize': '80px'});
					}

				}
			}
			if ($(win).width() < 959) {
				obj.fitText(headings, 1.4, {'minFontSize': '30px', 'maxFontSize': '80px'});
			}

			switch (self.data('action')) {
				case 'play':
					if (!intervalID) {
						intervalIDs = setInterval(function() {
							obj.anim.call(obj);
						}, 2500);
						setTimeout(function() {
							clearInterval(intervalIDs);
						}, count * 2500);
						intervalID = true;
						current = 1;
					}
					else {
						setTimeout(function() {
							intervalIDs = setInterval(function() {
								obj.anim.call(obj);
							}, 2500);
						}, 1000);
						setTimeout(function() {
							clearInterval(intervalIDs);
						}, count * 2500);
						current = 0;
					}

					break;
				case 'pause':
					current = 0;
					clearInterval(intervalIDs);
					break;
			}

		});
	};

	/* ---------------------------------------------------- */
	/*	absImage											*/
	/* ---------------------------------------------------- */

	$.fn.absImage = function() {
		return this.each(function(idx, value) {
			var $this = $(value),
					width = $this.width(),
					height = $this.height(),
					method = {
				calculate: function(el, w, h, ratio) {
					el.css({
						'width': w * ratio,
						'height': h * ratio
					});
				},
				adjustImage: function(self) {
					var actualWidth = self.parent().actual('width'),
							ratio = actualWidth / 960,
							winWidth = $(win).width();
					if (winWidth < 959) {
						if (winWidth > 768 && winWidth < 960) {
							this.calculate(self, width, height, ratio);
						} else if ($(win).width() > 479 && winWidth < 767) {
							this.calculate(self, width, height, ratio);
						} else if ($(win).width() < 479) {
							this.calculate(self, width, height, ratio);
						}
					}
				}
			}
			method.adjustImage($this);
			$(window).on('resize', function() {
				method.adjustImage($this);
			});

		});
	};

	/* ---------------------------------------------------- */
	/*	Progress Bar										*/
	/* ---------------------------------------------------- */

	$.fn.progressBar = function(options, callback) {

		var defaults = {
			speed: 600
		}, o = $.extend({}, defaults, options);

		return this.each(function() {

			var elem = $(this), methods = {};

			methods = {
				init: function() {
					this.touch = Modernizr.touch ? true : false;
					this.refreshElements();
					this.processing();
				},
				elements: {
					'.bar': 'bar',
					'.percent': 'per'
				},
				$: function(selector) {
					return $(selector, elem);
				},
				refreshElements: function() {
					for (var key in this.elements) {
						this[this.elements[key]] = this.$(key);
					}
				},
				getProgress: function() {
					return this.bar.data('progress');
				},
				setProgress: function(self) {
					self.bar.animate({'width': self.getProgress() + '%'}, {
						duration: o.speed,
						easing: 'swing',
						step: function(progress) {
							self.per.text(Math.ceil(progress) + '%');
						},
						complete: function(scope, i, elem) {
							if (callback) {
								callback.call(this, i, elem);
							}
						}
					});
				},
				processing: function() {
					var self = this;
					if (self.touch) {
						self.setProgress(self);
					} else {
						elem.on('start', function() {
							self.setProgress(self);
						});
					}
				}
			};
			methods.init();

		});

	};

	/* end jQuery Progress Bar */

	/* ---------------------------------------------------- */
	/*	Notifications										*/
	/* ---------------------------------------------------- */

	$.fn.notifications = function(options) {

		var defaults = {
			speed: 200
		}, o = $.extend({}, defaults, options);

		return this.each(function() {

			var closeBtn = $('<a class="alert-close" href="#"></a>'),
					closeButton = $(this).append(closeBtn).find('> .alert-close');

			function fadeItSlideIt(object) {
				object.fadeTo(o.speed, 0, function() {
					object.slideUp(o.speed);
				});
			}

			closeButton.click(function() {
				fadeItSlideIt($(this).parent());
				return false;
			});

		});
	};

	/* end jQuery Notifications */

	/* ---------------------------------------------------- */
	/*	Actual Plugin										*/
	/* ---------------------------------------------------- */

	/* Copyright 2012, Ben Lin (http://dreamerslab.com/)
	 * Licensed under the MIT License (LICENSE.txt).
	 *
	 * Version: 1.0.15
	 *
	 * Requires: jQuery >= 1.2.3
	 */
	(function(a) {
		a.fn.addBack = a.fn.addBack || a.fn.andSelf;
		a.fn.extend({
			actual: function(b, l) {
				if (!this[b]) {
					throw'$.actual => The jQuery method "' + b + '" you called does not exist';
				}
				var f = {
					absolute: false,
					clone: false,
					includeMargin: false
				};

				var i = a.extend(f, l);
				var e = this.eq(0);
				var h, j;
				if (i.clone === true) {
					h = function() {
						var m = "position: absolute !important; top: -1000 !important; ";
						e = e.clone().attr("style", m).appendTo("body");
					};

					j = function() {
						e.remove();
					};

				} else {
					var g = [];
					var d = "";
					var c;
					h = function() {
						c = e.parents().addBack().filter(":hidden");
						d += "visibility: hidden !important; display: block !important; ";
						if (i.absolute === true) {
							d += "position: absolute !important; ";
						}
						c.each(function() {
							var m = a(this);
							g.push(m.attr("style"));
							m.attr("style", d);
						});
					};

					j = function() {
						c.each(function(m) {
							var o = a(this);
							var n = g[m];
							if (n === undefined) {
								o.removeAttr("style");
							} else {
								o.attr("style", n);
							}
						});
					};

				}
				h();
				var k = /(outer)/.test(b) ? e[b](i.includeMargin) : e[b]();
				j();
				return k;
			}
		});
	})(jQuery);

	/* end jQuery Actual Plugin */

}(jQuery, window, Modernizr, navigator, document));

//******************************
function init_masonry(columnWidth) {

	var $container = jQuery('#masonry');
	$container.masonry({
		itemSelector: '.box',
		columnWidth: columnWidth,
		gutterWidth: 10
	});
	$container.animate({'opacity': 1}, 777, function() {
		jQuery('#infscr-loading').animate({opacity: 'hide'}, 333);
	});
}

function masonry_reload(type, columns) {

	jQuery('div#masonryjaxloader').show();
	var post_key = jQuery('#masonryjaxloader').data('next-post-key');
	if (post_key) {
		jQuery('#infscr-loading').animate({opacity: 'show'}, 300);
		var data = {
			action: "folio_get_masonry_piece",
			post_key: post_key,
			type: type,
			columns: columns,
			posts: jQuery('#masonryjaxloader').data('posts'),
			current_col_algoritm: jQuery('#masonryjaxloader').data('col-algoritm')
		};
		jQuery.post(ajaxurl, data, function(response) {
			jQuery('#masonryjaxloader').replaceWith(response);
			if (!jQuery('#masonryjaxloader').length) {
				jQuery('.masonry_view_more_button').remove();
			}
			jQuery("#masonry").imagesLoaded(function() {
				// Single Image
				var el = jQuery('.masonry_piece_' + post_key);
				jQuery("#masonry").append(el).masonry('appended', el, true);
				jQuery('#masonry').masonry('reload');
				//***
				jQuery('#masonry .masonry_piece_' + post_key).css({'opacity': 0});
				//***
				setTimeout(function() {
					jQuery('#masonry').masonry('reload');
					jQuery('.masonry_piece_' + post_key).animate({'opacity': 1}, 777);
					jQuery('#infscr-loading').animate({opacity: 'hide'}, 222);
				}, 300);
				//***
				jQuery('.single-image').each(function() {
					if (jQuery(this).children().attr('class') != 'curtain') {
						jQuery(this).append('<span class="curtain"></span>');
					}
				});

			});
		});
	} else {
		jQuery('#masonry').masonry('reloadItems');
		jQuery('.masonry_view_more_button').remove();
	}


}

