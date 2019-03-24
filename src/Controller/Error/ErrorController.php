<?php

namespace App\Controller\Error;

class ErrorController {
    public function pageUnknow(){
        $error = "la page que vous demandez n'existe pas.";
        require('src/View/error/error.php');
    }
    public function chapterUnknow($id){
        $error = "le chapitre $id n'existe pas.";
        require('src/View/error/error.php');
    }
}
