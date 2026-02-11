<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Exception;

class UnprocessableEntityException extends ApiException
{
    public function __construct(string $message = '', int $code = 422)
    {
        parent::__construct($message, $code);
    }
}
