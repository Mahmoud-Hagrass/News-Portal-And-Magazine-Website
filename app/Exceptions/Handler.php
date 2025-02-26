<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // Handle MethodNotAllowedHttpException
    protected function handleMethodNotAllowedException(){
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'error' => 'Invalid request method.',
            ], Response::HTTP_METHOD_NOT_ALLOWED); // 405
        });
    }

    // Handle NotFoundHttpException
    protected function handleNotFoundHttpException(){
         $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'error' => 'Resource not found.',
            ], Response::HTTP_NOT_FOUND); // 404
        });
    }

    // Handle QueryException
    protected function handleQueryException(){
        $this->renderable(function (QueryException $e, $request) {
            return response()->json([
                'error' => 'A database error occurred. Please try again later.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        });
    }

     // Handle all other exceptions
    protected function handleAllOtherExceptions(){
         $this->renderable(function (Throwable $e, $request) {
            return response()->json([
                'error' => 'Something went wrong. Please try again later.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // 500
        });

    }
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->handleMethodNotAllowedException() ; 
        $this->handleNotFoundHttpException() ; 
        $this->handleQueryException() ; 
        //$this->handleAllOtherExceptions() ; 
    }
}
