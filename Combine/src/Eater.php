<?php

namespace App;

abstract class Eater implements EaterInterface
{
    protected int $ate;

    public function __construct(public readonly string $name, protected readonly int $amountCanEat)
    {
        $this->ate = 0;
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

    public function isGroup(): bool
    {
        return false;
    }

    public function getAte(): int
    {
        return $this->ate;
    }
}
