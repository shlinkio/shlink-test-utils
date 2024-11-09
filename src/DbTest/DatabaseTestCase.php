<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\DbTest;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\TestCase;
use Shlinkio\Shlink\TestUtils\Exception\MissingDependencyException;

abstract class DatabaseTestCase extends TestCase
{
    private static EntityManagerInterface|null $em = null;

    public static function setEntityManager(EntityManagerInterface $em): void
    {
        self::$em = $em;
    }

    final protected function getEntityManager(): EntityManagerInterface
    {
        if (self::$em === null) {
            throw MissingDependencyException::forEntityManager();
        }

        return self::$em;
    }

    /**
     * Create a repository instance for provided empty.
     * If $repositoryName is not provided, default repository will be returned via $em->getRepository($entityName)
     *
     * @template TEntity of object
     * @template TRepo of ObjectRepository<TEntity>
     * @param class-string<TEntity> $entityName
     * @param class-string<TRepo>|null $repositoryName
     * @return ($repositoryName is null ? ObjectRepository<TEntity> : TRepo)
     */
    final protected function createRepository(string $entityName, string|null $repositoryName = null): ObjectRepository
    {
        $em = $this->getEntityManager();
        if ($repositoryName === null) {
            return $em->getRepository($entityName);
        }

        return new $repositoryName($em, $em->getClassMetadata($entityName));
    }

    #[Before]
    final public function beginTransaction(): void
    {
        $this->getEntityManager()->beginTransaction();
    }

    #[After]
    final public function rollback(): void
    {
        $this->getEntityManager()->rollback();
        $this->getEntityManager()->clear();
    }
}
