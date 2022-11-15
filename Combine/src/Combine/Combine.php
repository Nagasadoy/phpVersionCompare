<?php

namespace App\Combine;

use App\Food\AbstractFood;
use App\Food\FoodContainer;
use App\Herd\HerdMember;
use App\Report\CommonReport;

class Combine
{
    /**
     * @var HerdMember[]
     */
    private array $members;

    private array $foodContainers;

    public function __construct(array $members, array &$foodContainers, private CommonReport $report)
    {
        $this->members = $members;
        $this->foodContainers = $foodContainers;
    }

    public function feed(): void
    {
        foreach ($this->members as $member) {
            $member->eat($this->foodContainers, $this->report);
        }
    }

    public function getFoodContainers(): array
    {
        return $this->foodContainers;
    }
}