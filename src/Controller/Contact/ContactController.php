<?php

namespace App\Controller\Contact;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController 
{
    public function contact(){
        require('src/View/contact/contact.php');
    }

    public function postContact(){
        $secret = "6Lc135oUAAAAAOQwp5gGmJIrgu2gJQr9yAXR6jTQ";
        $response = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;
        
        $decode = json_decode(file_get_contents($api_url), true);
        if (isset($decode['success']) AND $decode['success'] == true) {
            $mail = new PHPMailer(true);
            try {
                ob_start();
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'jrdev.send@gmail.com';
                $mail->Password   = 'ecumwhoakukdzmld';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                $mail->setFrom('jean@forteroche.fr', 'Site de Jean Forteroche');
                $mail->addAddress('jonathan.ravix@gmail.com');
                $mail->addReplyTo($_POST["email"], $_POST["name"]);
                $mail->isHTML(true);
                $mail->Subject = $_POST["subject"];
                $mail->Body    = $_POST["message"];
            
                $mail->send();
                $test = ob_get_clean();
            } catch (Exception $e) {
                $decode['success'] = false;
            }

        }
        require('src/View/contact/contact.php');
    }
}