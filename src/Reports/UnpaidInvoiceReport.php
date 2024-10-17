<?php

namespace Reports;

use Models\Database\MySQLDatabase;
use Reports\ReportTableGenerator;

class UnpaidInvoiceReport implements IReport
{
    private MySQLDatabase $db;
    private ?string $startDate;
    private ?string $endDate;
    private ?float $minAmount;
    private ?float $maxAmount;
    private ?string $clientName;
    private ?string $sortColumn;
    private string $sortOrder;

    public function __construct(ReportRequestObj $reportRequest)
    {
        $this->db = new MySQLDatabase();
        $this->startDate = $reportRequest->getStartDate();
        $this->endDate = $reportRequest->getEndDate();
        $this->minAmount = $reportRequest->getMinAmount();
        $this->maxAmount = $reportRequest->getMaxAmount();
        $this->clientName = $reportRequest->getClientName();
        $this->sortColumn = $reportRequest->getSortColumn();
        $this->sortOrder = $reportRequest->getSortOrder();
    }

    private function getReportQuery(): string
    {

        $query = '';
        $query .= '    SELECT  ';
        $query .= '        c.name AS client_name,  ';
        $query .= '        c.nip,  ';
        $query .= '        c.bank_account_nr,  ';
        $query .= '        i.invoice_number,  ';
        $query .= '        i.due_date,  ';
        $query .= '        i.total_amount ';
        $query .= '    FROM  ';
        $query .= '        clients c ';
        $query .= '    JOIN  ';
        $query .= '        invoices i ON c.id = i.customer_id ';
        $query .= '    LEFT JOIN  ';
        $query .= '        payments p ON i.id = p.invoice_id ';
        $query .= '    WHERE  ';
        $query .= '        p.id IS NULL ';
        $query .= '        AND i.due_date < CURDATE() ';

        if ($this->startDate) {
            $query .= ' AND i.due_date >= ' . $this->db->escapeString($this->startDate);
        }

        if ($this->endDate) {
            $query .= ' AND i.due_date <= ' . $this->db->escapeString($this->endDate);
        }

        if ($this->minAmount) {
            $query .= ' AND i.total_amount >= ' . (float)$this->minAmount;
        }

        if ($this->maxAmount) {
            $query .= ' AND i.total_amount <= ' . (float)$this->maxAmount;
        }

        if ($this->clientName) {
            $query .= ' AND c.name LIKE ' . $this->db->escapeString('%' . $this->clientName . '%');
        }

        $allowedSortColumns = ['invoice_number', 'due_date', 'total_amount', 'client_name', 'nip'];
        $sortColumn = in_array($this->sortColumn, $allowedSortColumns) ? $this->sortColumn : 'due_date';
        $query .= ' ORDER BY ' . $sortColumn . ' ' . $this->sortOrder;

        return $query;
    }

    public function generateReport(): string
    {
        $query = $this->getReportQuery();
        $queryResult = $this->db->fetchAll($query);
        $reportGenerator = new ReportTableGenerator($queryResult);
        return $reportGenerator->generateReport('Raport Nierozliczonych Faktur');
    }
}
