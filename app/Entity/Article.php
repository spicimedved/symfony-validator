<?php

namespace App\Entity;

class Article
{
    protected $title;

    protected $content;

    protected $isPublished;

    protected $createdAt;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param null $isPublished
     * @return mixed
     */
    public function isPublished($isPublished = null)
    {
        if (null !== $isPublished) {
            $this->isPublished = $isPublished;
        }

        return $this->isPublished;
    }
}