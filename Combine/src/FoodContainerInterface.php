<?php

namespace App;

interface FoodContainerInterface
{
    public function getFood(FoodInterface $food, int $amount): int;
}