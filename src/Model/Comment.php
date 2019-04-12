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

    /**
     * Starts the hydration function when instantiating the class
     *
     * @param  mixed Data of the comment to build 
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
     * Retrieve Id of the comment
     *
     * @return string Comment's Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Set Id of the comment
     *
     * @param  int Comment's Id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Retrieve $id of the chapter of the comment
     *
     * @return int Comment's parent chapter
     */
    public function getPostId(): ?int
    {
        return $this->postId;
    }
    /**
     * Set chapter id of the comment
     *
     * @param  string Comment's parent chapter
     */
    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }

    /**
     * Retrieve author of the comment
     *
     * @return string Comment's author
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }
    /**
     * Set author of the comment
     *
     * @param  string Comment's author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * Retrieve content of the comment
     *
     * @return string Comment's content
     */
    public function getComment(): ?string
    {
        return $this->content;
    }
    /**
     * Set content of the comment
     *
     * @param  string Comment's content
     */
    public function setComment($content): void
    {
        $this->content = $content;
    }

    /**
     * Retrieve date of the comment
     *
     * @return string Comment's date
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }
    /**
     * Set date of the comment
     *
     * @param  string Comment's date
     */
    public function setDateAdd($dateAdd):void
    {
        $this->dateAdd = $dateAdd;
    }

    /**
     * Retrieve the reported status of the comment
     *
     * @return bool Comment's reported status, true is reported
     */
    public function getReport(): ?string
    {
        return $this->report;
    }
    /**
     * Set reported status of the comment
     *
     * @param  bool Comment's reported status, true is reported
     */
    public function setReport($report): void
    {
        $this->report = $report;
    }

    /**
     * Retrieve moderate status of the comment
     *
     * @return bool Comment's moderated status, true is moderated
     */
    public function getModerate(): ?string
    {
        return $this->moderate;
    }
    /**
     * Set moderate status of the comment
     *
     * @param  string Comment's moderated status, true is moderated
     */
    public function setModerate($moderate): void
    {
        $this->moderate = $moderate;
    }
}