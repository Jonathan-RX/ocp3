<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\config\Config;

class ContactMail{
    /**
     * Check parameters and send a new mail if true
     *
     * @param  string Visitor's email
     * @param  string Visitor's name
     * @param  string Message subject
     * @param  string Message
     *
     * @return bool True on success, false on fail
     */
    public function sendMail($email, $name, $subject, $message){
        return $this->initSMTP('jonathan.ravix@gmail.com', [$email, $name], $subject, $message);
            
    }

    /**
     * Send a mail to external email, used for reset password form
     *
     * @param  string User mail
     * @param  string Subject of the mail
     * @param  string Message to sent
     *
     * @return bool True on success, false on fail
     */
    public function sendMailTo($email, $subject, $message){
        return  $this->initSMTP($email, ['jean@forteroche.fr', 'Site de Jean Forteroche'], $subject, $message);
           
    }

    private function initSMTP($adresse, $replyTo = [], $subject, $message){
        $mail = new PHPMailer(true);
        $config = new Config();
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = $config->getMailHost();
            $mail->SMTPAuth   = $config->getMailAuth();
            $mail->Username   = $config->getMailUser();
            $mail->Password   = $config->getMailPassword();
            $mail->SMTPSecure = $config->getMailSecure();
            $mail->Port       = $config->getMailPort();
            $mail->setFrom('jean@forteroche.fr', 'Site de Jean Forteroche');
            $mail->addAddress($adresse);
            $mail->addReplyTo($replyTo[0], $replyTo[1]);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}