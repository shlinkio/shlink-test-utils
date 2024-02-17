<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\Helper;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Runner\Version;
use ReflectionMethod;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as Html;
use SebastianBergmann\CodeCoverage\Report\PHP;
use SebastianBergmann\CodeCoverage\Report\Xml\Facade as Xml;
use SebastianBergmann\FileIterator\Facade as FileIteratorFacade;

use function debug_backtrace;
use function file_exists;

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

    public static function createCoverageForDirectories(array $dirs): CodeCoverage
    {
        $filter = new Filter();
        foreach ($dirs as $dir) {
            foreach ((new FileIteratorFacade())->getFilesAsArray($dir) as $file) {
                $filter->includeFile($file);
            }
        }

        return new CodeCoverage((new Selector())->forLineCoverage($filter), $filter);
    }

    public static function exportCoverage(
        ?CodeCoverage $coverage,
        string $basePath,
        bool $pretty = false,
        bool $mergeWithExisting = false,
    ): void {
        if ($coverage === null) {
            return;
        }

        $covPath = $basePath . '.cov';
        if ($mergeWithExisting && file_exists($covPath)) {
            $coverage->merge(require $covPath);
        }

        if ($pretty) {
            (new Html())->process($coverage, $basePath . '/coverage-html');
        } else {
            (new PHP())->process($coverage, $covPath);
            (new Xml(Version::getVersionString()))->process($coverage, $basePath . '/coverage-xml');
        }
    }
}
