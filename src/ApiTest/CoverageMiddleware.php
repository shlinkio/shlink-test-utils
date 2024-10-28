<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\ApiTest;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SebastianBergmann\CodeCoverage\CodeCoverage;

/**
 * A PSR-15 middleware used to capture coverage sent by classes extending ApiTestCase
 */
class CoverageMiddleware implements MiddlewareInterface
{
    public const COVERAGE_ID_HEADER = 'X-Coverage-Id';

    public function __construct(private readonly CodeCoverage|null $coverage)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $coverageId = $request->getHeaderLine(self::COVERAGE_ID_HEADER);
        if ($coverageId === '') {
            return $handler->handle($request);
        }

        $this->coverage?->start($coverageId);
        try {
            return $handler->handle($request);
        } finally {
            $this->coverage?->stop();
        }
    }
}
