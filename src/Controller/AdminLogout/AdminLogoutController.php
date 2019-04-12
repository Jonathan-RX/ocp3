<?php

namespace App\Controller\AdminLogout;

use App\Model\UsersManager;
use App\Services\PHPSession;

class AdminLogoutController
{
    /**
     * End the session and redirect to the login page
     */
    public function adminLogout(){
            PHPSession::delete('login_token');
            PHPSession::set('flash', '<div class="alert alert-success" role="alert">Vous êtes bien déconnecté.</div>');
            header('Location: /login');
    }
}