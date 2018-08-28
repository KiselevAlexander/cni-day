<?
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 05.02.18
 * Time: 0:14
 *
 * Для тестированая функционала без отправки почты и внесения в базу нужно указать имя клиента `test`
 * Для тесирования отправки почты только на свой email нужно указать имя клиента `test_mail`
 *
 */

define('STOP_STATISTICS', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
@$GLOBALS['APPLICATION']->RestartBuffer();
error_reporting(E_ALL);

// header('content/type: application/json');

/**
 * Тестовый ответ без отправки email
 */
/*echo json_encode([
    "status" => "Ready!",
    "response" => "Thanks!"
]);

die();*/

include "client_email/email.php";
/**
 * Преобразование utm меток
 * @param $metrics
 * @return string
 */
function parseMetrics($metrics) {
    $metrics = json_decode($metrics, true);

    $map = [
        'utm_source' => 'Рекламная площадка',
        'utm_medium' => 'Канал трафика',
        'utm_campaign' => 'Название рекламной кампании',
        'utm_term' => 'Ключевая фраза',
        'utm_content' => 'Дополнительной информации',
    ];

    $result = "";

    foreach ($metrics as $mKey => $mValue) {
        foreach ($map as $key => $value) {
            if ($mKey == $key) {
                $result .= "<tr><td>{$value}:</td><td>{$mValue}</td></tr>";
            }
        }
    }
    if ($result) {
        return "<table>{$result}</table>";
    } else {
        return "<table><tr><td>Отсутствует</td></tr></table>";
    }

}

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


$data['metrics'] = ($data['metrics']) ? parseMetrics($data['metrics']) : '';

$data['date'] = date('d.m.Y H:i:s');

$isDev = ($data['name'] == 'test');
$isTest = ($data['name'] == 'test_mail');

if (!$isDev && CModule::IncludeModule("iblock")) {

    /**
     * Save to bitrix
     */
    $el = new CIBlockElement();

    $PROP = [];
    $PROP['NAME'] = ($data['name']) ? $data['name'] : '';
    $PROP['PHONE'] = ($data['phone']) ? $data['phone'] : '';
    $PROP['TEXT'] = ($data['text']) ? $data['text'] : '';
    $PROP['CITY'] = ($data['city']) ? $data['city'] : '';
    $PROP['EMAIL'] = ($data['email']) ? $data['email'] : '';

    $arLoadProductArray = [
        "SITE_ID" => 1,
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID"      => 3,
        "PROPERTY_VALUES"=> $PROP,
        "NAME"           => $data['name'],
        "ACTIVE"         => "Y",            // активен
    ];

    // if(!$PRODUCT_ID = $el->Add($arLoadProductArray)) {
    //     echo "Error: ".$el->LAST_ERROR;
    // }
}

// die('test');

/**
 * Send email
 */
$message = "
    <h1>Заявка на сайте %city%</h1>
    <hr />
    <table>
        <tr><td><b>ФИО:</b></td><td>%name%</td></tr>
        <tr><td><b>Город:</b></td><td>%city%</td></tr>
        <tr><td><b>Телефон:</b></td><td>%phone%</td></tr>
        <tr><td><b>Текст:</b></td><td>%text%</td></tr>
        <tr><td><b>Дата:</b></td><td>%date%</td></tr>
    </table>
    <p>
        <b>Маркетинговая информация:</b>
        %metrics%
    </p>
";

foreach ($data as $key=>$value) {
    $message = str_replace("%{$key}%", $value ? $value : '-', $message);
}

$headers  = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: Лендинг cni-day.ru ({$data['city']}) <no-reply@cni-day.ru>\r\n";


$send_to = implode(',', $send_to);

if ($isDev) {
    $res = true;
} else {
    if ($isTest) {
        $send_to = 'alexander.kiselev@mail.ru';
    }
    $res = mail($send_to, 'Заявка на сайте', $message, $headers);

    send_client_email($data['email'], "День CNI {$data['city']}");
}


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
