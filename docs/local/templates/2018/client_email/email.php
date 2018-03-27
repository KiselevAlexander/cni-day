<?
function send_client_email($email, $subject) {
    ob_start();
    ?>
    <!doctype html>
    <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>
        <body style="margin: 0;padding: 0;">
        <table border="0"
               cellpadding="0"
               cellspacing="0"
               style="width: 100%; border: 0; font-family: 'Arial', sans-serif;max-width: 600px;margin: 0 auto;"

        >
            <tr>
                <td>
                    <img alt=""
                         src="http://cni-day.ru/local/templates/2018/client_email/28750780_1670272443027237_4167279859615137792_n.jpg"
                         style="width: 100%;"
                    />
                </td>
            </tr>
        </table>
        <table border="0"
               cellpadding="0"
               cellspacing="0"
               style="width: 100%; border: 0; font-family: 'Arial', sans-serif;max-width: 600px;margin: 0 auto; text-align: center;"
        >
            <tr>
                <td valign="middle" style="padding-top: 40px;">
                    <h1 style="text-transform: uppercase; font-size: 28px; line-height: 1.5;">
                        Спасибо, что оставили заявку <br />
                        на участие в дне CNI
                    </h1>
                </td>
            </tr>
            <tr>
                <td valign="middle" style="padding-top: 40px;">
                    <b>Вас ждет незабываемая вечеринка для нейл-мастеров.</b> <br><br>
                    <ul style="text-align: left; display: inline-block;">
                        <li>6 часов обучения</li>
                        <li>скидки на продукцию</li>
                        <li>розыгрыш MIX-лампы и 10 призов</li>
                        <li>знакомства с мастерами города</li>
                        <li>зажигательный ведущий и DJ Dzuba</li>
                        <li>фуршет и торт</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td valign="middle" style="padding-top: 40px;">
                    <b>Менеджер свяжется с Вами, чтобы уточнить все детали.</b>
                </td>
            </tr>
        </table>
        </body>
    </html>
    <?

    $msg = ob_get_clean();

    $headers  = "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: {$subject} <no-reply@cni-day.ru>\r\n";

    mail($email, $subject, $msg, $headers);
}