<?php

namespace App\Animal;

use App\Food\AbstractFood;
use App\Herd\HerdMember;
use App\Report\ReportInterface;

abstract class AbstractAnimal extends HerdMember
{
    protected AbstractFood $food;
    protected int $howMuchCanEat;
    protected string $name;
    protected AnimalState $animalState;

    public function __construct(string $name, int $howMuchCanEat)
    {
        $this->name = $name;
        $this->howMuchCanEat = $howMuchCanEat;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHowMuchCanEat(): int
    {
        return $this->howMuchCanEat;
    }

    abstract public function getFood(): AbstractFood;

    public function eat(array &$foods, ReportInterface $report): void
    {
        $this->animalState->eat($foods, $report);
    }
}

