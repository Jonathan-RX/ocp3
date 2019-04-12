<?php

namespace App\Controller\Home;
use App\Model\ChapterManager;

class HomeController 
{
    /**
     * Render website home page
     */
    public function home(){
        require('src/View/home/home.php');
    }
}