<?php

enum DoughType: string
{
    case THIN = 'тонкое';
    case THICK = 'толстое';
}

abstract class Pizza
{

    public function create(DoughType $doughType): void
    {
        $this->addDough($doughType);
        $this->addCheese();
        $this->addMeat();
        $this->addVegetables();
        $this->bake();
    }

    public function addDough(DoughType $doughType): void
    {
        echo 'Делаем ' . $doughType->value . ' тесто' . PHP_EOL;
    }

    protected abstract function addCheese(): void;

    protected abstract function addMeat(): void;

    protected function addVegetables(): void { }

    protected function addFruits(): void { }

    protected abstract function bake(): void;

}

class PepperoniPizza extends Pizza
{

    protected function addCheese(): void
    {
       echo 'Добавляем моцареллу' . PHP_EOL;
    }

    protected function addMeat(): void
    {
        echo 'Добавляем копченую колбасу' . PHP_EOL;
    }

    protected function addVegetables(): void
    {
        echo 'Добавляем овощи' . PHP_EOL;
    }

    protected function bake(): void
    {
        echo 'Запекаем при температуре 200 градусов' . PHP_EOL;
    }
}

class HawaiianPizza extends Pizza
{

    protected function addCheese(): void
    {
        echo 'Добавляем какой-то сыр, который нужен для гавайской пиццы' . PHP_EOL;
    }

    protected function addMeat(): void
    {
        echo 'Добавляем курицу' . PHP_EOL;
    }

    protected function addFruits(): void
    {
        echo 'Добавляем ананасы' . PHP_EOL;
    }

    protected function bake(): void
    {
        echo 'Запекаем при температуре 220 градусов' . PHP_EOL;
    }
}

/**
 * Клиентский код
 */

$pizza1 = new PepperoniPizza();

echo '===========Создаем пиццу пепперони=============' . PHP_EOL;
$pizza1->create(DoughType::THICK);

$pizza2 = new HawaiianPizza();

echo '===========Создаем пиццу гавайскую=============' . PHP_EOL;
$pizza2->create(DoughType::THIN);

