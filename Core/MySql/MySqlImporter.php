<?php
declare(strict_types=1);

namespace App\csvImport\Core\MySql;

use App\Core\Database\DB;
use App\csvImport\Core\Importer;

class MySqlImporter implements Importer
{
    private DB $db;
    private MySqlQueryBuilder $mySqlQueryBuilder;

    public function __construct(private string $tableName) {
        $this->db = DB::getInstance();
        $this->mySqlQueryBuilder = new mySqlQueryBuilder();
    }

    public function import(string $tableName, array $data): void
    {
        if (empty($data)) {
            return;
        }

        $query = $this->mySqlQueryBuilder->buildInsertQuery($this->tableName, $data);

        try {
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute();

            if ($result) {
                echo "Data imported successfully. Affected rows: " . $stmt->rowCount();
            } else {
                echo "Error importing data: " . implode(", ", $stmt->errorInfo());
            }
        } catch (\PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }


}