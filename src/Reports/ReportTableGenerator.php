<?php
namespace Reports;

use Models\DataTable;

class ReportTableGenerator
{
    private array $data;

    public function __construct(array $queryResult)
    {
        $this->setData($queryResult);
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function generateReport(string $reportTitle): string
    {
        if (!empty($this->data)) {
            return "<h2>{$reportTitle}</h2>" . (new DataTable($this->data))->generateTable();
        } else {
            return "<h2>Brak danych do wyświetlenia.</h2>";// Wszytskie takie teksty powtarzalne też do enumów żeby w wielu miejsach nie musieć zmieniać
        }
    }
}
