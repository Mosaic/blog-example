<?php

namespace App\Domain;

interface ArticleRepository
{
    /**
     * @param string $slug
     * @return Article
     */
    public function findBySlug(string $slug) : Article;

    /**
     * @return Article[]
     */
    public function findAll() : array;
}