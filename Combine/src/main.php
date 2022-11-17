<?php

namespace App;

use Exception;

require_once( __DIR__ .'/../vendor/autoload.php');

$eater1 = new Punish(new Sheep('sheep1', 10), 1);
$eater2 = new Sheep('sheep2', 5);

$eater3 = new Wolf('ff', 3);
$eater4 = new Wolf('pp', 11);

$eater4 = new Punish($eater4, 20);

$group = new EaterGroup('стадо овец');

try {
    $group->add($eater2);
    $group->add($eater1);
//    $group->add($eater3);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

$foodContainer = new FoodContainer(
    [
        new FoodRow(new Apple(), 20),
        new FoodRow(new Meat(), 20),
    ]
);

$combine = new Combine(
    eaters: [$group, $eater3, $eater4],
    foodContainer: $foodContainer
);

$combine->feed();

//$report1 = new ConsoleReport([$eater4, $eater3]);
//$report2 = new FileReport([$group]);

$reporter = new Reporter([new ConsoleReport(), new FileReport([$group])]);
$reporter->render($combine->dataForReport);



