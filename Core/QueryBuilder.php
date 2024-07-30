<?php

declare(strict_types=1);

namespace App\csvImport\Core;

interface QueryBuilder
{
    public function buildInsertQuery(string $tableName, array $data): string;
}
