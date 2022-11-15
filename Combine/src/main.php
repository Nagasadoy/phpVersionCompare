<?php
namespace App;
use App\Combine\Combine;
use App\Food\Apple;
use App\Food\FoodContainer;
use App\Food\Meat;
use App\Herd\Herd;
use App\Animal\Sheep;
use App\Animal\Wolf;

require_once ('../vendor/autoload.php');

$sheep1 = new Sheep('dolly', 5);

$sheep2 = new Sheep('dolly2', 4);

$wolf = new Wolf('volk', 10);

$herd = new Herd('стадо 1', Sheep::class);

try {
    $herd->add($sheep1);
    $herd->add($sheep2);
//    $herd->add($wolf);
} catch (\Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

$foods = [
    Apple::class => 10,
    Meat::class => 5
];

$combine = new Combine(
    members: [$herd, $wolf],
    foodContainers: $foods
);

$combine->feed();

print_r($combine->getFoodContainers());



