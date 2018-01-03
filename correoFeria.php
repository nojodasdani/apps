<?php
require 'mailer/PHPMailerAutoload.php';
$datos = $_POST['data'];
$asunto = $datos[2];
$llena = infoCorreo($datos);
$manda = enviarCorreo($asunto,$llena);

function infoCorreo($datos){//$name,$mail_to,$informacion,$tel
    $cuerpo_correo ="<!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <title></title>
            <style>
              .head {
                color: rgb(73,177,97);
                font-size:22px;
                font-weight: bold;
                text-align:right;
                vertical-align: 20px;
              }
              .content {
                color: black;
                text-align:left;
                font: small-caption;
              }
			  .footer {
                color: black;
                text-align:left;
                font: small-caption;
              }
              hr {
                color: black;
                width: 100%;
              }
            </style>
        </head>
        <body>
            <center>
              <div style='background-color: black'>
              <div style='text-align: center; width: 100%'>
                <img src='img/prox.png' alt='Proxtopic' width='50%'>
              </div>
                  <span class='head'>Experiencias por proximidad</span>
              </div>
            </center>
            <div class='content'>
                    Nombre: $datos[0]<br>
                    Correo: $datos[1]<br>
                    Mensaje: $datos[3]<br>
            </div>
			<div class='footer'>
            </div>
		</body>
        </html>";
    $array = array("feria@proxtopic.com",$cuerpo_correo);
    return $array;
}

function enviarCorreo($asunto, $info){
    $mail_subject = utf8_decode($asunto);
    $mail_subject = "=?ISO-8859-1?B?".base64_encode($mail_subject)."=?=";
    $mailer = new PHPMailer;
    $mailer->IsSMTP();
    $mailer->CharSet = 'UTF-8';
    $mailer->SMTPAuth = true;
    $mailer->SMTPSecure = 'ssl';
    $mailer->Host = 'mx1.hostinger.mx';
    $mailer->Port = 465;
    $mailer->Username = 'no-reply@opion-tech.com';
    $mailer->Password = 'opionNOreply2017';
    //$mailer->SMTPDebug = 4;
    $mailer->SetFrom('no-reply@opion-tech.com', "OPION");
    $mailer->Subject = $mail_subject;
    $mailer->MsgHTML($info[1]);
    $mailer->AddAddress($info[0]);
    $mailer->AddAddress('danielenriquez94.de@gmail.com');
    //$mailer->AddAddress('manuel.module@gmail.com');
    $result = $mailer->Send();
    return $result;
}
?>