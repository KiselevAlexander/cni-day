'use strict';

var images = ['arrow.svg', 'calendar__13-active.png', 'calendar__13-inactive.png', 'calendar__13.png', 'calendar__mobile-arrow.png', 'calendar__next-active.png', 'calendar__next.png', 'calendar__prev--mobile.png', 'calendar__prev-active--mobile.png', 'calendar__prev-active.png', 'calendar__prev.png', 'caret.svg', 'close.png', 'close.svg', 'cni__00.svg', 'cni__black.svg', 'cni__e4.svg', 'cni__white.svg', 'comments__avatar.jpg', 'comments__quote.svg', 'comments_avatars/anastasia_blohina.jpg', 'comments_avatars/elena.jpg', 'comments_avatars/irina.jpg', 'comments_avatars/mamina.jpg', 'comments_avatars/nata.jpg', 'contact__contact.png', 'contact__us.png', 'count_bg.png',
    'expert__blob.jpg', 'expert__morozova.jpg', 'expert__partials.png', 'expert__partials1.png', 'expert__partials2.png', 'favicon.png', 'fb.svg',

    'gifts__cream.png', 'gifts__text.png', 'gifts__text__mobile.png', 'insight.png', 'inspiration__abstract.jpg', 'inspiration__mob.jpg', 'inspiration__quote__black.svg', 'inspiration__word.png', 'instagram.svg', 'main__bg.jpg', 'main__bg_mob.jpg', 'mastery__nail_tube_bg.png', 'mastery__nail_tube_bg_mob.png', 'menu__black.png', 'menu__black.svg', 'menu__white.png', 'menu__white.svg', 'ok.svg', 'phone__black.svg', 'phone__white.svg', 'pin.png', 'play-icon.png', 'preloader.png', 'price__blob1.png', 'price__blob2.png', 'price__blob3.png', 'price__expert.png', 'price__must_have.png', 'price__nail_lover.png', 'quote/diana.jpg', 'quote/elena.jpg', 'quote/natalia.jpg', 'quote/Oksana.jpg', 'scroll.svg', 'secrets__partials0-1.png', 'secrets__partials0.png', 'secrets__partials1-1.png', 'secrets__partials1.png', 'secrets__partials2-1.png', 'secrets__partials2.png', 'sets__bg.jpg', 'sets__logo.svg', 'share.png', 'smart__bg.jpg', 'smart__word-mob.jpg', 'smart__word.png', 'twitter.svg', 'vk.svg', 'why__bg.jpg', 'why__text.png', 'wide_menu.svg', 'you__brush.png', 'you__partials.png', 'you__partials1.png', 'you__tube.png', 'you__you.svg', 'youtube.svg'];

var imagesLen = images.length;
var imagesCounter = 0;
var STATIC_PATH = '/static/img/';

    document.addEventListener('DOMContentLoaded', function () {
    for (; images.length;) {
        var nextImg = images.pop();
        var img = document.createElement('img');
        img.onload = function () {
            imagesCounter++;
            var percent = imagesCounter / imagesLen * 100;
            if (percent === 100) {
                percent = 99;
                window.addEventListener('load', function () {
                    var menu = void 0,
                        wrapper = void 0,
                        preloader = void 0;
                    menu = document.querySelector('.menu');
                    wrapper = document.querySelector('.wrapper');
                    preloader = document.querySelector('.preloader');
                    menu.className = menu.className.replace('preload-hidden', '');
                    wrapper.className = wrapper.className.replace('preload-hidden', '');
                    preloader.className = preloader.className += ' preload-hidden';
                });
            };

            document.querySelector('.progress').setAttribute('percent', Math.round(percent) + '%');
            document.querySelector('.mask').style.height = 160 - 160 * (percent / 100) + 'px';
        };

        img.src = STATIC_PATH + nextImg;
    }
});