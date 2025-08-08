<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(\App\Http\Middleware\SetLocale::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $e) {
            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'errors' => 'You are not authorized.',
                    'status' => Response::HTTP_UNAUTHORIZED,
                ], Response::HTTP_UNAUTHORIZED);
            }

            if ($e instanceof AuthorizationException) {
                return response()->json([
                    'errors' => 'You are not authorized.',
                    'status' => Response::HTTP_UNAUTHORIZED,
                ], Response::HTTP_UNAUTHORIZED);
            }

            $previous = $e->getPrevious();
            if ($previous instanceof ModelNotFoundException) {
                Log::error($previous);
                return response()->json([
                    'errors' => str($previous->getModel())->afterLast('\\') . 'not found',
                    'status' => Response::HTTP_NOT_FOUND,
                ], Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof AccessDeniedHttpException) {
                return response()->json([
                    'errors' => 'You are not authorized.',
                    'status' => Response::HTTP_FORBIDDEN,
                ], Response::HTTP_FORBIDDEN);
            }

            if ($e instanceof QueryException) {
                Log::error($e);
                return response()->json([
                    'errors' => 'Database error.',
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            if ($e instanceof ValidationException) {
                return response()->json([
                    'errors' => $e->errors(),
                    'status' => Response::HTTP_BAD_REQUEST,
                ], Response::HTTP_BAD_REQUEST);
            }

            if (! $e instanceof ValidationException) {
                Log::error($e);
                return response()->json([
                    'errors' => 'An unexpected error occurred.',
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });
    })->create();
