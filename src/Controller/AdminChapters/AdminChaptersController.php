<?php

namespace App\Controller\AdminChapters;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminChaptersController 
{
    public function adminChaptersController(){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        $chapters = $chmanager->getAllChaptersWithComs();
        require('src/View/admin/chapters/chapters.php');

    }

    public function editChapter($id){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        $chapter = $chmanager->getChapter($id);
        require('src/View/admin/chapters/chapter.php');
    }

    
}