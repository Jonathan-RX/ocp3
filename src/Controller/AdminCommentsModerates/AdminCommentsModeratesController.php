<?php

namespace App\Controller\AdminCommentsModerates;
use App\Model\CommentManager;

class AdminCommentsModeratesController{
    public function adminCommentsModeratesController(){
        \App\Model\UsersManager::checkSession();
        $comanager = new CommentManager();
        $comments = $comanager->getModeratesComments();
        require('src/View/admin/comments/commentsModerate.php');
    }
}