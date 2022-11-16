<?php

namespace App;

class Sheep extends Eater
{
    public function canEatThisFood(FoodInterface $food): bool{
        return $food instanceof Apple;
    }

    public function eat(FoodContainerInterface $foodContainer): void
    {
        $foodContainer->getFood(new Apple(), $this->amountCanEat );
    }
}