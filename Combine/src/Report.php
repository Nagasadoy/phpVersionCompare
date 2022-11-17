<?php

namespace App;

use SplObjectStorage;

abstract class Report implements ReportInterface
{
    protected SplObjectStorage $blackList;

    /**
     * @param EaterInterface[] $blackListArray
     */
    public function __construct(array $blackListArray = [])
    {
        $this->blackList = new SplObjectStorage();
        foreach ($blackListArray as $blackListItem) {
            $this->blackList->attach($blackListItem);
        }
    }

    public function getTextReport(array $rawData): string
    {
        $text = '';
        foreach ($rawData as $row) {
            $currentEater = $row['eater'];

            if ($this->blackList->contains($currentEater)) {
                continue;
            }

            if ($currentEater->isGroup()) {
                $type = 'стадо<' . $currentEater->getType() . '>';
            } else {
                $type = $currentEater->getType();
            }

            $text .= $type . ' ' . "'" . $currentEater->getName() . "'" . ' скушало ';

            $foodAndCountForCurrentEater = [];
            foreach ($row['foods'] as $food) {
                if (isset($foodAndCountForCurrentEater[$food['food']])) {
                    $foodAndCountForCurrentEater[$food['food']] += $food['amount'];
                } else {
                    $foodAndCountForCurrentEater[$food['food']] = $food['amount'];
                }
            }

            foreach ($foodAndCountForCurrentEater as $foodName => $amount) {
                $text .= $foodName . ' в количестве ' . $amount . ' штук ' ;
            }
            $text .= PHP_EOL;
        }
        return $text;
    }
}
