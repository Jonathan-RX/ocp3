<?php

namespace App\Controller\Comment;

use App\Model\CommentManager;

class CommentController{
    public function postComment($id){
        if(isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['postId'])){
            $data = new CommentManager();
            // Instance classe comment à ajouter
            // SETTERS classe ccmment
            $request = $data->addComment($_POST['postId'], $_POST['author'], $_POST['comment']); //Envoyer un objet au lieu des variables
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