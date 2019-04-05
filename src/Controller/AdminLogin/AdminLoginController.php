<?php

namespace App\Controller\AdminLogin;

use App\Model\UsersManager;
use App\Services\PHPSession;

class AdminLoginController
{
    public function adminLogin(){
        
        if(PHPSession::check('login_token')){
            header('Location: /admin/dashboard');
        }else{
            require('src/View/admin/login/login.php');
        }
    }

    public function adminLogout(){
            PHPSession::delete('login_token');
            PHPSession::set('flash', '<div class="alert alert-success" role="alert">Vous êtes bien déconnecté.</div>');
            header('Location: /login');
    }

    public function adminLoginOn(){
        if(preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " ,$_POST['email'])){
            $usmanager = new UsersManager();
            if($usmanager->checkUser($_POST['email'], $_POST['password'])){
                PHPSession::set('login_token', true);
                header('Location: /admin/dashboard');
                return false;
            }else{
                PHPSession::set('flash', '<div class="alert alert-danger" role="alert">La combinaison de votre adresse et mot de passe saisis ne correspondent pas.</div>');
            }
        }else{
            PHPSession::set('flash', '<div class="alert alert-danger" role="alert">L\'adresse saisie est invalide.</div>');
        }
        require('src/View/admin/login/login.php');
    }
}