<?php

namespace App;

class Sheep extends Eater
{
    public function canEatThisFood(FoodInterface $food): bool{
        return $food instanceof Apple;
    }

    public function eat(FoodContainerInterface $foodContainer): array
    {
        return $foodContainer->getFood(new Apple(), $this->amountCanEat );
    }
}