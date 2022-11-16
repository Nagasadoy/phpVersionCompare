<?php

namespace App;

class Punish implements CanEatInterface
{
    public function __construct(private readonly CanEatInterface $eater, private readonly int $punishmentCount)
    {
    }

    public function getEater(): CanEatInterface
    {
        return $this->eater;
    }

    public function eat(FoodContainerInterface $foodContainer): void
    {
        $foodDecorator = new LimitFoodContainer($foodContainer, $this->punishmentCount);
        $this->eater->eat($foodDecorator);
    }

    public function canEatThisFood(FoodInterface $food): bool
    {
        return $this->eater->canEatThisFood($food);
    }

    public function getAmountHowMuchCanEat(): int
    {
        return $this->punishmentCount;
    }

    public function getName(): string
    {
        return $this->eater->getName();
    }
}