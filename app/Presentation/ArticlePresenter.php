<?php

namespace App\Presentation;

use App\Domain\Article;

class ArticlePresenter
{
    /**
     * @var Article
     */
    private $article;

    /**
     * ArticlePresenter constructor.
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function publishedAt()
    {
        return strftime('%B %e, %Y', $this->article->getPublishedAt()->getTimestamp());
    }

    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->article, 'get' . ucfirst($method)], $params);
    }
}