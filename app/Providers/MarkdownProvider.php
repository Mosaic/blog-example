<?php

namespace App\Providers;

use App\Services\CommonMark;
use App\Services\Markdown;
use Interop\Container\Definition\DefinitionProviderInterface;
use League\CommonMark\CommonMarkConverter;

class MarkdownProvider implements DefinitionProviderInterface
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
            Markdown::class => function() {
                return new CommonMark(
                    new CommonMarkConverter()
                );
            }
        ];
    }
}