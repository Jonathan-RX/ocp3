<?php

namespace App\Controller\AdminResetPassword;

class AdminResetPasswordController
{
    /**
     * Render reset password page
     */
    public function adminResetPassword(){
            require('src/View/admin/login/resetPassword.php');
    }
}