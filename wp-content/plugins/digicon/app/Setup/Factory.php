<?php

namespace Digicon\Setup;

class Factory
{
    /**
     * @var mixed
     */
    protected $routes = [];

    /**
     * @param array $routes
     */
    public function __construct($routes = [])
    {
        $this->setRoutes($routes);
    }

    /**
     * @param array $routes
     */
    public function init($routes = [])
    {
        #check if route. ovveride existing route set in constructor
        if ($routes) {
            $this->setRoutes($routes);
        }

        $this->registerRoutes();
    }

    /**
     * @param array $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    protected function registerRoutes()
    {
        foreach ($this->getRoutes() as $key => $value) {
            $class = new $key();
            $class->$value();
        }
    }
}
