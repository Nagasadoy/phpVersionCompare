<?php

namespace App\Report;

use App\Animal\AbstractAnimal;
use SplObjectStorage;

class CommonReport implements ReportInterface
{

    private SplObjectStorage $blackList;
    private string $reportBody = '';
    /**
     * @var ReportRenderInterface[]
     */
    private array $renders;

    public function __construct(array $renders)
    {
        $this->blackList = new SplObjectStorage();
        $this->renders = $renders;
    }

    public function addRow(AbstractAnimal $animal, int $willEat): void
    {
        if (!$this->inBlacklist($animal)) {
            $row = 'Эта ' . $animal::class . ' по имени ' . $animal->getName() . ' съела ' . $willEat
                . ' штук ' . $animal->getFood()->getFoodName() . PHP_EOL;
            $this->reportBody .= $row;
        }
    }

    public function addInBlackList(AbstractAnimal $animal): void
    {
        $this->blackList->attach($animal);
    }

    private function inBlacklist(AbstractAnimal $animal): bool
    {
        if ($this->blackList->contains($animal)) {
            return true;
        }
        return false;
    }

    public function render(): void
    {
        if (count($this->renders) == 0) {
            echo 'Вы не указали ни один рендер для отчета' . PHP_EOL;
            return;
        }
        foreach ($this->renders as $render) {
            $render->render($this->reportBody);
        }
    }
}