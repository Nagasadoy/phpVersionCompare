<?php

namespace App;

abstract class Eater implements CanEatInterface
{

    public function __construct(public readonly string $name, protected readonly int $amountCanEat)
    {
    }

    public function canEatThisFood(FoodInterface $food): bool
    {
        return false;
    }

    public function getAmountHowMuchCanEat(): int
    {
        return $this->amountCanEat;
    }

    public function getName(): string
    {
        return $this->name;
    }
}