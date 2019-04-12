<?php

namespace App\Controller\AdminDeleteChapter;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminDeleteChapterController 
{   
    /**
     * Delete a chapter and redirect to chapter list
     *
     * @param  int Target chapter Id
     */
    public function deleteChapter($idChapter){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        if($chmanager->deleteChapter($idChapter)){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-success" role="alert">Le chapitre à bien été supprimé</div>');
            header('Location: /admin/chapitres', 302); exit;
        }else{
            \App\Services\PHPSession::set('alert', '<div class="alert alert-warning" role="alert">Une erreur s\'est produite.</div>');
            header('Location: /admin/chapitres', 302); exit;
        }
    }
}