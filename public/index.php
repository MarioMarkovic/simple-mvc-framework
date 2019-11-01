<?php 
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Model;

$mod = new Model();

var_dump($mod->select("SELECT * FROM tablica")->getResults());