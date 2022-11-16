<?php

namespace App;

class Punish implements EaterInterface
{
    public function __construct(private readonly EaterInterface $eater, private readonly int $punishmentCount)
    {
    }

    public function getEater(): EaterInterface
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

    public function getType(): string
    {
        return $this->eater->getType();
    }

    public function isGroup(): bool
    {
        return $this->eater->isGroup();
    }
}