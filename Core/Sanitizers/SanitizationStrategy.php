<?php
declare(strict_types=1);

namespace App\csvImport\Core\Sanitizers;

interface SanitizationStrategy
{
    public function sanitize(mixed $value): mixed;
}