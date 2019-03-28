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
        $request  = $this->db->query('SELECT * FROM chapters ORDER BY id DESC');
        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        $chapters = [];
        foreach($results as $r){
            $chapt = new Chapter($r);
            $chapt->setDate($r['date_add']);
            $chapters[] = $chapt;
        }
        return $chapters;
    }
    public function getAllChaptersWithComs()
    {
        $request  = $this->db->query('SELECT ch.id, ch.title, ch.slug, ch.content, ch.date_add, co.id AS com_id, co.post_id AS com_post_id, co.author AS com_author, co.content AS com_content FROM chapters ch LEFT JOIN comments co ON ch.id = co.post_id');
        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    public function getChapter($id)
    {
        $request  = $this->db->prepare('SELECT ch.id, ch.title, ch.slug, ch.content, ch.date_add, co.id AS com_id, co.post_id AS com_post_id, co.author AS com_author, co.content AS com_content, co.report as com_report, co.moderate as com_moderate, DATE_FORMAT(co.date_add, \'%d/%m/%Y à %H:%i\') as com_date_add FROM chapters ch LEFT JOIN comments co ON ch.id = co.post_id WHERE ch.id=?');
        $request->execute([$id]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $chapter = $this->constructChapter($result);
        return $chapter;
    }
    public function getChapterBySlug($slug)
    {
        $request  = $this->db->prepare('SELECT ch.id, ch.title, ch.slug, ch.content, ch.date_add, co.id AS com_id, co.post_id AS com_post_id, co.author AS com_author, co.content AS com_content, co.report as com_report, co.moderate as com_moderate, DATE_FORMAT(co.date_add, \'%d/%m/%Y à %H:%i\') as com_date_add FROM chapters ch LEFT JOIN comments co ON ch.id = co.post_id WHERE ch.slug=?');
        $request->execute([$slug]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $chapter = $this->constructChapter($result);
        return $chapter;
    }

    public function constructChapter($result){
        if(!empty($result[0]['id'])){
            $comments = [];
            $chapter = new Chapter();
            $chapter->setId($result[0]['id']);
            $chapter->setTitle($result[0]['title']);
            $chapter->setSlug($result[0]['slug']);
            $chapter->setContent($result[0]['content']);
            $chapter->setDate($result[0]['date_add']);
            foreach($result as $data){
                if(isset($data['com_id'])){
                    $comment = new Comment();
                    $comment->setId($data['com_id']);
                    $comment->setPostId($data['com_post_id']);
                    $comment->setAuthor($data['com_author']);
                    $comment->setComment($data['com_content']);
                    $comment->setReport($data['com_report']);
                    $comment->setModerate($data['com_moderate']);
                    $comment->setDateAdd($data['com_date_add']);
                    $comments[] = $comment;
                }
            } 
            $chapter->setComments($comments);
            return $chapter;
        }else{
            $chapter = new Chapter();
            return $chapter;
        }
    }
}