<?php

namespace App\Model;
use \PDO;

class CommentManager extends DbManager
{
    private $db;

    public function __construct()
    {
        $this->db = self::dbConnect();
    }

    public function addComment(Comment $comment){
        $request = $this->db->prepare('INSERT INTO comments(post_id, author, content, report, date_add) VALUES(?, ?, ?, false, NOW())');
        $results = $request->execute([$comment->getPostId(), $comment->getAuthor(), $comment->getComment()]); 
        return $results;
    }

    public function reportComment($commentId){
        $request = $this->db->prepare('UPDATE comments set report = true WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }

    public function count($postId){
        $request = $this->db->prepare('SELECT COUNT(*) AS commentNumber FROM comments WHERE post_id=?');
        $request->execute([$postId]);
        return $request->fetchColumn();
    }
}