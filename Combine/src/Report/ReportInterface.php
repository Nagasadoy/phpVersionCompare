<?php

namespace App\Report;

use App\Animal\AbstractAnimal;

interface ReportInterface
{
    public function render(): void;

    public function addRow(AbstractAnimal $animal, int $willEat): void;
}