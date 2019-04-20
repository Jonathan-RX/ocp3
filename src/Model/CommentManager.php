<?php

namespace App\Model;
use \PDO;

use App\Model\Comment;

class CommentManager extends DbManager
{
    private $db;

    /**
     * Builder, retrieves the connection to the database
     */
    public function __construct()
    {
        $this->db = self::dbConnect();
    } 
    
    /**
     * Insert new comment to database
     *
     * @param  object Comment's values
     * 
     * @return bool True on success, false on error
     */
    public function addComment(Comment $comment){
        $request = $this->db->prepare('INSERT INTO comments(post_id, author, content, report, moderate, date_add) VALUES(?, ?, ?, false, false, NOW())');
        $results = $request->execute([$comment->getPostId(), $comment->getAuthor(), $comment->getComment()]); 
        return $results;
    }

    /**
     * Change report status of a comment to true
     *
     * @param  int Comment's Id
     *
     * @return bool True on success, false on error
     */
    public function reportComment($commentId){
        $request = $this->db->prepare('UPDATE comments set report = true WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }
    
    /**
     * Change report status of a comment to false
     *
     * @param  int Comment's Id
     *
     * @return bool True on success, false on error
     */
    public function unreportComment($commentId){
        $request = self::dbConnect()->prepare('UPDATE comments set report = 0 WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }
    
    /**
     * Change moderate status of a comment to true
     *
     * @param  int Comment's Id
     *
     * @return bool True on success, false on error
     */
    public function moderateComment($commentId){
        $request = self::dbConnect()->prepare('UPDATE comments set moderate = 1, report = 0  WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }
    
    /**
     * Change moderate status of a comment to false
     *
     * @param  int Comment's Id
     *
     * @return bool True on success, false on error
     */
    public function unmoderateComment($commentId){
        $request = self::dbConnect()->prepare('UPDATE comments set moderate = 0 WHERE id=?');
        $results = $request->execute([$commentId]);
        return $results;
    }

    /**
     * Count the number of comments for a chapter
     *
     * @param  int Comment's parent chapter Id
     *
     * @return int Number of comments
     */
    public function count($postId){
        $request = $this->db->prepare('SELECT COUNT(*) AS commentNumber FROM comments WHERE post_id=?');
        $request->execute([$postId]);
        return $request->fetchColumn();
    }

    /**
     * Count the number of comments
     *
     * @return int Number of comments
     */
    public function countComments(){
        $request = $this->db->prepare('SELECT COUNT(*) AS commentNumber FROM comments');
        $request->execute();
        return $request->fetchColumn();
    }
    
    /**
     * Retrieves information from the last five comments from the database
     *
     * @return array Last five comments posted 
     */
    public function getFiveLastComs(){
        $request = $this->db->prepare('SELECT * FROM comments WHERE moderate=0 ORDER BY id DESC LIMIT 0,5');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }

    /**
     * Retrieves information from the last five comments with status reported from the database
     *
     * @return array Last five comments reported
     */
    public function getFiveLastReports(){
        $request = $this->db->prepare('SELECT * FROM comments WHERE report=1 AND moderate=0 ORDER BY id DESC LIMIT 0,5');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }
    
    /**
     * Retrieves information of comments with status reported from the database
     *
     * @return array All comments with reported status 
     */
    public function getReportedComments(){
        $request = $this->db->prepare('SELECT * FROM comments WHERE report=1');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }

    /**
     * Retrieves information of comments with status moderated from the database
     *
     * @return array All comments with moderated status 
     */
    public  function getModeratesComments(){
        $request = $this->db->prepare('SELECT * FROM comments WHERE moderate=1 ORDER BY id DESC');
        $results = $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, 'App\Model\Comment');
    }

    /**
     * Count the number of comments with reported status
     *
     * @return int Number of comments with reported status
     */
    public static function countReportedComments(){
        $request = self::dbConnect()->prepare('SELECT COUNT(*) AS commentNumber FROM comments WHERE report=1 AND moderate=0');
        $request->execute();
        return $request->fetchColumn();
    }
}