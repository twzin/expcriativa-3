<?php

    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');
    require_once('src/PhPMailerSrc.php');
    require_once('GeraSenha.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'projetoindependentden@gmail.com';
    $mail->Password = $Fanhui;
    $mail->Port = 587;

    $mail->IsHtml(true);

    return $mail


?>