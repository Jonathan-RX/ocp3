<?php

namespace App\Model;
use \PDO;

use App\Model\Comment;

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
    
    public static function moderateComment($commentId){
        $request = self::dbConnect()->prepare('UPDATE comments set moderate = 1, report = 0  WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }
    
    public static function unmoderateComment($commentId){
        $request = self::dbConnect()->prepare('UPDATE comments set moderate = 0 WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }
    
    public static function unreportComment($commentId){
        $request = self::dbConnect()->prepare('UPDATE comments set report = 0 WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }

    public function count($postId){
        $request = $this->db->prepare('SELECT COUNT(*) AS commentNumber FROM comments WHERE post_id=?');
        $request->execute([$postId]);
        return $request->fetchColumn();
    }

    public function countComments(){
        $request = $this->db->prepare('SELECT COUNT(*) AS commentNumber FROM comments');
        $request->execute();
        return $request->fetchColumn();
    }
    
    public function getFiveLastComs(){
        $request = $this->db->prepare('SELECT * FROM comments WHERE moderate=0 ORDER BY id DESC LIMIT 0,5');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }

    public function getFiveLastReports(){
        $request = $this->db->prepare('SELECT * FROM comments WHERE report=1 AND moderate=0 ORDER BY id DESC LIMIT 0,5');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }

    public static function getReportedComments(){
        $db = self::dbConnect();
        $request = $db->prepare('SELECT * FROM comments WHERE report=1');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }

    public static function getModeratesComments(){
        $db = self::dbConnect();
        $request = $db->prepare('SELECT * FROM comments WHERE moderate=1');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }


    public static function countReportedComments(){
        $db = self::dbConnect();
        $request = $db->prepare('SELECT COUNT(*) AS commentNumber FROM comments WHERE report=1 AND moderate IS null');
        $request->execute();
        return $request->fetchColumn();
    }
}