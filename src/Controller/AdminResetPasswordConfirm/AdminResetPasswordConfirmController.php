<?php

namespace App\Controller\AdminResetPasswordConfirm;

use App\Model\UsersManager;
use App\Services\PHPSession;

class AdminResetPasswordConfirmController
{
    /**
     * Confirm password, update it and redirect to login page with a success message
     */
    public function adminResetPasswordConfirm(){
        if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $_POST['password']) AND $_POST['password'] === $_POST['passwordconfirm']){
            $token = PHPSession::check('token');
            $usmanager = new UsersManager();
            $usmanager->changePassword($_POST['password'], $token);
            PHPSession::delete('token');
            PHPSession::delete('reset_token');
            PHPSession::set('flash', '<div class="alert alert-success" role="alert">Votre mot de passe a bien été modifié, vous pouvez vous identifier.</div>');
            header('Location: /login');
        }else{
            PHPSession::set('flash', '<div class="alert alert-warning" role="alert">Votre nouveau mot de passe ne respecte pas les conditions nécessaires. Veuillez recommencer.</div>');
            header('Location: /confirmation');
        }
    }
}