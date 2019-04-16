<?php

namespace App\Controller\AdminResetPasswordSubmit;

use App\Model\UsersManager;
use App\Services\PHPSession;
use App\Services\ContactMail;

class AdminResetPasswordSubmitController
{
    /**
     * Get the result of the reset password form, check if the mail is correct and send mail with unique token for reset password if true
     */
    public function adminResetPasswordSubmit(){
        if(isset($_POST['email'])){
            if(preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " ,$_POST['email'])){
                $usmanager = new UsersManager();
                $token = $usmanager->resetPassword($_POST['email']);
                if($token){
                    var_dump($token);
                    //envoi du mail
                    $message = "Bonjour, <br />
                    Une demande de réinitialisation du mot de passe associé à votre mail vient d'être soumise sur le site Jean Forteroche. <br /><br />
                    Pour réinitialiser votre mot de passe, veuillez utiliser le lien suivant :<br />
                    http://ocp3.jr-dev.fr/confirmation/$token <br /><br />
                    Si vous n'êtes pas à l'origine de cette demande, merci de ne pas en tenir compte.";
                    $mail  = new ContactMail();
                    var_dump($mail->sendMailTo(
                        $_POST['email'], 
                        'Reinitialisation du mot de passe de votre compte ' . $_POST['email'], 
                        $message
                    ));
                }
            }
            PHPSession::set('flash', '<div class="alert alert-success" role="alert">Si l\'adresse mail existe, vous recevrez un lien vous permettant de réinitialiser votre mot de passe.</div>');
            require('src/View/admin/login/resetPassword.php');
        }else{
            PHPSession::set('flash', '<div class="alert alert-danger" role="alert">Une erreur s\'est produite.</div>');
            require('src/View/admin/login/resetPassword.php');
        }
    }
}