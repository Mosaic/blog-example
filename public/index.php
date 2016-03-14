<?php

/**
 * Mosaic - Framework
 *
 * @package Mosaic
 * @author  Patrick Brouwers       <patrick@maatwebsite.nl>
 * @author  Guido Contreras Woda   <guiwoda@gmail.com>
 */

define('MOSAIC_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = include __DIR__ . '/../bootstrap/app.php';

(new Mosaic\Http\WebServer)->pipe(
    $app->getContainer()->make(Mosaic\Http\Middleware\DispatchRequest::class)
)->serve($app->captureRequest());