<?php
namespace App\DataTransferObject;

class BookmarkDTO {
    private $name_user;
    private $id_user;
    private $item_id;
    private $item_type;
    private $page;
    private $limit;

    /**
     * Get the value of name_user
     */ 
    public function getName_user()
    {
        return $this->name_user;
    }

    /**
     * Set the value of name_user
     *
     * @return  self
     */ 
    public function setName_user($name_user)
    {
        $this->name_user = $name_user;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of item_id
     */ 
    public function getItem_id()
    {
        return $this->item_id;
    }

    /**
     * Set the value of item_id
     *
     * @return  self
     */ 
    public function setItem_id($item_id)
    {
        $this->item_id = $item_id;

        return $this;
    }

    /**
     * Get the value of item_type
     */ 
    public function getItem_type()
    {
        return $this->item_type;
    }

    /**
     * Set the value of item_type
     *
     * @return  self
     */ 
    public function setItem_type($item_type)
    {
        $this->item_type = $item_type;

        return $this;
    }

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
     * Get the value of limit
     */ 
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */ 
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}