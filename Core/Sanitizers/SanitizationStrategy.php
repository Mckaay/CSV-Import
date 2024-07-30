<?php

declare(strict_types=1);

namespace App\csvImport\Core\Sanitizers;

interface SanitizationStrategy
{
    public static function sanitize(mixed $value): mixed;
}
