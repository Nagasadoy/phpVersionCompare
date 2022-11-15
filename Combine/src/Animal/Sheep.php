<?php

namespace App\Animal;

use App\Food\AbstractFood;
use App\Food\Apple;

class Sheep extends AbstractAnimal
{
    public function __construct(string $name, int $howMuchCanEat, AnimalState $animalState = new NormalState())
    {
        parent::__construct($name, $howMuchCanEat);
        $this->food = new Apple();
        $this->animalState = $animalState;
        $this->animalState->setAnimal($this);
    }

    public function getFood(): AbstractFood
    {
        return $this->food;
    }
}