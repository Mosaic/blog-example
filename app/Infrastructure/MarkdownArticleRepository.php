<?php

namespace App\Infrastructure;

use App\Domain\Article;
use App\Domain\ArticleRepository;
use App\Services\Markdown;
use League\Flysystem\FileNotFoundException;
use Mosaic\Filesystem\Filesystem;
use Mosaic\Routing\Exceptions\NotFoundHttpException;

class MarkdownArticleRepository implements ArticleRepository
{
    /**
     * @var Filesystem
     */
    private $file;

    /**
     * @var Markdown
     */
    private $markdown;

    /**
     * MarkdownArticleRepository constructor.
     * @param Filesystem $file
     * @param Markdown   $markdown
     */
    public function __construct(Filesystem $file, Markdown $markdown)
    {
        $this->file     = $file;
        $this->markdown = $markdown;
    }

    /**
     * @param string $slug
     * @return Article
     * @throws NotFoundHttpException
     */
    public function findBySlug(string $slug) : Article
    {
        try {
            $content = $this->file->read('blog://' . $slug . '.md');
        } catch (FileNotFoundException $e) {
            throw new NotFoundHttpException;
        }

        return $this->hydrate($slug, $content);
    }

    /**
     * @param string $filename
     * @param string $content
     * @return Article
     */
    private function hydrate(string $filename, string $content)
    {
        return (new MarkdownArticleHydrator($this->markdown))->toArticle($filename, $content);
    }

    /**
     * @return Article[]
     */
    public function findAll() : array
    {
        $articles = [];
        foreach ($this->file->listContents('blog://') as $file) {
            $articles[] = $this->findBySlug($file['filename']);
        }

        return $articles;
    }
}