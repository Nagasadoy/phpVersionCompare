<?php

namespace App;

class Wolf extends Eater
{
    public function canEatThisFood(FoodInterface $food): bool
    {
        return $food instanceof Meat;
    }

    public function eat(FoodContainerInterface $foodContainer): array
    {
        return $foodContainer->getFood(new Meat(), $this->amountCanEat);
    }
}