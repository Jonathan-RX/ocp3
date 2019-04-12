<?php

namespace App\Model;

class Chapter{
    private $id;
    private $title;
    private $slug;
    private $content;
    private $date;
    private $comments = [];

    /**
     * Starts the hydration function when instantiating the class
     *
     * @param  mixed Data of the chapter to build 
     */
    public function __construct($values = null){
        if($values != null){
            $this->hydrate($values);
        }
    }

    /**
     * Remove the "_" when reading the fields in the database
     *
     * @param  mixed Name of the value
     * @param  mixed Value to save
     */
    public function __set($name, $value) {
        $method = 'set' . str_replace('_', '', $name);
        if (method_exists($this, $method)) {
            $val = call_user_func(array($this, $method), $value);
        }
    }

    /**
     * Retrieves a value array to associate with the class
     *
     * @param  array Array of values ​​to record
     */
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

    /**
     * Retrieve Id of the chapter
     *
     * @return string Id of the chapter
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * Set Id of the chapter
     *
     * @param  mixed Id of the chapter
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Retrieve Title of the chapter
     *
     * @return string Title of the chapter
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    /**
     * Set Title of the chapter
     *
     * @param  mixed Title of the chapter
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * Retrieve Slug of the Chapter
     *
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    /**
     * Set Slug of the chapter
     *
     * @param  mixed Sluf of the chapter
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Retrieve Content of the chapter
     *
     * @return string Content of the chapter
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
    /**
     * Set Content of the chapter
     *
     * @param  mixed Content of the chapter
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * Retrieve Comments of the chapter
     *
     * @return array Comments of the chapter
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
     * Set Comments of the chapter
     *
     * @param  mixed Comments of the chapter
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * Retrieve Date of publication of the chapter
     * 
     * @return string Date of the chapter
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set Date of publication of the chapter
     *
     * @param  mixed Date of the chapter
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
    
    /**
     * Turn a string into a url
     *
     * @param  string Value to convert
     */
    public static function slugify(string $string): string
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }

}