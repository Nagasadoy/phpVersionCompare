<?php

namespace App;

class Combine
{
    /**
     * @var CanEatInterface[]
     */
    private array $eaters;

    private FoodContainer $foodContainer;
    public array $report;

    public function __construct(array $eaters, FoodContainer $foodContainer)
    {
        $this->eaters = $eaters;
        $this->foodContainer = $foodContainer;
    }

    public function getFoodContainer()
    {
        return $this->foodContainer;
    }

    public function feed(): void
    {
        $this->report = [];

        foreach ($this->eaters as $eater){
            $this->report[$eater->getName()] = $eater->eat($this->foodContainer);
        }
    }
}