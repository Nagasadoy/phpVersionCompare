<?php

namespace App;

class Reporter implements ReportInterface
{
    /**
     * @param ReportInterface[] $reports
     */
    public function __construct(private readonly array $reports)
    {
    }

    public function render(array $rawData): void
    {
        foreach ($this->reports as $report) {
            $report->render($rawData);
        }
    }
}
