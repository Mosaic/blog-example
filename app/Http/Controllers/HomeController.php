<?php

namespace App\Http\Controllers;

use App\Domain\Article;
use App\Domain\ArticleRepository;
use App\Presentation\ArticlePresenter;
use Mosaic\View\Factory;

class HomeController
{
    /**
     * @param ArticleRepository $repository
     * @param Factory           $factory
     * @return \Mosaic\View\View
     */
    public function index(ArticleRepository $repository, Factory $factory)
    {
        $articles = array_map(function (Article $article) {
            return new ArticlePresenter($article);
        }, $repository->findAll());

        return $factory->make('home.twig', [
            'articles' => $articles
        ]);
    }
}
