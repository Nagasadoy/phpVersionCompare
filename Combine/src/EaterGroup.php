<?php

namespace App;

use Exception;

class EaterGroup implements CanEatInterface
{
    private \SplObjectStorage $group;

    public function __construct(public readonly string $name, public readonly string $type)
    {
        $this->group = new \SplObjectStorage();
    }

    /**
     * @throws Exception
     */
    public function add(CanEatInterface $eater): void
    {
        if($eater::class == $this->type
            || ($eater::class == Punish::class && $eater->getEater()::class == $this->type)
            // || $eater::class == Punish::class
        ) {
            $this->group->attach($eater);
        } else {
            throw new Exception('В это стадо: ' . $this->type . ' нельзя добавить объект' . $eater::class);
        }
    }

    public function eat(FoodContainerInterface $foodContainer): void
    {
        foreach ($this->group as $eater)
        {
            $eater->eat($foodContainer);
        }
    }

    /**
     * @throws Exception
     */
    public function canEatThisFood(FoodInterface $food): bool
    {
        if(count($this->group) == 0){
            throw new Exception('Стадо не может быть пустым!');
        }
        return $this->group[0]->canEatThisFood($food);
    }

    public function getAmountHowMuchCanEat(): int
    {
        $sum = 0;
        foreach ($this->group as $eater){
            $sum += $eater->getAmountHowMuchCanEat();
        }
        return $sum;
    }

    public function getName(): string
    {
        return $this->name;
    }
}