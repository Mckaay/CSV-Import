<?php

declare(strict_types=1);

namespace App\csvImport\Core\Sanitizers;

class IntegerSanitizer implements SanitizationStrategy
{
    public static function sanitize(mixed $value): int
    {
        return (int) preg_replace('/[^0-9-]/', '', $value);
    }
}
