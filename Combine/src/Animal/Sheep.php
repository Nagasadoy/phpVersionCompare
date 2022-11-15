<?php

namespace App\Animal;

use App\Food\Apple;

class Sheep extends AbstractAnimal
{
    public function __construct(string $name, int $howMuchCanEat)
    {
        parent::__construct($name, $howMuchCanEat);
        $this->food = new Apple();
    }
}