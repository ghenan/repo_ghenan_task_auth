<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Nette\Schema\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function render($request, Throwable $e)
    {
        return $this->HandleException($e);
    }

    protected function HandleException(Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'NOT FOUND'
            ], 404);
        }
        if ($exception instanceof AuthenticationException) {
            return response()->json(['error' => 'UNAUTHORIZED'], 401);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => 'NOT FOUND'], 404);
        }


        if ($exception instanceof AuthorizationException) {
            return response()->json(['error' => 'FORBIDDEN ERROR'], 403);
        }

        if ($exception instanceof ThrottleRequestsException) {
            return response()->json(['error' => 'There IS a problem with the server'], 429);
        }


        if ($exception instanceof QueryException) {
            return response()->json(['error' => 'SERVER ERROR'], 500);
        }
        if ($exception instanceof ValidationException ){
            return response()->json(['error' => $exception->errors()], 422);
        }


    }
}

