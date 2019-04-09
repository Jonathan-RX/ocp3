<?php

namespace App\Controller\AdminComments;
use App\Model\CommentManager;

class AdminCommentsController{
    public function adminCommentsController(){
        \App\Model\UsersManager::checkSession();
        $comanager = new CommentManager();
        $comments = $comanager->getReportedComments();
        require('src/View/admin/comments/comments.php');
    }
}