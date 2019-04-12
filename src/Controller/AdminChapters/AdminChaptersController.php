<?php

namespace App\Controller\AdminChapters;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminChaptersController 
{
    /**
     * Get chapter information and load the view for the admin page Chapters
     */
    public function adminChaptersController(){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        $chapters = $chmanager->getAllChaptersWithComs();
        require('src/View/admin/chapters/chapters.php');

    }   
}