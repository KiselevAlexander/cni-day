<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 05.02.18
 * Time: 0:14
 */

header('content/type: application/json');

$to = [
    'masha@profhairs.ru',
    'cni-day@ya.ru',
    'digital@cni.ru',
    'ivanovo@cni.ru',
    'event@cni.ru',
    'koreshkov@me.com',
    'alexander.kiselev@mail.ru'
];

$to = ($data['sendto']) ? explode(',', $data['sendto']) : $to;
$product = (isset($data['product']) && $data['product'] !== 0)
    ? 'Продукт: день ' . $data['product']
    : 'Продукт: не выбран';

$data = $_POST;
$name = $data['form']['data'][0][1];
$phone = $data['form']['data'][1][1];
$text = $data['form']['data'][2][1];
$date = date('Y-m-d H:i:s');

$message = "Заявка на сайте\n\nИмя:\n$name\nТелефон:\n$phone\nТекст:\n$text\nДата:\n$date";

$res = mail(implode(',', $to), 'Заявка на сайте', $message);

if ($res) {
    echo json_encode([
        "status" => "Ready!",
        "response" => "Thanks for filling out form!"
    ]);
} else {
    echo json_encode([
        'error' => 'Send error'
    ]);
}