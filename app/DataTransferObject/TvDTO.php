<?php
namespace App\DataTransferObject;

class TvDTO {
    private $page; 
    private $isBookmarked;
    private $id;

    /**
     * Get the value of page
     */ 
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */ 
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of isBookmarked
     */ 
    public function getIsBookmarked()
    {
        return $this->isBookmarked;
    }

    /**
     * Set the value of isBookmarked
     *
     * @return  self
     */ 
    public function setIsBookmarked($isBookmarked)
    {
        $this->isBookmarked = $isBookmarked;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}