<?php

namespace App\Controller\Legals;
use App\Model\ChapterManager;

class LegalsController 
{
    /**
     * Render legals page
     */
    public function legals(){
        $chmanager = new ChapterManager();
        require('src/View/legals/legals.php');
    }
}