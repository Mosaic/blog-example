<?php

namespace App\Http\Routes;

use Mosaic\Routing\RouteBinder;
use Mosaic\Routing\Router;

class HomeRoute implements RouteBinder
{

    /**
     * Bind routes to router
     *
     * @param Router $router
     */
    public function bind(Router $router)
    {
        $router->get('/', 'App\Http\Controllers\HomeController@index');
    }
}
