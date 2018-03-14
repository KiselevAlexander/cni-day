<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 05.02.18
 * Time: 0:14
 */

header('content/type: application/json');

$to = [
    'cni-day@ya.ru',
    'digital@cni.ru',
    'event@cni.ru',
    'alexander.kiselev@mail.ru'
];

$to = ($data['sendto']) ? explode(',', $data['sendto']) : $to;
$product = (isset($data['product']) && $data['product'] !== 0)
    ? 'Продукт: день ' . $data['product']
    : 'Продукт: не выбран';

$data = $_POST;
$city = $data['city'];
$name = $data['form']['data'][0][1];
$phone = $data['form']['data'][1][1];
$text = $data['form']['data'][2][1];
$date = date('d.m.Y H:i:s');

$message = "
    <h1>Заявка на сайте</h1>
    <hr />
    <p><b>Имя:</b> $name</p>
    <p><b>Телефон:</b> $phone</p>
    <p><b>Текст:</b> $text</p>
    <p><b>Дата:</b> $date</p>
";


$headers  = "Content-type: text/html; charset=utf-8 \r\n";
$headers .= "From: Лендинг cni-day.ru <no-reply@cni-day.ru>\r\n";


$to = implode(',', $to);

if ($name == 'test') {
    $to = 'alexander.kiselev@mail.ru';
}

$res = mail($to, 'Заявка на сайте', $message, $headers);

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
