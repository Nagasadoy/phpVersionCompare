<?php

namespace App\Report;

interface ReportRenderInterface
{
    public function render(string $text):void;
}