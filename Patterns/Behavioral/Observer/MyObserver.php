<?php

namespace App\Patterns\Behavioral\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Lair implements \SplSubject
{
    public bool $supplyBlock = false;
    public bool $isAttack = false;

    private SplObjectStorage $observers;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function eventSupplyBlock()
    {
        echo 'Соплай блок' . PHP_EOL;
        $this->supplyBlock = true;
        $this->notify();
    }

    public function eventAtack()
    {
        echo 'На логово напали!' . PHP_EOL;
        $this->isAttack = true;
        $this->notify();
    }
}


class ZergObserverSupply implements SplObserver
{

    public function update(SplSubject $lair): void
    {
        if ($lair->supplyBlock) {
            echo 'Соплай блок, нужно построить больше оверсиров' . PHP_EOL;
            $lair->supplyBlock = false;
        }
    }
}

class ZergObserverAttack implements SplObserver
{

    public function update(SplSubject $lair): void
    {
        if ($lair->isAttack) {
            echo 'Превратить рабов в плетки' . PHP_EOL;
        }
    }
}

/**
 * Клиентский код
 */

$lair = new Lair();
$lair->attach(new ZergObserverAttack());
$lair->attach(new ZergObserverSupply());
if (rand(1, 100) < 50) {
    $lair->eventAtack();
}
if (rand(1, 5) > 3) {
    $lair->eventSupplyBlock();
}