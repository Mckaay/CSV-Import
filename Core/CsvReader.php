<?php
declare(strict_types=1);

namespace App\csvImport\Core;

use App\csvImport\SampleFieldMapper;
use http\Exception\InvalidArgumentException;

class CsvReader
{
    private array $headers = [];
    private array $content = [];
    private CsvValidator $validator;


    public function __construct(private string $filePath,  CsvValidator $validator = null)
    {
        $this->validator = $validator ?? new CsvValidator();
        $this->validator->validate($this->filePath);
        $this->validator->validateConsistency($this->headers,$this->content);
        $this->parse();
    }

    public function getContent(): array {
        return $this->content;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    private function parse(): void
    {
        $csvData = array_map('str_getcsv', file($this->filePath));

        if (empty($csvData)) {
            throw new \InvalidArgumentException("Theres no proper csv data in this file");
        }

        $this->headers = array_shift($csvData);
        $this->content = $csvData;
    }
}
