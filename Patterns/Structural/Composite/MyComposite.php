<?php

/**
 * Базовый класс
 */
abstract class CombatUnit
{

    protected CombatUnit $squad;

    public function setSquad(?CombatUnit $squad): void
    {
        $this->squad = $squad;
    }

    public function getSquad(): CombatUnit
    {
        return $this->squad;
    }


    public function add(CombatUnit $unit): void { }

    public function remove(CombatUnit $unit): void { }

    public function isComposite(): bool
    {
        return false;
    }

    abstract public function action(): void;
}

class Solider extends CombatUnit
{
    public function __construct(private string $name)
    {
    }

    public function action(): void
    {
        echo $this->name . ': к бою готов! ';
    }
}

class Squad extends CombatUnit
{
    private SplObjectStorage $members;

    public function __construct(private readonly string $name)
    {
        $this->members = new SplObjectStorage();
    }

    public function isComposite(): bool
    {
        return true;
    }

    public function add(CombatUnit $unit): void {
        $this->members->attach($unit);
        $unit->setSquad($this);
    }

    public function remove(CombatUnit $unit): void {
        $this->members->detach($unit);
        $unit->setSquad(null);
    }

    public function action(): void
    {
        echo 'Отряд: ' . $this->name;
        echo '[';
        foreach ($this->members as $combatUnit){
            $combatUnit->action();
        }
        echo ']';
    }
}

/**
 * Клиентский код
 */

$squad1 = new Squad('A');
$squad1->add(new Solider('a1'));
$squad1->add(new Solider('a2'));

$squad2 = new Squad('B');
$squad2->add(new Solider('b1'));
$squad2->add(new Solider('b2'));

$army = new Squad('ARMY');
$army->add($squad1);
$army->add($squad2);

$army->action();
