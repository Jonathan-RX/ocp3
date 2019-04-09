<?php

namespace App\Controller\AdminChapterSubmit;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminChapterSubmitController 
{
    public function newChapter(){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        $chapter = new \App\Model\Chapter();
        $chapter->setTitle($_POST['title']);
        $title = $chapter->slugify($_POST['title']);
        $chapter->setSlug($title);
        $chapter->setContent($_POST['content']);
        if($id = $chmanager->addChapter($chapter)){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-success" role="alert">Le chapitre à bien été ajouté</div>');
            header('Location: /admin/chapitre/' . $id);
        }else{

        }
    }
    
    public function updateChapter(){
        \App\Model\UsersManager::checkSession();
        $chmanager = new ChapterManager();
        $chapter = new \App\Model\Chapter();
        $chapter->setID($_POST['id']);
        $chapter->setTitle($_POST['title']);
        $title = $chapter->slugify($_POST['slug']);
        $chapter->setSlug($title);
        $chapter->setContent($_POST['content']);
        if( $chmanager->updateChapter($chapter)){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-success" role="alert">Le chapitre à bien été mis à jours</div>');
            header('Location: /admin/chapitre/' . $_POST['id']);
        }else{

        }
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
}