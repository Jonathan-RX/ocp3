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

    public function addComment($postId, $author, $comment){ // Comment $comment
        $request = $this->db->prepare('INSERT INTO comments(post_id, author, content, report, date) VALUES(?, ?, ?, false, NOW())');
        $results = $request->execute([$postId, $author, $comment]); // Remplacer [$postId, $author, $comment] par [$comment->getPostId(), $comment->getAuthor(), $comment->getComment()]
        return $results;
    }

    public function reportComment($commentId){
        $request = $this->db->prepare('UPDATE comments set report = true WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }
}