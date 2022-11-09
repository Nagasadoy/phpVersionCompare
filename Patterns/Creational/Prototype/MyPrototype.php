<?php

namespace App\Patterns\Creational\Prototype;


use App\Patterns\Creational\AbstractFactory\Camp;

class Engine
{
    public function __construct(public readonly int $power, public readonly string $type)
    {
    }

}

class Driver
{
    public Car $car;
    public function __construct(public readonly string $name, public readonly string $surname)
    {
    }

    public function addCar(Car $car): void
    {
        $this->car=$car;
    }
}


class Car
{
    public function __construct(
        public readonly string $mark,
        public readonly string $color,
        public readonly string $country,
        private string $serialNumber,
        public Driver $driver,
        public Engine $engine
    )
    {
    }

    public function setSerialNumber(string $value):self
    {
        $this->serialNumber = $value;
        return $this;
    }

    public function __clone(): void
    {
        $this->serialNumber = 'not';
        $this->engine = clone $this->engine;
        $this->driver = clone $this->driver;
        $this->driver->car = $this;
    }
}

$driver = new Driver('Noname', 'Noname');
$engine = new Engine(250, 'v8');

$car = new Car('ford', 'white', 'USA', 'h213fd', $driver, $engine);

$car2 = clone $car;

/**
 * ОБЪЕКТЫ
 */
if($car->engine === $car2->engine){
    echo 'NO CLONE ENGINE' . PHP_EOL;
}

if($car->driver === $car2->driver){
    echo 'NO_CLONE DRIVER' . PHP_EOL;
}

/**
 * ПРИМИТИВЫ
 */
if($car->mark !== $car2->mark){
    echo 'NO_CLONE MARK' . PHP_EOL;
}

if($car->color !== $car2->color){
    echo 'NO_CLONE COLOR' . PHP_EOL;
}

if($car->country !== $car2->country){
    echo 'NO_CLONE COUNTRY' . PHP_EOL;
}

print_r($car);
print_r($car2);

$car2->setSerialNumber('ddd');
print_r($car2);
