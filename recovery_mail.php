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

$mail->Subject = 'Восстановление пароля аккаунта продавца в СпектрМашСервис';
$mail->Body    = 'Ваш пароль: '.$pswrd.'<br>В целях безопасности вашего аккаунта реккомендуем сменить пароль! Сделать это можно, авторизовавшись,
                    на личной странице вашего аккаунта';
$mail->AltBody = '';

if(!$mail->send()) {
    echo '<script>alert("Упс, ошибочка в отправке на почту!")</script>'; 
} else {
    echo '<script>alert("Пароль отправлен на вашу почту!")</script>'; 
}
?>