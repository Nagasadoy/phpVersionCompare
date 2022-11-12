<?php

enum IteratorField
{
    case PRICE;
    case MODEL;
    case COLOR;
}

class Car
{
    public function __construct(private readonly string $model, private readonly string $color, private readonly float $price)
    {
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

}

class CarIterator implements Iterator
{
    private int $position = 0;
    private array $arrayCollection = [];

    public function __construct(CarCollection $collection, IteratorField $type)
    {
        $this->arrayCollection = $collection->getCollection();

        usort($this->arrayCollection,function (Car $el1,Car $el2) use ($type){

            if($type == IteratorField::COLOR){
                return $el1->getColor() <=> $el2->getColor();
            }

            if($type == IteratorField::MODEL){
                return $el1->getModel() <=> $el2->getModel();
            }

            if($type == IteratorField::PRICE)
            {
                return -1 * ($el1->getPrice() <=> $el2->getPrice());
            }

            return $el1->getPrice() <=> $el2->getPrice();
        });
    }

    public function current(): mixed
    {
        return $this->arrayCollection[$this->position];
    }

    public function next(): void
    {
        $this->position+=1;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->arrayCollection[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}

class CarCollection implements IteratorAggregate
{
    private array $collection = [];

    public function getIterator(): Iterator
    {
        return new CarIterator($this, IteratorField::PRICE);
    }

    public function getColorIterator(): Iterator
    {
        return new CarIterator($this, IteratorField::COLOR);
    }

    public function getModelIterator(): Iterator
    {
        return new CarIterator($this, IteratorField::MODEL);
    }

    public function addCar(Car $car): void
    {
        $this->collection[] = $car;
    }

    public function getCollection(): array
    {
        return $this->collection;
    }
}


/**
 * Клиентский код
 */

$carCollection = new CarCollection();
$carCollection->addCar(new Car('BMW', 'red', 200_000));
$carCollection->addCar(new Car('BMW', 'white', 200_000));
$carCollection->addCar(new Car('BMW', 'white', 100_000));
$carCollection->addCar(new Car('BMW', 'green', 100_000));

$carCollection->addCar(new Car('Audi', 'black', 180_000));

$carCollection->addCar(new Car('TOYOTA', 'white', 150_000));

echo 'СОРТИРОВКА ПО ЦЕНЕ:' . PHP_EOL;

try {
    foreach ($carCollection->getIterator() as $car) {
        print_r($car);
    }
} catch (Exception $e) {
    echo 'Хмм почему то думает, что тут может выброситься exception!' . PHP_EOL;
}

echo 'СОРТИРОВКА ПО ЦВЕТУ:' . PHP_EOL;

foreach ($carCollection->getColorIterator() as $car) {
    print_r($car);
}


echo 'СОРТИРОВКА ПО МОДЕЛИ:' . PHP_EOL;

foreach ($carCollection->getModelIterator() as $car) {
    print_r($car);
}