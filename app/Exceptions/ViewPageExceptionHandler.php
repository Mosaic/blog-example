<?php

namespace App\Exceptions;

use Mosaic\Routing\Exceptions\HttpException;
use Mosaic\View\Factory;
use Whoops\Exception\Inspector;
use Whoops\Handler\Handler;
use Whoops\Run;

class ViewPageExceptionHandler extends Handler
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * ViewPageExceptionHandler constructor.
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
        $exception = $this->getException();

        header('Content-Type: text/html');

        $code = 500;
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
        }

        echo $this->factory->make('error.twig', [
            'message' => $exception->getMessage(),
            'code'    => $code
        ])->render();

        return Handler::QUIT;
    }
}