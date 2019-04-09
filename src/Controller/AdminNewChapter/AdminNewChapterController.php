<?php

namespace App\Controller\AdminNewChapter;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminNewChapterController 
{
    public function newChapter(){
        \App\Model\UsersManager::checkSession();
        $chapter = new \App\Model\Chapter();
        $chapter->setId('new');
        $chapter->setTitle('');
        $chapter->setSlug('');
        $chapter->setContent('');
        $chapter->setDate('');
        require('src/View/admin/chapters/newchapter.php');
    }

}