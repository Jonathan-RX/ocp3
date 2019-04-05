<?php

namespace App\Controller\Contact;

use App\Services\ContactMail;
use App\Services\PHPSession;

class ContactController 
{
    public function contact(){
        require('src/View/contact/contact.php');
    }

    
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
        $secret = "6Lc135oUAAAAAOQwp5gGmJIrgu2gJQr9yAXR6jTQ";
        $response = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;
        
        $decode = json_decode(file_get_contents($api_url), true);
        if (isset($decode['success']) AND $decode['success'] == true) {
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