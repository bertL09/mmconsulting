<?php
namespace Reports;


class ReportFactory
{
    public function createReport(ReportRequestObj $reportRequest)
    {
         // Zalecane wydzielenie typów raportów do Enum dla lepszej czytelności i bezpieczeństwa
        switch ($reportRequest->getReportType()) {
            case 'overpayments':
                return new OverpaymentReport($reportRequest);
            case 'underpayments':
                return new UnderpaymentReport($reportRequest);
            case 'unpaid_invoices':
                return new UnpaidInvoiceReport($reportRequest);
            default:
                throw new \Exception("Nieznany typ raportu.");
        }
    }
}
