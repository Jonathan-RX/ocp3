<?php

namespace App\Controller\AdminEditChapter;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminEditChapterController 
{
    /**
     * Load chapter editing page
     *
     * @param  int Target comment Id
     */
    public function editChapter($id){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        $chapter = $chmanager->getChapter($id);
        if(!$chapter->getId()){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-warning" role="alert">Le chapitre n\'existe pas.</div>');
            header('Location: /admin/chapitres');
        }
        require('src/View/admin/chapters/chapter.php');
    }

    
}