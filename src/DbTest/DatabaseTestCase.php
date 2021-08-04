<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\DbTest;

use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Shlinkio\Shlink\TestUtils\Exception\MissingDependencyException;

abstract class DatabaseTestCase extends TestCase
{
    private static ?EntityManagerInterface $em = null;

    public static function setEntityManager(EntityManagerInterface $em): void
    {
        self::$em = $em;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        if (self::$em === null) {
            throw MissingDependencyException::forEntityManager();
        }

        return self::$em;
    }

    final protected function setUp(): void
    {
        $this->getEntityManager()->beginTransaction();
        $this->beforeEach();
    }

    final public function tearDown(): void
    {
        $this->afterEach();
        $this->getEntityManager()->rollback();
        $this->getEntityManager()->clear();
    }

    protected function beforeEach(): void
    {
    }

    protected function afterEach(): void
    {
    }
}
