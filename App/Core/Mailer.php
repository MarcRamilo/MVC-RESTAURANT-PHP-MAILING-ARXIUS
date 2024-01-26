<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/phpmailer/phpmailer/src/PHPMailer.php';

class Mailer extends PHPMailer
{

    function mailServerSetup()
    {
        // $this->SMTPDebug = 4;
        // $this->SMTPDebug = SMTP::DEBUG_SERVER;
        // $this->SMTPDebug = SMTP::DEBUG_CONNECTION;
        $this->isSMTP();
        $this->Host = 'smtp.gmail.com';
        $this->SMTPAuth = true;
        $this->SMTPAutoTLS = false;
        $this->Username = 'marcramilogarrido04@gmail.com';
        $this->Password = 'ocyjrgcmqskasfiu';
        $this->SMTPSecure = 'tls'; 
        $this->Port = 587 ;
    }

    /**
     * @throws Exception
     */
    function addRec($to, $cc, $bcc)
    {
        $this->setFrom('', '');

        foreach ($to as $address) {
            $this->addAddress($address);
        }

        foreach ($cc as $address) {
            $this->addCC($address);
        }

        foreach ($bcc as $address) {
            $this->addBCC($address);
        }
    }
     /**
     * @throws Exception
     */
    function addAttach($att)
    {
        foreach ($att as $attachment) {
            $this->addAttachment($attachment);
        }
    }
     /**
     * @throws Exception
     */
    function addVeifyContent($user = null)
    {
        $this->isHTML(true);
        $this->Subject = 'Verifica la teva compte';
        $content = 'Hola ' . $user['name'];
        $content .= '<p>Gracies per registrar-te en la nostre web, per verificar la teva compte has de fer-ho fent click en el siguent enllaç:</p>
        <a style="padding:4px; background-color: red; color:white text-decoration-color:unset;" href="http://localhost/user/verify/?username=' . $user['username'] . "&token=" . $user['token'] .'">Verificar compte</a>';
       $this->Body = $content;
    }
    function addContentChat($content){
        $this->isHTML(true);
        $this->Subject = 'Missatge de ' . $_SESSION['logged_user']['username'];
        $this->Body = $content;

    }
}
