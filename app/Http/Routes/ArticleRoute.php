<?php

namespace App\Http\Routes;

use App\Http\Controllers\ArticleController;
use Mosaic\Routing\RouteBinder;
use Mosaic\Routing\Router;

class ArticleRoute implements RouteBinder
{

    /**
     * Bind routes to router
     *
     * @param Router $router
     */
    public function bind(Router $router)
    {
        $router->get('{slug}', [
            'uses' => ArticleController::class . '@show'
        ]);
    }
}