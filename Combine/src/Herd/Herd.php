<?php

namespace App\Herd;
use App\Report\CommonReport;
use App\Report\ReportInterface;
use SplObjectStorage;

class Herd extends HerdMember
{
    private SplObjectStorage $members;

    public function __construct(public readonly string $name, public readonly string $membersType)
    {
        $this->members = new SplObjectStorage();
    }

    /**
     * @throws \Exception
     */
    public function add(HerdMember $member): void
    {
        if($member::class != $this->membersType){
            throw new \Exception(
                'Невозможно добавить в стадо ' . $this->membersType . ' объект класса ' . $member::class
            );
        }

        $this->members->attach($member);
        $member->setHerd($this);
    }

    public function isHerd(): bool
    {
        return true;
    }

    public function eat(array &$foods, ReportInterface $report): void
    {
        foreach ($this->members as $member) {
            $member->eat($foods, $report);
        }
    }
}