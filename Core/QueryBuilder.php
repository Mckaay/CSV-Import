<?php

namespace App\csvImport\Core;

interface QueryBuilder
{
    public function buildInsertQuery(string $tableName, array $data): string;
}