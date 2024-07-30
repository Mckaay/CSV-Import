<?php

declare(strict_types=1);

namespace App\csvImport\Core;

class CsvImporter implements Importer
{
    private CsvReader $csvReader;
    private Importer $importer;
    private DataTransfomer $dataTransfomer;
    public function __construct(
        private string $tableName,
        private string $filePath,
        Importer $importer,
        DataTransfomer $dataTransfomer
    ) {
        $this->csvReader = new CsvReader($this->filePath);
        $this->importer = $importer;
        $this->dataTransfomer = $dataTransfomer;
        $this->import($this->tableName, $this->dataTransfomer->transformData($this->csvReader->getContent()));
    }


    public function import(string $tableName, array $data): void
    {
        $this->importer->import($tableName, $data);
    }
}
