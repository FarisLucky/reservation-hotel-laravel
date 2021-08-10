<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof QueryException || $e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException("Resource Not Found");
        }
        return parent::render($request, $e);
    }

    protected function prepareJsonResponse($request, Throwable $e)
    {
        return \response()->json([
            'status' => $this->isHttpException($e) ? $e->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR,
            'errors' => [
                [
                    'title' => Str::title(Str::snake(class_basename($e),' ')),
                    'details' => $e->getMessage()
                ]
            ]
        ], $this->isHttpException($e) ? $e->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function invalidJson($request, ValidationException $exception)
    {
        $errors = (new Collection($exception->validator->errors()))
            ->map(function ($error, $key) {
                return [
                    'title' => 'Validation Error',
                    'details' => $error[0],
                    'source' => [
                        'pointer' => '/'.str_replace('.','/',$key),
                    ]
                ];
            })->values();

        return response()->json([
            'status' => $exception->status,
            'errors' => $errors,
        ], $exception->status);
    }

    /**
     * AUTHENTICATION EXCEPTION HANDLER
     *
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json([
                    'status' => $exception->getCode(),
                    'errors' => [
                        'title' => 'Unauthenticated',
                        'detail' => 'You are not authenticated'
                    ]
                ], Response::HTTP_FORBIDDEN)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }


}
