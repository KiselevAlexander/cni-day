'use strict';

(function ($) {
      $('.slide').on('startShow', function (ev, no_anim) {
            if (no_anim) return false;

            var tl = new TimelineLite();
            switch ($(this).data('anchor')) {

                  // MAIN
                  case "main":

                        tl.fromTo($(this).find('.main__bg'), 1, { opacity: 0 }, { opacity: 1 }, 0.5);
                        break;

                  // YOU
                  case "you":
                        tl.fromTo($('.you-you'), 1, { x: 200 }, { x: 0 }, 0);
                        tl.fromTo($('.you-brush'), 1, { y: -400 }, { y: 0 }, 0);
                        break;

                  // SECRETS  
                  case "secrets":
                        tl.fromTo($('.secrets__left'), 1, { x: -200 }, { x: 0 }, 0);
                        tl.fromTo($('.secrets__right'), 1, { x: 200 }, { x: 0 }, 0);
                        break;

                  // EXPERT  
                  case "expert":
                        tl.fromTo($('.expert__first-name'), 1, { x: -200 }, { x: 0 }, 0);
                        tl.fromTo($('.expert__last-name'), 1, { x: 200 }, { x: 0 }, 0);
                        break;

                  // COMMENTS
                  case "comments":
                        tl.fromTo($(this).find('.comments__quote-left'), 1, { x: -200 }, { x: 0 }, 0);
                        tl.fromTo($(this).find('.comments__quote-right'), 1, { x: 200 }, { x: 0 }, 0);
                        tl.fromTo($(this).find('.comments__slider-item .text'), 1, { opacity: 0 }, { opacity: 1 }, 0.3);
                        break;

                  // MASTERY
                  case "mastery":
                        tl.fromTo($(this).find('.mastery__container-left'), 1, { x: -200 }, { x: 0 }, 0);
                        tl.fromTo($(this).find('.mastery__container-right'), 1, { x: 200 }, { x: 0 }, 0);
                        break;

                  //CALENDAR  
                  case "calendar":
                        tl.fromTo($(this).find('.calendar__prev'), 1, { x: -200 }, { x: 0 }, 0);
                        tl.fromTo($(this).find('.calendar__next'), 1, { x: 200 }, { x: 0 }, 0);

                        break;

                  // PRICE
                  case "price":
                        tl.fromTo($(this).find('.price__product:eq(0)'), 1, { x: -200 }, { x: 0 }, 0);
                        tl.fromTo($(this).find('.price__product:eq(1)'), 1, { y: 200 }, { y: 0 }, 0);
                        tl.fromTo($(this).find('.price__product:eq(2)'), 1, { x: 200 }, { x: 0 }, 0);
                        break;

                  // GIFTS
                  case "gifts":
                        tl.fromTo($(this).find('.gifts__gifts-for-you'), 1, { x: -200 }, { x: 0 }, 0);
                        break;
            }
      });
})(jQuery);
'use strict';

(function ($) {
  $(document).on('ready', function () {
    (function init() {
      var oldLeft = 0,
          index = 0;
      changeLine(oldLeft, index);
      $('.calendar__day-slider .item').on('click', function (ev) {
        if ($(ev.currentTarget).hasClass('active')) return false;
        $('.calendar__day-slider .item.active').removeClass('active');
        $(ev.currentTarget).addClass('active');

        index = $('.calendar__day-slider .item').index($(ev.currentTarget));
        oldLeft = changeLine(oldLeft, index);
        changeContent(index);
      });
      $('.js-calendar-day').on('click', function (ev) {
        if ($(ev.currentTarget).hasClass('active')) return false;
        var localIndex = $('.js-calendar-day').index($(ev.currentTarget));
        $('.js-calendar-day').removeClass('active');
        $(ev.currentTarget).addClass('active');
        $('.calendar__day-slider .item.active').removeClass('active');
        $('.calendar__day-slider .item').eq(localIndex).addClass('active');
        oldLeft = changeLine(oldLeft, -1);
        changeContent(localIndex);
      });
    })();

    function changeLine(oldLeft, index) {
      var $activeElement = $('.calendar__day-slider').find('.item.active'),
          offset = $activeElement.offset(),
          parentOffset = $activeElement.parent().offset();

      var newLeft = offset.left - parentOffset.left,
          newRight = $activeElement.parent().width() - $activeElement.width() - newLeft;

      if (index > -1) {
        $('.js-calendar-day').removeClass('active');
        $('.js-calendar-day').eq(index).addClass('active');
      }

      $('.active-line').velocity({
        left: newLeft
      }, {
        duration: 200,
        delay: newLeft < oldLeft ? 0 : 100,
        queue: false
      });
      $('.active-line').velocity({
        right: newRight
      }, {
        duration: 200,
        delay: newLeft < oldLeft ? 100 : 0,
        queue: false
      });

      return newLeft;
    }

    function changeContent(index) {
      $('.calendar__programm.active').velocity({
        translateX: [-150, 0],
        opacity: [0, 1]
      }, {
        duration: 500,
        queue: false,
        complete: function complete(el) {
          return $(el).removeClass('active');
        }
      });
      $('.calendar__programm').eq(index).velocity({
        translateX: [0, 150],
        opacity: [1, 0]
      }, {
        duration: 500,
        queue: false,
        begin: function begin(el) {
          return $(el).addClass('active');
        }
      });
    }

    // nobile 
    $('.calendar__mobile-accordion').on('click', function (ev) {
      $(ev.currentTarget).toggleClass('active').parent().toggleClass('active');
    });
  });
})(jQuery);
'use strict';

(function ($) {
  $(document).on('ready', function () {
    var maxHeight = 0;

    var fixPriceHeight = function fixPriceHeight() {
      setTimeout(function () {
        $('.price__tarif').each(function (_, el) {
          if ($(el).outerHeight() > maxHeight) maxHeight = $(el).outerHeight();
        });

        $('.price__tarif').css('height', maxHeight);
        $('.price__tarif-plan-container').addClass('price__tarif-plan-container--abs');
      }, 1);
    };

    if ($(window).width() > 1023) {
      fixPriceHeight();
    }

    $(window).on('resize', function () {
      if ($(window).width() < 1024) return false;
      $('.price__tarif').css('height', 'auto');
      $('.price__tarif-plan-container').removeClass('price__tarif-plan-container--abs');
      maxHeight = 0;
      setTimeout(function () {
        fixPriceHeight();
      }, 10);
    });
  });
})(jQuery);
'use strict';

(function ($, w) {
	function ValidatePhone(val) {
		var rePhone = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
		var numbers = /[\d{10}]/g;

		if (/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/.test(val)) {
			if (val.match(numbers).length < 11) {
				return 'Слишком мало цифр';
			}
			if (val.match(numbers).length > 11) {
				return 'Слишком много цифр';
			}
			return true;
		} else {
			return 'Не верный формат';
		}
	}

	$('.js-required-name, .js-phone-mask').on('blur', function (ev) {
		var $input = $(ev.target);
		if (!$input.val()) {
			$input.parent().addClass('error').attr('message', $input.hasClass('js-phone-mask') ? 'Укажите ваш телефон' : 'Укажите ваше имя');
		} else {
			if ($input.hasClass('js-phone-mask')) {
				var validate = ValidatePhone($input.val());
				if (validate != true) {
					$input.parent().addClass('error').attr('message', validate);
				}
			}
			$input.parent().removeClass('error');
		}
	});

	$('.js-required-mail').on('blur', function (ev) {
		var $input = $(ev.target);

		if (!$input.val()) {
			$input.parent().removeClass('error');
			return true;
			// $input.parent()
			// .addClass('error')
			// .attr('message', 'Укажите вашу электронную почту');
			// return false;
		}

		if (/^[-._a-zA-Z0-9]+@(?:[a-zA-Z0-9][-a-z0-9A-Z]+\.)+[A-Za-z]{2,6}$/.test($input.val())) {
			$input.parent().removeClass('error');
		} else {
			$input.parent().addClass('error').attr('message', 'Некорректно указан Email адрес');
		}
	});

	$('.js-phone-mask').mask('+7 (999) 999-99-99', {
		completed: function completed() {
			$(this).parent().removeClass('error').next().find('input').focus();
		}
	});

	// submin
	$('.form__form').on('submit', function (ev) {

		ev.preventDefault();

		var $form = $(this);

		$form.find('input').trigger('blur');

		var formData = {
			name: $('[name="name"]').val(),
			phone: $('[name="phone"]').val(),
			mail: $('[name="mail"]').val(),
			product: $('[value="' + $('[name="product"]').val() + '"]').text(),
			price: $('[name="price"]').val()
		};

		var goal = $('[name="goal"]').val();

		if ($form.find('.error:eq(0)').length) {

			$form.find('.error:eq(0)').find('input').focus();
		} else {

			$form.find('input, select, .js-popup-button').attr('disabled', 'disabled');

			$.ajax({
				url: '/order.php',
				dataType: 'json',
				type: 'post',
				data: formData,
				success: function success(res) {
					if (res.result) {
						$('.form').addClass('hidden');

						$('.form__complete').removeClass('hidden');

						$form.find('input, select, .js-popup-button').removeAttr('disabled');

						if (w.fbq) {

							var price = formData.price || formData.product.match(/[\d]/ig).join('');

							fbq('track', 'Lead', {
								value: price,
								currency: 'RUB'
							});
						}

						if (goal && goal != '') {
							if (w.yaCounter42617899) {
								window.yaCounter42617899.reachGoal(goal, {}, function () {
									console.log('Reach goal: ', goal);
								});
							}
						}
					} else {
						alert("Извините! Что-то пошло не так!\nПопробуйте позднее");
						$form.find('input, select, .js-popup-button').removeAttr('disabled');
					}
				},
				error: function error() {
					$form.find('input, select').removeAttr('disabled');
				}
			});
		}
	});

	$('.js-input input').on('focus', function (ev) {
		console.log('focus');
		ev.preventDefault();
		return false;
	});
})(window.jQuery, window);
'use strict';

(function ($) {
			var DESIGNGALLERY = getDesign();
			var EVENTSGALLERY = getEvents();
			function buildFullGallery(galleryClass, GALLERY, catName) {

						var $fullContainer = $(galleryClass + ' .big-preview');

						if ($fullContainer.hasClass('slick-initialized')) {
									$fullContainer.slick('unslick');
						}

						$fullContainer.html('');

						$.each(GALLERY, function (i, cat) {
									if (cat.name == catName && cat.items.length > 0) {
												$.each(cat.items, function (i, item) {
															var $image = $('<div class="image" />');

															$image.css('background-image', 'url("' + item + '")');

															$fullContainer.append($image);
												});
												$(galleryClass + ' .big-preview__category').html(cat.date + ' ' + cat.title);
									}
						});

						$fullContainer.slick({
									slidesToShow: 1,
									slidesToScroll: 1,
									infinitive: true,
									arrows: true,
									dots: true,
									appendDots: $(galleryClass + ' .js-big-bullets'),
									dotsClass: 'bullets-container'
						});
			}
			function initGallery(galleryClass, GALLERY) {

						var $previewContainer = $(galleryClass + ' .preview-slider-container');

						$previewContainer.html('');

						$.each(GALLERY, function (i, item) {

									var $sliderItem = $('<div class="preview" />');

									var $overlay = $('<div class="preview-overlay" />');

									$overlay.attr('text', (item.date && item.date != '' ? item.date + "\n" : '') + item.title);

									var $image = $('<div class="image" />');

									$image.css('background-image', 'url("' + item.image + '")');

									$sliderItem.attr('data-cat', item.name);

									if (i == 0) {

												$sliderItem.addClass('selected');

												buildFullGallery(galleryClass, GALLERY, item.name);
									}

									$sliderItem.append($overlay);

									$sliderItem.append($image);

									$sliderItem.click(function (e) {

												e.preventDefault();

												var $this = $(this);

												$(galleryClass + ' .preview').removeClass('selected');

												$this.addClass('selected');

												buildFullGallery(galleryClass, GALLERY, $this.data('cat'));
									});

									$previewContainer.append($sliderItem);
						});

						$previewContainer.slick({
									infinite: true,
									slidesToShow: 3,
									slidesToScroll: 1,
									dots: true,
									arrows: true,
									// appendDots : $('.js-preview-bullets'),
									dotsClass: 'bullets-container'
						});
						$(".slick-arrow").text("");
			}

			$(function () {
						initGallery('.events', EVENTSGALLERY);
						initGallery('.design', DESIGNGALLERY);
			});
})(jQuery);
'use strict';

(function ($) {
	$(document).on('ready', function () {
		var scrollTop;

		function lockScroll() {
			scrollTop = window.scrollY;
			$('html, body').css('top', -scrollTop);
			$('html').addClass('noscroll');
		}

		function unlockScroll() {
			$('html, body').css('top', 0);
			$('html').removeClass('noscroll');
			window.scrollTo(0, scrollTop);
		}

		$('.js-cni').on('click', function () {
			window.previousSlide = window.currentSlide;
			window.currentSlide = 0;
			location.hash = '#main';
		});

		$('.js-menu').on('click', function () {
			$('.menu').find('*').removeClass('show');
			$('.menu__buy--white').addClass('show');
			$('.menu').find('.menu__cni--white').addClass('show');
			$('.menu').find('.menu__phone--white').addClass('show');
			$('.menu__container').velocity({
				opacity: [1, 0]
			}, {
				display: 'block'
			});
			$('.menu__close').addClass('show');
			window.mouseIndicator.turnOff();
		});

		$('.js-close').on('click', function () {
			window.inSliding = false;
			$('.menu__container').velocity({
				opacity: [0, 1]
			}, {
				display: 'none'
			});

			$('.menu__burger--white').addClass('show');
			$('.menu__close').removeClass('show');
			$('.slide').eq(window.currentSlide).trigger('startShow', [true]);
		});

		$('.overlay').on('click', function (ev) {
			if (!/overlay/.test(ev.target.className)) return;
			window.inSliding = false;
			$('.popup, .popup-price').removeClass('show');
			$('.overlay').removeClass('show');

			$('.popup').find('.form').removeClass('hidden').find('input').val('');
			$('.popup').find('.form__complete').addClass('hidden');
			unlockScroll();
		});

		$('.js-close-popup').on('click', function () {
			window.inSliding = false;
			$('.popup, .popup-price').removeClass('show');
			$('.overlay').removeClass('show');

			$('.popup').find('.form').removeClass('hidden').find('input').val('');
			$('.popup').find('.form__complete').addClass('hidden');
			unlockScroll();
		});

		$('.js-open-popup').on('click', function (ev) {
			window.inSliding = true;
			lockScroll();
			ev.preventDefault();

			var selected = $(this).data('selected'),
			    cost = $(this).data('cost'),
			    goal = $(this).data('metrica');

			if ($(this).data('popup')) {

				$('.popup-price#' + $(this).data('popup')).addClass('show');
			} else {

				$('.popup').addClass('show');

				$('.overlay').addClass('show');

				if (selected) $('.popup').find('.js-product-select')[0].value = selected;

				if (cost) $('.popup').find('[name="price"]').val(cost);

				if (goal) $('.popup').find('[name="goal"]').val(goal);else $('.popup').find('[name="goal"]').val('');
			}
		});
	});
})(jQuery);

var map;

function initMap() {
	var style_bw = [{
		"featureType": "administrative",
		"elementType": "all",
		"stylers": [{
			"saturation": "-100"
		}]
	}, {
		"featureType": "administrative.province",
		"elementType": "all",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "landscape",
		"elementType": "all",
		"stylers": [{
			"saturation": -100
		}, {
			"lightness": 65
		}, {
			"visibility": "on"
		}]
	}, {
		"featureType": "poi",
		"elementType": "all",
		"stylers": [{
			"saturation": -100
		}, {
			"lightness": "50"
		}, {
			"visibility": "simplified"
		}]
	}, {
		"featureType": "road",
		"elementType": "all",
		"stylers": [{
			"saturation": "-100"
		}]
	}, {
		"featureType": "road.highway",
		"elementType": "all",
		"stylers": [{
			"visibility": "simplified"
		}]
	}, {
		"featureType": "road.arterial",
		"elementType": "all",
		"stylers": [{
			"lightness": "30"
		}]
	}, {
		"featureType": "road.local",
		"elementType": "all",
		"stylers": [{
			"lightness": "40"
		}]
	}, {
		"featureType": "transit",
		"elementType": "all",
		"stylers": [{
			"saturation": -100
		}, {
			"visibility": "simplified"
		}]
	}, {
		"featureType": "water",
		"elementType": "geometry",
		"stylers": [{
			"hue": "#ffff00"
		}, {
			"lightness": -25
		}, {
			"saturation": -97
		}]
	}, {
		"featureType": "water",
		"elementType": "labels",
		"stylers": [{
			"lightness": -25
		}, {
			"saturation": -100
		}]
	}];

	var styles = [{
		stylers: [{
			saturation: -100
		}, {
			gamma: 1
		}]
	}, {
		elementType: 'labels.text.stroke',
		stylers: [{
			visibility: 'off'
		}]
	}, {
		featureType: 'poi.business',
		elementType: 'labels.text',
		stylers: [{
			visibility: 'off'
		}]
	}, {
		featureType: 'poi.business',
		elementType: 'labels.icon',
		stylers: [{
			visibility: 'off'
		}]
	}, {
		featureType: 'poi.place_of_worship',
		elementType: 'labels.text',
		stylers: [{
			visibility: 'off'
		}]
	}, {
		featureType: 'poi.place_of_worship',
		elementType: 'labels.icon',
		stylers: [{
			visibility: 'off'
		}]
	}, {
		featureType: 'road',
		elementType: 'geometry',
		stylers: [{
			visibility: 'simplified'
		}]
	}, {
		featureType: 'water',
		stylers: [{
			visibility: 'on'
		}, {
			saturation: 50
		}, {
			gamma: 0
		}, {
			hue: '#50a5d1'
		}]
	}, {
		featureType: 'administrative.neighborhood',
		elementType: 'labels.text.fill',
		stylers: [{
			color: '#333333'
		}]
	}, {
		featureType: 'road.local',
		elementType: 'labels.text',
		stylers: [{
			weight: 0.5
		}, {
			color: '#333333'
		}]
	}, {
		featureType: 'transit.station',
		elementType: 'labels.icon',
		stylers: [{
			gamma: 1
		}, {
			saturation: 50
		}]
	}];

	map = new google.maps.Map(document.getElementById('map'), {
		center: {
			lat: 45.05811,
			lng: 38.928359
		},
		zoom: 15,
		styles: styles
	});
	var image = '/static/img/pin.png';
	var marker = new google.maps.Marker({
		position: {
			lat: 45.05811,
			lng: 38.928359
		},
		map: map,
		icon: image,
		title: 'CNI'
	});
	var infowindow = new google.maps.InfoWindow({
		content: 'УЛ. КРАСНЫХ ПАРТИЗАН, 181. '
	});

	marker.addListener('click', function () {
		infowindow.open(map, marker);
	});
    setMarker(map);
}
'use strict';

(function ($) {
	$(document).ready(function () {
		if ($(window).width() > 768) {
			$(window).on('mousemove', function (ev) {
				var tl = new TimelineLite();
				var h = $('.js-mouse-parallax-high')[0],
				    m = $('.js-mouse-parallax-mid')[0],
				    l = $('.js-mouse-parallax-low')[0],
				    b = $('.js-mouse-parallax-background')[0],
				    windowHeight = $(window).height();

				if (h && h.getBoundingClientRect().top > 0 && h.getBoundingClientRect().top < windowHeight + 100) {
					tl.to($('.js-mouse-parallax-high'), 0.1, { x: -((windowHeight / 2 - ev.pageX) / 10), y: -((windowHeight / 2 - ev.pageY) / 10) }, 0);
				}
				if (m && m.getBoundingClientRect().top > 0 && m.getBoundingClientRect().top < windowHeight + 100) {
					tl.to($('.js-mouse-parallax-mid'), 0.1, { x: -((windowHeight / 2 - ev.pageX) / 50), y: -((windowHeight / 2 - ev.pageY) / 50) }, 0);
				}
				if (l && l.getBoundingClientRect().top > 0 && l.getBoundingClientRect().top < windowHeight + 100) {
					tl.to($('.js-mouse-parallax-low'), 0.1, { x: -((windowHeight / 2 - ev.pageX) / 100), y: -((windowHeight / 2 - ev.pageY) / 100) }, 0);
				}
				if (b && b.getBoundingClientRect().top - 254 < 0 && b.getBoundingClientRect().top < windowHeight + 100) {
					tl.to($('.js-mouse-parallax-background'), 0.1, { css: {
							'background-position': -((windowHeight / 2 - ev.pageX) / 100) + 'px ' + -((windowHeight / 2 - ev.pageY) / 100) + 'px'
						}
					}, 0);
				}

				var th = $('.js-mouse-parallax-translate-high')[0],
				    tm = $('.js-mouse-parallax-translate-mid')[0],
				    tlw = $('.js-mouse-parallax-translate-low')[0];

				if (th && th.getBoundingClientRect().top > 0 && th.getBoundingClientRect().top < windowHeight + 100) {

					tl.to($('.js-mouse-parallax-translate-high'), 0.1, { x: -((windowHeight / 2 - ev.pageX) / 10), y: -((windowHeight / 2 - ev.pageY) / 10) }, 0);
				}
				if (tm && tm.getBoundingClientRect().bottom > -150 && tm.getBoundingClientRect().bottom < windowHeight + 100) {
					tl.to($('.js-mouse-parallax-translate-mid'), 0.1, { x: -((windowHeight / 2 - ev.pageX) / 50), y: -((windowHeight / 2 - ev.pageY) / 50) }, 0);
				}
				if (tlw && tlw.getBoundingClientRect().bottom > -150 && tlw.getBoundingClientRect().bottom < windowHeight + 100) {

					tl.to($('.js-mouse-parallax-translate-low'), 0.1, { x: -((windowHeight / 2 - ev.pageX) / 100), y: -((windowHeight / 2 - ev.pageY) / 100) }, 0);
				}
			});
		}
	});
})(jQuery);
'use strict';

(function ($) {
  $('.js-share').on('click', function (ev) {
    if ($(this).next().css('max-width') == '150px') $(this).next().css('max-width', '0px');else $(this).next().css('max-width', '150px');

    ev.preventDefault();
  });

  $('.js-share-target').on('click', function socialHandle(e) {
    e.preventDefault();

    var socialType = {
      vk: 'http://vk.com/share.php?',
      fb: 'http://facebook.com/sharer/sharer.php?',
      tw: 'https://twitter.com/share?',
      ok: 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&&st.s=1&'
    };

    var url = 'http://krasnodar.cni-day.ru';
    var title = 'Nail-семинар в Краснодаре.';
    var text = '13 марта в Galich Hall пройдет день CNI с Еленой Морозовой. В программе новинки моделирования и дизайна, подарки и nail-вечеринка';
    var img = 'http://krasnodar.cni-day.ru/img/cni_share-img.jpg';
    var type = $(this).data('type');
    var shareUrl = socialType[type];
    if (type == 'vk') {
      shareUrl += 'url=' + encodeURIComponent(url);
      shareUrl += '&title=' + encodeURIComponent(title);
      shareUrl += '&description=' + encodeURIComponent(text);
      shareUrl += '&image=' + encodeURIComponent(img);
      shareUrl += '&noparse=true';
    }
    if (type == 'fb') {
      shareUrl += 'u=' + encodeURIComponent(url);
    }
    if (type == 'tw') {
      shareUrl += 'url=' + encodeURIComponent(url);
      shareUrl += '&text=' + encodeURIComponent('#деньCNI Nail-семинар в Краснодаре. 13 марта в Galich Hall состоится день CNI с Еленой Морозовой.');
    }
    if (type == 'ok') {
      shareUrl += '&st._surl=' + encodeURIComponent(url);
      shareUrl += '&st.comments=' + encodeURIComponent(text);
    }
    var w = 626,
        h = 436,
        y = window.top.outerHeight / 2 + window.top.screenY - h / 2,
        x = window.top.outerWidth / 2 + window.top.screenX - w / 2;
    window.open(shareUrl, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + y + ', left=' + x);
  });
})(jQuery);
'use strict';

// поправить паралакс
// линии на флаконах
// паддинг на последней строчке
// увеличить расстояние у футера
// при клике на видео менять овервлоф
// сдвинуть капли
// поменять изображение
// шрифт на мобиле инспирейшн

function pad(d) {
	return d < 10 ? '0' + d.toString() : d.toString();
}

(function ($) {
	$(document).ready(function () {

		// fix mousewheel for safari
		// const mousewheel = new FixWheel('mousewheel')
		// mousewheel.init(document.body)

		var selector = '.slide';
		var container = '.slide__container';
		var previousSlide = 0;
		window.currentSlide = 0;

		var onMouseWheel = function onMouseWheel(ev) {
			if (window.inSliding) return false;
			window.currentSlide += ev.direction == 'up' ? -1 : 1;
			if (window.currentSlide < 0) {
				window.currentSlide = 0;
				return false;
			};
			if (window.currentSlide > $(selector).length - 1) {
				window.currentSlide = $(selector).length - 1;
				return false;
			}
			toSlide(window.currentSlide);
		};

		$('html').on('keydown', function (ev) {
			var direction;
			if (ev.keyCode == 38) {
				onMouseWheel({ direction: 'up' });
			}
			if (ev.keyCode == 40) {
				onMouseWheel({ direction: 'down' });
			}
		});

		if (!$(document.body).hasClass('mobile')) {
			var _mouseIndicator = window.mouseIndicator = new WheelIndicator({
				callback: onMouseWheel
			});

			if ($(window).width() < 1025) _mouseIndicator.turnOff();
		}
		// set valid height of the slide after window resize
		var previousHeight = $(window).height();
		var previousWidth = $(window).width();

		function fixHeight() {
			$(selector).css('height', window.innerHeight);
			$(selector).find('.slide__bg').css('height', '100%');

			if (window.innerWidth < 1024) {
				$('[data-anchor^="calendar"]').css('height', 'auto');
				$('[data-anchor^="sets"]').css('height', 'auto');
				$('[data-anchor^="gifts"]').css('height', 'auto');
				$('[data-anchor^="smart"]').css('height', 'auto');
				//				$('[data-anchor^="price"]').css('height', 'auto');
				$('[data-anchor^="expert"]').css('height', window.innerHeight + 100);
				$('[data-anchor^="contact"]').css('height', window.innerHeight + 100);
				$('.price__tarif-plan-container').removeClass('price__tarif-plan-container--abs');
				//$('[data-anchor^="learn"]').css('height', 'auto');
				//				$('[data-anchor^="event"]').css('height', 'auto');
			} else {
				$(selector).css('height', window.innerHeight);
				$(selector).find('.slide__bg').css('height', '100%');
			}
		}

		if ($(window).width() < 1025) {
			fixHeight();
		}

		// if (window.innerWidth >= 768 && window.innerHeight <= 1024 && window.innerHeight > window.innerWidth {
		// 	$('[data-anchor^="price"]').css('height', 'auto');			
		// 	$('.preview-slider-container').slick('slickSetOption', 'slidesToShow', 4, true)
		// }

		$(window).on('resize', function () {
			if (!$(document.body).hasClass('mobile')) {
				if ($(window).width() != previousWidth) {
					fixHeight();
				}
				previousWidth = $(window).width();
				if ($(window).width() < 1025) {
					$('.price__tarif').css('height', 'auto');
					mouseIndicator.turnOff();
				} else {
					mouseIndicator.turnOn();
				}
			}
		});

		$(window).on('hashchange', function () {

			var newSlide = $('.slide[data-anchor="' + location.hash.replace('#', '') + '"]');
			if (!window.inSliding) {
				if ($('.menu__container').css('display') != 'none') {
					$('.menu__container').velocity({
						opacity: [0, 1]
					}, {
						display: 'none',
						queue: false
					});

					$('.menu__close').removeClass('show');
				}

				var newSlideIndex = $('.slide').index(newSlide);
				if (newSlideIndex == -1) return;
				window.previousSlide = window.currentSlide;
				window.currentSlide = newSlideIndex;
				toSlide(newSlideIndex);
			}
		});

		function colorSlider(id) {
			$('.page-slider').removeClass('page-slider--black').removeClass('page-slider--blue').removeClass('page-slider--white');

			$('.page-slider').addClass('page-slider--' + $('.slide:eq(' + id + ')').data('slider-cls'));
		}

		function toSlide(id) {
			var hash = $('.slide:eq(' + id + ')').data('anchor');
			$('.menu__item').removeClass('active');
			$('.menu__item[href="#' + hash + '"]').addClass('active');

			$('.page-slider__item').removeClass('active');
			$('.page-slider__item:eq(' + id + ')').addClass('active');
			colorSlider(id);
			if ($(window).width() < 1025) {
				$('.slide:eq(' + id + ')').velocity('scroll');
				$('.slide:eq(' + id + ')').trigger('startShow');
				$('.menu__burger--white').addClass('show');
				return false;
			}

			var $el = $('' + selector).eq(id);
			if ($el.hasClass('slide--inline')) {
				$el.css({
					'left': 0,
					'top': $(window).height() * (id - 1)
				});
				$el.velocity({
					opacity: [1, 0]
				}, {
					duration: previousSlide + 1 == window.currentSlide ? 700 : 0,
					queue: false
				});
				$el.find('.slide__bg').velocity({
					opacity: [.8, 0]
				}, {
					duration: previousSlide + 1 == window.currentSlide ? 700 : 0,
					queue: false
				});

				window.inSliding = true;
				setTimeout(function () {
					window.inSliding = false;
				}, 200);
				window.location.hash = $el.data('anchor');

				if (previousSlide != window.currentSlide || previousSlide == 0 && window.currentSlide == 0) {
					$el.trigger('startShow');
				}

				if (previousSlide + 1 == window.currentSlide) {
					previousSlide = id;
					return false;
				}
			}

			var $prev = $('' + selector).eq(previousSlide);
			if ($prev && $prev.hasClass('slide--inline')) {
				$prev.velocity({
					opacity: [0, 1]
				}, {
					duration: 700,
					queue: false
				});
				$prev.find('.slide__bg').velocity({
					opacity: [0, .8]
				}, {
					duration: 700,
					queue: false,
					complete: function complete() {
						$prev.css('left', 9999);
					}
				});

				window.inSliding = true;
				setTimeout(function () {
					window.inSliding = false;
				}, 700);
				window.location.hash = $prev.data('anchor');

				if (previousSlide != window.currentSlide || previousSlide == 0 && window.currentSlide == 0) {
					$prev.trigger('startShow');
				}

				if (previousSlide > window.currentSlide) {
					previousSlide = id;
					return false;
				}
			}

			var tl = new TimelineLite();
			tl.to($(container), 0.7, {
				y: '+=' + $el.offset().top * -1,
				onStart: function onStart() {
					window.inSliding = true;
					window.location.hash = $el.data('anchor');
					if (previousSlide != window.currentSlide || previousSlide == 0 && window.currentSlide == 0) {
						previousSlide = id;
						$el.trigger('startShow');
					}
				},
				onComplete: function onComplete() {
					setTimeout(function () {
						window.inSliding = false;
					}, 100);
				}
			}, 0);
		};

		$(selector).on('startShow', function () {
			if ($(window).width() > 1024 && !$(document.body).hasClass('mobile')) window.mouseIndicator.turnOn();

			var menuColors = $(this).attr('data-menu');
			$('.menu').find('*').removeClass('show');
			switch (menuColors[0]) {
				case "0":
					$('.menu__cni--white').addClass('show');
					break;
				case "1":
					$('.menu__cni--black').addClass('show');
					break;
			}
			switch (menuColors[1]) {
				case "0":
					$('.menu__burger--white').addClass('show');
					break;
				case "1":
					$('.menu__burger--black').addClass('show');
					break;
			}
			switch (menuColors[2]) {
				case "0":
					$('.menu__phone--white').addClass('show');
					$('.menu__buy--white').addClass('show');
					break;
				case "1":
					$('.menu__phone--black').addClass('show');
					$('.menu__buy--black').addClass('show');
					break;
			}
		});

		$('.js-slider').each(function (_, slider) {
			var show = 'block';
			var hammertime = new Hammer(slider);

			hammertime.on('pan', function (ev) {
				var item = $(ev.target).closest('.js-item');
				$(item).css({
					transform: 'translateX(' + ev.deltaX + 'px)',
					opacity: '' + Math.abs(0.3 / ev.deltaX * 100)
				});

				if (ev.isFinal) {
					// 2 - left
					// 4 - right
					var $slider = $(slider);
					var curIndex = $slider.data('currentIndex');
					var prevIndex = curIndex;
					curIndex += ev.direction == 2 ? 1 : -1;
					if (curIndex < 0) curIndex = $slider.find('.js-item').length - 1;
					if (curIndex > $slider.find('.js-item').length - 1) curIndex = 0;

					var $item = $slider.find('.js-item:eq(' + curIndex + ')');

					var tl = new TimelineLite();

					$slider.find('.js-item').not(':eq(' + curIndex + ')').velocity({
						opacity: [0, Math.abs(0.3 / ev.deltaX * 100)],
						translateX: [ev.deltaX * 2, ev.deltaX]
					}, {
						queue: false,
						display: 'none',
						easing: 'easeIn'
					});
					if ($(item).hasClass("techniks__slider-item")) {
						show = 'table';
					}
					$item.velocity({
						opacity: [1, Math.abs(0.3 / ev.deltaX * 100)],
						translateX: [0, ev.deltaX * -2]
					}, {
						queue: false,
						display: show,
						easing: 'easeOut'
					});
					$slider.next('.js-bullets-container').find('.bullets-item').removeClass('bullets-item--active');
					$slider.next('.js-bullets-container').find('.bullets-item:eq(' + curIndex + ')').addClass('bullets-item--active');
					$slider.data('currentIndex', curIndex);
				}
			});
		});

		// simple slider    
		$('.js-slider').each(function (_, slider) {
			$(slider).find('.js-item').each(function (index, item) {
				var show = 'block';
				if ($(item).hasClass("techniks__slider-item")) {
					show = 'table';
				}
				var bullet = document.createElement('div');
				bullet.className = 'bullets-item js-bullet' + (index == 0 ? ' bullets-item--active' : '');

				if ($(slider).data('inverse')) {
					$(bullet).addClass('bullets-item--inverse');
				}

				$(slider).data('currentIndex', 0);
				$(slider).next('.js-bullets-container').append(bullet);
				$(item).css({
					position: 'absolute',
					display: index == 0 ? show : 'none'
				});

				if (index == 0) $(item).css({
					transform: 'translateX(0)'
				});

				$(bullet).data('index', index);
			});
		});

		$(document).on('click', '.js-bullet', function () {
			var $slider = $(this).parent().prev();
			var curIndex = $(this).data('index');
			var $item = $slider.find('.js-item:eq(' + curIndex + ')');

			$slider.find('.js-item').not(':eq(' + curIndex + ')').velocity({
				opacity: 0,
				translateX: -50
			}, {
				queue: false,
				display: 'none'
			});
			$item.velocity({
				opacity: 1,
				translateX: [0, -50]
			}, {
				queue: false,
				display: 'table'
			});
			$slider.next('.js-bullets-container').find('.bullets-item').removeClass('bullets-item--active');
			$(this).addClass('bullets-item--active');
			$slider.data('currentIndex', curIndex);
		});

		setTimeout(function () {
			if (location.hash != '') {
				var newSlide = $('.slide[data-anchor="' + location.hash.replace('#', '') + '"]');

				var newSlideIndex = $('.slide').index(newSlide);
				window.previousSlide = window.currentSlide;
				window.currentSlide = newSlideIndex;
				$('.page-slider__item:eq(' + newSlideIndex + ')').addClass('active');
				toSlide(newSlideIndex);
				colorSlider(newSlideIndex);
				setTimeout(function () {
					window.scrollTo(0, $('.slide:eq(' + newSlideIndex + ')').offset().top);
				}, 2000);
			} else toSlide(0);
		});

		$('.scroll-icon').on('click', function () {
			toSlide(1);
		});

		// PAGE SLIDER-----------
		var slider = document.querySelector('.js-page-slider');
		var slides = document.querySelectorAll('.slide');
		for (var index = 0; index < slides.length; index++) {
			var div = document.createElement('div'),
			    slide = slides[index];

			var pagediv = div.cloneNode();
			pagediv.className = 'page-slider__item';
			pagediv.setAttribute('data-id', pad(index + 1));
			document.querySelector('.js-page-slider').appendChild(pagediv);

			pagediv.onclick = function () {
				if (!window.inSliding) {
					var id = parseInt($(this).data('id') - 1);
					if (window.currentSlide == id) return;
					window.currentSlide = id;
					toSlide(id);
				}
			};
		}
	});

	$('.video__content-overlay').on('click', function () {
		$(this).hide();
		$(this).next('iframe').attr('src', 'http://www.youtube.com/embed/' + $(this).data('id') + '?showinfo=0&autoplay=1&rel=0');
	});

	if (!$(document.body).hasClass('mobile')) $('.video__scroll').perfectScrollbar();
	$('.js-video').on('click', function (ev) {
		var $el = $(ev.currentTarget);
		var prevId = $('.video__content-overlay').data('id');
		var prevPreview = $('.video__content-overlay').css('background-image');
		$('.video__content-overlay').show().data('id', $el.data('id')).css('background-image', $el.css('background-image'));

		$('.js-video').parent().removeClass('active');
		$(ev.currentTarget).parent().addClass('active');
		$el.data('id', prevId).css('background-image', prevPreview);
		var iframe = $el.closest('.video__scroll').prev().find('iframe')[0];
		iframe.src = 'about:blank';
	});

	// if ($(document.body).hasClass('mobile')) {
	// 	var maxOsx = window.innerHeight;
	// 	maxOsx = maxOsx > window.innerWidth ? maxOsx : window.innerWidth;
	// 	$('.slide').css('min-height', maxOsx)
	// }		
})(jQuery);
"use strict";

(function ($, w) {
  /*$(document).ready(() => {
    $('[data-metrica]').on('click', function() {
      var metrica = $(this).data('metrica');
      window.yaCounter42617899.reachGoal(metrica);
    })
  })*/
})(jQuery, window);