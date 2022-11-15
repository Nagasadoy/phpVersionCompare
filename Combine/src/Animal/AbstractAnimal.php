<?php

namespace App\Animal;

use App\Food\AbstractFood;

abstract class AbstractAnimal
{
    protected AbstractFood $food;
    protected int $howMuchCanEat;
    protected string $name;

    public function __construct(string $name, int $howMuchCanEat)
    {
        $this->name = $name;
        $this->howMuchCanEat = $howMuchCanEat;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFood():AbstractFood
    {
        return $this->food;
    }

    public function getHowMuchCanEat(): int
    {
        return $this->howMuchCanEat;
    }

}
