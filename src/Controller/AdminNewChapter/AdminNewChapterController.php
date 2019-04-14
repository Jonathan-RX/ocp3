<?php

namespace App\Controller\AdminNewChapter;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminNewChapterController 
{
    /**
     * Loads the page for creating a chapter
     */
    public function newChapter(){
        \App\Model\UsersManager::checkSession();
        require('src/View/admin/chapters/newChapter.php');
    }

}