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

    public function feed(): void
    {
        $this->report = [];
        $countedContainer = new FoodCounterContainer($this->foodContainer);
        foreach ($this->eaters as $eater) {
            $countedContainer->clearReport();
            //$eater->eat($this->foodContainer); Вот так было по-старому (раньше только выполнялись действия) а теперь
            // countedContainer также выполняет действия, но кроме этого подсчитывает кто и что съел
            $eater->eat($countedContainer);
            $this->report[] = ['eater' => $eater->getName(), 'foods' => $countedContainer->getReport()];
        }
    }
}