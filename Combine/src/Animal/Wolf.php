<?php

namespace App\Animal;

use App\Food\AbstractFood;
use App\Food\Meat;

class Wolf extends AbstractAnimal
{
    public function __construct(string $name, int $howMuchCanEat)
    {
        parent::__construct($name, $howMuchCanEat);
        $this->food = new Meat();
    }

    public function getFood(): AbstractFood
    {
        return $this->food;
    }
}
