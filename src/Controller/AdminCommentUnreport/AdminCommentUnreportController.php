<?php

namespace App\Controller\AdminCommentUnreport;
use App\Model\CommentManager;

class AdminCommentUnreportController{
    public function unreportComment($idComment, $url){
        \App\Model\UsersManager::checkSession();
        if(CommentManager::unreportComment($idComment)){
            \App\Services\PHPSession::set('alert', '<div class="alert alert-success" role="alert">Le commentaire n\'est plus signalé.</div>');
            header('Location: /admin/' . $url);
        }else{
            \App\Services\PHPSession::set('alert', '<div class="alert alert-warning" role="alert">Une erreur s\'est produite.</div>');
            header('Location: /admin/' . $url);
        }
    }
}