<?php

namespace App\Controller\Chapter;

use App\Model\ChapterManager;
use App\Controller\Error\ErrorController;

class ChapterController {
    public function chapter($id){
        $data = new ChapterManager();
        $chapter = $data->getChapter($id);
        if(!empty($chapter->getId())){
            require('src/View/chapters/chapter.php');
        }else{
            $error = new ErrorController();
            $error->chapterUnknow($id);
        }
    }
    public function chapterBySlug($slug){
        $data = new ChapterManager();
        $chapter = $data->getChapterBySlug($slug);
        if(!empty($chapter->getId())){
            require('src/View/chapters/chapter.php');
        }else{
            $error = new ErrorController();
            $error->chapterUnknow($slug);
        }
    }
}