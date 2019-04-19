<?php

namespace App\Controller\PostComment;

use App\Model\ChapterManager;
use App\Model\CommentManager;
use App\Model\Comment;
use App\Services\PHPSession;
use App\Services\Captcha;

class PostCommentController{
    /**
     * Add a comment on a chapter and redirect to the chapter page
     */
    public function postComment(){
        $captchaService = new Captcha();
        $captcha = $captchaService->checkCaptcha($_POST['g-recaptcha-response']);
        $chapter = new ChapterManager();
        $c = $chapter->getChapter($_POST['postId']);
        if ($captcha) {
            if(!empty($_POST['author']) AND !empty($_POST['comment']) AND !empty($_POST['postId'])){
                
                $data = new CommentManager();
                $comment = new Comment();
                $comment->setPostId($_POST['postId']);
                $comment->setAuthor($_POST['author']);
                $comment->setComment($_POST['comment']);
                $request = $data->addComment($comment);
                if($request != false){
                    PHPSession::set('addComment', '<div class="alert alert-success">Le commentaire à bien été ajouté.</div>');
                    header('Location: /chapitre/' . $c->getSlug() . '#comments');
                }
            }
                PHPSession::set('addComment', '<div class="alert alert-warning">Impossible d\'ajouter le commentaire. Veuillez vérifier les informations que vous avez saisies.</div>');
                header('Location: /chapitre/' . $c->getSlug() . '#comments');
        }else{
            PHPSession::set('addComment', '<div class="alert alert-warning">Vous devez cocher le bouton anti robot.</div>');
            header('Location: /chapitre/' . $c->getSlug() . '#comments');
        }
    }
}