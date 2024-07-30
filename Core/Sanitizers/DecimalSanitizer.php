<?php

declare(strict_types=1);

namespace App\csvImport\Core\Sanitizers;

class DecimalSanitizer implements SanitizationStrategy
{
    public static function sanitize($value): float
    {
        $value = str_replace(['$', ','], '', $value);
        $value = str_replace(",", ".", $value);
        $value = preg_replace('/\.(?=.*\.)/', '', $value);
        return floatval($value);
    }
}
