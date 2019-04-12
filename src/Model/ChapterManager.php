<?php

namespace App\Model;
use \PDO;

class ChapterManager extends DbManager
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
     * Retrieve and structure 5 chapters from the database
     *
     * @param  mixed Number of page to load
     *
     * @return array Chapiters list 
     */
    public function getFiveChaptersWithComs($page)
    {
        $chapters = [];
        if(is_numeric($page)){
            $start = ($page - 1) * 5;
            $request  = $this->db->prepare('SELECT * FROM chapters ORDER BY id DESC LIMIT :debut,5');
            $request->bindParam(':debut', $start, PDO::PARAM_INT);
            $request->execute();
            $results = $request->fetchAll(PDO::FETCH_ASSOC);
            foreach($results as $r){
                $chapt = new Chapter($r);
                $chapt->setDate($r['date_add']);
                $chapters[] = $chapt;
            }
        }
        return $chapters;
    }
    
    /**
     * Retrieve and structure all chapters from the database
     *
     * @return array Chapters list
     */
    public function getAllChaptersWithComs()
    {
        $chapters = [];
        $request  = $this->db->prepare('SELECT * FROM chapters ORDER BY id DESC');
        $request->execute();
        $results = $request->fetchAll(PDO::FETCH_ASSOC);
        foreach($results as $r){
            $chapt = new Chapter($r);
            $chapt->setDate($r['date_add']);
            $chapters[] = $chapt;
        }
        return $chapters;
    }

    /**
     * Retrieve and structure one chapter by $id from the database
     *
     * @param  int Chapter's Id
     *
     * @return object Chapter informations
     */
    public function getChapter($id)
    {
        $request  = $this->db->prepare('SELECT ch.id, ch.title, ch.slug, ch.content, ch.date_add, co.id AS com_id, co.post_id AS com_post_id, co.author AS com_author, co.content AS com_content, co.report as com_report, co.moderate as com_moderate, DATE_FORMAT(co.date_add, \'%d/%m/%Y à %H:%i\') as com_date_add FROM chapters ch LEFT JOIN comments co ON ch.id = co.post_id WHERE ch.id=?');
        $request->execute([$id]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $chapter = $this->constructChapter($result);
        return $chapter;
    }

    /**
     * Retrieve and structure one chapter by $slug from the database
     *
     * @param  string Chapter's slug
     *
     * @return object Chapter informations
     */
    public function getChapterBySlug($slug)
    {
        $request  = $this->db->prepare('SELECT ch.id, ch.title, ch.slug, ch.content, ch.date_add, co.id AS com_id, co.post_id AS com_post_id, co.author AS com_author, co.content AS com_content, co.report as com_report, co.moderate as com_moderate, DATE_FORMAT(co.date_add, \'%d/%m/%Y à %H:%i\') as com_date_add FROM chapters ch LEFT JOIN comments co ON ch.id = co.post_id WHERE ch.slug=?');
        $request->execute([$slug]);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        $chapter = $this->constructChapter($result);
        return $chapter;
    }

    /**
     * Calculation of the number of pages to display on the front side
     *
     * @return int Number of pages
     */
    public function getNumberPages()
    {
        $request = $this->db->prepare('SELECT COUNT(*) AS chaptersNumber FROM chapters');
        $request->execute();
        return $request->fetchColumn()/5;
    }

    /**
     * Calculation of the number of chapters
     *
     * @return int Number of chapters
     */
    public function countChapters(){
        $request = $this->db->prepare('SELECT COUNT(*) AS chapterNumber FROM chapters');
        $request->execute();
        return $request->fetchColumn();
    }

    /**
     * Insert a new chapter in the database
     *
     * @param  object Chapter
     *
     * @return int Id of the inserted chapter
     */
    public function addChapter(Chapter $chapter){
        $request = $this->db->prepare('INSERT INTO chapters(title,slug,content,date_add) VALUES(?,?,?,NOW())');
        $results = $request->execute([$chapter->getTitle(), $chapter->getSlug(), $chapter->getContent()]);
        return $this->db->lastInsertId();
    }
    
    /**
     * Update a chapter in the database
     *
     * @param  object Chapter
     *
     * @return bool True on Success, false on error
     */
    public function updateChapter(Chapter $chapter){
        $request = $this->db->prepare('UPDATE chapters set title = ?, slug = ?, content = ? WHERE id=?');
        $results = $request->execute([$chapter->getTitle(), $chapter->getSlug(), $chapter->getContent(),$chapter->getId()]);
        return $results;
    }
    
    /**
     * Delete a chapter in the database
     *
     * @param  mixed Id of the chapter
     *
     * @return bool True on Successn false on error
     */
    public function deleteChapter($id){
        $request = $this->db->prepare('DELETE FROM chapters WHERE id=?');
        if($request->execute([$id])){
            $request = $this->db->prepare('DELETE FROM comments WHERE post_id=?');
            if($request->execute([$id])){
                return true;
            }
        }
        return false;
    }

    /**
     * Constructs a "Chapter" object from the information received as parameter
     *
     * @param  array Array of chapter values
     *
     * @return object Chapter object
     */
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
                if($data['com_id']){
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