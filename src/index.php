<?php include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// посмотрим какой город был выбран этим юзером в прошлый раз
$sUserCity = $APPLICATION->get_cookie('USER_CITY');
// установим глобальную переменную cur_city = код города (из сабдомена)
$GLOBALS['sCurCity'] = preg_replace('/^(?:([^\.]+)\.)?cni-day\.ru$/', '\1', $_SERVER['SERVER_NAME']);
// символьные коды возможных городов и полные описания возможных городов
$arCityCodes = $arCities = array();

// кэшируем подключение модуля инфоблоков и выборку возможных городов
$obCache = new CPHPCache;
$iLifeTime = 60*60*3;


$sCacheID = SITE_ID.'City';

/**
 * Очистка кеша
 */
if (isset($_GET['clear_cache'])) {

    $obCache->clean($sCacheID, '/');

}


// если кеш есть и он ещё не истек, то
if($obCache->InitCache($iLifeTime, $sCacheID, '/')) {
    // получаем закешированные переменные
    $arVars = $obCache->GetVars();
    $arCityCodes = $arVars['arCityCodes'];
    $arCities = $arVars['arCities'];
}
else {
    // иначе обращаемся к базе
    // получим список всех возможных городов на сайте
    if (CModule::IncludeModule('iblock')) {
        // узнаем все города на сайте с непустым кодом
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");
        $arFilter = Array('IBLOCK_ID'=>1, 'GLOBAL_ACTIVE'=>'Y', '!code'=>false);
        $dbCities = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
        // заполняем ими массивы $arCityCodes и $arCities

        while ($arCity = $dbCities->GetNextElement()) {
            $arFields = $arCity->GetFields();
            $arCityCodes[] = $arFields['CODE'];
            $arCities[] = array(
                "NAME" => $arFields['NAME'],
                "ID" => $arFields["ID"],
                "CODE" => $arFields['CODE']
            );
        }
        if (empty($arCityCodes)) ShowError('Нет городов');
    } else ShowError('Не получилось подключить модуль «iblock»');
}
if($obCache->StartDataCache()) $obCache->EndDataCache(array('arCityCodes' => $arCityCodes, 'arCities' => $arCities));
// конец кэширования

foreach ($arCities as $arCity) {
    if ($arCity['CODE'] == $sCurCity) {
        // запишем название города (позже пригодится где-нибудь)
        $GLOBALS['sCurCityName'] = $arCity['NAME'];
        // это самое главное, id нам нужен будет для фильтров
        $GLOBALS['iCurCityID'] = $arCity['ID'];
    }
}


// если запрошен сайт с пустым или неверным сабдоменом
if (!in_array($sCurCity,$arCityCodes) && !empty($sCurCity)) {
    // то если существует валидная кука
    if (in_array($sUserCity,$arCityCodes)) {
        // редирект на город записанный в куках
//        header("Location: http://cni-test.insightag.beget.tech");
    } else {
        // если кука не валидная или ее не существует
        // Устанавливаем ее и редиректим на 1й город по сортировке городов
        $APPLICATION->set_cookie('USER_CITY', $arCityCodes[0]);
        // header("Location: http://cni-day.ru");
    }
}
// после всех редиректов устанавливаем куку на текущий город
if (strlen($sCurCity)) $APPLICATION->set_cookie('USER_CITY', $sCurCity);
// установим фильтр, который будем повсеместно применять
// для списков элементов на сайте, где предполагается зависимость от города
//получаем инфо из ИБ
CModule::IncludeModule('iblock');
//echo "<pre>";
$arSelect = Array("ID", "IBLOCK_ID", "PROPERTIES_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_ID" => 1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID" => $iCurCityID);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement()){
    $day = $ob->GetProperties();

}

//echo "</pre>";
function dateRus ($date){
    $date = explode(".", $date);
    $result = $date[0]." ";
    switch ($date[1]) {
        case "01" :
            $result .= "января";
            break;
        case "02" :
            $result .= "февраля";
            break;
        case "03" :
            $result .= "марта";
            break;
        case "04" :
            $result .= "апреля";
            break;
        case "05" :
            $result .= "мая";
            break;
        case "06" :
            $result .= "июня";
            break;
        case "07" :
            $result .= "июля";
            break;
        case "08" :
            $result .= "августа";
            break;
        case "09" :
            $result .= "сентября";
            break;
        case "10" :
            $result .= "октября";
            break;
        case "11" :
            $result .= "ноября";
            break;
        case "12" :
            $result .= "декабря";
            break;
    }
    return $result;
}
function designOut($count){
    $count = substr($count, -1);
    switch ($count){
        case "0":
        case "5":
        case "6":
        case "7":
        case "8":
        case "9":
            return "дизайнов";
        case "1":
            return "дизайн";
        case "2":
        case "3":
        case "4":
            return "дизайна";

    }
};
function dayOut($count){
    $count = substr($count, -1);
    switch ($count){
        case "0":
        case "5":
        case "6":
        case "7":
        case "8":
        case "9":
            return "дней";
        case "1":
            return "день";
        case "2":
        case "3":
        case "4":
            return "дня";

    }
}
$now = new DateTime(date("Y-m-d", time()));
if ($day["DATE"]["VALUE"]) {
    $dateWill = explode(".",$day["DATE"]["VALUE"]);
    $dateFut = new DateTime($dateWill[2]."-".$dateWill[1]."-".$dateWill[0]);
} else {
    $dateFut = new DateTime(date("Y-m-d", time()));
}

$interval = $dateFut->diff($now);
$days = $interval->days;
$priceall = array(
    $day["TICKET_1_LOWPRICE"]["VALUE"],
    $day["TICKET_2_LOWPRICE"]["VALUE"],
    $day["TICKET_3_LOWPRICE"]["VALUE"]
);
$price1 = $day["TICKET_1_LOWPRICE"]["VALUE"];
$price2 = $day["TICKET_2_LOWPRICE"]["VALUE"];
$price3 = $day["TICKET_3_LOWPRICE"]["VALUE"];

if ($days <= 10){
    $price1 = $day["TICKET_1_HIGHPRICE"]["VALUE"];
    $price2 = $day["TICKET_2_HIGHPRICE"]["VALUE"];
    $price3 = $day["TICKET_3_HIGHPRICE"]["VALUE"];
    $priceall = array(
        $day["TICKET_1_HIGHPRICE"]["VALUE"],
        $day["TICKET_2_HIGHPRICE"]["VALUE"],
        $day["TICKET_3_HIGHPRICE"]["VALUE"]
    );
}


/**
 * Тестирование под админом
 */

//global $USER;
//if ($USER->IsAdmin()) {
//    var_dump($arCityCodes);
//    die('test');
//}

?>
<!DOCTYPE html>
<html lang="ru"></html>
<head>
    <meta charset="UTF-8"/>
    <title>CNI - Дизайн. технологии. моделирование. <?= dateRus($day["DATE"]["VALUE"])?>, <?= $sCurCityName?></title>
    <script src="/preload.js"></script>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png?v=2"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
    <?
    /**
     * Кастомные стили для каждого города отдельно
     */
    if (is_file($_SERVER['DOCUMENT_ROOT'] . '/css/cities/' . $GLOBALS['sCurCity'] . '.css')) {
        ?>
        <link rel="stylesheet" href="<?='/css/cities/' . $GLOBALS['sCurCity'] . '.css'?>">
        <?
    }
    ?>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1"/>
    <meta property="og:url" content="http://<?=$GLOBALS['sCurCity'];?>.cni-day.ru"/>
    <meta property="og:title" content="Nail-семинар в городе <?= $GLOBALS['sCurCityName']?>."/>
    <meta property="og:description"
          content="<?= dateRus($day["DATE"]["VALUE"])?> в Galich Hall пройдет день CNI с Еленой Морозовой. В программе новинки моделирования и дизайна, подарки и nail-вечеринка"/>
    <meta name="description"
          content="<?= dateRus($day["DATE"]["VALUE"])?> в Galich Hall пройдет день CNI с Еленой Морозовой. В программе новинки моделирования и дизайна, подарки и nail-вечеринка"/>
    <meta property="og:image" content="img/cni_share-img.jpg"/>

    <script async="async" type="text/javascript">(function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter42617899 = new Ya.Metrika({
                        id:42617899,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        trackHash:true
                    });
                } catch (e) {
                }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () {
                    n.parentNode.insertBefore(s, n);
                };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <script type="text/javascript">!function (f, b, e, v, n, t, s) {
            if (f.fbq)return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq)f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1882222438663563'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=1882222438663563&amp;ev=PageView&amp;noscript=1"/></noscript>
</head>
<body>
<?php $tickets = json_decode(file_get_contents('./tickets.json'), true); ?>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/42617899" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>

<div class="preloader preload">

    <div class="mask">
        <div class="empty"></div>
    </div>

    <div percent="0%" class="progress"></div>

</div>

<div class="overlay">
    <div class="tooltip">Обязательное поле</div>
    <div class="popup">

        <a href="javascript:void(0);" class="close js-close-popup"></a>

        <div class="tube">
            <img src="img/you__tube.png"/>
        </div>

        <div class="form">
            <?if ($days > 10){?>
                <div class="title">
                    <span class="title--stop">stop-</span>
                    <span class="title--cena">
                        цена
                        <div class="title__second">
                            Забери свой билет, пока не подорожал(осталось <?= ($days-10)?> <?= dayOut($days-10)?>)
                        </div>
                    </span>
                </div>
            <?}
            else {
                ?>
                <div class="title">
                    <span class="title--cena">
                        цена
                        <div class="title__second">До начала осталось <?= $days?> дней</div>
                    </span>
                </div>
                <?
            }?>

            <form class="form__form">

                <input name="goal" type="hidden"/>
                <input name="price" type="hidden"/>

                <div class="form__input js-input">
                    <input name="name"
                           type="text"
                           placeholder="Ваше имя"
                           class="js-required-name"
                    />
                </div>
                <div class="form__input js-input">
                    <input name="phone"
                           type="tel"
                           placeholder="Номер телефона"
                           class="js-required js-phone-mask"
                    />
                </div>
                <div class="form__input js-input">
                    <input name="mail"
                           type="text"
                           placeholder="Email"
                           class="js-required-mail"
                    />
                </div>
                <div class="form__input js-input">
                    <select id="product" name="product" class="js-product-select">
                        <?
                        $i=1;
                        do {
                            ?>
                            <option value="price<?= $i?>"><?= strip_tags($day["TICKET_".$i."_NAME"]["~VALUE"])?> | <?= $priceall[$i-1]?></option>
                            <?
                            $i++;
                        } while (!empty($day["TICKET_".$i."_NAME"]["~VALUE"]))?>
                    </select>
                </div>

                <div class="form__input js-input button__buy">

                    <button class="popup-button js-popup-button">
                        купить билет онлайн
                    </button>

                    <div class="form__input__text">
                        Вы можете приобрести билет сразу онлайн<br> и не тратить время на оплату
                    </div>

                </div>

                <div class="form__input js-input button__reserved">

                    <button type="submit" class="popup-button js-popup-button">
                        забронировать билет
                    </button>

                    <div class="form__input__text">
                        Мы бронируем для Вас билет, после с Вами<br> свяжется менеджер
                    </div>

                </div>
            </form>
        </div>
        <div class="form__complete hidden">
            <div class="form__complete__wrapper">
                <div class="title"><span class="title--stop">Thank you!<div class="title__second">
                    Спасибо, что оставили заявку.<br/>Скоро наш менеджер свяжется с Вами.
                </div></span></div>
                <div class="close-wrapper"><a class="button button--blue js-close-popup">Закрыть</a></div>
            </div>
        </div>
    </div>
</div>
<div id="musthave" class="popup-price">
    <div class="overlay"></div>
    <div class="popup-price__container"><a href="javascript:void(0)" class="popup-price__close js-close-popup"></a>

        <div class="popup-price__header popup-price__header--musthave">
            <div class="popup-price__header-name"><?= strip_tags($day["TICKET_2_NAME"]["~VALUE"]);?></div>
            <div class="popup-price__header-date"><?= strip_tags($day["TICKET_2_DATE"]["~VALUE"]);?></div>
        </div>
        <?foreach ($day["TICKET_2_PROGRAMM_MORE"]["VALUE"] as $k=>$v){
            $text = explode("br",$day["TICKET_2_PROGRAMM_MORE"]["DESCRIPTION"][$k])?>
            <div class="popup-price__container-element">
                <div class="popup-price__title"><span class="price__icon" style="background-image: url('<?= CFile::getPath($v)?>')"></span><?= $text[0]?></div>
                <ul class="popup-price__keys">
                    <?$i = 1;
                    do {
                        ?>
                        <li><?= $text[$i]?></li>
                        <?
                        $i++;
                    } while ($i<count($text));?>
                </ul>
            </div>
        <?}?>
        <div class="popup-price__container-element">
            <div class="price__bottom"><span class="price__value"><?= $price2?> <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                                     x="0px" y="0px" width="13.5px" height="27px" viewBox="0 0 13.5 27" style="enable-background:new 0 0 13.5 27;" xml:space="preserve"> <style type="text/css"> .st0 {
                                stroke: #FFFFFF;
                                stroke-width: 0.5;
                                stroke-miterlimit: 10;
                            } </style> <defs> </defs> <path class="st0" d="M6.4,16.1c1.7,0,3.4-0.5,4.7-1.7s2.2-3.2,2.2-6.2c0-3-0.9-5-2.2-6.3s-3-1.7-4.7-1.7H2.5v11.9H0.2V16h2.3v2.3 H0.2v3.6h2.3v4.8h3.9v-4.8h5.1v-3.6H6.4V16.1z M6.4,4.2c1.2,0,1.9,0.3,2.4,0.9c0.4,0.6,0.5,1.7,0.5,3.2s-0.1,2.4-0.5,3 c-0.4,0.6-1.2,0.8-2.4,0.8V4.2z"/> </svg></span><span
                        class="price__ticket-left">
                    <span class="price__ticket-left-value"><?= $day["TICKET_2_QUANTITY"]["VALUE"];?></span>
                    <div class="price__ticket-left-text">
                        осталось<br>мест
                    </div>
                </span>
                <a
                        data-selected="price1"
                        data-cost="<?= $price2?>"
                        data-metrica="11scrn_send_NE"
                        text="купить"
                        class="button button--white js-open-popup"
                >
                    купить
                </a>
            </div>
        </div>
        <div class="popup-price__big-close js-close-popup">
            <div class="close-text">Закрыть</div>
            <div class="close-button"></div>
        </div>
    </div>
</div>

<div id="nailexpert" class="popup-price">
    <div class="overlay"></div>
    <div class="popup-price__container">

        <a href="javascript:void(0)" class="popup-price__close js-close-popup"></a>

        <div class="popup-price__header popup-price__header--nailexpert">
            <div class="popup-price__header-name"><?= strip_tags($day["TICKET_3_NAME"]["~VALUE"]);?></div>
            <div class="popup-price__header-date"><?= strip_tags($day["TICKET_3_DATE"]["~VALUE"]);?></div>
        </div>
        <?foreach ($day["TICKET_3_PROGRAMM_MORE"]["VALUE"] as $k=>$v){
            $text = explode("br",$day["TICKET_3_PROGRAMM_MORE"]["DESCRIPTION"][$k])?>
            <div class="popup-price__container-element">
                <div class="popup-price__title">
                    <span class="price__icon" style="background-image: url('<?= CFile::getPath($v)?>')"></span>
                    <?= $text[0]?>
                </div>
                <ul class="popup-price__keys">
                    <?$i = 1;
                    do {
                        ?>
                        <li><?= $text[$i]?></li>
                        <?
                        $i++;
                    } while ($i<count($text));?>
                </ul>
            </div>
        <?}?>
        <div class="popup-price__container-element">
            <div class="price__bottom">

                <span class="price__value">
                    <?= $price3?> <svg x="0px" y="0px" width="13.5px" height="27px" viewBox="0 0 13.5 27" style="enable-background:new 0 0 13.5 27;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                stroke: #FFFFFF;
                                stroke-width: 0.5;
                                stroke-miterlimit: 10;
                            }
                        </style>
                        <defs> </defs>
                        <path class="st0" d="M6.4,16.1c1.7,0,3.4-0.5,4.7-1.7s2.2-3.2,2.2-6.2c0-3-0.9-5-2.2-6.3s-3-1.7-4.7-1.7H2.5v11.9H0.2V16h2.3v2.3 H0.2v3.6h2.3v4.8h3.9v-4.8h5.1v-3.6H6.4V16.1z M6.4,4.2c1.2,0,1.9,0.3,2.4,0.9c0.4,0.6,0.5,1.7,0.5,3.2s-0.1,2.4-0.5,3 c-0.4,0.6-1.2,0.8-2.4,0.8V4.2z"/>
                    </svg>
                </span>

                <span class="price__ticket-left">

                    <span class="price__ticket-left-value">
                        <?= $day["TICKET_3_QUANTITY"]["VALUE"]?>
                    </span>

                    <div class="price__ticket-left-text">
                        осталось<br>мест
                    </div>

                </span>

                <a data-selected="price2"
                   data-cost="<?= $price3?>"
                   data-metrica="11scrn_send_NE"
                   text="купить"
                   class="button button--white js-open-popup"
                >
                    купить
                </a>
            </div>
        </div>
        <div class="popup-price__big-close js-close-popup">
            <div class="close-text">Закрыть</div>
            <div class="close-button"></div>
        </div>
    </div>
</div>

<div id="naillover" class="popup-price">
    <div class="overlay"></div>
    <div class="popup-price__container">

        <a href="javascript:void(0)" class="popup-price__close js-close-popup"></a>

        <div class="popup-price__header popup-price__header--naillover">
            <div class="popup-price__header-name"><?= strip_tags($day["TICKET_1_NAME"]["~VALUE"]);?></div>
            <div class="popup-price__header-date"><?= strip_tags($day["TICKET_1_DATE"]["~VALUE"]);?></div>
        </div>

        <?foreach ($day["TICKET_1_PROGRAMM_MORE"]["VALUE"] as $k=>$v){
            $text = explode("br",$day["TICKET_1_PROGRAMM_MORE"]["DESCRIPTION"][$k])?>
            <div class="popup-price__container-element">
                <div class="popup-price__title">
                    <span class="price__icon" style="background-image: url('<?= CFile::getPath($v)?>')"></span>
                    <?= $text[0]?>
                </div>
                <ul class="popup-price__keys">
                    <?$i = 1;
                    do {
                        ?>
                        <li><?= $text[$i]?></li>
                        <?
                        $i++;
                    } while ($i<count($text));?>
                </ul>
            </div>
        <?}?>
        <div class="popup-price__container-element">
            <div class="price__bottom">
                <span class="price__value">
                    <?= $price1?> <svg x="0px" y="0px" width="13.5px" height="27px" viewBox="0 0 13.5 27" style="enable-background:new 0 0 13.5 27;">
                        <style type="text/css">
                            .st0 {
                                stroke: #FFFFFF;
                                stroke-width: 0.5;
                                stroke-miterlimit: 10;
                            }
                        </style>
                        <defs> </defs>
                        <path class="st0" d="M6.4,16.1c1.7,0,3.4-0.5,4.7-1.7s2.2-3.2,2.2-6.2c0-3-0.9-5-2.2-6.3s-3-1.7-4.7-1.7H2.5v11.9H0.2V16h2.3v2.3 H0.2v3.6h2.3v4.8h3.9v-4.8h5.1v-3.6H6.4V16.1z M6.4,4.2c1.2,0,1.9,0.3,2.4,0.9c0.4,0.6,0.5,1.7,0.5,3.2s-0.1,2.4-0.5,3 c-0.4,0.6-1.2,0.8-2.4,0.8V4.2z"/>
                    </svg>
                </span>
                <span class="price__ticket-left">
                    <span class="price__ticket-left-value"><?= $day["TICKET_1_QUANTITY"]["VALUE"]?></span>
                    <div class="price__ticket-left-text">
                        осталось<br>мест
                    </div>
                </span>
                <a data-selected="price2"
                   data-cost="<?= $price1?> "
                   data-metrica="11scrn_send_NE"
                   text="купить"
                   class="button button--white js-open-popup"
                >
                    купить
                </a>
            </div>
        </div>
        <div class="popup-price__big-close js-close-popup">
            <div class="close-text">Закрыть</div>
            <div class="close-button"></div>
        </div>
    </div>
</div>
<!-- --- MENU-->
<div class="menu preload preload-hidden">

    <a href="javascript:void(0);"
       class="menu__cni menu__cni--white js-cni"
    >
        Дни<br><?= $day["IN_CITY"]["VALUE"]?>
    </a>

    <a href="javascript:void(0);"
       class="menu__cni menu__cni--black js-cni"
    >
        Дни<br><?= $day["IN_CITY"]["VALUE"]?>
    </a>

    <a href="javascript:void(0);"
       class="menu__burger menu__burger--white js-menu"
    ></a>

    <a href="javascript:void(0);"
       class="menu__burger menu__burger--black js-menu"
    ></a>

    <a href="tel:<?= $day['PHONE_CODE']['VALUE'].$day['PHONE_NUMBER']['VALUE']?>"
       data-metrica="20_Mobile_call"
       class="menu__phone-mobile"
    ></a>

    <a href="tel:<?= $day["PHONE_CODE"].$day['PHONE_NUMBER']['VALUE']?>"
       data-metrica="20_Mobile_call"
       class="menu__phone menu__phone--white"
    >
        <div class="prefix"><?= $day["PHONE_CODE"]["VALUE"]?></div>
        <div class="afix"><?= $day['PHONE_NUMBER']["VALUE"]?></div>
    </a>

    <a href="#" class="menu__buy menu__buy--white">
        <div data-metrica="01scrn_send" text="купить билет" class="buy js-open-popup">купить билет</div>
        <div data-metrica="01scrn_send" text="купить" class="buy mobile--hidden js-open-popup">записаться</div>
    </a>

    <a href="tel:<?= $day['PHONE_CODE']['VALUE'].$day['PHONE_NUMBER']['VALUE']?>"
       data-metrica="20_Mobile_call"
       class="menu__phone menu__phone--black"
    >
        <div class="prefix"><?= $day["PHONE_CODE"]["VALUE"]?></div>
        <div class="afix"><?= $day['PHONE_NUMBER']["VALUE"]?></div>
    </a>

    <a href="#" class="menu__buy menu__buy--black">
        <div data-metrica="01scrn_send" text="купить билет" class="buy js-open-popup">купить билет</div>
        <div data-metrica="01scrn_send" text="купить" class="buy mobile--hidden js-open-popup">записаться</div>
    </a>

    <a class="menu__close js-close"></a>

</div>

<div class="menu__container">
    <a href="#expert" class="menu__item">Спикер</a>
    <a href="#comments" class="menu__item">Отзывы </a>
    <a href="#calendar" class="menu__item">Программа</a>
    <a href="#sets" class="menu__item">Формат</a>
    <a href="#price" href="#contact" class="menu__item">Контакты</a>
</div>

<div class="wrapper preload preload-hidden">
    <div class="page-slider page-slider--black js-page-slider"></div>
    <div class="slide__container"><!-- --- parallaxed overflowed items-->
        <div class="you-tube"></div>
        <div data-layer="5" data-slide="1"
             class="you-particles you-particles--1 js-particles js-mouse-parallax-translate-low"></div>
        <div data-layer="2" data-slide="1"
             class="you-particles you-particles--2 js-particles js-mouse-parallax-translate-mid"></div>
        <div class="you-text">
            <div data-layer="3" data-slide="1" class="you-wish js-particles">Ты должна это увидеть</div>
            <div class="you-you"></div>
        </div>

        <!-- ---  -->
        <div data-anchor="main" data-menu="000" data-slider-cls="black" class="slide">

            <div class="main__bg-black">

                <div class="main__bg">

                    <div class="main__container">

                        <div class="main-logo">ДЕНЬ CNI</div>

                        <div class="main-title">
                            <?= $day["DESCRIPTION"]["VALUE"]?>
                        </div>

                        <div class="main-days"><?= dateRus($day["DATE"]["VALUE"])?>, <?= $day["PLACE_NAME_RUS"]["VALUE"]?></div>

                        <div class="main-button">
                            <a data-metrica="01scrn_send"
                               text="купить билет"
                               class="button js-open-popup"
                            >
                                купить билет
                            </a>
                        </div>
                    </div>
                    <div class="scroll-icon">Узнать больше</div>
                </div>
            </div>
        </div>

        <div data-anchor="you" data-menu="101" data-slider-cls="white" class="slide you-mobile">
            <div class="you-brush"></div>
        </div>

        <div data-anchor="secrets" data-menu="000" data-slider-cls="blue" class="slide secret-slide">

            <div class="secrets-bg"></div>

            <div class="particles-wrapper">
                <div data-layer="2" data-slide="2"
                     class="secrets-particle secrets-particle--1-0 js-particles js-mouse-parallax-translate-high"></div>
                <div data-layer="2" data-slide="2"
                     class="secrets-particle secrets-particle--1-1 js-particles js-mouse-parallax-translate-high"></div>
                <div data-layer="4" data-slide="2"
                     class="secrets-particle secrets-particle--2-0 js-particles js-mouse-parallax-translate-mid"></div>
                <div data-layer="4" data-slide="2"
                     class="secrets-particle secrets-particle--2-1 js-particles js-mouse-parallax-translate-mid"></div>
                <div data-layer="6" data-slide="2"
                     class="secrets-particle secrets-particle--3-0 js-particles js-mouse-parallax-translate-low"></div>
                <div data-layer="6" data-slide="2"
                     class="secrets-particle secrets-particle--3-1 js-particles js-mouse-parallax-translate-low"></div>
            </div>

            <div class="secrets__container">

                <div class="secrets__left">
                    <div class="secrets-number">4</div>
                    <div class="secrets-text">4 мастер-класса в один день:

                        <ul class="secrets-text-under">
                            <li>Наращивание и Baby Nails</li>
                            <li>Экспресс-маникюр и гель-лаки</li>
                            <li>Smart-маникюр за 60 минут</li>
                            <li>Тренды сезона в дизайне ногтей</li>
                        </ul>

                        <a data-metrica="01scrn_send"
                           text=""
                           class="button-secret js-open-popup"
                        >
                            купить билет
                        </a>

                    </div>
                </div>

                <div class="secrets__right">
                    <div class="secrets-number">6</div>
                    <div class="secrets-text">6 возможностей для nail-стилиста:
                        <ul class="secrets-text-under">
                            <li>Пошаговые инструкции для эталонных ногтей</li>
                            <li>Призы и розыгрыш MIX-лампы</li>
                            <li>Вечеринка с фуршетом</li>
                            <li>Скидка 20% на продукцию</li>
                            <li>Презентация новых коллекций</li>
                            <li>Сертификат участника</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div data-anchor="techniks" data-menu="000" data-slider-cls="black" class="slide techniks">

            <div class="techniks__bg">

                <div class="techniks__slider js-slider">

                    <div class="title"><?= $day["TECHNIKS_HEADER"]["VALUE"]?></div>

                    <?
                    foreach ($day["TECHNIKS_SLIDER"]["VALUE"] as $k=>$v){
                        $text = explode("head",$day["TECHNIKS_SLIDER"]["DESCRIPTION"][$k]);
                        ?>

                        <div class="techniks__slider-item js-item">

                            <div class="person-container">

                                <img class="img avatar"
                                     src="<?= CFile::getPath($v)?>"
                                />

                            </div>

                            <div class="text">
                                <div class="text__title">
                                    <?= $text[0]?>
                                </div>
                                <div class="text__description">
                                    <?=$text[1]?>
                                </div>
                            </div>

                        </div>
                    <?}?>

                </div>

                <div class="techniks__bullets js-bullets-container"></div>

            </div>
        </div>

        <div data-anchor="learn" data-menu="111" data-slider-cls="white" class="slide gallery design">
            <div class="learn__container">

                <div class="title-container">
                    <div class="title">
                        <?= count($day["GALLERY_DESIGN"]["VALUE"])?> <?= designOut(count($day["GALLERY_DESIGN"]["VALUE"]))?>
                        , которым вы научитесь
                    </div>

                    <div class="design">design</div>

                </div>

                <div class="big-preview__wrapper">

                    <div class="big-preview"></div>

                    <div
                            class="bullets-container__wrapper bullets-container__wrapper--big-preview js-big-bullets"
                    ></div>

                </div>

                <div class="choosen-container">

                    <div class="preview-slider-container"></div>

                </div>

                <div class="bullets-container__wrapper js-preview-bullets"></div>

            </div>
        </div>
        <div data-anchor="gifts" data-menu="000" data-slider-cls="blue" class="slide">
            <div class="gifts__bg"></div>
            <div class="gifts__overflow">
                <div class="gifts__container">
                    <div class="gifts__gifts-for-you">
                        <div class="text--small"><?= $day["GIFTS_HEADER"]["VALUE"]?></div>
                    </div>
                    <div class="gifts__prizes">
                        <div class="message"><img src="/img/lamp.png"/>

                            <div class="text">
                                <?= $day["GIFTS_TEXT"]["VALUE"]?>
                            </div>
                        </div>
                        <div class="prizes__list">
                            <?$i = 0;
                            do {
                                $i++;
                                ?>
                                <div class="prizes__item">
                                    <?if (!empty($day['GIFTS_IMG_'.$i]['VALUE'])){?>
                                        <img src="<?= CFile::getPath($day['GIFTS_IMG_'.$i]['VALUE'])?>"/>
                                    <?}?>

                                    <div class="name"><?= $day["GIFTS_HEADER_".$i]["VALUE"]?></div>
                                    <div class="descr">
                                        <?= $day["GIFTS_TEXT_".$i]["VALUE"]?>
                                    </div>
                                </div>
                                <?
                            } while($i<=6);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Speakers -->

        <div data-anchor="expert" data-menu="111" data-slider-cls="white" class="slide skeakers">

            <div class="expert__container">

                <?
                /**
                 * Если один спикер выводим только первый элемент
                 */
                if (count($day["SPEAKER_NAME"]["VALUE"]) === 1):
                    ?>
                    <div class="expert__first-name-container is-single">

                        <div class="expert__first-name">
                            <?
                            echo $day["SPEAKER_NAME"]["VALUE"][0];
                            ?>
                        </div>

                        <div class="expert__last-name">
                            <?
                            echo $day["SPEAKER_SURNAME"]["VALUE"][0];
                            ?>
                        </div>

                        <div data-layer="6" data-slide="3" class="expert__vacancy-container js-particles">
                            <div class="expert-vacancy">speaker</div>
                            <div class="expert-descr">
                                <?= $day["SPEAKER_DESCRIPTION"]["~VALUE"][0]?>
                            </div>
                        </div>

                    </div>

                <?endif;?>


                <?
                /**
                 * Если спикер не один выводим столбцами информацию о спикерах
                 */
                if (count($day["SPEAKER_NAME"]["VALUE"]) !== 1):
                    ?>
                    <div class="expert__first-name-container is-several">

                        <?foreach ($day["SPEAKER_NAME"]["VALUE"] as $key=>$name):?>

                            <div class="expert__vacancy-container js-particles">

                                <div class="expert-vacancy">
                                    <? echo $name . ' ' . $day["SPEAKER_SURNAME"]["VALUE"][$key];?>
                                </div>

                                <div class="expert-descr">
                                    <?= $day["SPEAKER_DESCRIPTION"]["~VALUE"][$key]?>
                                </div>

                            </div>

                        <?endforeach;?>

                    </div>

                <?endif;?>



            </div>

            <div class="skeaker__photo"
                 style="background-image: url(<?= CFile::GetPath($day['SPEAKER_PHOTO']['VALUE'])?>)"
            ></div>

        </div>

        <!-- /Speakers -->

        <!-- Reviews -->
        <div data-anchor="comments" data-menu="000" data-slider-cls="black" class="slide">
            <div class="comments__bg"></div>
            <div class="comments__quote-left"></div>
            <div class="comments__quote-right"></div>
            <div class="comments__slider js-slider">
                <div class="title">Что говорят участники</div>
                <?
                foreach ($day["REVIEWS_TEXT"]["VALUE"] as $k=>$v){
                    $header = explode("head", $day["REVIEWS_TEXT"]["DESCRIPTION"][$k]);
                    $city = explode("city", $header[1]);
                    $text =(count($city) > 1)? $city [1]:$city[0];
                    ?>
                    <div class="comments__slider-item js-item">
                        <div class="text">
                            <?= $text?>
                        </div>
                        <div class="person-container">
                            <img src="<?= CFile::GetPath($v)?>" class="img avatar"/>
                            <div class="name"><?= $header[0]?></div>
                            <div class="city"><?= (count($city) > 1)? $city [0]:""?></div>
                        </div>
                    </div>
                <?}?>
            </div>
            <div class="comments__bullets js-bullets-container"></div>
        </div>



        <div data-anchor="video" data-menu="000" data-slider-cls="black" class="slide slide--inline">
            <div class="slide__bg"></div>
            <div class="video__container">
                <div class="video__title">Видео-отзывы участников</div>
                <div class="video__content">
                    <div data-id="<?= $day["REVIEWS_VIDEO"]["DESCRIPTION"][0]?>" style="background-image: url(<?= CFile::getPath($day["REVIEWS_VIDEO"]["VALUE"][0])?>)"
                         class="video__content-overlay"></div>
                    <iframe></iframe>
                </div>
                <div class="video__scroll">
                    <?foreach ($day["REVIEWS_VIDEO"]["VALUE"] as $k=>$v){
                        if ($k>0){
                            ?>
                            <div class="video__element">
                                <div data-id="<?= $day["REVIEWS_VIDEO"]["DESCRIPTION"][$k]?>"
                                     style="background-image:url(<?= CFile::getPath($v)?>)"
                                     class="thumbnail js-video"
                                ></div>
                            </div>
                        <?}
                    }
                    ?>
                </div>
            </div>
        </div>
        <div data-anchor="mastery" data-menu="110" data-slider-cls="black" class="slide">
            <div class="mastery__bg"></div>
            <div class="mastery__mobile">
                <div class="mastery__left">BE<br/>MASTER</div>
                <div class="mastery__center">&</div>
                <div class="mastery__right">ENJOY<br/>BEAUTY</div>
            </div>
            <div class="mastery__container">
                <div class="mastery__container-left">
                    <div class="mastery__block">
                        <div class="mastery__title">Повышай мастерство</div>
                        <div class="mastery__perk">Подбор материалов для проблемных ногтей</div>
                        <div class="mastery__perk">Секреты борьбы с отслойками и сколами</div>
                        <div class="mastery__perk">Топовые технологии моделирования и дизайна</div>
                        <div class="mastery__perk">Тренды декоративных покрытий ногтей</div>
                    </div>
                </div>
                <div class="mastery__container-right">
                    <div class="mastery__block">
                        <div class="mastery__title">Наслаждайся моментом</div>
                        <div class="mastery__perk">Закрытая вечеринка nail-маньяков</div>
                        <div class="mastery__perk">Вдохновение новыми дизайнами</div>
                        <div class="mastery__perk">Ответы на острые вопросы</div>
                        <div class="mastery__perk">Щедрые подарки и WOW-розыгрыши</div>
                    </div>
                </div>
            </div>
        </div>
        <div data-anchor="calendar" data-menu="000" data-slider-cls="blue" class="slide">
            <div class="calendar__bg"></div>
            <div class="calendar__container">
                <div class="calendar__first-day js-calendar-day">

                    <?
                    if (strlen(explode(".",$day["DATE"]["VALUE"])[0]) >1 ){
                        echo substr(explode(".",$day["DATE"]["VALUE"])[0], 0,1);
                    }?>

                    <img class="calendar__first-day__digit"
                         src="img/<?= substr(explode(".",$day["DATE"]["VALUE"])[0], -1)?>-active.png"
                    />

                </div>
                <div class="calendar__day-slider">
                    <div class="item active"><?= dateRus($day["DATE"]["VALUE"])?></div>
                    <?
                    $i = 1;
                    while($i<$day["DAYS"]["VALUE"]) {
                        $date = explode(".",$day["DATE"]["VALUE"]);
                        $date[0] += $i;
                        $date = implode(".", $date);
                        ?>
                        <div class="item">
                            <?= dateRus($date)?>
                        </div>
                        <?
                        $i++;
                    } ?>
                    <div class="active-line"></div>
                </div>
                <div class="calendar__programm active">

                    <div class="calendar__mobile-accordion">
                        <?= dateRus($day["DATE"]["VALUE"])?>
                    </div>

                    <?
                    foreach ($day["DAY_1"]["VALUE"] as $k=>$text){
                        ?>
                        <div class="item">
                            <div class="content">
                                <span class="time">
                                    <?= $day["DAY_1"]["DESCRIPTION"][$k]?>
                                </span>
                                <?$text = explode("br", $text);
                                foreach ($text as $v){
                                    ?>
                                    <p class="text"><?= $v?></p>
                                    <?
                                }
                                ?>
                            </div>
                        </div>
                        <?
                    }
                    ?>

                    <div class="">
                        <div class="content">
                            <a data-metrica="01scrn_send"
                               text=""
                               class="button-secret js-open-popup"
                            >
                                купить билет
                            </a>
                        </div>
                    </div>

                </div>
                <?if ($day["DAYS"]["VALUE"]>1){?>
                    <div class="calendar__programm">
                        <div class="calendar__mobile-accordion"><?
                            $date = explode(".",$day["DATE"]["VALUE"]);
                            $date[0] += 1;
                            $date = implode(".", $date);
                            echo dateRus($date)
                            ?></div>
                        <!--                    <div class="item subheader">-->
                        <!--                        <div class="content"><p class="text">Только-->
                        <!--                            --><?php //echo $tickets['naillover'] ?>
                        <!--                            билетов. Успейте забронировать</p></div>-->
                        <!--                    </div>-->
                        <?
                        foreach ($day["DAY_2"]["VALUE"] as $k=>$text){
                            ?>
                            <div class="item">
                                <div class="content">

                                    <span class="time">
                                        <?= $day["DAY_2"]["DESCRIPTION"][$k]?>
                                    </span>

                                    <?$text = explode("br", $text);
                                    foreach ($text as $v){
                                        ?>
                                        <p class="text"><?= $v?></p>
                                        <?
                                    }
                                    ?>
                                </div>
                            </div>
                            <?
                        }
                        ?>
                        <div class="item">
                            <div class="content">
                                <a data-metrica="01scrn_send"
                                   text=""
                                   class="button-secret js-open-popup"
                                >
                                    купить билет
                                </a>
                            </div>
                        </div>
                    </div>
                <?}
                if ($day["DAYS"]["VALUE"]>2){?>
                    <div class="calendar__programm">
                        <div class="calendar__mobile-accordion"><?
                            $date = explode(".",$day["DATE"]["VALUE"]);
                            $date[0] += 2;
                            $date = implode(".", $date);
                            echo dateRus($date)
                            ?>
                        </div>
                        <!--                    <div class="item subheader">-->
                        <!--                        <div class="content"><p class="text">Только-->
                        <!--                            --><?php //echo $tickets['nailexpert'] ?>
                        <!--                            билетов. Успейте забронировать</p></div>-->
                        <!--                    </div>-->
                        <?
                        foreach ($day["DAY_3"]["VALUE"] as $k=>$text){
                            ?>
                            <div class="item">
                                <div class="content">
                                    <span class="time">
                                        <?= $day["DAY_3"]["DESCRIPTION"][$k]?>
                                    </span>
                                    <?$text = explode("br", $text);
                                    foreach ($text as $v){
                                        ?>
                                        <p class="text"><?= $v?></p>
                                        <?
                                    }
                                    ?>
                                </div>
                            </div>
                            <?
                        }
                        ?>

                        <div class="item">
                            <div class="content">
                                <a data-metrica="01scrn_send"
                                   text=""
                                   class="button-secret js-open-popup"
                                >
                                    купить билет
                                </a>
                            </div>
                        </div>

                    </div>
                <?}?>
                <div class="calendar__second-days">
                    <?
                    $i = 1;
                    while($i<$day["DAYS"]["VALUE"]) {
                        $date = explode(".",$day["DATE"]["VALUE"]);
                        $date[0] += $i;
                        ?>
                        <div class="day js-calendar-day"><?= $date[0]?></div>
                        <?
                        $i++;
                    } ?>
                </div>
            </div>
        </div>

        <div data-anchor="sets" data-menu="000" data-slider-cls="white" class="slide">
            <div class="sets__bg"></div>
            <img src="img/sets__bg.jpg" class="sets__blob"/>

            <div class="sets__container">
                <div data-layer="2" data-slide="7" class="sets__logo js-particles"></div>
                <div class="sets__keys">

                    <div class="big-title"><?= $day["SETS_HEADER"]["VALUE"]?></div>

                    <div class="sets__item">
                        <div class="sets__item-title"><?= $day["SETS_HEADER_1"]["VALUE"]?></div>
                        <div class="sets__item-descr">
                            <?= $day["SETS_TEXT_1"]["VALUE"]?>
                        </div>
                    </div>

                    <div class="sets__item">
                        <div class="sets__item-title"><?= $day["SETS_HEADER_2"]["VALUE"]?></div>
                        <div class="sets__item-descr">
                            <?= $day["SETS_TEXT_2"]["VALUE"]?>
                        </div>
                    </div>

                    <div class="sets__item">
                        <div class="sets__item-title"><?= $day["SETS_HEADER_3"]["VALUE"]?></div>
                        <div class="sets__item-descr">
                            <?= $day["SETS_TEXT_3"]["VALUE"]?>
                        </div>
                    </div>

                    <div class="sets__item">
                        <div class="sets__item-title"><?= $day["SETS_HEADER_4"]["VALUE"]?></div>
                        <div class="sets__item-descr">
                            <?= $day["SETS_TEXT_4"]["VALUE"]?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div data-anchor="price" data-menu="111" data-slider-cls="white" class="slide">
            <div class="price__bg"></div>
            <div class="price__title">Стоимость участия</div>
            <div class="price__container">
                <?if (!empty($day["TICKET_2_NAME"]["~VALUE"])){?>
                    <div class="price__product">
                        <div class="price__product-header">

                            <div
                                    class="price__product-header-image price__product-header-image--first price__product-header-image--black">
                                <?= $day["TICKET_2_NAME"]["~VALUE"]?>
                            </div>

                            <div class="price__product-header-caption">
                                <?= $day["TICKET_2_DATE"]["VALUE"]?>
                            </div>

                        </div>
                        <?foreach ($day["TICKET_2_PROGRAMM"]["VALUE"] as $k=>$v){
                            ?>
                            <div class="price__key"><span class="price__icon" style="background-image: url('<?= CFile::getPath($v)?>')"></span><?= $day["TICKET_2_PROGRAMM"]["DESCRIPTION"][$k]?></div>
                            <?
                        }?>

                        <a data-popup="musthave"
                           href="javascript:void(0)"
                           class="price__more-link js-open-popup"
                        >
                            Подробное описание
                        </a>

                        <div class="price__bottom">

                            <span class="price__value">
                                <?= $price2?>
                                <svg class="rubble" x="0px" y="0px" width="13.5px" height="27px" viewBox="0 0 13.5 27" style="enable-background:new 0 0 13.5 27;" xml:space="preserve">
                                    <style type="text/css"> .st0 {
                                            stroke: #FFFFFF;
                                            stroke-width: 0.5;
                                            stroke-miterlimit: 10;
                                        } </style>
                                    <defs> </defs>
                                    <path class="st0" d="M6.4,16.1c1.7,0,3.4-0.5,4.7-1.7s2.2-3.2,2.2-6.2c0-3-0.9-5-2.2-6.3s-3-1.7-4.7-1.7H2.5v11.9H0.2V16h2.3v2.3 H0.2v3.6h2.3v4.8h3.9v-4.8h5.1v-3.6H6.4V16.1z M6.4,4.2c1.2,0,1.9,0.3,2.4,0.9c0.4,0.6,0.5,1.7,0.5,3.2s-0.1,2.4-0.5,3 c-0.4,0.6-1.2,0.8-2.4,0.8V4.2z"/>
                                </svg>
                            </span>

                            <span class="price__ticket-left">
                                <span class="price__ticket-left-value">
                                    <?=  $day["TICKET_2_QUANTITY"]["VALUE"]?>
                                </span>
                                <div class="price__ticket-left-text">
                                    осталось<br>мест
                                </div>
                            </span>

                            <a data-selected="price1"
                               data-cost="<?= $price2?>"
                               data-metrica="11scrn_send_MH"
                               text="купить"
                               class="button button--white js-open-popup"
                            >
                                купить
                            </a>

                        </div>
                    </div>
                <?}?>
                <div class="price__product">

                    <div class="price__product-header">
                        <div class="price__product-header-image price__product-header-image--second"><?= $day["TICKET_1_NAME"]["~VALUE"]?></div>
                        <div class="price__product-header-caption"><?= $day["TICKET_1_DATE"]["VALUE"]?></div>
                    </div>

                    <?foreach ($day["TICKET_1_PROGRAMM"]["VALUE"] as $k=>$v){
                        ?>
                        <div class="price__key">
                            <span class="price__icon" style="background-image: url('<?= CFile::getPath($v)?>')"></span>
                            <?= $day["TICKET_1_PROGRAMM"]["DESCRIPTION"][$k]?>
                        </div>
                        <?
                    }?>

                    <a data-popup="naillover"
                       href="javascript:void(0)"
                       class="price__more-link js-open-popup"
                    >
                        Подробное описание
                    </a>

                    <div class="price__bottom">
                        <span class="price__value">
                            <?= $price1?>
                            <svg class="rubble" x="0px" y="0px" width="13.5px" height="27px" viewBox="0 0 13.5 27" style="enable-background:new 0 0 13.5 27;" xml:space="preserve">
                                <style type="text/css">
                                    .st0 {
                                        stroke: #FFFFFF;
                                        stroke-width: 0.5;
                                        stroke-miterlimit: 10;
                                    } </style>
                                <defs> </defs>
                                <path class="st0" d="M6.4,16.1c1.7,0,3.4-0.5,4.7-1.7s2.2-3.2,2.2-6.2c0-3-0.9-5-2.2-6.3s-3-1.7-4.7-1.7H2.5v11.9H0.2V16h2.3v2.3 H0.2v3.6h2.3v4.8h3.9v-4.8h5.1v-3.6H6.4V16.1z M6.4,4.2c1.2,0,1.9,0.3,2.4,0.9c0.4,0.6,0.5,1.7,0.5,3.2s-0.1,2.4-0.5,3 c-0.4,0.6-1.2,0.8-2.4,0.8V4.2z"/>
                            </svg>
                        </span>
                        <span class="price__ticket-left">
                            <span class="price__ticket-left-value">
                                <?=  $day["TICKET_1_QUANTITY"]["VALUE"]?>
                            </span>
                            <div class="price__ticket-left-text">
                                осталось<br>мест
                            </div>
                        </span>
                        <a data-selected="price2"
                           data-cost="<?= $price1?>"
                           data-metrica="11scrn_send_NL"
                           text="купить"
                           class="button button--white js-open-popup"
                        >
                            купить
                        </a>
                    </div>
                </div>
                <?if (!empty($day["TICKET_3_NAME"]["~VALUE"])){?>
                    <div class="price__product">
                        <div class="price__product-header">
                            <div
                                    class="price__product-header-image price__product-header-image--third price__product-header-image--black"
                            >
                                <?= $day["TICKET_3_NAME"]["~VALUE"]?>
                            </div>
                            <div class="price__product-header-caption"><?= $day["TICKET_3_DATE"]["VALUE"]?></div>
                        </div>
                        <?foreach ($day["TICKET_3_PROGRAMM"]["VALUE"] as $k=>$v){
                            ?>
                            <div class="price__key"><span class="price__icon" style="background-image: url('<?= CFile::getPath($v)?>')"></span>
                                <?= $day["TICKET_3_PROGRAMM"]["DESCRIPTION"][$k]?>
                            </div>
                            <?
                        }?>

                        <a data-popup="nailexpert"
                           href="javascript:void(0)"
                           class="price__more-link js-open-popup"
                        >
                            Подробное описание
                        </a>

                        <div class="price__bottom">
                            <span class="price__value"><?= $price3?>
                                <svg class="rubble" x="0px" y="0px" width="13.5px" height="27px" viewBox="0 0 13.5 27" style="enable-background:new 0 0 13.5 27;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0 {
                                            stroke: #FFFFFF;
                                            stroke-width: 0.5;
                                            stroke-miterlimit: 10;
                                        }
                                    </style>
                                    <defs> </defs>
                                    <path class="st0" d="M6.4,16.1c1.7,0,3.4-0.5,4.7-1.7s2.2-3.2,2.2-6.2c0-3-0.9-5-2.2-6.3s-3-1.7-4.7-1.7H2.5v11.9H0.2V16h2.3v2.3 H0.2v3.6h2.3v4.8h3.9v-4.8h5.1v-3.6H6.4V16.1z M6.4,4.2c1.2,0,1.9,0.3,2.4,0.9c0.4,0.6,0.5,1.7,0.5,3.2s-0.1,2.4-0.5,3 c-0.4,0.6-1.2,0.8-2.4,0.8V4.2z"/>
                                </svg>
                            </span>

                            <span class="price__ticket-left">

                                <span class="price__ticket-left-value">
                                    <?=  $day["TICKET_3_QUANTITY"]["VALUE"]?>
                                </span>

                                <div class="price__ticket-left-text">
                                    осталось<br>мест
                                </div>

                            </span>

                            <a data-selected="price3"
                               data-cost="<?= $price3?>"
                               data-metrica="11scrn_send_NE"
                               text="купить"
                               class="button button--white js-open-popup"
                            >
                                купить
                            </a>

                        </div>
                    </div>
                <?}?>
            </div>
        </div>
        <div data-anchor="inspiration" data-menu="111" data-slider-cls="white" class="slide">
            <div class="inspiration__mobile"></div>
            <div class="inspiration__container">
                <div class="inspiration__word js-mouse-parallax-background">
                    <div class="inspiration__word-mask"></div>
                    <img src="img/inspiration__word.png" class="inspiration__word-text"/>
                </div>

                <div class="inspiration__quote">

                    <div class="inspiration__quote-icon"></div>

                    <div class="inspiration__quote-name">
                        <?= $day["SPEAKER_NAME"]["VALUE"][0]." ".$day["SPEAKER_SURNAME"]["VALUE"][0]?>
                    </div>

                    <div class="inspiration__quote-text">
                        <?= $day["INSPIRATION_TEXT"]["~VALUE"] ?>
                    </div>
                </div>

            </div>
        </div>

        <div data-anchor="events" data-menu="111" data-slider-cls="white" class="slide gallery events">
            <div class="learn__container">

                <div class="title-container">
                    <div class="title">Фотоотчеты прошлых мероприятий</div>
                    <div class="design">events</div>
                </div>

                <div class="big-preview__wrapper">
                    <div class="big-preview"></div>
                    <div class="bullets-container__wrapper bullets-container__wrapper--big-preview js-big-bullets"></div>
                </div>

                <div class="choosen-container">
                    <div class="preview-slider-container"></div>
                    <div class="bullets-container__wrapper js-preview-bullets"></div>
                </div>

            </div>
        </div>

        <div data-anchor="contact" data-menu="011" data-slider-cls="white" class="slide">
            <div id="map"></div>
            <div class="contact__sheet">
                <div class="col">
                    <div class="contact__contact"></div>
                    <div class="contact__us"></div>
                    <div class="col first">
                        <div class="contact__city"><?= $day["PLACE_NAME"]["VALUE"]?></div>
                        <div class="contact__address">
                            <?= $day["PLACE_ADDRESS"]["VALUE"]?>. <a href="mailto:<?= $day['MAIL']['VALUE']?>"><?= $day["MAIL"]["VALUE"]?></a>
                        </div>
                        <div data-metrica="15scrn_send_contact"
                             text="забронировать"
                             class="button button--white js-open-popup"
                        >
                            забронировать
                        </div>
                    </div>
                    <div class="col second">
                        <a href="tel:<?= $day["PHONE_CODE"]['VALUE'].$day['PHONE_NUMBER']['VALUE']?>"
                           class="contact__phone"
                        >
                            <?= str_replace(array("(", ")"), "",$day["PHONE_CODE"]["VALUE"].$day['PHONE_NUMBER']["VALUE"])?>
                        </a>

                        <div class="contact__naming"><?= $day["PLACE_STATUS"]["VALUE"]?></div>
                        <div class="contact__partner"></div>
                    </div>
                </div>
            </div>
        </div>

        <div data-anchor="smart" data-menu="000" data-slider-cls="black" class="slide">

            <div class="smart__container">
                <div class="smart__slogan">CNI — уникальный бренд, созданный на стыке науки и моды. <br/> Это
                    возможность создавать идеальный аксессуар для стильных женщин.
                </div>
                <div class="smart__word js-mouse-parallax-background">
                    <div class="smart__word-mask"></div>
                    <img src="img/smart__word.png" class="smart__word-text"/></div>
                <div class="smart__list">
                    <div class="smart__item">
                        <div class="name">#SMART people</div>
                        <div class="descr">Каждый мастер — представитель международной команды стилистов CNI. Постоянное
                            обучение и поддержка технологов бренда — основа внутренней политики CNI.
                        </div>
                    </div>
                    <div class="smart__item">
                        <div class="name">#SMART price</div>
                        <div class="descr">Умная мода — это доступная мода.
                            Это идеальное сочетание цены и качества в своем сегменте. Больше не нужно
                            переплачивать за бренд и рекламу.
                        </div>
                    </div>
                    <div class="smart__item">
                        <div class="name">#SMART products</div>
                        <div class="descr">Уникальные технологии и огромный ассортименит для всех видов и состояний
                            ногтей.
                        </div>
                    </div>
                    <div class="smart__item">
                        <div class="descr">Стань частью международной команды Nail-стилистов CNI!</div>
                        <br/><a data-metrica="16scrn_send" href="#" text="забронировать" class="button js-open-popup">забронировать </a>
                    </div>
                </div>
            </div>

            <div class="smart__footer">
                <div class="smart__footer-item industry">© 2016 Centre of Nail Industry</div>
                <div class="smart__footer-item social">
                    <span class="text">CNI в соц. сетях</span>

                    <a href="https://www.facebook.com/CNICorporation/"
                       target="_blank"
                       class="icon icon--fb"
                    ></a>

                    <a href="https://vk.com/international_corporation_cni"
                       target="_blank"
                       class="icon icon--vk"
                    ></a>

                    <a href="https://www.instagram.com/cni_corporation/"
                       target="_blank"
                       class="icon icon--in"
                    ></a>

                    <a href="https://www.youtube.com/channel/UCHJUegSvvgx29Yv-uJswFXQ"
                       target="_blank"
                       class="icon icon--yt"
                    ></a>

                    <a href="https://ok.ru/profile/576661542420"
                       target="_blank"
                       class="icon icon--ok"
                    ></a>

                    <a href="https://twitter.com/CorpCNI"
                       target="_blank"
                       class="icon icon--tw"
                    ></a>

                    <a href="#" class="mobile-br share js-share">
                        <span class="text text--left">Поделиться</span>
                        <div class="icon icon--right icon--share"></div>
                    </a>

                    <div class="share-icons">

                        <a href="#"
                           target="_blank"
                           data-type="fb"
                           class="icon icon--fb js-share-target"
                        ></a>

                        <a href="#"
                           target="_blank"
                           data-type="vk"
                           class="icon icon--vk js-share-target"
                        ></a>

                        <a href="#"
                           target="_blank"
                           data-type="tw"
                           class="icon icon--tw js-share-target"
                        ></a>

                        <a href="#"
                           target="_blank"
                           data-type="ok"
                           class="icon icon--ok js-share-target"
                        ></a>

                    </div>
                </div>
                <a target="_blank" href="http://inrussia.me" class="smart__footer-item insight-logo"></a>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.4.1/velocity.min.js"></script>
<script src="jquery.maskedinput.js"></script>
<script src="perfect-scrollbar.jquery.min.js"></script>
<script src="hammer.min.js"></script>
<script src="wheel-indicator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TimelineMax.min.js"></script>
<script>
    function getDesign(){
        var gallery = [];
        $.ajax({
            url: "/gallery.php?id=<?= $iCurCityID?>&req=DESIGN",
            async: false,
            type: "GET",
            dataType: "json",
            success: function(data){
                gallery = data;
            }
        });
        return gallery;
    };
    function getEvents(){
        var events = [];
        $.ajax({
            url: "/gallery.php?id=<?= $iCurCityID?>&req=EVENTS",
            async: false,
            type: "GET",
            dataType: "json",
            success: function(data){
                events = data;
            }
        });
        return events;
    }
</script>
<script src="script.js"></script>
<script async="async" defer="defer"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE2or3wm2a-ZZPFPnrkb6TsGEguYN-s3o&amp;callback=initMap"></script>
<script>
    function setMarker(map){
        $.get( "http://maps.googleapis.com/maps/api/geocode/json?address=<?= $day["PLACE_ADDRESS"]["VALUE"]?>о&sensor=false&language=ru", function( data ) {
            var image = 'img/pin.png';
            var marker = new google.maps.Marker({
                position: data.results[0].geometry.location,
                map: map,
                icon: image,
                title: 'CNI'
            });
            var infowindow = new google.maps.InfoWindow({
                content: '<?= $day["PLACE_ADDRESS"]["VALUE"]?>'
            });
            map.setCenter(data.results[0].geometry.location);
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
        });

    }
</script>
</body>