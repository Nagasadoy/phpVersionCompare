<?php

namespace App;

interface EaterInterface
{
    public function eat(FoodContainerInterface $foodContainer): void;

    public function canEatThisFood(FoodInterface $food): bool;

    public function getAte(): int;

    public function getAmountHowMuchCanEat(): int;

    public function getName(): string;

    public function getType(): string;

    public function isGroup(): bool;
}
