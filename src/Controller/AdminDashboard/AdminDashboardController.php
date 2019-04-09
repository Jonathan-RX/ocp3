<?php

namespace App\Controller\AdminDashboard;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminDashboardController 
{
    public function adminDashboard(){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        $numberChapter = $chmanager->countChapters();
        $comanager = new CommentManager();
        $numberComment = $comanager->countComments();
        $lastComs = $comanager->getFiveLastComs();
        $lastReports = $comanager->getFiveLastReports();
        require('src/View/admin/dashboard/dashboard.php');

    }
}