<?php

namespace App\Controller\AdminChapterSubmit;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminChapterSubmitController 
{
    /**
     * Save a new chapter in database, then redirect to the chapter edition inserted
     */
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
            \App\Services\PHPSession::set('alert', '<div class="alert alert-alert" role="alert">Une erreur s\'est produite</div>');
            header('Location: /admin/chapitres');
        }
    }
}