<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Exception;

use Psr\Http\Message\ResponseInterface;

abstract class ApiException extends \Exception
{
    public function __construct(string $message = '', int $code = 500)
    {
        parent::__construct($message, $code);
    }

    public static function fromResponse(ResponseInterface $response): self
    {
        $message = $response->getBody()->getContents();

        return match ($response->getStatusCode()) {
            400 => new BadRequestException($message),
            401 => new UnauthorizedException($message),
            403 => new ForbiddenException($message),
            404 => new NotFoundException($message),
            408 => new TimeoutException($message),
            422 => new UnprocessableEntityException($message),
            429 => new TooManyRequestsException($message),
            500 => new InternalServerErrorException($message),
            default => new InternalServerErrorException($message),
        };
    }
}
