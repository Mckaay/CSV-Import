<?php

declare(strict_types=1);

namespace App\csvImport\Core;

class CsvValidator
{
    public function validate(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File does not exist: {$filePath}");
        }

        if (!is_readable($filePath)) {
            throw new \InvalidArgumentException("File is not readable: {$filePath}");
        }

        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        if (strtolower($fileExtension) !== 'csv') {
            throw new \InvalidArgumentException("File is not a CSV: {$filePath}");
        }

        if (filesize($filePath) === 0) {
            throw new \InvalidArgumentException("CSV file is empty: {$filePath}");
        }
    }

    public function validateConsistency(array $headers, array $content): void
    {
        $headerCount = count($headers);
        foreach ($content as $index => $row) {
            if (count($row) !== $headerCount) {
                throw new \RuntimeException("Inconsistent number of columns in row " . ($index + 2));
            }
        }
    }
}
