<?php

namespace App\Http\Controllers;

use App\Domain\ArticleRepository;
use App\Presentation\ArticlePresenter;
use Mosaic\View\Factory;

class ArticleController
{
    /**
     * @param string            $slug
     * @param ArticleRepository $repository
     * @param Factory           $view
     * @return string
     */
    public function show(string $slug, ArticleRepository $repository, Factory $view)
    {
        $article = $repository->findBySlug($slug);

        return $view->make('article.twig', [
            'article' => new ArticlePresenter($article)
        ]);
    }
}