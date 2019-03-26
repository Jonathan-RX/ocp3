<?php

namespace App\Model;

class Comment{
    private $id;
    private $postId;
    private $author;
    private $content;
    private $dateAdd;
    private $report;
    private $moderate;

    public function __construct($values = null){
        if($values != null){
            $this->hydrate($values);
        }
    }

    public function hydrate(array $values)
    {
        foreach ($values as $key=>$value)
        {
            $elements = explode('_',$key);
            $newKey='';
            foreach($elements as $el)
            {
                $newKey .= ucfirst($el);
            }

            $method = 'set' .ucfirst($newKey);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getPostId(): ?int
    {
        return $this->postId;
    }
    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function getComment(): ?string
    {
        return $this->content;
    }
    public function setComment($content): void
    {
        $this->content = $content;
    }

    public function getDateAdd()
    {
        return $this->dateAdd;
    }
    public function setDateAdd($dateAdd):void
    {
        $this->dateAdd = $dateAdd;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }
    public function setReport($report): void
    {
        $this->report = $report;
    }

    public function getModerate(): ?string
    {
        return $this->moderate;
    }
    public function setModerate($moderate): void
    {
        $this->moderate = $moderate;
    }
}