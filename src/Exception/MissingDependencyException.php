<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\Exception;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\ClientInterface;
use RuntimeException;
use Shlinkio\Shlink\TestUtils\ApiTest\ApiTestCase;
use Shlinkio\Shlink\TestUtils\DbTest\DatabaseTestCase;

use function sprintf;

class MissingDependencyException extends RuntimeException implements ExceptionInterface
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function forApiClient(): self
    {
        return new self(sprintf(
            'An API client was not provided. Call %s::setApiClient() with a %s instance in order to be able '
            . 'to test API calls.',
            ApiTestCase::class,
            ClientInterface::class,
        ));
    }

    public static function forEntityManager(): self
    {
        return new self(sprintf(
            'An Entity Manager was not provided. Call %s::setEntityManager() with a %s instance in order to be able '
            . 'to test databases.',
            DatabaseTestCase::class,
            EntityManagerInterface::class,
        ));
    }
}
