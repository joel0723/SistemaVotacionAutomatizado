<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailHandler {

    public $mail;
    private $jsonFile;

    function __construct()
    {
        $this->mail = new PHPMailer(true);
        
    }

    public function sendEmail($to,$subject,$content) {

        try {

        

        // Configuration

        $this->mail->SMTPDebug = 2;
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "20186508@itla.edu.do";
        $this->mail->Password = "20186508";
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port = 587;
        $this->mail->setFrom("20186508@itla.edu.do","Sistema de notificacion");

        //Destinatario

        $this->mail->addAddress($to);

        //Contenido

        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $content;

        //Enviar correo

        $this->mail->send();

        } catch(Exception $e) {

            echo "El mensaje no pudo ser enviado por el siguiente error {$this->mail->ErrorInfo}";
            exit();
        }

        
    }
}

?>