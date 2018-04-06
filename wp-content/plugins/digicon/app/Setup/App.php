<?php

namespace Digicon\Setup;

use Illuminate\Database\Capsule\Manager as Capsule;

class App
{
    const ROUTE_DIRECTORY = DIGICON_EVENTS_PLUGIN_DIR . 'config/routes.php';

    public function make()
    {
        $this->registerRoutes();
        $this->registerProviders();
    }

    protected function registerRoutes()
    {
        require_once self::ROUTE_DIRECTORY;

        foreach ($routes as $key => $value) {
            $class = new $key;
            $class->$value();
        }
    }

    /**
     * Register providers here...
     * 
     */
    public function registerProviders()
    {
        global $wpdb;
        
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => defined('DB_DRIVER') ? DB_DRIVER : 'mysql',
            'host'   => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset'  => DB_CHARSET,
            'collation' => DB_COLLATE ? DB_COLLATE : DB_CHARSET . '_unicode_ci',
            'prefix'    => $wpdb->prefix,
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}