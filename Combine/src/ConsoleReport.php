<?php

namespace App;

use SplObjectStorage;

class ConsoleReport implements ReportInterface
{

    public function __construct(private SplObjectStorage $blackList = new SplObjectStorage())
    {
    }

    public function render(array $data): void
    {
        foreach ($data as $row){
            $currentEater = $row['eater'];
            if($this->blackList->contains($currentEater)){
                continue;
            }

            $e = $currentEater;

            if($e->isGroup()){
                echo 'Стадо' . PHP_EOL;
            } else {
                echo 'Не стадо' . PHP_EOL;
            }

            echo $currentEater->getType() .' ' . $currentEater->getName() . ' '. ' скушало ';

            foreach ($row['foods'] as $food){
                echo $food['food'] . ' в количестве ' . $food['amount'] . PHP_EOL;
            }
        }
    }
}