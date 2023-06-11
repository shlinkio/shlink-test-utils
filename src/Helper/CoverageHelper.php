<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\Helper;

use PHPUnit\Framework\Attributes\Test;
use ReflectionMethod;

use function debug_backtrace;

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
}
