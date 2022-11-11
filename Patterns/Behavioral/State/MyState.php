<?php

namespace App\Patterns\Behavioral\State;

class Car
{
    public function __construct(private CarState $carState, public float $speed=0, public bool $light=false)
    {
        $this->carState->setCar($this);
    }

    /**
     * @param CarState $carState
     */
    public function setCarState(CarState $carState): void
    {
        $this->carState = $carState;
    }


    /**
     * Контекст позволяет изменять объект Состояния во время выполнения.
     */
    public function changeGear(CarState $state): void
    {
        echo "Меняем передачу!" . PHP_EOL;
        $this->carState = $state; // меняем состояние
        $this->carState->setCar($this);
    }

    public function drive():void
    {
        $this->carState->drive();
    }

    public function lightsOn():void
    {
        $this->carState->lightsOn();
    }

}

abstract class CarState
{
    /**
     * @var Car для изменения состояния у контекста
     */
    protected Car $car;

    public function setCar(Car $car):void
    {
        $this->car = $car;
    }

    abstract public function lightsOn():void;
    abstract public function drive():void;
}

class TopGear extends CarState
{

    public function lightsOn(): void
    {
        echo 'Фары горят' . PHP_EOL;
        $this->car->light = true;
    }

    public function drive(): void
    {
        echo 'Едет не быстро 20км/ч' . PHP_EOL;
        $this->car->speed = 20;
    }
}

class Muted extends CarState
{
    public function lightsOn(): void
    {
        echo 'Фары не горят' . PHP_EOL;
        $this->car->light = false;
    }

    public function drive(): void
    {
        echo 'Стоит на месте' . PHP_EOL;
        $this->car->speed = 0;
    }
}

class FourthGear extends CarState
{
    public function lightsOn(): void
    {
        echo 'Фары горят' . PHP_EOL;
        $this->car->light = true;
    }

    public function drive(): void
    {
        echo 'Едет со скоростью 60 км/ч' . PHP_EOL;
        $this->car->speed = 60;
    }
}

$car = new Car(new Muted());
$car->drive();
$car->lightsOn();

$car->changeGear(new TopGear());
$car->drive();

$car->changeGear(new FourthGear());
$car->drive();

echo 'END';