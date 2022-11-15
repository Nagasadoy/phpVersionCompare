<?php

namespace App\Animal;

use App\Report\ReportInterface;

class NormalState extends AnimalState
{
    public function eat(array &$foods, ReportInterface $report): void
    {
        if (isset($foods[$this->animal->getFood()::class])) {

            $willEat = $this->animal->getHowMuchCanEat();

            // Если осталось меньше чем полагается
            if($foods[$this->animal->getFood()::class] < $willEat){
                $willEat = $foods[$this->animal->getFood()::class];
                $foods[$this->animal->getFood()::class] = 0;
                echo 'Остатки' . PHP_EOL;
            } else {
                $foods[$this->animal->getFood()::class] -= $willEat;
            }

            $report->addRow($this->animal, $willEat);
        }
    }
}