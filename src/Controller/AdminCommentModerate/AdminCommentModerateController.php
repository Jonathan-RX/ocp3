<?php

namespace App\Controller\AdminCommentModerate;
use App\Model\CommentManager;

class AdminCommentModerateController{
    public function moderateComment($idComment, $url){
        \App\Model\UsersManager::checkSession();
        if(CommentManager::moderateComment($idComment)){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-success" role="alert">Le commentaire à bien été modéré</div>');
            header('Location: /admin/' . $url);
        }else{
            \App\Services\PHPSession::set('alert', '<div class="alert alert-warning" role="alert">Une erreur s\'est produite.</div>');
            header('Location: /admin/' . $url);
        }
    }
}