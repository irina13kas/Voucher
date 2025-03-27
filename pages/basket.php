<?php

session_start();
$total = 0;
$order = $_SESSION['order'];
$total += $order['type']['price'];
$total += $order['meal']['price'] * $order['days'];
// Стоимость страны и услуг
$total += $order['country']['price'];
foreach ($order['services'] as $service) {
    $total += $service['price'];
}
$success = true;
$_SESSION['order']['total_cost'] = $total;
if($_SESSION['order'] > 0) {
    $success = false;
}
?>

<html>
    <head>
        <title>Работа</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body topmargin="0" bottommargin="0" rightmargin="0"  leftmargin="0"   background="../images/back_main.gif">
        <table cellpadding="0" cellspacing="0" border="0"  align="center" width="583" height="614">
            <tr>
                <td valign="top" width="583" height="208" background="../images/row1.gif">
                    <div style="margin-left:88px; margin-top:57px "><img src="../images/w1.gif">    </div>
                    <div style="margin-left:50px; margin-top:69px ">
                        <a href="../index.php">Главная<img src="../images/m1.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="20" height="10">
                        <a href="order.php">Заказ<img src="../images/m2.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="basket.php">Корзина<img src="../images/m3.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="index-3.php">О компании<img src="../images/m4.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="index-4.php">Контакты<img src="../images/m5.gif" border="0" ></a>
                        </form>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top" width="583" height="338"  bgcolor="#FFFFFF">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top" height="338" width="42"></td>
                            <td valign="top" height="338" width="492">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td width="492" valign="top" height="106">

                                            <div style="margin-left:1px; margin-top:2px; margin-right:10px "><br>
                                                <div style="margin-left:5px "><img src="../images/1_p1.gif" align="left"></div>
                                                <div style="margin-left:95px "><font class="title">Вокруг света за 80 дней</font><br>
                                            


                                                </div> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="492" valign="top" height="232">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td valign="top" height="232" width="248">
                                                        
                                                        <div style="margin-left:6px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                        <?php if (!isset($_SESSION['user'])): ?>
                                                            <div style="text-align: center; margin-top: 50px;">
                                                                <h3>Для оформления заказа войдите в систему</h3>
                                                                <a href="/index.php"><button>Войти в профиль</button></a>
                                                            </div>
                                                        <?php else: ?> 
                                                            <h3>Детали заказа</h3>
                                                            <p><strong>Тип путевки:</strong> <?= $order['type']['name'] ?> 
                                                                - <?= $order['type']['price'] ?></p>
                                                            <p><strong>Страна:</strong> <?= $order['country']['name'] ?> 
                                                                - <?= $order['country']['price'] ?></p>
                                                            <p><strong>Вид питания:</strong> <?= $order['meal']['name'] ?> 
                                                                - <?= $order['meal']['price']?> руб./день</p>
                                                            <p><strong>Дополнительные услуги:</strong> </p>
                                                            <ul>
                                                                <?php foreach ($order['services'] as $service): ?>
                                                                    <li> 
                                                                        <?= $service['name'] ?> - <?= $service['price'] ?>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <div style="margin-left:6px; margin-top:7px; "><img src="../images/1_w2.gif"></div>

                                                    <td valign="top" height="215" width="1" background="../images/tal.gif" style="background-repeat:repeat-y"></td>
                                                    <td valign="top" height="215" width="243">
                                                        <div style="margin-left:22px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w2.gif"></div>
                                                        <div style="margin-left:22px; margin-top:13px; ">
                                                            <?php if ($success): ?>
                                                                <h3 style="color: green;">Заказ успешно оформлен!</p>
                                                            <?php endif; ?>
                                                            <h2>Итоговая сумма: <?= $total ?> руб.</h2>
                                                            
<br><br><br><br>
                                                   
                                                        </div>
                                                        <div style="margin-left:22px; margin-top:16px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w4.gif"></div>
                                                        <div style="margin-left:22px; margin-top:9px; ">
                                                        <form action="send_order.php" method="post">
                                                            <button type="submit">Отправить на почту и записать в файл</button>
                                                        </form>   
                                                                </div> 
                                                            </div>
                                                            <?php endif; ?> 


                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" height="338" width="49"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" width="583" height="68" background="../images/row3.gif">
                    <div style="margin-left:51px; margin-top:31px ">
                        <a href="#"><img src="../images/p1.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="26" height="9">
                        <a href="#"><img src="../images/p2.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="30" height="9">
                        <a href="#"><img src="../images/p3.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="149" height="9">
                        <a href="index-5.php"><img src="../images/copyright.gif" border="0"></a>
                    </div>
                </td>
            </tr>

        </table>
    </body>
</html>

<?php
require 'template.php';

if (isset($_POST['send_email'])) {

// Подготовка данных для письма
$orderData = [
    'user' => $_SESSION['order']['name'],
    'type' => $_SESSION['order']['type']['name'],
    'country' => $_SESSION['order']['country']['name'],
    'meal' => $_SESSION['order']['meal']['name'],
    'days' => $_SESSION['order']['days'],
    'services' => $_SESSION['order']['services'],
    'total' => $_SESSION['order']['total_cost']
];

// Путь к файлу Excel
$excelFile = $order['name'] . '_' . date('Y-m-d') . '.xlsx';

// Отправка письма
$mailer = new MailSender();
if ($mailer->sendOrderConfirmation(
    $order['email'],
    $order['name'],
    $orderData,
    $excelFile
)) {
    $_SESSION['mail_status'] = 'Письмо с подтверждением заказа отправлено на ваш email';
} else {
    $_SESSION['mail_status'] = 'Произошла ошибка при отправке письма';
}
}
// Перенаправление обратно в корзину
header("Location: basket.php");
exit;
?>
<!-- <?php
// Данные для письма
$to = $_SESSION['order']['email'];
$subject = 'Ваш заказ туристической путевки';
$order = $_SESSION['order'];

// Формируем текст письма
$message = '
<html>
<head>
    <title>Ваш заказ</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { color: #0066cc; }
        .details { margin-left: 20px; }
    </style>
</head>
<body>
    <h2 class="header">Уважаемый(ая) '.htmlspecialchars($_SESSION['order']['name']).'!</h2>
    <div class="details">
        <p>Вы оформили заказ на <strong>'.htmlspecialchars($order['type']['name']).'</strong> в '.htmlspecialchars($order['country']['name']).'</p>
        
        <h3>Детали заказа:</h3>
        <ul>
            <li>Тип питания: '.htmlspecialchars($order['meal']['name']).'</li>
            <li>Количество дней: '.htmlspecialchars($order['days']).'</li>
            <li>Дополнительные услуги: '.implode(', ', array_map('htmlspecialchars', $order['services']['name'])).'</li>
        </ul>
        
        <h3>Итоговая стоимость: '.$order['total_cost'].' руб.</h3>
        
        <p>Спасибо за ваш заказ!</p>
        <p>Команда TravelDream</p>
    </div>
</body>
</html>
';

// Заголовки письма
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "From: TravelDream <noreply@traveldream.ru>\r\n";
$headers .= "Reply-To: support@traveldream.ru\r\n";

// Отправка письма
$mailSent = mail($to, $subject, $message, $headers);

// Проверка отправки
if ($mailSent) {
    $_SESSION['mail_status'] = 'Письмо с деталями заказа отправлено на ваш email';
} else {
    $_SESSION['mail_status'] = 'Ошибка при отправке письма';
}

// Перенаправление с сообщением
header("Location: basket.php");
exit;
?> -->

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\IOFactory;
// if (!isset($_SESSION['order'])) {
//     die('Данные не найдены. Заполните форму в template.php.');
// }

// require 'vendor/autoload.php';
// // Создаем новый Excel-документ
// $data = $_SESSION['order'];
// $fileName = "assets/".$data['name'].date('d-m-Y').".xlsx";
// if (file_exists($fileName)) {
//     $spreadsheet = IOFactory::load($fileName);
//     $sheet = $spreadsheet->getActiveSheet();
// } else {
//     $spreadsheet = new Spreadsheet();
//     $sheet = $spreadsheet->getActiveSheet();
// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();

// // Заполняем данные из сессии
// $data = $_SESSION['order'];
// $voucherNumber = rand(1000, 9999); // Случайный номер путевки

// // Устанавливаем данные в ячейки (пример для шаблона из изображения)
// $sheet->setCellValue('A1', 'Туроператор: ' . 'Вокруг света за 80 дней');
// $sheet->setCellValue('G1', 'Утверждено Главным Министерством туризма от 01.02.2022');
// $sheet->setCellValue('A3', 'г. Чегдомын');
// $sheet->setCellValue('A4', 'ИНН 123456987');
// $sheet->setCellValue('A6', 'Туристическая путевка №');
// $sheet->setCellValue('B6', $voucherNumber);

// // Заказчик
// $sheet->setCellValue('A8', 'Заказчик туристического продукта:');
// $sheet->setCellValue('B8', $data['name']);
// $sheet->setCellValue('A9', 'Телефон:');
// $sheet->setCellValue('B9', $data['phone']);
// $sheet->setCellValue('A10', 'Email:');
// $sheet->setCellValue('B10', $data['email']);

// // Данные путевки
// $sheet->setCellValue('A12', 'Тип путевки:');
// $sheet->setCellValue('B12', $data['type']['name']);
// $sheet->setCellValue('A13', 'Страна пребывания:');
// $sheet->setCellValue('B13', $data['country']['name']);
// $sheet->setCellValue('A14', 'Цена путевки базовая:');
// $sheet->setCellValue('B14', $data['type']['price']);
// $sheet->setCellValue('A15', 'Цена путевки с учетом страны:');
// $sheet->setCellValue('B15', $data['type']['price']+$data['country']['price']);

// // Доп. услуги
// $services = $data['services'];
// $sheet->setCellValue('A17', 'Дополнительные услуги:');
// for ($i = 0; $i < count($services); $i++) {
//     $sheet->setCellValue('A' . (18 + $i), ($i + 1));
//     $sheet->setCellValue('B' . (18 + $i), trim($services[$i]['name']));
//     $sheet->setCellValue('C' . (18 + $i), trim($services[$i]['price']));
// }

// // Итоги
// $sheet->setCellValue('A22', 'Количество дней:');
// $sheet->setCellValue('B22', $data['days']);
// $sheet->setCellValue('A23', 'Вид питания:');
// $sheet->setCellValue('B23', $data['meal']['name']);
// $sheet->setCellValue('A25', 'Полная стоимость тура:');
// $sheet->setCellValue('B25', $data['total_cost'] . ' руб.');

// // Дата и подпись
// $sheet->setCellValue('A27', 'Дата:');
// $sheet->setCellValue('B27', date('d.m.Y'));
// $sheet->setCellValue('A28', 'Оператор:');
// $sheet->setCellValue('B28', 'Наташа Петрова');
// // Сохраняем файл на сервере
// $writer = new Xlsx($spreadsheet);
// $writer->save($fileName);
// }
?>
