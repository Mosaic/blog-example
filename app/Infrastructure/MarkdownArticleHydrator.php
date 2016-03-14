<?php

namespace App\Infrastructure;

use App\Domain\Article;
use App\Services\Markdown;
use App\Services\MarkdownMetadataExtractor;

class MarkdownArticleHydrator
{
    /**
     * @var Markdown
     */
    private $markdown;

    /**
     * @param Markdown $markdown
     */
    public function __construct(Markdown $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * @param string $filename
     * @param string $content
     * @return Article
     */
    public function toArticle(string $filename, string $content) : Article
    {
        $meta = (new MarkdownMetadataExtractor)->extract($content);

        return new Article(
            str_replace('.md', '', $filename),
            $meta['title'],
            $meta['author'],
            $meta['publishedAt'],
            $this->markdown->toHtml($meta['content'])
        );
    }
}