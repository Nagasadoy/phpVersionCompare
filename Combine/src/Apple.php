<?php

namespace App;

class Apple implements FoodInterface
{

    public function getName(): string
    {
        return 'яблоко';
    }
}