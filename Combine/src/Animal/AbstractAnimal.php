<?php

namespace App\Animal;

use App\Food\AbstractFood;
use App\Herd\HerdMember;

abstract class AbstractAnimal extends HerdMember
{
    protected AbstractFood $food;
    protected int $howMuchCanEat;
    protected string $name;

    public function __construct(string $name, int $howMuchCanEat)
    {
        $this->name = $name;
        $this->howMuchCanEat = $howMuchCanEat;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHowMuchCanEat(): int
    {
        return $this->howMuchCanEat;
    }

    abstract public function getFood(): AbstractFood;

    public function eat(array &$foods): void
    {
        if (isset($foods[$this->food::class])) {
            $foods[$this->food::class] -= $this->howMuchCanEat;
        }
        echo 'Эта ' . static::class . ' по имени ' . $this->name  . ' съела ' . $this->howMuchCanEat
            . ' штук ' . $this->getFood()->getFoodName() . PHP_EOL;
    }

}
