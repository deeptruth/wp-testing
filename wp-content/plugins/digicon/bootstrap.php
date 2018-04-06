<?php

use Digicon\Setup\App;
use Digicon\Setup\Database;
use Illuminate\Container\Container;

/**
 * Set up db after plugin's activation
 */

Database::init();

/**
 * Bootstrap container
 * @var Container
 */
$container = new Container;

$app = $container->make(App::class);

$app->make();