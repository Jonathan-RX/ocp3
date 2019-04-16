<?php

namespace App\Controller\AdminLoginOn;

use App\Model\UsersManager;
use App\Services\PHPSession;

class AdminLoginOnController
{
    /**
     * Get the result of the login form, check if the information is correct and redirect to the dashboard if yes
     */
    public function adminLoginOn(){
        if(isset($_POST['login']) AND isset($_POST['password'])){
            $usmanager = new UsersManager();
            if($usmanager->checkUser($_POST['login'], $_POST['password'])){
                PHPSession::set('login_token', true);
                header('Location: /admin/dashboard');
                return false;
            }else{
                PHPSession::set('flash', '<div class="alert alert-danger" role="alert">La combinaison de votre adresse et mot de passe saisis ne correspondent pas.</div>');
            }
            require('src/View/admin/login/login.php');
        }else{
            PHPSession::set('flash', '<div class="alert alert-danger" role="alert">Une erreur s\'est produite.</div>');
            require('src/View/admin/login/login.php');
        }
    }
}