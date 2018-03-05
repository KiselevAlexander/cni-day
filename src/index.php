<?php include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$TEMPLATE = '2018';

// посмотрим какой город был выбран этим юзером в прошлый раз
$sUserCity = $APPLICATION->get_cookie('USER_CITY');

// установим глобальную переменную cur_city = код города (из сабдомена)
if ($_SERVER['SERVER_NAME'] === '127.0.0.1') {
    $GLOBALS['sCurCity'] = 'msk';
} else {
    $GLOBALS['sCurCity'] = preg_replace('/^(?:([^\.]+)\.)?cni-day\.ru$/', '\1', $_SERVER['SERVER_NAME']);
}

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

$PRICES = [];

if ($days <= 10){

    array_push($PRICES, $day["TICKET_1_HIGHPRICE"]["VALUE"]);
    array_push($PRICES, $day["TICKET_2_HIGHPRICE"]["VALUE"]);
    array_push($PRICES, $day["TICKET_3_HIGHPRICE"]["VALUE"]);

} else {
    array_push($PRICES, $day["TICKET_1_LOWPRICE"]["VALUE"]);
    array_push($PRICES, $day["TICKET_2_LOWPRICE"]["VALUE"]);
    array_push($PRICES, $day["TICKET_3_LOWPRICE"]["VALUE"]);
}


/**
 * Тестирование под админом
 */

//global $USER;
//if ($USER->IsAdmin()) {
//    var_dump($arCityCodes);
////    die('test');
//}

$APPLICATION->IncludeFile(
    "/local/templates/{$TEMPLATE}/index.php",
    Array(
        "CITY_NAME" => $sCurCityName,
        "DAY" => $day,
        "PRICES" => $PRICES,
    ),
    Array("MODE"=>"html")
);

?>