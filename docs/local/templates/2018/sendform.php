<?
define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$GLOBALS['APPLICATION']->RestartBuffer();

header('content/type: application/json');


$send_to = [
    'cni-day@ya.ru',
    'digital@cni.ru',
    'event@cni.ru',
    'alexander.kiselev@mail.ru'
];

$data = $_POST;

$send_to = ($data['sendto']) ? explode(',', $data['sendto']) : $send_to;

$product = (isset($data['product']) && $data['product'] !== 0)
    ? 'Продукт: день ' . $data['product']
    : 'Продукт: не выбран';

$city = $data['city'];
$name = $data['name'];
$phone = $data['phone'];
$email = $data['email'];
$text = $data['text'];
$additionalData = $data['data'];
$date = date('d.m.Y H:i:s');


CModule::IncludeModule("iblock");

/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 05.02.18
 * Time: 0:14
 */




/**
 * Save to bitrix
 */
$el = new CIBlockElement;

$PROP = [];
$PROP['NAME'] = $name;
$PROP['PHONE'] = $phone;
$PROP['TEXT'] = $text;
$PROP['CITY'] = $city;

$arLoadProductArray = [
    "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
    "IBLOCK_ID"      => 3,
    "PROPERTY_VALUES"=> $PROP,
    "NAME"           => $name,
    "ACTIVE"         => "Y",            // активен
];

if(!$PRODUCT_ID = $el->Add($arLoadProductArray)) {
    echo "Error: ".$el->LAST_ERROR;
}

/**
 * Send email
 */
$message = "
    <h1>Заявка на сайте $city</h1>
    <hr />
    <p><b>Город:</b> $city</p>
    <p><b>Имя:</b> $name</p>
    <p><b>Телефон:</b> $phone</p>
    <p><b>Текст:</b> $text</p>
    <p><b>Дата:</b> $date</p>
";


$headers  = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: Лендинг cni-day.ru ($city) <no-reply@cni-day.ru>\r\n";


$send_to = implode(',', $send_to);

if ($name == 'test') {
    $send_to = 'alexander.kiselev@mail.ru';
}

$res = mail($send_to, 'Заявка на сайте', $message, $headers);

if ($res) {
    echo json_encode([
        "status" => "Ready!",
        "response" => "Thanks!"
    ]);
} else {
    echo json_encode([
        'error' => 'Send error'
    ]);
}
