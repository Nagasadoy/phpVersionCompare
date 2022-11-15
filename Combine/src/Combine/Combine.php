<?php

namespace App\Combine;

use App\Food\AbstractFood;
use App\Food\FoodContainer;
use App\Herd\HerdMember;

class Combine
{
    /**
     * @var HerdMember[]
     */
    private array $members;

    private array $foodContainers;

    public function __construct(array $members, array &$foodContainers)
    {
        $this->members = $members;
        $this->foodContainers = $foodContainers;
    }

    public function feed(): void
    {
        foreach ($this->members as $member) {
            $member->eat($this->foodContainers);
        }
    }

    public function getFoodContainers(): array
    {
        return $this->foodContainers;
    }
}