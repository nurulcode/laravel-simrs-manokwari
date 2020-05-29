<?php

namespace Sty\Tests;

use Exception;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

trait ExceptionToggler
{
    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct()
            {
                //
            }

            public function report(Exception $e)
            {
                //
            }

            public function render($request, Exception $e)
            {
                throw $e;
            }
        });

        return $this;
    }

    protected function withExceptionHandling()
    {
        if ($this->oldExceptionHandler) {
            $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        }

        return $this;
    }
}
