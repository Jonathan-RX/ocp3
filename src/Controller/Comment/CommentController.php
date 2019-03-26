<?php

namespace App\Controller\Comment;

use App\Model\ChapterManager;
use App\Model\CommentManager;
use App\Model\Comment;

class CommentController{
    public function postComment(){
        if(isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['postId'])){
            $chapter = new ChapterManager();
            $c = $chapter->getChapter($_POST['postId']);
            $data = new CommentManager();
            $comment = new Comment();
            $comment->setPostId($_POST['postId']);
            $comment->setAuthor($_POST['author']);
            $comment->setComment($_POST['comment']);
            $request = $data->addComment($comment);
            if($request != false){
                header('Location: /chapitre/' . $c->getSlug() . '?comment=success');
            }else{
                die('Impossible d\'ajouter le commentaire.');
            }
       }
    }
    public function reportComment($slug, $commentId){
        $data = new CommentManager();
        $request = $data->reportComment($commentId);
        $chapter = new ChapterManager();
        $c = $chapter->getChapterBySlug($slug);
        if($request != false){
            header('Location: /chapitre/' . $c->getSlug() . '?reportComment=success');
        }else{
            die('Impossible de signaler le commentaire.');
        }
    }
}