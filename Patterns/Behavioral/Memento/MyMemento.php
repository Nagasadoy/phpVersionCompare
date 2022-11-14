<?php

namespace App\Patterns\Behavioral\Memento;

/**
 * Оригинальный объект (Карта)
 */
class Map
{
    public const WIDTH = 4;
    public const HEIGHT = 4;

    private array $map;

    public function __construct(private string $region)
    {
        $this->map = [
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0]
        ];
    }

    public function setRegion(string $region): Map
    {
        $this->region = $region;
        return $this;
    }

    public function incCell(int $x, int $y): void
    {
        $this->map[$x][$y]++;
    }

    public function save(): MapSnapShotInterface
    {
        return new MapSnapshot($this->map, $this->region);
    }

    public function restore(MapSnapShotInterface $snapShot): void
    {
        $this->map = $snapShot->getMap();
        $this->region = $snapShot->getRegion();
    }

}

interface MapSnapShotInterface
{
    public function printMapState(): void;

    public function getMap(): array;

    public function getRegion(): string;
}

/**
 * Снимок
 */
class MapSnapshot implements MapSnapShotInterface
{
    private string $date;

    public function __construct(private readonly array $map, private readonly string $region)
    {
        $this->date = date('Y-m-d H:i:s');
    }

    /**
     * @return MapSnapShotInterface[]
     */
    public function getMap(): array
    {
        return $this->map;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function printMapState(): void
    {
        echo '[' . PHP_EOL;
        for ($i = 0; $i < Map::HEIGHT; $i++) {
            echo '  [';
            for ($j = 0; $j < Map::WIDTH; $j++) {
                echo $this->map[$i][$j] . ' ';
            }
            echo ']' . PHP_EOL;
        }
        echo ']' . PHP_EOL;
    }
}

/**
 * Опекун
 */
class History
{
    /**
     * @var MapSnapshot[]
     */
    private array $snapshots = [];

    public function __construct(private readonly Map $map)
    {
    }

    /**
     * Бэкап
     */
    public function saveState(): void
    {
        $this->snapshots[] = $this->map->save();
    }

    public function undo(): void
    {
        if (count($this->snapshots) == 0) {
            return;
        }

        $snapShot = array_pop($this->snapshots);
        $this->map->restore($snapShot);
    }

    public function history(): void
    {
        echo 'История' . PHP_EOL;
        foreach ($this->snapshots as $snapshot) {
            $snapshot->printMapState();
            echo $snapshot->getRegion() . PHP_EOL;
        }
    }
}

$map = new Map('north');

$history = new History($map);

for ($i = 0; $i < 10; $i++) {
    $map->incCell(rand(0, 3), rand(0, 3));
    $history->saveState();
}
$map->setRegion('another');
$history->saveState();
$history->history();

$history->undo();
$history->undo();
$history->undo();
$history->undo();
$history->undo();
$history->undo();
$history->undo();
$history->undo();
$history->undo();
$history->undo();
$history->undo();

echo 'Отмена всех действий кроме первого' . PHP_EOL;

print_r($map);

