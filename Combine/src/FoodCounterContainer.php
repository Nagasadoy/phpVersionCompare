<?php

namespace App;

class FoodCounterContainer implements FoodContainerInterface
{
    private array $report = [];

    public function __construct(private readonly FoodContainerInterface $foodContainer)
    {
    }

    public function getFood(FoodInterface $food, int $amount): int
    {
        $amount = $this->foodContainer->getFood($food, $amount);
        $this->report[] = ['food' => $food->getName(), 'amount' => $amount];
        return $amount;
    }

    public function clearReport()
    {
        $this->report = [];
    }

    public function getReport(): array
    {
        return $this->report;
    }
}