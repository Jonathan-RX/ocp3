<?php

namespace App\Controller\Comment;

use App\Model\CommentManager;
use App\Model\Comment;

class CommentController{
    public function postComment($id){
        if(isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['postId'])){
            $data = new CommentManager();
            $comment = new Comment();
            $comment->setPostId($_POST['postId']);
            $comment->setAuthor($_POST['author']);
            $comment->setComment($_POST['comment']);
            $request = $data->addComment($comment);
            if($request != false){
                header('Location: chapitre-' . $id . '?comment=success');
            }else{
                die('Impossible d\'ajouter le commentaire.');
            }
       }
    }
    public function reportComment($postId, $commentId){
        $data = new CommentManager();
        $request = $data->reportComment($commentId);
        if($request != false){
            header('Location: /chapitre-' . $postId . '?reportComment=success');
        }else{
            die('Impossible de signaler le commentaire.');
        }
    }
}