<?php

namespace App\Controller\Chapters;

use App\Model\ChapterManager;
use App\Controller\Error\ErrorController;

class ChaptersController 
{
    public function chapters($page = 1){
        $chmanager = new ChapterManager();
        $chapters = $chmanager->getFiveChaptersWithComs($page);
        $nbrPages = $chmanager->getNumberPages();
        if(isset($chapters[0])){
            require('src/View/chapters/chapters.php');
        }else{
            $error = new ErrorController();
            $error->pageUnknow();
        }
    }
}