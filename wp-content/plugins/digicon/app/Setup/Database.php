<?php

namespace Digicon\Setup;

use Illuminate\Database\Capsule\Manager as Capsule;

require_once ABSPATH . 'wp-admin/includes/upgrade.php';

/**
 *
 */

class Database
{
    public function __construct()
    {
        $this->registerProviders();
    }

    public function init()
    {
        $this->install();
        $this->unInstall();
    }

    public function install()
    {
        register_activation_hook(DIGICON_EVENTS_INIT_FILE, array($this, 'registerTables'));
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
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset' => DB_CHARSET,
            'collation' => DB_COLLATE ? DB_COLLATE : DB_CHARSET . '_unicode_ci',
            'prefix' => $wpdb->prefix,
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     *
     * @return void
     */
    public function registerTables()
    {
        if (get_option('create_events_table')) {
            return;
        }

        update_option('create_events_table', 1);

        global $wpdb;

        // creates wp_awesomeness in database if not exists
        $table = $wpdb->prefix . "events";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            `id` int(9) NOT NULL AUTO_INCREMENT,
            `code` char(10) NOT NULL,
            `title` varchar(30) NOT NULL,
            `deleted_at` timestamp NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
        UNIQUE (`id`)
        ) $charset_collate;";
        dbDelta($sql);

    }

    /**
     * Uninstall hook
     *
     * @return void
     */
    public function unInstall()
    {
        register_deactivation_hook(DIGICON_EVENTS_INIT_FILE, array($this, 'removeTables'));
    }

    /**
     * Unintstall function
     *
     * @return void
     */
    public function removeTables()
    {
        global $wpdb;

        delete_option('create_events_table');

        // creates wp_awesomeness in database if not exists
        $table = $wpdb->prefix . "events";

        $sql = "DROP TABLE `$table`";

        $wpdb->query($sql);
    }
}
