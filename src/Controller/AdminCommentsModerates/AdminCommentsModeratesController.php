<?php

namespace App\Controller\AdminCommentsModerates;
use App\Model\CommentManager;

class AdminCommentsModeratesController{
    /**
     * Get comments moderated from the database and loads the comments administration page
     */
    public function adminCommentsModeratesController(){
        \App\Model\UsersManager::checkSession();
        $comanager = new CommentManager();
        $comments = $comanager->getModeratesComments();
        require('src/View/admin/comments/commentsModerate.php');
    }
}