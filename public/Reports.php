<?php

require_once __DIR__ . '/autoload.php';

use Reports\ReportFactory;
use Reports\ReportRequestObj;

$reportType = $_GET['report'] ?? null;
$startDate = $_GET['startDate'] ?? null;
$endDate = $_GET['endDate'] ?? null;
$minAmount = $_GET['minAmount'] ?? null;
$maxAmount = $_GET['maxAmount'] ?? null;
$clientName = $_GET['clientName'] ?? null;
$sortColumn = $_GET['sortColumn'] ?? null;
$sortOrder = $_GET['sortOrder'] ?? 'ASC';

if ($reportType) {
    try {
        $reportRequest = new ReportRequestObj($reportType);
        if ($startDate) $reportRequest->setStartDate($startDate);
        if ($endDate) $reportRequest->setEndDate($endDate);
        if ($minAmount) $reportRequest->setMinAmount((float)$minAmount);
        if ($maxAmount) $reportRequest->setMaxAmount((float)$maxAmount);
        if ($clientName) $reportRequest->setClientName($clientName);
        if ($sortColumn) $reportRequest->setSortColumn($sortColumn);
        $reportRequest->setSortOrder($sortOrder);

        $reportFactory = new ReportFactory();
        $report = $reportFactory->createReport($reportRequest);

        echo $report->generateReport();
    } catch (\Exception $e) {
        echo "Błąd: " . $e->getMessage();
    }
} else {
    echo "Nie podano typu raportu.";
}
