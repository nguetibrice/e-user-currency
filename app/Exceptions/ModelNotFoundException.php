<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Throwable;

class ModelNotFoundException extends BaseException
{
    public function __construct(string $message, int $code = Response::HTTP_NOT_FOUND, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
