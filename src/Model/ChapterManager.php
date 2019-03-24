<?php

namespace App\Model;
use \PDO;

class ChapterManager extends DbManager
{
    private $db;

    public function __construct()
    {
        $this->db = self::dbConnect();
    }
    public function getAllChapters()
    {
        $request  = $this->db->query('SELECT * FROM chapters ORDER BY id');
        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        $chapters = [];
        foreach($results as $r){
            $chapt = new Chapter($r);
            $chapters[] = $chapt;
        }
        return $chapters;
    }
    public function getAllChaptersWithComs()
    {
        $request  = $this->db->query('SELECT ch.id, ch.title, ch.content, ch.date, co.id AS com_id, co.post_id AS com_post_id, co.author AS com_author, co.content AS com_content FROM chapters ch LEFT JOIN comments co ON ch.id = co.post_id');
        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    public function getChapter($id)
    {
        $request  = $this->db->prepare('SELECT ch.id, ch.title, ch.content, ch.date, co.id AS com_id, co.post_id AS com_post_id, co.author AS com_author, co.content AS com_content, DATE_FORMAT(co.date, \'%d/%m/%Y à %H:%i\') as com_date FROM chapters ch LEFT JOIN comments co ON ch.id = co.post_id WHERE ch.id=?');
        $request->execute([$id]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $comments = [];
        $chapter = new Chapter();
        foreach($result as $data){
            if($data['com_id']){
                $comment = new Comment();
                $comment->setId($data['com_id']]);
                // Pareil pour les autres

                $comments[] = $comment;
            }
        } 
        $chapter->setComments($comments);
        return $chapter;
    }
}