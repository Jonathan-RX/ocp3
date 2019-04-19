<?php

namespace App\Controller\PostContact;

use App\Services\ContactMail;
use App\Services\PHPSession;
use App\Services\Captcha;

class PostContactController 
{
   
    /**
     * Check the fields of the form, send an email and redirect to the contact page with a message of success or error
     */
    public function postContact(){
        if(!preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " ,$_POST['email'])){
            PHPSession::set('alert', '<header class="entry-header"><h4 class="entry-title">Votre adresse mail n\'a pas le bon format.</h4></header>');
            header('Location: /contact');
            return false;
        }
        if(!$_POST['data_privacy_consent']){
            PHPSession::set('alert', '<header class="entry-header"><h4 class="entry-title">Vous devez accepter l\'utilisation des données pour envoyer un mail.</h4></header>');
            header('Location: /contact');
            return false;
        }
        $captchaService = new Captcha();
        $captcha = $captchaService->checkCaptcha($_POST['g-recaptcha-response']);
        if ($captcha){
            $mail  = new ContactMail();
            if($mail->sendMail($_POST['email'], $_POST['name'], $_POST['subject'], $_POST['message'])){
                PHPSession::set('alert', '<header class="entry-header"><h4 class="entry-title">Merci ' . $_POST["name"] . ', le message a bien été envoyé.</h4></header>');
            }else{
                PHPSession::set('alert', '<header class="entry-header"><h4 class="entry-title"> Echec de l\'envoi du message, veuillez réessayer</h4></header>');
            }
            

        }else{
            PHPSession::set('alert', '<header class="entry-header"><h4 class="entry-title"> Erreur dans la sécurité antirobot, veuillez réessayer</h4></header>');
        }
        require('src/View/contact/contact.php');
    }
}