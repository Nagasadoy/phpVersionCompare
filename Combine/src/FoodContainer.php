<?php

namespace App;

class FoodContainer implements FoodContainerInterface
{
    /**
     * @param FoodRow[] $foodRows
     */
    public function __construct(private array $foodRows)
    {
    }

    public function getContainerContent(): array
    {
        return $this->foodRows;
    }

    public function getFood(FoodInterface $food, int $amount): array
    {
        $eated = 0;

        foreach ($this->foodRows as $foodRow) {

            if ($foodRow->isFood($food)) {
                $getted = $foodRow->getFood($amount);
                $eated += $getted;
                $amount -= $getted;
            }
            if ($amount === 0) {
                break;
            }
        }
        return [$food->getName() => $eated];
    }
}