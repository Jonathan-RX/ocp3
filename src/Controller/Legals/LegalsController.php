<?php

namespace App\Controller\Legals;
use App\Model\ChapterManager;

class LegalsController 
{
    public function legals(){
        $chmanager = new ChapterManager();
        require('src/View/legals/legals.php');
    }
}