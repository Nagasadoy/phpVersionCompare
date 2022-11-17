<?php

namespace App;

class FileReport extends Report
{
    public function render(array $rawData): void
    {
        $text = '==Файловый отчет==' . PHP_EOL;
        $text .= $this->getTextReport($rawData);
        fwrite(fopen('report.txt', 'w+'), $text);
    }
}
