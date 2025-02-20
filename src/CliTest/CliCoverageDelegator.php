<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\CliTest;

use Psr\Container\ContainerInterface;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use Symfony\Component\Console\Application;
use Symfony\Component\EventDispatcher\EventDispatcher;

use function getenv;

class CliCoverageDelegator
{
    public const COVERAGE_ID_ENV = 'COVERAGE_ID';

    public function __construct(private readonly CodeCoverage|null $coverage)
    {
    }

    public function __invoke(ContainerInterface $c, string $serviceName, callable $callback): Application
    {
        /** @var Application $app */
        $app = $callback();
        $eventDispatcher = new EventDispatcher();
        $coverage = $this->coverage;

        // When the command starts, start collecting coverage
        $eventDispatcher->addListener(
            'console.command',
            static function () use (&$coverage): void {
                $id = getenv(self::COVERAGE_ID_ENV);
                if ($id && $coverage !== null) {
                    $coverage->start($id);
                }
            },
        );

        // When the command ends, stop collecting coverage
        $eventDispatcher->addListener(
            'console.terminate',
            static function () use (&$coverage): void {
                $id = getenv(self::COVERAGE_ID_ENV);
                if ($id && $coverage !== null) {
                    $coverage->stop();
                }
            },
        );

        $app->setDispatcher($eventDispatcher);

        return $app;
    }
}
