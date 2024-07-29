<?php
declare(strict_types=1);

namespace App\csvImport\Core\Sanitizers;

class DateSanitizer implements SanitizationStrategy
{
    public function sanitize(mixed $value): string
    {
        $date = \DateTime::createFromFormat('m/d/Y', $value);
        return $date ? $date->format('Y-m-d') : '0000-00-00';
    }
}