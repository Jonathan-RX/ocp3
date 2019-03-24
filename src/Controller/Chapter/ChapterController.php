<?php

namespace App\Controller\Chapter;

use App\Model\ChapterManager;
use App\Controller\Error\ErrorController;

class ChapterController {
    public function chapter($id){
        $data = new ChapterManager();
        $chapter = $data->getChapter($id);
        if(!empty($chapter)){
            require('src/View/chapters/chapter.php');
        }else{
            $error = new ErrorController();
            $error->chapterUnknow($id);
        }
    }
}