<?php

namespace App\Controller\ReportComment;

use App\Model\ChapterManager;
use App\Model\CommentManager;
use App\Model\Comment;
use App\Services\PHPSession;

class ReportCommentController{
    /**
     * Add the reported status to a comment and redirect to the chapter page
     *
     * @param  mixed Slug of the parent chapter
     * @param  int Comment Id
     */
    public function reportComment($slug, $commentId){
        $data = new CommentManager();
        $request = $data->reportComment($commentId);
        $chapter = new ChapterManager();
        $c = $chapter->getChapterBySlug($slug);
        if($request != false){
            PHPSession::set('reportComment', '<div class="alert alert-success">Le commentaire à bien été signalé.</div>');
            header('Location: /chapitre/' . $c->getSlug() . '#comments');
        }else{
            die('Impossible de signaler le commentaire.');
        }
    }
}