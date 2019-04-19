<?php

namespace App\Controller\AdminCheckToken;

use App\Model\UsersManager;
use App\Services\PHPSession;

class AdminCheckTokenController
{

    /**
     * Check token get from Url and render page for new password if true
     *
     * @param  string Token to check
     */
    public function adminCheckToken($token = ''){
            $usmanager = new UsersManager();
            if($usmanager->checkToken($token)){
                PHPSession::set('reset_token', 'true');
                PHPSession::set('token', $token);
                require('src/View/admin/login/resetPasswordForm.php');
            }elseif(PHPSession::check('reset_token') AND PHPSession::check('token')){
                require('src/View/admin/login/resetPasswordForm.php');
            }else{
                PHPSession::set('flash', '<div class="alert alert-warning" role="alert">Une erreur est survenue. Veuillez recommencer.</div>');
                header('Location: /reinitialisation-mot-de-passe');
            }
    }
}