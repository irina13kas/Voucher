<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailSender {
    private $mail;
    
    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->configure();
    }
    
    private function configure() {
        // Настройки SMTP
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com'; // Ваш SMTP-сервер
        $this->mail->Username = 'm.ira13kas@gmail.com';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
        
        // Общие настройки
        $this->mail->CharSet = 'UTF-8';
        $this->mail->setFrom('noreply@traveldream.ru', 'TravelDream');
        $this->mail->isHTML(true);
    }
    
    public function sendOrderConfirmation($toEmail, $toName, $orderDetails, $attachmentPath = null) {
        try {
            $this->mail->addAddress($toEmail, $toName);
            $this->mail->Subject = 'Подтверждение заказа туристической путевки';
            
            // Формируем HTML-письмо
            $this->mail->Body = $this->createEmailBody($orderDetails);
            
            // // Прикрепляем файл если есть
            // if ($attachmentPath) {
            //     $this->mail->addAttachment($attachmentPath);
            // }
            
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Ошибка отправки письма: {$this->mail->ErrorInfo}");
            return false;
        }
    }
    
    private function createEmailBody($order) {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .header { color: #2c3e50; }
                .order-details { background: #f9f9f9; padding: 20px; border-radius: 5px; }
                .total { font-weight: bold; font-size: 1.2em; }
            </style>
        </head>
        <body>
            <div class="header">
                <h2>Уважаемый(ая) '.htmlspecialchars($order['user']).'!</h2>
                <p>Благодарим вас за заказ в TravelDream!</p>
            </div>
            
            <div class="order-details">
                <h3>Детали вашего заказа:</h3>
                <p><strong>Тип путевки:</strong> '.htmlspecialchars($order['type']).'</p>
                <p><strong>Страна:</strong> '.htmlspecialchars($order['country']).'</p>
                <p><strong>Питание:</strong> '.htmlspecialchars($order['meal']).'</p>
                <p><strong>Количество дней:</strong> '.htmlspecialchars($order['days']).'</p>
                
                <h4>Дополнительные услуги:</h4>
                <ul>';
                    foreach ($order['services'] as $service) {
                        $html .= '<li>'.htmlspecialchars($service['name']).'</li>';
                    }
        $html .= '</ul>
                
                <p class="total">Итоговая стоимость: '.htmlspecialchars($order['total']).' руб.</p>
            </div>
            
            <p>С уважением,<br>Команда TravelDream</p>
        </body>
        </html>
        ';
    }
}
?>