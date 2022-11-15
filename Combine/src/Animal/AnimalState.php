<?php

namespace App\Animal;

use App\Report\ReportInterface;

abstract class AnimalState
{
    protected AbstractAnimal $animal;

    public function setAnimal(AbstractAnimal $animal): void
    {
        $this->animal = $animal;
    }

    abstract public function eat(array &$foods, ReportInterface $report): void;
}

