<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\Helper;

use PHPUnit\Framework\Attributes\Test;
use ReflectionMethod;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Report\PHP;
use SebastianBergmann\FileIterator\Facade as FileIteratorFacade;

use function debug_backtrace;
use function microtime;
use function register_shutdown_function;

class CoverageHelper
{
    public static function resolveCoverageId(string $baseClass, string|int $dataName): string
    {
        return $baseClass . self::resolveTestMethod($baseClass) . self::resolveTestDataSet($dataName);
    }

    private static function resolveTestMethod(string $baseClass): string
    {
        $stack = debug_backtrace();

        // Get the first class in the stack which is baseClass, then get its first test method
        foreach ($stack as $t) {
            if (! isset($t['object'], $t['class']) || $t['class'] !== $baseClass) {
                continue;
            }

            $ref = new ReflectionMethod($t['object'], $t['function']);
            $attributes = $ref->getAttributes();
            foreach ($attributes as $attr) {
                if ($attr->getName() === Test::class) {
                    return '::' . $t['function'];
                }
            }
        }

        return '';
    }

    private static function resolveTestDataSet(string|int $dataName): string
    {
        return ! empty($dataName) ? '#' . $dataName : '';
    }

    /**
     * @param non-empty-string[] $dirs
     * @param string|null $shutdownExportBasePath - If provided, it will export coverage to this location on shutdown
     */
    public static function createCoverageForDirectories(
        array $dirs,
        ?string $shutdownExportBasePath = null,
    ): CodeCoverage {
        $filter = new Filter();
        foreach ($dirs as $dir) {
            foreach ((new FileIteratorFacade())->getFilesAsArray($dir) as $file) {
                $filter->includeFile($file);
            }
        }

        $coverage = new CodeCoverage((new Selector())->forLineCoverage($filter), $filter);

        if ($shutdownExportBasePath !== null) {
            register_shutdown_function(function () use ($shutdownExportBasePath, $coverage): void {
                $id = (string) microtime(as_float: true);
                $covPath = $shutdownExportBasePath . '/' . $id . '.cov';
                (new PHP())->process($coverage, $covPath);
            });
        }

        return $coverage;
    }
}
