<?php

namespace App\Patterns\Creational\FactoryMethod;

interface TowerInterface
{
    public function fire():void;
}

// Конкретные башни
class ArrowTower implements TowerInterface
{

    public function fire(): void
    {
        echo '*Стрелковая башня стреляет стрелами*' . PHP_EOL;
    }
}

class FireTower implements TowerInterface
{
    public function fire(): void
    {
        echo '*Огненная башня стреляет огнем*' . PHP_EOL;
    }
}

class FrostTower implements TowerInterface
{
    public function fire(): void
    {
        echo '*Ледяная башня стреляет льдом*' . PHP_EOL;
    }
}

abstract class TowerCreator
{
    abstract public function towerCreate(): TowerInterface;

    public function createAndFire(): void{
        $tower = $this->towerCreate();
        $tower->fire();
    }
}

/**
 * Конкретные создатели
 */
class ArrowTowerCreator extends TowerCreator
{
    public function towerCreate(): TowerInterface
    {
        return new ArrowTower();
    }
}

class FrostTowerCreator extends TowerCreator
{
    public function towerCreate(): TowerInterface
    {
        return new FrostTower();
    }
}

class FireTowerCreator extends TowerCreator
{
    public function towerCreate(): TowerInterface
    {
        return new FireTower();
    }
}

/**
 * Клиентский код
 */

$fireTowerCreator = new FireTowerCreator();
$frostTowerCreator = new FrostTowerCreator();
$arrowTowerCreator = new ArrowTowerCreator();

$fireTowerCreator->createAndFire(); // Создали и сразу сделали действие присущее этому типу башни
$frostTowerCreator->createAndFire();
$arrowTowerCreator->createAndFire();

$fireTower = $fireTowerCreator->towerCreate();
print_r($fireTower);

