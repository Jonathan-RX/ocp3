<?php

namespace App\Model;

class Chapter{
    private $id;
    private $title;
    private $slug;
    private $content;
    private $date;
    private $comments = [];

    public function __construct($values = null){
        if($values != null){
            $this->hydrate($values);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . str_replace('_', '', $name);
        if (method_exists($this, $method)) {
            $val = call_user_func(array($this, $method), $value);
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

    public function getId(): ?string
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getComments()
    {
        return $this->comments;
    }
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date): void
    {
        $this->date = $date;
    }
    public static function slugify(string $string): string
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }

}