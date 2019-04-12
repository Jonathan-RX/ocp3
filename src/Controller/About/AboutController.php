<?php

namespace App\Controller\About;

class AboutController 
{
    /**
     * Load the view for the page about
     */
    public function about(){
        require('src/View/about/about.php');
    }
}