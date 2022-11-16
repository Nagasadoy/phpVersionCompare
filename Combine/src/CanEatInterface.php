<?php

namespace App;

interface CanEatInterface
{
    public function eat(FoodContainerInterface $foodContainer): void;

    public function canEatThisFood(FoodInterface $food): bool;

    public function getAmountHowMuchCanEat():int;

    public function getName():string;
}