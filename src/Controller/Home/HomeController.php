<?php

namespace App\Controller\Home;
use App\Model\ChapterManager;

class HomeController 
{
    public function home(){
        $chmanager = new ChapterManager();
        require('src/View/home/home.php');
    }
}