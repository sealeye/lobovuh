<?php

$email = 'ipacmanx@gmail.com';

$tel = @$_POST['tel'];
$tel = trim($tel);
$fio = @$_POST['fio'];
$fio = trim($fio);

$body = file_get_contents('views/letter.tpl');

if (!empty($fio)) {
  $body = str_replace("%fio%", ', '.$fio, $body);
} else {
  $body = str_replace("%fio%", '', $body);
}
if (!empty($tel)) {
  $body = str_replace("%tel%", ', '.$tel, $body);
} else {
  $body = str_replace("%tel%", '', $body);
}

date_default_timezone_set('Etc/UTC');
require_once 'lib/PHPM/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->CharSet = "utf-8";
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';

/* Настройки настроечки для smtp */
// $mail->isSMTP();
// $mail->Host = "smtp.yandex.ru";
// $mail->Port = 465;
// $mail->SMTPSecure = 'ssl';
// $mail->SMTPAuth = true;
// $mail->Username = "логин";
// $mail->Password = "пароль";

$mail->setFrom('info@lobovuh.ru', 'Сайт лобовух');
$mail->addAddress($email);

if (isset($_FILES['photo'])) {
  if(@is_array(getimagesize($_FILES['photo']['tmp_name']))){
    $mail->addAttachment($_FILES['photo']['tmp_name'],'photo.jpg');
  }
}
$mail->Subject = 'Новая заявка';
$mail->Body    = $body;
$mail->IsHTML(true);

if (!$mail->send()) {
   echo json_encode(array("result"=>"error", "message"=>$mail->ErrorInfo));
} else {
   echo json_encode(array("result"=>"ok"));
}