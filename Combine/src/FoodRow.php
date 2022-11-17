<?php

namespace App;

class FoodRow
{
    public function __construct(public readonly FoodInterface $food, private int $amount)
    {
    }

    public function isFood(FoodInterface $food): bool
    {
        return $food::class == $this->food::class;
    }

    public function getFood(int $amount): int
    {
        $outer = min($this->amount, $amount);
        $this->amount -= $outer;
        return $outer;
    }
}
