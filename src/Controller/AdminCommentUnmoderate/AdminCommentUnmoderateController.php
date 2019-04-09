<?php

namespace App\Controller\AdminCommentUnmoderate;
use App\Model\CommentManager;

class AdminCommentUnmoderateController{
    public function unmoderateComment($idComment, $url){
        \App\Model\UsersManager::checkSession();
        if(CommentManager::unmoderateComment($idComment)){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-success" role="alert">Le contenu du commentaire est à nouveau visible</div>');
            header('Location: /admin/' . $url);
        }else{
            \App\Services\PHPSession::set('alert', '<div class="alert alert-warning" role="alert">Une erreur s\'est produite.</div>');
            header('Location: /admin/' . $url);
        }
    }
}