<?php

namespace Reports;

class ReportRequestObj
{
    private string $reportType;
    private ?string $startDate = null;
    private ?string $endDate = null;
    private ?float $minAmount = null;
    private ?float $maxAmount = null;
    private ?string $clientName = null;
    private ?string $sortColumn = null;
    private string $sortOrder = 'ASC';

    public function __construct(string $reportType)
    {
        $this->reportType = $reportType;
    }

    public function getReportType(): string
    {
        return $this->reportType;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function getMinAmount(): ?float
    {
        return $this->minAmount;
    }

    public function getMaxAmount(): ?float
    {
        return $this->maxAmount;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function getSortColumn(): ?string
    {
        return $this->sortColumn;
    }

    public function getSortOrder(): string
    {
        return $this->sortOrder == 'DESC' ? 'DESC' : 'ASC';
    }

    public function setStartDate(?string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setEndDate(?string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function setMinAmount(?float $minAmount): void
    {
        $this->minAmount = $minAmount;
    }

    public function setMaxAmount(?float $maxAmount): void
    {
        $this->maxAmount = $maxAmount;
    }

    public function setClientName(?string $clientName): void
    {
        $this->clientName = $clientName;
    }

    public function setSortColumn(?string $sortColumn): void
    {
        $this->sortColumn = $sortColumn;
    }

    public function setSortOrder(string $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }
}
