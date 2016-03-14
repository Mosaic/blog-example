<?php

/**
 * Init application
 */

$app = new Mosaic\Cement\Application(
    realpath(__DIR__ . '/../')
);

$app->components(
    Mosaic\Exceptions\Component::whoops()->formatters(
        new Whoops\Handler\PrettyPageHandler
    ),
    Mosaic\Http\Component::diactoros(),
    Mosaic\Routing\Component::fastRoute()->binders(
        new App\Http\Routes\HomeRoute,
        new App\Http\Routes\ArticleRoute
    ),
    Mosaic\Filesystem\Component::flystem($app->getFolderStructure())->local(
        'blog',
        $app->getFolderStructure()->storagePath() . '/blog'
    ),
    Mosaic\View\Component::twig($app->getFolderStructure())
);

$app->provide(new App\Providers\MarkdownProvider);
$app->provide(new App\Providers\RepositoryProvider);

return $app;
