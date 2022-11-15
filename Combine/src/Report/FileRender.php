<?php

namespace App\Report;

class FileRender implements ReportRenderInterface
{

    public function render(string $text): void
    {
        fwrite(fopen('report.txt','w+'), $text);
    }
}