<?php

namespace App\Patterns\Structural\Bridge;

/**
 * Абстракция
 */
abstract class Tower
{

    public function __construct(private TowerBuilderInterface $builder)
    {
    }


    public function changeBuilder(TowerBuilderInterface $builder): Tower
    {
        $this->builder = $builder;
        return $this;
    }

    public function getBuilder(): TowerBuilderInterface
    {
        return $this->builder;
    }

    abstract public function fire(): void;
}

class ArrowTower extends Tower
{

    public function fire(): void
    {
        $this->getBuilder()->build();
        echo 'Стрелковая башня стреляет стрелами, ее построил ' . $this->getBuilder()->getNameBuilder() . PHP_EOL;
    }
}

class FireTower extends Tower
{

    public function fire(): void
    {
        $this->getBuilder()->build();
        echo 'Огненная башня стреляет огнем, ее построил ' . $this->getBuilder()->getNameBuilder() . PHP_EOL;
    }
}

/**
 * Реализация
 */
interface TowerBuilderInterface
{
    public function getNameBuilder(): string;
    public function build():void;
}

class Orc implements TowerBuilderInterface
{

    public function getNameBuilder(): string
    {
        return 'орк';
    }

    public function build(): void
    {
        echo '@' . PHP_EOL . '@' . PHP_EOL .$this->getNameBuilder(). PHP_EOL;
    }
}

class Human implements TowerBuilderInterface
{
    public function getNameBuilder(): string
    {
        return 'человек';
    }

    public function build(): void
    {
        echo '#' . PHP_EOL . '#' . PHP_EOL .$this->getNameBuilder(). PHP_EOL;
    }
}

/**
 * Клиентский код
 */

$human = new Human();
$orc = new Orc();

$arrowRower = new ArrowTower($human);
$arrowRower->fire();

$arrowRower->changeBuilder($orc);
$arrowRower->fire();

$fireTower = new FireTower($orc);
$fireTower->fire();

$fireTower->changeBuilder($human);
$fireTower->fire();

