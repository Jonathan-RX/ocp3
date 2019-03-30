<?php

namespace App\Controller\About;

class AboutController 
{
    public function about(){
        require('src/View/about/about.php');
    }
}