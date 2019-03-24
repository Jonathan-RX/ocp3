<?php

namespace App\Model;

class Chapter{
    private $id;
    private $title;
    private $content;
    private $date;
    private $comments = [];

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

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date): void
    {
        $this->date = $date;
    }

}