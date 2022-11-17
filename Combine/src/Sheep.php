<?php

namespace App;

class Sheep extends Eater
{
    public function canEatThisFood(FoodInterface $food): bool{
        return $food instanceof Apple;
    }

    public function eat(FoodContainerInterface $foodContainer): void
    {
        $this->ate += $foodContainer->getFood(new Apple(), $this->amountCanEat);
    }

    public function getType(): string
    {
        return 'овца';
    }
}