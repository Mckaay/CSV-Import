<?php
declare(strict_types=1);

namespace App\csvImport\Core\Sanitizers;

class TextSanitizer implements SanitizationStrategy
{
    public function sanitize(mixed $value): string
    {
        return addslashes($value);
    }
}