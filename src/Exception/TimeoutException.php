<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Exception;

class TimeoutException extends ApiException
{
    public function __construct(string $message = '', int $code = 408)
    {
        parent::__construct($message, $code);
    }
}
