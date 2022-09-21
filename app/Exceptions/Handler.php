<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        //for other serice 
        $this->reportable(function (Throwable $e) {
            //
        });

        //for front end respone
        $this->renderable(function(Throwable $e,$request){
            if($e instanceof NotFoundHttpException){
                return response()->json([
                    "message"=>'u are lost :('
                ],404);
            }

            if($e instanceof ModelNotFoundException){
                return response()->json([
                    "message"=>'no model :('
                ],404);
            }

            
        });
    }
}
