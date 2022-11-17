<?php

namespace App;

class Meat implements FoodInterface
{
    public function getName(): string
    {
        return 'мясо';
    }
}
