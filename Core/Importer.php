<?php
declare(strict_types=1);

namespace App\csvImport\Core;

interface Importer
{
    public function import(string $tableName, array $data): void;
}