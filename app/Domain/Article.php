<?php

namespace App\Domain;

use DateTime;

class Article
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var DateTime
     */
    private $publishedAt;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $slug;

    /**
     * @param string   $slug
     * @param string   $title
     * @param string   $author
     * @param DateTime $publishedAt
     * @param string   $content
     */
    public function __construct(string $slug, string $title, string $author, DateTime $publishedAt, string $content)
    {
        $this->author      = $author;
        $this->content     = $content;
        $this->publishedAt = $publishedAt;
        $this->title       = $title;
        $this->slug        = $slug;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAuthor() : string
    {
        return $this->author;
    }

    /**
     * @return DateTime
     */
    public function getPublishedAt() : DateTime
    {
        return $this->publishedAt;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }
}