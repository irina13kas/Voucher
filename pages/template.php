<?php
header('Content-Type: application/json');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

session_start();
if (isset($_POST['send_email'])) {
    if (!isset($_SESSION['order'])) {
        die('Данные не найдены. Заполните форму в template.php.');
    }
    
    require '../vendor/autoload.php';
    // Создаем новый Excel-документ
    $data = $_SESSION['order'];
    $fileName = $data['surname'].'_'.date('d-m-Y').".xlsx";
    if (file_exists($fileName)) {
        $spreadsheet = IOFactory::load($fileName);
    } else {
        $spreadsheet = new Spreadsheet();
    }
        $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Заполняем данные из сессии
    $data = $_SESSION['order'];
    $voucherNumber = rand(1000, 9999); // Случайный номер путевки
    
    // Устанавливаем данные в ячейки (пример для шаблона из изображения)
    $sheet->getStyle('A:I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    $sheet->mergeCells('A1:C1');
    $sheet->setCellValue('A1', 'Туроператор:');
    $sheet->mergeCells('A2:C2');
    $sheet->setCellValue('A2', 'Вокруг света за 80 дней');
    $sheet->mergeCells('G1:I1');
    $sheet->setCellValue('G1', 'Утверждено Главным');
    $sheet->mergeCells('G2:I2');
    $sheet->setCellValue('G2', 'Министерством туризма от 01.02.2022');
    $sheet->mergeCells('G3:I3');
    $sheet->setCellValue('G3', 'от 01.02.2022');
    $sheet->mergeCells('A3:C3');
    $sheet->setCellValue('A3', 'г. Чегдомын');
    $sheet->mergeCells('A4:C4');
    $sheet->setCellValue('A4', 'ИНН 123456987');
    $sheet->mergeCells('C6:F6');
    $sheet->getStyle('C6')->getFont()->setBold(true);
    $sheet->setCellValue('C6', 'Туристическая путевка №');
    $sheet->getStyle('G6')->getFont()->setBold(true);
    $sheet->setCellValue('G6', $voucherNumber);
    
    // Заказчик
    $sheet->mergeCells('A8:F8');
    $sheet->getStyle('A8:F8')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('A8', 'Заказчик туристического продукта:');
    $sheet->mergeCells('G8:I8');
    $sheet->getStyle('G8:I8')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('G8', $data['name'].' '.$data['surname']);
    $sheet->mergeCells('A9:F9');
    $sheet->getStyle('A9:F9')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('A9', 'Телефон:');
    $sheet->mergeCells('G9:I9');
    $sheet->getStyle('G9:I9')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('G9', $data['phone']);
    $sheet->mergeCells('A10:F10');
    $sheet->getStyle('A10:F10')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('A10', 'Email:');
    $sheet->mergeCells('G10:I10');
    $sheet->getStyle('G10:I10')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('G10', $data['email']);
    
    // Данные путевки
    $sheet->mergeCells('A12:F12');
    $sheet->getStyle('A12:F12')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('A12', 'Тип путевки:');
    $sheet->mergeCells('G12:I12');
    $sheet->getStyle('G12:I12')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('G12', $data['type']['name']);
    $sheet->mergeCells('A13:F13');
    $sheet->getStyle('A13:F13')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('A13', 'Страна пребывания:');
    $sheet->mergeCells('G13:I13');
    $sheet->getStyle('G13:I13')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('G13', $data['country']['name']);
    $sheet->mergeCells('A14:F14');
    $sheet->getStyle('A14:F14')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('A14', 'Цена путевки базовая:');
    $sheet->mergeCells('G14:I14');
    $sheet->getStyle('G14:I14')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('G14', $data['type']['price']);
    $sheet->mergeCells('A15:F15');
    $sheet->getStyle('A15:F15')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('A15', 'Цена путевки с учетом страны:');
    $sheet->mergeCells('G15:I15');
    $sheet->getStyle('G15:I15')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
    $sheet->setCellValue('G15', $data['type']['price']+$data['country']['price']);
    
    // Доп. услуги
    $services = $data['services'];
    $sheet->mergeCells('A17:D17');
    $sheet->setCellValue('A17', 'Дополнительные услуги:');
    $price = 0;
    $index = 0;
    for ($i = 0; $i < count($services); $i++) {
        $sheet->setCellValue('B' . (18 + $i), ($i + 1));
        $sheet->getStyle('B' . (18 + $i), ($i + 1))->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $sheet->mergeCells('C'.(18 + $i).':E'.(18 + $i));
        // 2. Затем применяем стиль с границами
    $sheet->getStyle('C'.(18 + $i).':E'.(18 + $i))->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ]
        ]
    ]);
        $sheet->setCellValue('C' . (18 + $i), trim($services[$i]['name']));
        $sheet->setCellValue('F' . (18 + $i), trim($services[$i]['price']));
        $sheet->getStyle('F' . (18 + $i), ($i + 1))->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ]
            ]
        ]);
        $price += $services[$i]['price'];
        $index +=1;
    }
    $sheet->setCellValue('E'.$index+18, 'Итого');
    $sheet->setCellValue('F'.$index+18, $price);
    
    // Итоги
    $sheet->mergeCells('A23:E23');
    $sheet->setCellValue('A23', 'Количество дней:');
    $sheet->setCellValue('F23', $data['days']);
    $sheet->mergeCells('A24:E24');
    $sheet->setCellValue('A24', 'Вид питания:');
    $sheet->mergeCells('F24:G24');
    $sheet->setCellValue('F24', $data['meal']['name'].', '.$data['meal']['price']);
    
    $sheet->mergeCells('A26:E26');
    $sheet->getStyle('A26')->getFont()->setBold(true);
    $sheet->setCellValue('A26', 'Полная стоимость тура:');
    $sheet->mergeCells('F26:G26');
    $sheet->getStyle('F26')->getFont()->setBold(true);
    $sheet->setCellValue('F26', $data['total_cost'] . ' руб.');
    
    // Дата и подпись
    $sheet->mergeCells('B28:D28');
    $sheet->setCellValue('B28', 'Дата оформления:');
    $sheet->mergeCells('B29:D29');
    $sheet->setCellValue('B29', date('d.m.Y'));
    $sheet->mergeCells('G28:I28');
    $sheet->setCellValue('G28', 'Оператор:');
    $sheet->mergeCells('G29:I29');
    $sheet->setCellValue('G29', 'Наташа Петрова');
    // Сохраняем файл на сервере
    // $writer = new Xlsx($spreadsheet);
    // $writer->save($fileName);
    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Disposition: attachment; filename=""'.$fileName.'.xlsx');

    // $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    // $writer->save('php://output');

    // Путь для сохранения
// Настройка пути сохранения
$storageDir = __DIR__ . '../assets/';  // Путь к папке
$fullPath = $storageDir . $fileName;
// Проверяем и создаем папку, если её нет
if (!file_exists($storageDir)) {
    mkdir($storageDir, 0755, true); // 0755 — права на запись
}
// Сохраняем файл
try {
    $writer = new Xlsx($spreadsheet);
    $writer->save($fullPath);
    // Ответ в JSON (можно использовать в AJAX)
    echo json_encode([
        'status' => 'success',
        //'message' => 'Файл успешно сохранен на сервере.',
        'path' => $fullPath,
        //'url' => '../assets/' . $fileName, // Относительный URL
        
    ]);
    exit;
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Ошибка при сохранении: ' . $e->getMessage(),
    ]);
    exit;
}

// $dir = __DIR__ . '/assets/'; // Папка на сервере
// if (!file_exists($dir)) {
//     mkdir($dir, 0755, true); // Создаём папку, если её нет
// }

// // Формируем уникальное имя файла
// $filename = 'voucher_' . time() . '.xlsx';
// $fullPath = $dir . $filename;

// Сохраняем на сервер
   }
    
?>

<!-- <?php
require 'vendor/autoload.php';

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

// class MailSender {
//     private $mail;
    
//     public function __construct() {
//         $this->mail = new PHPMailer(true);
//         $this->configure();
//     }
    
//     private function configure() {
//         // Настройки SMTP
//         $this->mail->isSMTP();
//         $this->mail->Host = 'smtp.gmail.com'; // Ваш SMTP-сервер
//         $this->mail->Username = 'm.ira13kas@gmail.com';
//         $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//         $this->mail->Port = 465;
        
//         // Общие настройки
//         $this->mail->CharSet = 'UTF-8';
//         $this->mail->setFrom('noreply@traveldream.ru', 'TravelDream');
//         $this->mail->isHTML(true);
//     }
    
//     public function sendOrderConfirmation($toEmail, $toName, $orderDetails, $attachmentPath = null) {
//         try {
//             $this->mail->addAddress($toEmail, $toName);
//             $this->mail->Subject = 'Подтверждение заказа туристической путевки';
            
//             // Формируем HTML-письмо
//             $this->mail->Body = $this->createEmailBody($orderDetails);
            
//             // // Прикрепляем файл если есть
//             // if ($attachmentPath) {
//             //     $this->mail->addAttachment($attachmentPath);
//             // }
            
//             $this->mail->send();
//             return true;
//         } catch (Exception $e) {
//             error_log("Ошибка отправки письма: {$this->mail->ErrorInfo}");
//             return false;
//         }
//     }
    
//     private function createEmailBody($order) {
//         return '
//         <!DOCTYPE html>
//         <html>
//         <head>
//             <style>
//                 body { font-family: Arial, sans-serif; line-height: 1.6; }
//                 .header { color: #2c3e50; }
//                 .order-details { background: #f9f9f9; padding: 20px; border-radius: 5px; }
//                 .total { font-weight: bold; font-size: 1.2em; }
//             </style>
//         </head>
//         <body>
//             <div class="header">
//                 <h2>Уважаемый(ая) '.htmlspecialchars($order['user']).'!</h2>
//                 <p>Благодарим вас за заказ в TravelDream!</p>
//             </div>
            
//             <div class="order-details">
//                 <h3>Детали вашего заказа:</h3>
//                 <p><strong>Тип путевки:</strong> '.htmlspecialchars($order['type']).'</p>
//                 <p><strong>Страна:</strong> '.htmlspecialchars($order['country']).'</p>
//                 <p><strong>Питание:</strong> '.htmlspecialchars($order['meal']).'</p>
//                 <p><strong>Количество дней:</strong> '.htmlspecialchars($order['days']).'</p>
                
//                 <h4>Дополнительные услуги:</h4>
//                 <ul>';
//                     foreach ($order['services'] as $service) {
//                         $html .= '<li>'.htmlspecialchars($service['name']).'</li>';
//                     }
//         $html .= '</ul>
                
//                 <p class="total">Итоговая стоимость: '.htmlspecialchars($order['total']).' руб.</p>
//             </div>
            
//             <p>С уважением,<br>Команда TravelDream</p>
//         </body>
//         </html>
//         ';
//     }
// }
?> -->