<?php

namespace App\Controller\Error;

class ErrorController {
    /**
     * Render 404 error page
     */
    public function pageUnknow(){
        $error = "la page que vous demandez n'existe pas.";
        require('src/View/error/error.php');
    }
}
