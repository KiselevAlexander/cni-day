<?

$day = $arParams['DAY'];

?><!DOCTYPE html>
<html>
<head>
    <!-- Site made with Mobirise Website Builder v3.12.1, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v3.12.1, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Уникальная вечеринка-обучение для нейл-мастеров. Розыгрыши, щедрые подарки, море вдохновения и позитива. День, который нельзя пропустить!">

    <meta property="og:url" content="http://<?=$GLOBALS['sCurCity'];?>.cni-day.ru"/>
    <meta property="og:title" content="Nail-семинар в городе <?=$GLOBALS['sCurCityName']?>."/>
    <meta property="og:description"
          content="<?=dateRus($day["DATE"]["VALUE"])?> Уникальная вечеринка-обучение для нейл-мастеров. Розыгрыши, щедрые подарки, море вдохновения и позитива. День, который нельзя пропустить!"/>
    <meta name="description"
          content="<?=dateRus($day["DATE"]["VALUE"])?> Уникальная вечеринка-обучение для нейл-мастеров. Розыгрыши, щедрые подарки, море вдохновения и позитива. День, который нельзя пропустить!"/>
    <meta property="og:image" content="/static/img/cni_share-img.jpg"/>

    <link rel="shortcut icon" href="/local/templates/2018/assets/images/cni-.svg" type="image/x-icon">
    <title>День CNI. г. <?=$arParams['CITY_NAME']?> <?=dateRus($day["DATE"]["VALUE"])?> 2018. Мастер-классы по маникюру</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/local/templates/2018/assets/bootstrap-material-design-font/css/material.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/et-line-font-plugin/style.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/tether/tether.min.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/animate.css/animate.min.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/dropdown/css/style.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/theme/css/style.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/mobirise-gallery/style.css">
    <link rel="stylesheet" href="/local/templates/2018/assets/mobirise/css/mbr-additional.css" type="text/css">



</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter42617899 = new Ya.Metrika({
                    id:42617899,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/42617899" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<section id="ext_menu-9">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="https://mobirise.com" class="navbar-logo"><img src="/local/templates/2018/assets/images/cni-.svg" alt="Mobirise"></a>
                        <a class="navbar-caption" href="/#features1-6">
                            ДЕНЬ CNI <span style="text-transform: uppercase;"><?=$arParams['CITY_NAME']?></span><br>
                            <?=dateRus($day["DATE"]["VALUE"])?> 2018<br>
                        </a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                        <li class="nav-item"><a class="nav-link link" href="/#msg-box5-2">ПРОГРАММА</a></li>
                        <li class="nav-item"><a class="nav-link link" href="/#features1-6">КУПИТЬ БИЛЕТ</a></li>
                        <li class="nav-item"><a class="nav-link link" href="/#gallery2-4">ГАЛЕРЕЯ ДИЗАЙНОВ</a></li>
                        <li class="nav-item"><a class="nav-link link" href="/#contacts2-7">КОНТАКТЫ</a></li>
                        <li class="nav-item nav-btn">
                            <a class="nav-link btn btn-white btn-white-outline"
                               href="tel:<?=$day['PHONE_CODE']['VALUE'].$day['PHONE_NUMBER']['VALUE']?>"
                               onclick="window.yaCounter42617899.reachGoal('Mobile_call');"
                            >
                                <?=$day['PHONE_CODE']['VALUE'].$day['PHONE_NUMBER']['VALUE']?>
                            </a>
                        </li>
                        <li class="nav-item nav-btn"><a class="nav-link btn btn-primary" href="/#form1-8">ЗАПИСАТЬСЯ</a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="mbr-section mbr-section-hero mbr-section-full header2 mbr-after-navbar" id="header2-0" style="background-image: url(/local/templates/2018/assets/images/1-2-2000x1125.jpg);">

    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(0, 0, 0);">
    </div>

    <div class="mbr-table mbr-table-full">
        <div class="mbr-table-cell">

            <div class="container">
                <div class="mbr-section row">
                    <div class="mbr-table-md-up">

                        <div class="mbr-table-cell col-md-5 content-size text-xs-center text-md-right">

                            <h3 class="mbr-section-title display-2">
                                ДЕНЬ CNI<br>
                                <span class="text-uppercase"><?=$arParams['CITY_NAME']?></span>
                            </h3>

                            <div class="mbr-section-text">
                                <p>
                                    <?=$day["DESCRIPTION"]["VALUE"]?>
                                </p>
                            </div>

                            <div class="mbr-section-btn">
                                <a class="btn btn-primary" href="/#form1-8">ЗАПИСАТЬСЯ</a>
                            </div>

                        </div>

                        <div class="mbr-table-cell mbr-valign-top mbr-left-padding-md-up col-md-7 image-size" style="width: 70%;">
                            <?if ($day["YOUTUBE_VIDEO"]["VALUE"]):?>
                            <div class="mbr-figure">
                                <iframe class="mbr-embedded-video"
                                        src="<?=$day["YOUTUBE_VIDEO"]["VALUE"]?>?rel=0&amp;amp;showinfo=0&amp;autoplay=0&amp;loop=0"
                                        width="1280"
                                        height="720"
                                        frameborder="0"
                                        allowfullscreen
                                ></iframe>
                            </div>
                            <?endif;?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="mbr-arrow mbr-arrow-floating hidden-sm-down" aria-hidden="true"><a href="#msg-box5-2"><i class="mbr-arrow-icon"></i></a></div>

</section>
<?if ($day['SPEAKER_NAME']['VALUE']):?>
<section class="mbr-section" id="msg-box5-2" style="background-color: rgb(239, 239, 239); padding-top: 0px; padding-bottom: 0px;">
    <div class="container">
        <div class="row">
            <div class="mbr-table-md-up">

                <div class="mbr-table-cell col-md-5 text-xs-center text-md-right content-size">
                    <h3 class="mbr-section-title display-2 text-uppercase">
                        <?=$day['SPEAKER_NAME']['VALUE'][0]?> <?=$day['SPEAKER_SURNAME']['VALUE'][0]?>
                    </h3>

                    <div class="lead">

                        <p>
                            <?=$day["SPEAKER_DESCRIPTION"]["~VALUE"][0]?>
                        </p>

                    </div>

                </div>

                <div class="mbr-table-cell mbr-left-padding-md-up mbr-valign-top col-md-7 image-size" style="width: 50%;">
                    <div class="mbr-figure">
                        <img src="<?=CFile::getPath($day['SPEAKER_PHOTO']['VALUE'][0])?>">
                    </div>
                </div>

            </div>

            <div class="mbr-table-md-up">

                <div class="mbr-table-cell mbr-left-padding-md-up mbr-valign-top col-md-7 image-size" style="width: 50%;">
                    <div class="mbr-figure">
                        <img src="<?=CFile::getPath($day['SPEAKER_PHOTO']['VALUE'][1])?>">
                    </div>
                </div>

                <div class="mbr-table-cell col-md-5 text-xs-center text-md-right content-size">
                    <h3 class="mbr-section-title display-2 text-uppercase">
                        <?=$day['SPEAKER_NAME']['VALUE'][1]?> <?=$day['SPEAKER_SURNAME']['VALUE'][1]?>
                    </h3>

                    <div class="lead">

                        <p>
                            <?=$day["SPEAKER_DESCRIPTION"]["~VALUE"][1]?>
                        </p>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<?endif;?>
<section class="mbr-section" id="msg-box5-2" style="background-color: rgb(239, 239, 239); padding-top: 0px; padding-bottom: 0px;">


    <div class="container">
        <div class="row">
            <div class="mbr-table-md-up">

                <div class="mbr-table-cell col-md-5 text-xs-center text-md-right content-size">
                    <h3 class="mbr-section-title display-2 text-uppercase">
                        <?=$arParams['CITY_NAME']?>, <?=dateRus($day["DATE"]["VALUE"])?><br>
                        ДЕНЬ CNI
                    </h3>
                    <div class="lead">

                        <p>
                            <?=$day["DESCRIPTION_2"]["~VALUE"]["TEXT"]?>
                        </p>

                    </div>

                    <div>
                        <a class="btn btn-primary" href="/#form1-8">ЗАПИСАТЬСЯ</a>
                    </div>
                </div>

                <div class="mbr-table-cell mbr-left-padding-md-up mbr-valign-top col-md-7 image-size" style="width: 50%;">
                    <div class="mbr-figure"><img src="/local/templates/2018/assets/images/mix-1400x1400.jpg"></div>
                </div>

            </div>
        </div>
    </div>

</section>

<section class="mbr-section mbr-section__container article" id="header3-5" style="background-color: rgb(255, 255, 255); padding-top: 80px; padding-bottom: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="mbr-section-title display-2">ЧЕМУ ВЫ НАУЧИТЕСЬ НА ДНЕ CNI</h3>
                <small class="mbr-section-subtitle"></small>
            </div>
        </div>
    </div>
</section>

<section class="mbr-gallery mbr-section mbr-section-nopadding mbr-slider-carousel" id="gallery2-4" data-filter="false" style="padding-top: 3rem; padding-bottom: 6rem;">
    <!-- Filter -->


    <!-- Gallery -->
    <div class="mbr-gallery-row container">
        <div class=" mbr-gallery-layout-default">

                    <?
                    foreach ($day["TECHNIKS_SLIDER"]["VALUE"] as $k=>$v){
                        $text = explode("head",$day["TECHNIKS_SLIDER"]["DESCRIPTION"][$k]);
                        ?>
                        <div class="mbr-gallery-item mbr-gallery-item__mobirise3 mbr-gallery-item--p0" data-tags="Animated" data-video-url="false">
                            <div href="#lb-gallery2-4" data-slide-to="0" data-toggle="modal">

                                <img alt="" src="<?=CFile::getPath($v)?>">

                                <span class="icon-focus"></span>

                                <span class="mbr-gallery-title"><?=$text[0]?><br><?=$text[1]?></span>
                            </div>
                        </div>
                    <?}?>

            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Lightbox -->
    <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery2-4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="carousel-inner">
                        <?
                        foreach ($day["TECHNIKS_SLIDER"]["VALUE"] as $k=>$v){
                            ?>
                            <div class="carousel-item<?=($k === 0) ? ' active': ''?>">
                                <img alt="" src="<?=CFile::getPath($v)?>">
                            </div>
                        <?}?>
                    </div>
                    <a class="left carousel-control" role="button" data-slide="prev" href="#lb-gallery2-4">
                        <span class="icon-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" role="button" data-slide="next" href="#lb-gallery2-4">
                        <span class="icon-next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <a class="close" href="#" role="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-cards mbr-section mbr-section-nopadding" id="features1-6" style="background-color: rgb(255, 255, 255);">



    <div class="mbr-cards-row row striped">

        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 40px; padding-bottom: 40px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="/local/templates/2018/assets/images/-600x399.jpg" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title text-uppercase">ДЕНЬ CNI <?=$arParams['CITY_NAME']?></h4>
                        <h5 class="card-subtitle">5 мастер-классов</h5>
                        <p class="card-text">
                            ● Моделирование ногтей гелем<br>
                            ● Укрепление ногтей<br>
                            ● Тонкости работы с гель-лаками<br>
                            ● Маникюр и инструменты<br>
                            ● 5 техник нейл-дизайна<br>
                            ***<br>
                            Розыгрыши, Подарки, Главный приз - MIX-лампа.<br>Скидка 15% на продукцию CNI.&nbsp;Фуршет и праздник.<br>
                            ***<br>
                            Стоимость участия = <strong>1000 р.</strong></p>
                        <div class="card-btn"><a href="/#form1-8" class="btn btn-danger">ЗАПИСАТЬСЯ</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mbr-cards-col col-xs-12 col-lg-6" style="padding-top: 40px; padding-bottom: 40px;">
            <div class="container">
                <div class="card cart-block">
                    <div class="card-img"><img src="/local/templates/2018/assets/images/93db23e5-5978-40c3-87e9-0bcb352ab561-600x410.jpg" class="card-img-top"></div>
                    <div class="card-block">
                        <h4 class="card-title">"АКВАРЕЛЬ"</h4>
                        <h5 class="card-subtitle">Семинар с отработкой</h5>
                        <p class="card-text">
                            5-часовой семинар с отработкой на моделях:<br>
                            ●&nbsp;<u>Акварельные цветы</u><br>
                            ●&nbsp;<u>Геометрия Акварелью</u><br>
                            ●&nbsp;<u>Абстракция.</u><br>
                            ***<br>
                            Всего 10 мест! Материалы предоставляются.&nbsp;<br>
                            Кисти и инструменты ученик приобретает самостоятельно.<br>
                            ***<br>
                            Стоимость обучения = <strong>2000 р.</strong>
                        </p>
                        <div class="card-btn"><a href="/#form1-8" class="btn btn-primary">ЗАПИСАТЬСЯ</a></div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</section>

<section class="mbr-section mbr-section-md-padding mbr-footer footer2" id="contacts2-7" style="background-color: rgb(40, 50, 78); padding-top: 90px; padding-bottom: 90px;">

    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p>
                    <strong>АДРЕС</strong><br>
                    <?=$day['PLACE_ADDRESS']['VALUE']?><br><br>
                    <strong>Контакты</strong><br>
                    Email: <a href="mailto:<?=$day['MAIL']['VALUE']?>" style="color: #fff;"><?=$day['MAIL']['VALUE']?></a><br><br>
                    Тел.: <strong><a href="tel:+74932371714" style="color: #fff;" onclick="window.yaCounter42617899.reachGoal('Mobile_call');"><?=$day['PHONE_CODE']['VALUE'].$day['PHONE_NUMBER']['VALUE']?></a></strong><br>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p class="mbr-contacts__text"><strong>ССЫЛКИ</strong></p>
                <ul>
                    <li><a href="https://www.instagram.com/cni_event/" target="_blank">Instagram</a></li>
                    <li><a href="http://ru.cni-corporation.com/" target="_blank">Официальный сайт корпорации CNI</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="mbr-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:ChIJb6ufNUAUTUER5Efm7WYCyFI" allowfullscreen=""></iframe></div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section" id="form1-8" style="background-color: rgb(255, 255, 255); padding-top: 40px; padding-bottom: 120px;">

    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <h3 class="mbr-section-title display-2">ОСТАВЬТЕ ЗАЯВКУ</h3>
                    <small class="mbr-section-subtitle">чтобы гарантированно попасть на главное событие нейл-индустрии в вашем городе!</small>
                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">


                    <div data-form-alert="true">
                        <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Благодарим за заявку на участие. Сегодня с Вами свяжется менеджер и расскажет, как забрать билет!</div>
                    </div>


                    <form action="/local/templates/2018/" method="post" data-form-title="ОСТАВЬТЕ ЗАЯВКУ">

                        <input type="hidden" value="d+W6CUmCvzkkK6cu/pvPGiAJ6ddQRsLROu7TqRMCF4NT3eN2DDvw2p7gOo95/up4QNIyDpyYUoMxWrbYzp1cbEM2lUv+i2sBnxFOmIP0FFn2GnYH1IawHyEQBCvqCFz4" data-form-email="true">

                        <input data-form-sendto="true" type="hidden" name="sendto" value="<?=implode(',', $day['SEND_MAIL_ADDRESS']['VALUE'])?>">

                        <div class="row row-sm-offset">

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-8-name">Имя<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" required="" data-form-field="Name" id="form1-8-name">
                                </div>
                            </div>



                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-8-phone">Телефон<span class="form-asterisk">*</span></label>
                                    <input type="tel" class="form-control" name="phone" data-form-field="Phone" id="form1-8-phone">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="form1-8-message">Комментарии</label>
                            <textarea class="form-control" name="message" rows="7" data-form-field="Message" id="form1-8-message"></textarea>
                        </div>

                        <div><button type="submit" class="btn btn-primary">ЗАПИСАТЬСЯ</button></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/local/templates/2018/assets/tether/tether.min.js"></script>
<script src="/local/templates/2018/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/local/templates/2018/assets/smooth-scroll/smooth-scroll.js"></script>
<script src="/local/templates/2018/assets/viewport-checker/jquery.viewportchecker.js"></script>
<script src="/local/templates/2018/assets/masonry/masonry.pkgd.min.js"></script>
<script src="/local/templates/2018/assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/local/templates/2018/assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js"></script>
<script src="/local/templates/2018/assets/dropdown/js/script.min.js"></script>
<script src="/local/templates/2018/assets/touch-swipe/jquery.touch-swipe.min.js"></script>
<script src="/local/templates/2018/assets/theme/js/script.js"></script>
<script src="/local/templates/2018/assets/mobirise-gallery/player.min.js"></script>
<script src="/local/templates/2018/assets/mobirise-gallery/script.js"></script>
<script src="/local/templates/2018/assets/formoid/formoid.min.js"></script>


<input name="animation" type="hidden">

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter42617899 = new Ya.Metrika({
                    id:42617899,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/42617899" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>