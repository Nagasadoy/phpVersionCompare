<?php

namespace App;

class ConsoleReport extends Report
{
    public function render(array $rawData): void
    {
        $text = '==Консольный отчет==' . PHP_EOL;
        $text .= $this->getTextReport($rawData);
        echo $text;
    }
}
