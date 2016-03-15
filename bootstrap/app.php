<?php

/*
|--------------------------------------------------------------------------
| Init Application
|--------------------------------------------------------------------------
*/

$app = new Mosaic\Cement\Application(
    realpath(__DIR__ . '/../')
);

/*
|--------------------------------------------------------------------------
| Exception handling component
|--------------------------------------------------------------------------
*/

$app->component(Mosaic\Exceptions\Component::whoops()->formatters(
    function ($exception) use ($app) {
        $handler = new App\Exceptions\ViewPageExceptionHandler(
            $app->getContainer()->get(Mosaic\View\Factory::class)
        );

        $handler->setException($exception);

        return $handler->handle();
    }
));

/*

/*
|--------------------------------------------------------------------------
| Http component
|--------------------------------------------------------------------------
*/

$app->component(Mosaic\Http\Component::diactoros());

/*
|--------------------------------------------------------------------------
| Routing component
|--------------------------------------------------------------------------
*/

$app->component(Mosaic\Routing\Component::fastRoute()->binders(
    new App\Http\Routes\HomeRoute,
    new App\Http\Routes\ArticleRoute
));

/*
|--------------------------------------------------------------------------
| Filesystem component
|--------------------------------------------------------------------------
*/

$app->component(Mosaic\Filesystem\Component::flystem($app->getFolderStructure())
    ->local('blog', $app->getFolderStructure()->storagePath() . '/blog'));

/*
|--------------------------------------------------------------------------
| View component
|--------------------------------------------------------------------------
*/

$app->component(
    Mosaic\View\Component::twig($app->getFolderStructure())
);

/*
|--------------------------------------------------------------------------
| View component
|--------------------------------------------------------------------------
*/

$app->provide(new App\Providers\MarkdownProvider);
$app->provide(new App\Providers\RepositoryProvider);

return $app;
