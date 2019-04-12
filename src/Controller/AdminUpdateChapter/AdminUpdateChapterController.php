<?php

namespace App\Controller\AdminUpdateChapter;
use App\Model\ChapterManager;
use App\Model\CommentManager;

class AdminUpdateChapterController 
{
    /**
     * Retrieves the information from the form, updates the chapter in the database and redirects to the chapter editing page
     */
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
}