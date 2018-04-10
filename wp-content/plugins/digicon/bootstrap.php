<?php

require DIGICON_EVENTS_PLUGIN_DIR . 'config/routes.php';

use Digicon\Setup\Factory;
use Digicon\Setup\Database;
use Illuminate\Container\Container;

/**
 * Set up db after plugin's activation
 */

/**
 * Bootstrap container
 * @var Container
 */
$container = new Container;

$app = $container->make(Factory::class);

$app->init($routes);

$database = $container->make(Database::class);

$database->init();
