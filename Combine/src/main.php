<?php
namespace App;
use App\Animal\PunishedState;
use App\Combine\Combine;
use App\Food\Apple;
use App\Food\Meat;
use App\Herd\Herd;
use App\Animal\Sheep;
use App\Animal\Wolf;
use App\Report\CommonReport;
use App\Report\ConsoleRender;
use App\Report\FileRender;

require_once ('../vendor/autoload.php');

$sheep1 = new Sheep('dolly', 5, new PunishedState(1));

$sheep2 = new Sheep('dolly2', 4);


$wolf = new Wolf('volk', 10);

$herd = new Herd('стадо 1', Sheep::class);

try {
    $herd->add($sheep1);
    $herd->add($sheep2);
} catch (\Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

$foods = [
    Apple::class => 10,
    Meat::class => 5
];

$report = new CommonReport([new ConsoleRender(), new FileRender()]);
$report->addInBlackList($wolf);

$combine = new Combine(
    members: [$herd, $wolf],
    foodContainers: $foods,
    report: $report
);

$combine->feed();

print_r($combine->getFoodContainers());

$report->render();



