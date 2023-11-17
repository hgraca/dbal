<?php

namespace Doctrine\DBAL\Platforms;

use Doctrine\DBAL\SQL\Builder\DefaultSelectSQLBuilder;
use Doctrine\DBAL\SQL\Builder\SelectSQLBuilder;

/**
 * Provides the behavior, features and SQL dialect of the PostgreSQL 9.4+ database platform.
 *
 * @deprecated Use {@see PostgreSQLPlatform} instead.
 */
class PostgreSQL94Platform extends PostgreSQLPlatform
{
    public function createSelectSQLBuilder(): SelectSQLBuilder
    {
        return new DefaultSelectSQLBuilder($this, 'FOR UPDATE', null);
    }
}
