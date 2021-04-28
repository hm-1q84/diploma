<?php 
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'spektrmashservis@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'RP2YppYo6rr-'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('spektrmashservis@mail.ru'); // от кого будет уходить письмо?
$mail->addAddress($email);     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Регистрация аккаунта в СпектрМашСервис';
$mail->Body    = 'Поздравляю с регистрацией аккаунта в продавца в СпектрМашСервис!<br>Ваш логин: '.$login.'<br>Пароль: '.$pswrd;
$mail->AltBody = '';

if(!$mail->send()) {
    echo 'Упс, ошибочка в отправке на почту!';
} else {
    echo '<script>alert("Аккаунт успешно создан! Пароль сгенерирован и отправлен на указанную почту.")</script>'; 
}
?>