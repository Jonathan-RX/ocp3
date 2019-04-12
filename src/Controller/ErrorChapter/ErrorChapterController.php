<?php

namespace App\Controller\ErrorChapter;

class ErrorChapterController {
    /**
     * Render 404 error page for a chapter
     *
     * @param  int The chapter id in error
     */
    public function chapterUnknow($id){
        $error = "le chapitre $id n'existe pas.";
        require('src/View/error/error.php');
    }
}
