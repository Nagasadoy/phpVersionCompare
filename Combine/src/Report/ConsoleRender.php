<?php

namespace App\Report;

class ConsoleRender implements ReportRenderInterface
{
    public function render(string $text): void
    {
        echo $text . PHP_EOL;
    }
}