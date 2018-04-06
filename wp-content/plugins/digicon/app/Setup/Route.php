<?php

namespace Digicon\Setup;

class Route
{
    /**
     * Bootstrap plugin dependencies
     *
     * @return  $this
     */
    public function bootstrap()
    {
        add_action('admin_menu', array($this, 'buildMenu'));
        return $this;
    }
}