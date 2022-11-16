<?php

namespace App;

class FoodContainer implements FoodContainerInterface
{
    /**
     * @param FoodRow[] $foodRows
     */
    public function __construct(private readonly array $foodRows)
    {
    }

    public function getContainerContent(): array
    {
        return $this->foodRows;
    }

    public function getFood(FoodInterface $food, int $amount): int
    {
        $getted = 0;
        foreach ($this->foodRows as $foodRow) {

            if ($foodRow->isFood($food)) {
                $getted += $foodRow->getFood($amount);
            }
            if ($amount === $getted) {
                break;
            }
        }
        return $getted;
    }
}