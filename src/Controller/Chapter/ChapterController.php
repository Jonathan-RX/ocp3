<?php

namespace App\Controller\Chapter;

use App\Model\ChapterManager;
use App\Controller\ErrorChapter\ErrorChapterController;

class ChapterController {
    /**
     * Retrieves chapter information with its slug, or redirects to a 404 error page if it does not exist
     *
     * @param  string Text to convert
     */
    public function chapterBySlug($slug){
        $data = new ChapterManager();
        $chapter = $data->getChapterBySlug($slug);
        if(!empty($chapter->getId())){
            require('src/View/chapters/chapter.php');
        }else{
            $error = new ErrorChapterController();
            $error->chapterUnknow($slug);
        }
    }
}