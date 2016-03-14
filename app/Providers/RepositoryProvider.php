<?php

namespace App\Providers;

use App\Domain\ArticleRepository;
use App\Infrastructure\MarkdownArticleRepository;
use App\Services\Markdown;
use Interop\Container\Definition\DefinitionProviderInterface;
use Mosaic\Container\Container;
use Mosaic\Filesystem\Filesystem;

class RepositoryProvider implements DefinitionProviderInterface
{
    /**
     * Returns the definition to register in the container.
     *
     * Definitions must be indexed by their entry ID. For example:
     *
     *     return [
     *         'logger' => ...
     *         'mailer' => ...
     *     ];
     *
     * @return array
     */
    public function getDefinitions()
    {
        return [
            ArticleRepository::class => function(Container $container) {
                return new MarkdownArticleRepository(
                    $container->get(Filesystem::class),
                    $container->get(Markdown::class)
                );
            }
        ];
    }
}