<?php

namespace App;

class Wolf extends Eater
{
    public function canEatThisFood(FoodInterface $food): bool
    {
        return $food instanceof Meat;
    }

    public function eat(FoodContainerInterface $foodContainer): void
    {
        $foodContainer->getFood(new Meat(), $this->amountCanEat);
    }

    public function getType(): string
    {
        return 'волк';
    }
}