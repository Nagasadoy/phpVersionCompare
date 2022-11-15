<?php

namespace App\Food;

class FoodContainer
{
    public function __construct(public AbstractFood $typeFood, public int $amount)
    {
    }
}