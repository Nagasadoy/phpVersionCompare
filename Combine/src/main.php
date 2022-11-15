<?php
namespace App;
use App\Animal\Sheep;

require_once ('../vendor/autoload.php');

$sheep = new Sheep('dolly', 5);

print_r($sheep);
