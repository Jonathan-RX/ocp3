<?php

namespace App\Controller\PostComment;

use App\Model\ChapterManager;
use App\Model\CommentManager;
use App\Model\Comment;
use App\Services\PHPSession;

class PostCommentController{
    /**
     * Add a comment on a chapter and redirect to the chapter page
     */
    public function postComment(){
        $secret = "6Lc135oUAAAAAOQwp5gGmJIrgu2gJQr9yAXR6jTQ";
        $response = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;
        
        $decode = json_decode(file_get_contents($api_url), true);
        $chapter = new ChapterManager();
        $c = $chapter->getChapter($_POST['postId']);
        if (isset($decode['success']) AND $decode['success'] == true) {
            if(isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['postId'])){
                
                $data = new CommentManager();
                $comment = new Comment();
                $comment->setPostId($_POST['postId']);
                $comment->setAuthor($_POST['author']);
                $comment->setComment($_POST['comment']);
                $request = $data->addComment($comment);
                if($request != false){
                    PHPSession::set('addComment', '<div class="alert alert-success">Le commentaire à bien été ajouté.</div>');
                    header('Location: /chapitre/' . $c->getSlug() . '#comments');
                }else{
                    die('Impossible d\'ajouter le commentaire.');
                }
            }
        }else{
            PHPSession::set('addComment', '<div class="alert alert-warning">Vous devez cocher le bouton anti robot.</div>');
            header('Location: /chapitre/' . $c->getSlug() . '#comments');
        }
    }
}