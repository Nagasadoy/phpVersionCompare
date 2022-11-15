<?php

namespace App\Herd;

use App\Report\ReportInterface;

abstract class HerdMember
{
    protected HerdMember $herd;

    public function setHerd(?HerdMember $herd): void
    {
        $this->herd = $herd;
    }

    public function getHerd(): HerdMember
    {
        return $this->herd;
    }

    public function add(HerdMember $member): void {}

    public function isHerd(): bool
    {
        return false;
    }

    abstract public function eat(array &$foods, ReportInterface $report): void;
}
