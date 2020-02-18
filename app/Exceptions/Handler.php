<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ResponseTrait;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
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
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        // Modify exception code if it is zero, because it should not happen that in case of exception error code is zero
        if ($exception->getCode() === 0) {
            $errorCode = ErrorCodes::DEFAULT_ERROR;
        } else {
            $errorCode = $exception->getCode();
        }

        switch (true) {
            case $exception instanceof ModelNotFoundException:
                return $this->response('Record not found', null, 404, 'error');
            case $exception instanceof NotFoundHttpException:
                return $this->response('Not found', null, 404, 'error');

            // Validatation exceptions
            case $exception instanceof ValidationException:
                $messageArray = collect($exception->validator->messages()->all());
                return $this->response($messageArray->implode(', '), null, ErrorCodes::VALIDATION_ERROR, 'error');

            // Render Notice exceptions as they are
            case $exception instanceof NoticeException:
                return $this->response($exception->getMessage(), $exception->getData(), $errorCode, 'error');

            // If exception occures which is not handled above
            default:
                // In production just rewrite any exception to server error 500
                if (app()->isProduction()) {
                    return $this->response('Server error', null, 500, 'error');
                // In any other environment render exception as it is
                } else {
                    return $this->response($exception->getMessage(), null, $errorCode, 'error');
                }
        }
    }
}
