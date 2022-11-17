<?php

namespace App;

use Exception;

class EaterGroup implements EaterInterface
{
    private \SplObjectStorage $group;
    private ?string $type;

    public function __construct(public readonly string $name)
    {
        $this->group = new \SplObjectStorage();
        $this->type = null;
    }

    /**
     * @throws Exception
     */
    public function add(EaterInterface $eater): void
    {
        if (is_null($this->type)) {
            $this->type = $eater->getType();
        }

        if ($this->type !== $eater->getType()) {
            throw new WrongTypeEaterException('В это стадо: [' . $this->type . '] под названием '
                . "'" . $this->name . "'" . ' нельзя добавить объект [' . $eater->getType() . '] по имени '
                . "'" . $eater->getName() . "'");
        } else {
            $this->group->attach($eater);
        }
    }

    public function eat(FoodContainerInterface $foodContainer): void
    {
        foreach ($this->group as $eater) {
            $eater->eat($foodContainer);
        }
    }

    /**
     * @throws Exception
     */
    public function canEatThisFood(FoodInterface $food): bool
    {
        if (count($this->group) == 0) {
            throw new Exception('Стадо не может быть пустым!');
        }
        return $this->group[0]->canEatThisFood($food);
    }

    public function getAmountHowMuchCanEat(): int
    {
        $sum = 0;
        foreach ($this->group as $eater) {
            $sum += $eater->getAmountHowMuchCanEat();
        }
        return $sum;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isGroup(): bool
    {
        return true;
    }

    public function getAte(): int
    {
        $sum = 0;
        foreach ($this->group as $eater) {
            $sum += $eater->getAte();
        }
        return $sum;
    }
}
