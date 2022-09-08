<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\TestUtils\Helper;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Process\Process;

class TestHelper
{
    public function createTestDb(
        array $createDbCommand = ['vendor/bin/doctrine', 'orm:schema-tool:create'],
        array $migrateDbCommand = ['vendor/bin/doctrine-migrations', 'migrations:migrate'],
        array $dropSchemaCommand = ['vendor/bin/doctrine', 'orm:schema-tool:drop'],
        array $runSqlCommand = ['vendor/bin/doctrine', 'dbal:run-sql'],
    ): void {
        $process = new Process($this->withFlags([...$dropSchemaCommand, '--force']));
        $process->run();// The database may not exist, so let's not enforce a successful run

        // The migrations table is not part of Shlink's schema, so we need to drop it separately
        $process = new Process($this->withFlags([...$runSqlCommand, 'DROP TABLE migrations']));
        $process->run(); // The migrations table may not exist, so let's not enforce a successful run

        $process = new Process($this->withFlags($createDbCommand));
        $process->mustRun();

        $process = new Process($this->withFlags($migrateDbCommand));
        $process->mustRun();
    }

    public function seedFixtures(EntityManagerInterface $em, array $config): void
    {
        $paths = $config['paths'] ?? [];
        if (empty($paths)) {
            return;
        }

        $loader = new Loader();
        foreach ($paths as $path) {
            $loader->loadFromDirectory($path);
        }

        $executor = new ORMExecutor($em, new ORMPurger());
        $executor->execute($loader->getFixtures());
    }

    private function withFlags(array $command): array
    {
        return [...$command, '--no-interaction', '-q'];
    }
}
