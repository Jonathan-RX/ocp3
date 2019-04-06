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

    public function deleteChapter($id){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        if($chmanager->deleteChapter($id)){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-success" role="alert">Le chapitre à bien été supprimé</div>');
            header('Location: /admin/chapitres');
        }else{
            \App\Services\PHPSession::set('alert', '<div class="alert alert-warning" role="alert">Une erreur s\'est produite.</div>');
            header('Location: /admin/chapitres');
        }
    }

    public function editChapter($id){
        \App\Model\UsersManager::checkSession();
        if(is_numeric($id)){
            $chmanager = new ChapterManager();
            $chapter = $chmanager->getChapter($id);
        }else{
            $chapter = new \App\Model\Chapter();
            $chapter->setId('new');
            $chapter->setTitle('');
            $chapter->setSlug('');
            $chapter->setContent('');
            $chapter->setDate('');
        }
        require('src/View/admin/chapters/chapter.php');
    }
}