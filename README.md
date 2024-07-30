# Simple CSV Data to Database Importer

# How to use:


Create FieldMapper for example:
```php 
class SampleFieldMapper extends FieldsMapper 
{
protected static array $mapping = [
'date',
'check #',
'description',
'amount',
];
protected static array $columnTypes = [
'date' => ColumnType::DATE,
'check #' => ColumnType::INTEGER,
'description' => ColumnType::TEXT,
'amount' => ColumnType::DECIMAL,
];
}
```

then

```php
`$csvImporter = new CsvImporter(
    {tableName},
    {filePath},
    new MySqlImporter({tableName},new SampleFieldMapper()),
    new DataTransfomer(new SampleFieldMapper())
    );`
```
To DO: 
1. Use Dependency Injection Container,
2. Use DataSet to store values from file,
3. Add option to define delimiter,
4. Handle Duplicates
5. Much more ;)

