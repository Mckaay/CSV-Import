Simple CSV data to database importer.

How to use:


`$csvImporter = new CsvImporter(
    {tableName},
    {filePath},
    new MySqlImporter({tableName},new SampleFieldMapper()),
    new DataTransfomer(new SampleFieldMapper())
    );`

To DO: 
1. Use Dependency Injection Container,
2. Use DataSet to store values from file,
3. Add option to define delimiter,
4. Handle Duplicates
5. More ;)

