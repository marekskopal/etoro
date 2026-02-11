<?php

declare(strict_types=1);

namespace MarekSkopal\Etoro\Exception;

abstract class ApiException extends \Exception
{
    public function __construct(string $message = '', int $code = 500)
    {
        parent::__construct($message, $code);
    }

    public static function fromCode(int $code = 500): self
    {
        return match ($code) {
            400 => new BadRequestException('Bad Request'),
            401 => new UnauthorizedException('Unauthorized'),
            403 => new ForbiddenException('Forbidden'),
            404 => new NotFoundException('Not Found'),
            408 => new TimeoutException('Timeout'),
            429 => new TooManyRequestsException('Too Many Requests'),
            500 => new InternalServerErrorException('Internal Server Error'),
            default => new InternalServerErrorException('Internal Server Error'),
        };
    }
}
