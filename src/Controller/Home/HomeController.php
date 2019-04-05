<?php

namespace App\Controller\Home;
use App\Model\ChapterManager;

class HomeController 
{
    public function home(){
        require('src/View/home/home.php');
    }
}