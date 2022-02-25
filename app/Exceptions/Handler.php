<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Auth\Events\Authenticated;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
    public function register()
    {
        $this->reportable(function (Throwable $exception) {
            $debug = config('app.debug');
            $message = '';
            $status_code = 500;
            // cek jika eksepsinya dikarenakan model tidak ditemukan
            if ($exception instanceof ModelNotFoundException) {
                $message = 'Resource is not found';
                $status_code = 404;
            }
            //  cek jika eksepsinya dikarenakan resource tidak ditemukan
            elseif ($exception instanceof NotFoundHttpException) {
                $message = 'Endpoint is not found';
                $status_code = 404;
            }
            //  cek jika eksepsinya dikarenakan method tidak diizinkan
            elseif ($exception instanceof MethodNotAllowedHttpException) {
                $message = 'Method is not allowed';
                $status_code = 405;
            }
            //  cek jika eksepsinya dikarenakan kegagalan validasi
            else if ($exception instanceof ValidationException) {
                $validationErrors = $exception->validator->errors()->getMessages();
                $validationErrors = array_map(function ($error) {
                    return array_map(function ($message) {
                        return $message;
                    }, $error);
                }, $validationErrors);
                $message = $validationErrors;
                $status_code = 405;
            }
            //  cek jika eksepsinya dikarenakan kegagalan query
            else if ($exception instanceof QueryException) {
                if ($debug) {
                    $message = $exception->getMessage();
                } else {
                    $message = 'Query failed to execute';
                }
                $status_code = 500;
            }
            $rendered = parent::render(request(), $exception);
            $status_code = $rendered->getStatusCode();
            if (empty($message)) {
                $message = $exception->getMessage();
            }
            $errors = [];
            if ($debug) {
                $errors['exception'] = get_class($exception);
                $errors['trace'] = explode("\n", $exception->getTraceAsString());
            }
            return response()->json([
                'status'    => 'error',
                'message'   => $message,
                'data'      => null,
                'errors'    => $errors,
            ], $status_code);
        });
    }

    public function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'status' => 'error',
            'message' => 'unauthenticate',
            'data' => null
        ], 401);
    }
}
