<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\Helper;

use Closure;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\TestCase;

abstract class SeededTestCase extends TestCase
{
    private static ?Closure $seedFixtures = null;

    /**
     * @param callable(): void $seedFixtures
     */
    public static function setSeedFixturesCallback(callable $seedFixtures): void
    {
        self::$seedFixtures = Closure::fromCallable($seedFixtures);
    }

    #[Before]
    final public function seedFixturesIfProvided(): void
    {
        if (self::$seedFixtures !== null) {
            (self::$seedFixtures)();
        }
    }
}
