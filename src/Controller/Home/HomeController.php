<?php

namespace App\Controller\Home;
use App\Model\ChapterManager;

class HomeController 
{
    public function home(){
        $chmanager = new ChapterManager();
        $chapters = $chmanager->getAllChapters();
        require('src/View/home/home.php');
    }
}