<?php

namespace App\Controller\AdminLogin;

use App\Model\UsersManager;
use App\Services\PHPSession;

class AdminLoginController
{
    /**
     * Check if the session exists, redirect to the dashboard if yes, on the login page if not
     */
    public function adminLogin(){
        if(PHPSession::check('login_token')){
            header('Location: /admin/dashboard');
        }else{
            require('src/View/admin/login/login.php');
        }
    }
}