<?php

namespace App;

interface ReportInterface
{
    public function render(array $data): void;
}