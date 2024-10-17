<?php

namespace Reports;


interface IReport
{
    public function generateReport(): string;
}
