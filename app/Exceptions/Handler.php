<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $e
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return $this->returnValidationErrors($e);
        } elseif ($e instanceof ModelNotFoundException) {
            $model_name = strtolower(class_basename($e->getModel()));
            return $this->errorResponse("Dose not exists any $model_name with the specific identifier", 404);
        } elseif ($e instanceof AuthorizationException) {
            return $this->errorResponse($e->getMessage(), 403);
        } elseif ($e instanceof NotFoundHttpException) {
            return $this->errorResponse('The specified url can not be found', 404);
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('The specified method for the request in invalid', 405);
        } elseif ($e instanceof HttpException) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        } elseif ($e instanceof QueryException) {
            $error_code = $e->errorInfo[1];
            if ($error_code === 1451) {
                return $this->errorResponse('Can not remove this resource permanently. It is related with other resource', 409);
            }
        }

        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        return $this->errorResponse('Unexpected Exception. Try later', 500);
    }

    public function returnValidationErrors($e)
    {
        $errors = array_map(function ($item) {
            return $item[0];
        }, $e->errors());

        return $this->validationResponse(['errors' => $errors], 422);
    }
}
