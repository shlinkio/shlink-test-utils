<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\CliTest;

use Shlinkio\Shlink\TestUtils\Helper\SeededTestCase;
use Symfony\Component\Process\Process;

use function implode;

use const PHP_EOL;

abstract class CliTestCase extends SeededTestCase
{
    private const SHLINK_CLI_ENTRY_POINT = 'bin/cli';

    /**
     * @param string[] $inputs
     * @return array{string, int|null}
     */
    final protected function exec(array $command, array $inputs = []): array
    {
        $process = new Process([self::SHLINK_CLI_ENTRY_POINT, ...$command]);
        $process->setInput(implode(PHP_EOL, $inputs));
        $process->mustRun(null, ['COVERAGE_ID' => static::class]);

        return [$process->getOutput(), $process->getExitCode()];
    }
}
