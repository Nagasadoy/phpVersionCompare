<?php

namespace App;

class LimitFoodContainer implements FoodContainerInterface
{
    public function __construct(private readonly FoodContainerInterface $foodContainer, readonly int $limit)
    {
    }

    public function getFood(FoodInterface $food, int $amount): int
    {
        return $this->foodContainer->getFood($food, min($amount, $this->limit));
    }
}
